<?php
require_once APPROOT . '/models/Product.php';
require_once APPROOT . '/models/Order.php'; 
require_once APPROOT . '/models/OrderItem.php'; 

class ProductsController {
    private $productModel;
    private $orderModel;
    private $orderItemModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->orderModel = new Order();
        $this->orderItemModel = new OrderItem();
    }

    // 1. Trang danh sách sản phẩm (có tìm kiếm và lọc theo hãng)
    public function index()
    {
        // Lấy filter
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
        $brand   = isset($_GET['brand']) ? trim($_GET['brand']) : null;

        // Phân trang
        $limit = 6; // 6 sản phẩm mỗi trang
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        // Tổng sản phẩm
        $totalProducts = $this->productModel->countAll($keyword, $brand);
        $totalPages = ceil($totalProducts / $limit);

        // Lấy sản phẩm phân trang
        $products = $this->productModel->getPaginated($limit, $offset, $keyword, $brand);

        // Lấy brand list
        $brands = $this->productModel->getAllBrands();

        $data = [
            'products'     => $products,
            'brands'       => $brands,
            'currentBrand' => $brand,
            'keyword'      => $keyword,
            'currentPage'  => $page,
            'totalPages'   => $totalPages
        ];

        $this->loadview("public/products/index", $data);
    }


    // 2. Trang chi tiết sản phẩm
    public function detail() {
        // 1. Lấy tham số từ URL
        $slug = $_GET['slug'] ?? null;
        $id = $_GET['id'] ?? null; // Link cũ vẫn dùng ID

        $product = null;

        // 2. Tìm sản phẩm
        if ($slug) {
            $product = $this->productModel->findBySlug($slug);
        } elseif ($id) {
            $product = $this->productModel->find($id);
            
            // [REDIRECT SEO] Nếu vào bằng ID -> Chuyển sang Slug
            if ($product && !empty($product->slug)) {
                $cleanUrl = URLROOT . '/public/san-pham/' . $product->slug;
                header("Location: " . $cleanUrl, true, 301);
                exit;
            }
        }

        if (!$product) {
            // Xử lý lỗi 404
            die('Sản phẩm không tồn tại!'); 
        }

        $sizes = $this->productModel->getSizes($product->id); 

        $data = [
            'title' => $product->name,
            'product' => $product,
            'sizes' => $sizes
        ];
        $this->loadView('public/products/detail', $data);
    }

    // 3. Thêm vào giỏ hàng (Lưu vào Session)
    public function add($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['quantity'])) {
            header('Location: ' . URLROOT . '/index.php?url=products/detail/' . $id);
            exit;
        }

        $quantity = (int)$_POST['quantity'];
        
        if ($quantity <= 0) {
             $quantity = 1; 
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $quantity;
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }

        header('Location: ' . URLROOT . '/public/index.php?url=products/cart');
        exit;
    }

    // 4. Trang xem giỏ hàng
    public function cart() {
        $cartItems = [];
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $productId => $cartItem) {

            // Nếu cartItem là INT => chuyển về format mới
            if (!is_array($cartItem)) {
                $cartItem = [
                    "size" => "",
                    "quantity" => $cartItem
                ];
            }

            $qty  = $cartItem['quantity'];
            $size = $cartItem['size'];

            $product = $this->productModel->find($productId);

            if ($product) {
                $product->quantity = $qty;
                $product->size = $size;
                $product->total = $product->price * $qty;

                $cartItems[] = $product;
                $totalPrice += $product->total;
            }
        }



        $data = [
            'title' => 'Giỏ hàng của bạn',
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ];
        $this->loadView('public/products/cart', $data);
    }
    
    // 5. Xóa sản phẩm khỏi giỏ
    public function remove($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: ' . URLROOT . '/public/index.php?url=products/cart');
        exit;
    }

    // 6. Xử lý Thanh toán
    public function checkout() 
    {
        if (empty($_SESSION['cart'])) 
        {
            header('Location: ' . URLROOT . '/public/index.php?url=products/index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            // Lấy thông tin từ form
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $note = $_POST['note'];
            
            // Tính tổng tiền
            $total = 0;
            foreach ($_SESSION['cart'] as $key => $cartItem) {

                // Giỏ hàng dạng cũ chỉ có quantity (chưa có size)
                if (!is_array($cartItem)) {
                    $cartItem = [
                        'product_id' => $key,
                        'size' => '',
                        'quantity' => $cartItem
                    ];
                }

                $productId = $cartItem['product_id'];
                $qty       = $cartItem['quantity'];

                $product = $this->productModel->find($productId);

                if ($product) {
                    $total += $product->price * $qty;
                }
            }

            // 1. Tạo đơn hàng trong bảng orders
            $orderId = $this->orderModel->create(0, $fullname, $phone, $address, $total, $note);

            if ($orderId) 
            {
                // 2. Lưu chi tiết sản phẩm vào order_items
                    foreach ($_SESSION['cart'] as $key => $cart) 
                    {
                    $productId = $cart['product_id'];
                    $size = $cart['size'];
                    $qty = $cart['quantity'];

                    $product = $this->productModel->find($productId);

                    if ($product) {
                        $this->orderItemModel->add(
                            $orderId,
                            $productId,
                            $size,
                            $qty,
                            $product->price
                        );
                    }
                }


                // 3. Xóa giỏ hàng và thông báo thành công
                unset($_SESSION['cart']);
                echo "<script>alert('Đặt hàng thành công! Đơn hàng #{$orderId} đã được ghi nhận.'); window.location.href='" . URLROOT . "/public/index.php';</script>";
                exit;
            }
        }

        // Nếu không phải POST (hoặc lỗi), hiển thị lại trang giỏ hàng
        $this->cart();
    }

    public function loadView($viewPath, $data = []) {
        // Giải nén mảng $data thành các biến
        extract($data);
        
        // Đường dẫn đầy đủ tới file view
        $fileView = '../app/views/' . $viewPath . '.php';

        if (file_exists($fileView)) {
            // 1. Bắt đầu bộ đệm đầu ra (Output Buffer)
            ob_start();
            
            // 2. Nạp file view 
            require_once $fileView;
            
            // 3. Lấy nội dung trong bộ đệm và gán vào biến $content
            $content = ob_get_clean();
            
            // 4. Nạp file layout chính (main.php) để hiển thị
            require_once '../app/views/layouts/main.php';

        } else {
            // Hiển thị lỗi nếu không tìm thấy file view
            die('Lỗi: Không tìm thấy file view "' . $viewPath . '"');
        }
    }

    public function addToCartAjax() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {

            $id = (int)$_POST['product_id'];
            $qty = (int)$_POST['quantity'];
            $size = $_POST['size'];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $key = $id . "-" . $size;
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$key])) {
                $_SESSION['cart'][$key]['quantity'] += $qty;
            } else {
                $_SESSION['cart'][$key] = [
                    'product_id' => $id,
                    'size' => $size,
                    'quantity' => $qty
                ];
            }

            $cartCount = 0;
            foreach ($_SESSION['cart'] as $ci) {
                if (is_array($ci) && isset($ci['quantity'])) {
                    $cartCount += $ci['quantity'];
                }
            }

            echo json_encode([
                "success" => true,
                "message" => "Added",
                "cartCount" => $cartCount
            ]);
            exit;
        }
    }

    public function updateQuantity() 
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Lấy key từ ajax gửi lên (VD: 12-42)
            $key = $_POST["product_id"]; 
            $quantity = (int)$_POST["quantity"];

            if ($quantity < 1) $quantity = 1;

            // 1. Cập nhật số lượng vào Session
            $realProductId = null;

            if (isset($_SESSION["cart"][$key])) {
                if (is_array($_SESSION["cart"][$key])) {
                    // Cập nhật quantity trong mảng
                    $_SESSION["cart"][$key]['quantity'] = $quantity;
                    // Lấy Product ID thực để tí nữa query giá
                    $realProductId = $_SESSION["cart"][$key]['product_id'];
                } else {
                    // Fallback cho dữ liệu cũ
                    $_SESSION["cart"][$key] = $quantity;
                    $realProductId = $key; 
                }
            }

            // 2. Tính tổng tiền cho Item hiện tại ($itemTotal)
            $itemTotal = 0;
            if ($realProductId) {
                $product = $this->productModel->find($realProductId);
                if ($product) {
                    $itemTotal = $product->price * $quantity;
                }
            }

            // 3. Tính lại Tổng tiền giỏ hàng ($cartTotal) và Tổng số lượng ($cartCount)
            $cartTotal = 0;
            $cartCount = 0;

            if (isset($_SESSION["cart"])) {
                foreach ($_SESSION["cart"] as $sessionKey => $item) {
                    // Xác định ID và Quantity chuẩn từ item (dù là mảng hay số)
                    if (is_array($item)) {
                        $pId = $item['product_id'];
                        $qty = $item['quantity'];
                    } else {
                        $pId = $sessionKey; 
                        $qty = $item;
                    }

                    // Query sản phẩm để lấy giá
                    $p = $this->productModel->find($pId);
                    if ($p) {
                        $cartTotal += $p->price * $qty;
                    }
                    $cartCount += $qty;
                }
            }

            // 4. Trả về JSON cho JS cập nhật giao diện
            echo json_encode([
                "success" => true,
                "itemTotal" => $itemTotal,
                "cartTotal" => $cartTotal,
                "cartCount" => $cartCount
            ]);
            exit;
        }
    }

}