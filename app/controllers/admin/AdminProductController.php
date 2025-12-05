<?php
require_once APPROOT . "/models/Product.php";

class AdminProductController {
    private $product;

    public function __construct() {
        $this->checkAdminAccess();
        $this->product = new Product();
    }

    // --- ĐỊNH NGHĨA HÀM KIỂM TRA (Bảo Mật) ---
    private function checkAdminAccess() 
    {
        // 1. Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }

        // 2. Kiểm tra quyền Admin
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            
            // --- CODE MỚI: HIỆN LỖI 403 ---
            
            // Gửi mã phản hồi HTTP 403 cho trình duyệt (quan trọng cho SEO/Bot)
            http_response_code(403);
            
            // Load file giao diện lỗi vừa tạo
            if (file_exists(APPROOT . '/views/errors/403.php')) {
                require_once APPROOT . '/views/errors/403.php';
            } else {
                // Dự phòng nếu chưa tạo file view
                echo "<h1>403 Forbidden</h1><p>Bạn không có quyền truy cập trang này!</p>";
            }
            
            // Dừng code ngay lập tức để không lộ nội dung trang Admin
            exit;
        }
    }

    // --- 1. DANH SÁCH SẢN PHẨM ---
    public function list() {
        $keyword = $_GET['search'] ?? null;
        $products = $this->product->all($keyword);
        $title = "Quản lý sản phẩm";

        ob_start();
        require APPROOT . "/views/admin/products/list.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // --- 2. THÊM SẢN PHẨM MỚI ---
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $name  = $_POST['name'];
            $desc  = $_POST['description'];
            $price = $_POST['price'];
            $brand = $_POST['brand'] ?? '';

            $imgUrl = "";

            // --- FIX UPLOAD ẢNH ---
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

                $img = $_FILES['image'];
                $filename = time() . "_" . basename($img['name']);

                // đường dẫn vật lý
                $targetPath = dirname(APPROOT) . "/public/uploads/" . $filename;

                if (move_uploaded_file($img['tmp_name'], $targetPath)) {
                    // đường dẫn URL để show ảnh
                    $imgUrl = "/public/uploads/" . $filename;
                    //$imgUrl = $filename;
                }
            }

            $this->product->create($name, $desc, $price, $imgUrl, $brand);

            header("Location: " . URLROOT . "/public/index.php?url=admin/product/list");
            exit;
        }

        $title = "Thêm sản phẩm";
        ob_start();
        require APPROOT . "/views/admin/products/create.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // --- 3. SỬA SẢN PHẨM ---
    public function edit($id) {
        $product = $this->product->find($id);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $name  = $_POST['name'];
            $desc  = $_POST['description'];
            $price = $_POST['price'];
            $brand = $_POST['brand'] ?? $product->brand;

            // giữ ảnh cũ nếu không upload ảnh mới
            $imgUrl = $product->image_url;

            // --- FIX UPLOAD ẢNH ---
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) 
            {

                $img = $_FILES['image'];
                $filename = time() . "_" . basename($img['name']);

                $targetPath = dirname(APPROOT) . "/public/uploads/" . $filename;

                if (move_uploaded_file($img['tmp_name'], $targetPath)) {
                    $imgUrl = "/public/uploads/" . $filename;
                    //$imgUrl = $filename;
                }
            }

            $this->product->update($id, $name, $desc, $price, $imgUrl, $brand);

            header("Location: " . URLROOT . "/public/index.php?url=admin/product/list");
            exit;
        }

        $title = "Sửa sản phẩm";
        ob_start();
        require APPROOT . "/views/admin/products/edit.php";
        $content = ob_get_clean();
        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // --- 4. XÓA SẢN PHẨM ---
    public function delete($id) {
        $this->product->delete($id);
        header("Location: " . URLROOT . "/public/index.php?url=admin/product/list");
        exit;
    }
}
