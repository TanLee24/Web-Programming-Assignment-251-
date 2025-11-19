<?php
require_once APPROOT . '/models/Product.php';

// BỔ SUNG REQUIRE CÁC MODELS CẦN THIẾT CHO CHỨC NĂNG THANH TOÁN
require_once APPROOT . '/models/Order.php'; 
require_once APPROOT . '/models/OrderItem.php'; 

class ProductsController {
    private $productModel;
    // KHAI BÁO THUỘC TÍNH MỚI
    private $orderModel;
    private $orderItemModel;

    public function __construct() {
        $this->productModel = new Product();
        // KHỞI TẠO CÁC MODELS MỚI
        $this->orderModel = new Order();
        $this->orderItemModel = new OrderItem();
    }

    // 1. Trang danh sách sản phẩm (có tìm kiếm và lọc theo hãng)
    public function index() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
        $brandFilter = isset($_GET['brand']) ? $_GET['brand'] : null; // Lấy tham số lọc hãng

        // UPDATED: Gọi hàm all() mới với tham số $brandFilter
        $products = $this->productModel->all($keyword, $brandFilter); 
        
        // NEW: Lấy danh sách hãng để hiển thị Sidebar
        $brands = $this->productModel->getUniqueBrands(); 
        
        $data = [
            'title' => 'Sản phẩm - Do & Tan Sneakers',
            'products' => $products,
            'brands' => $brands,         // Truyền danh sách hãng ra View
            'currentBrand' => $brandFilter // Truyền hãng đang được lọc ra View
        ];
        $this->loadView('public/products/index', $data);
    }

    // 2. Trang chi tiết sản phẩm
    public function detail($id) {
        $product = $this->productModel->find($id);

        if (!$product) {
            die('Sản phẩm không tồn tại!');
        }

        $data = [
            'title' => $product->name,
            'product' => $product
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

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $quantity) {
                $product = $this->productModel->find($id);
                if ($product) {
                    $product->quantity = $quantity;
                    $product->total = $product->price * $quantity;
                    $cartItems[] = $product;
                    $totalPrice += $product->total;
                }
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
        // Lệnh này phải được require ở đầu file để tránh bị lỗi
        // require_once APPROOT . '/models/Order.php'; 
        // require_once APPROOT . '/models/OrderItem.php'; 

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
            foreach ($_SESSION['cart'] as $id => $qty) 
            {
                $product = $this->productModel->find($id);
                if ($product) $total += $product->price * $qty;
            }

            // 1. Tạo đơn hàng trong bảng orders
            $orderId = $this->orderModel->create(0, $fullname, $phone, $address, $total, $note);

            if ($orderId) 
            {
                // 2. Lưu chi tiết sản phẩm vào order_items
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $product = $this->productModel->find($id);
                    if ($product) {
                        $this->orderItemModel->add($orderId, $id, $qty, $product->price);
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
            
            // 2. Nạp file view (Ví dụ: products/index.php)
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = (int)$_POST['product_id'];
            $qty = (int)$_POST['quantity'];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] += $qty;
            } else {
                $_SESSION['cart'][$id] = $qty;
            }

            echo json_encode([
                'success' => true,
                'cartCount' => array_sum($_SESSION['cart'])
            ]);
            exit;
        }
    }

    public function updateQuantity() 
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $product_id = $_POST["product_id"];
            $quantity   = (int)$_POST["quantity"];

            if ($quantity < 1) $quantity = 1;

            if (isset($_SESSION["cart"][$product_id])) {
                $_SESSION["cart"][$product_id] = $quantity;
            }

            $product = $this->productModel->find($product_id);

            $itemTotal = $product->price * $quantity;

            $cartTotal = 0;
            foreach ($_SESSION["cart"] as $id => $qty) {
                $p = $this->productModel->find($id);
                if ($p) $cartTotal += $p->price * $qty;
            }

            echo json_encode([
                "success" => true,
                "cartCount" => array_sum($_SESSION["cart"]),
                "itemTotal" => $itemTotal,
                "cartTotal" => $cartTotal
            ]);
            exit;
        }
    }


    // public function removeItem()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //         $product_id = $_POST["product_id"];

    //         if (isset($_SESSION["cart"][$product_id])) {
    //             unset($_SESSION["cart"][$product_id]);
    //         }

    //         echo json_encode([
    //             "success" => true,
    //             "cartCount" => array_sum($_SESSION["cart"])
    //         ]);
    //         exit;
    //     }
    // }

}