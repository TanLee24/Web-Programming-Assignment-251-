<?php
require_once APPROOT . "/models/Product.php";

class AdminProductController {
    private $product;

    public function __construct() {
        $this->checkAdminAccess();
        $this->product = new Product();
    }

    // ĐỊNH NGHĨA HÀM KIỂM TRA (Bảo Mật) 
    private function checkAdminAccess() 
    {
        // 1. Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }

        // 2. Kiểm tra quyền Admin
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            
            // HIỆN LỖI 403 
            
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

    // 1. DANH SÁCH SẢN PHẨM 
    public function list() {
        // Lấy từ khóa tìm kiếm
        $keyword = $_GET['search'] ?? null;

        // CẤU HÌNH PHÂN TRANG
        $limit = 5; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        
        $offset = ($page - 1) * $limit;

        // 1. Đếm tổng số sản phẩm (để tính số trang)
        $totalRecords = $this->product->countAll($keyword, null);
        
        $totalPages = ceil($totalRecords / $limit);

        // 2. Lấy dữ liệu phân trang
        $products = $this->product->getPaginated($limit, $offset, $keyword, null);
        
        $title = "Quản lý sản phẩm";

        ob_start();
        // Truyền thêm biến $page, $totalPages, $keyword sang View
        require APPROOT . "/views/admin/products/list.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // 2. THÊM SẢN PHẨM MỚI 
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $name  = $_POST['name'];
            $desc  = $_POST['description'];
            $price = $_POST['price'];
            $brand = $_POST['brand'] ?? '';

            $imgUrl = "";

            // XỬ LÝ UPLOAD ẢNH
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // 1. Chỉ cho phép các đuôi ảnh an toàn
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $filename = $_FILES['image']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // 2. Kiểm tra xem file có phải ảnh thật không (chống fake đuôi)
                $check = getimagesize($_FILES['image']['tmp_name']);

                if (in_array($ext, $allowed) && $check !== false) {
                    // 3. Đặt tên file ngẫu nhiên để tránh trùng và tránh tên file độc hại
                    $new_name = time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;
                    $targetPath = dirname(APPROOT) . "/public/uploads/" . $new_name;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        $imgUrl = "/public/uploads/" . $new_name;
                    }
                } else {
                    // Nếu không hợp lệ, có thể báo lỗi hoặc bỏ qua
                    echo "<script>alert('Lỗi: Chỉ cho phép upload file ảnh (JPG, PNG)!'); window.history.back();</script>";
                    exit;
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

    // 3. SỬA SẢN PHẨM 
    public function edit($id) {
        $product = $this->product->find($id);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $name  = $_POST['name'];
            $desc  = $_POST['description'];
            $price = $_POST['price'];
            $brand = $_POST['brand'] ?? $product->brand;

            // giữ ảnh cũ nếu không upload ảnh mới
            $imgUrl = $product->image_url;

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $filename = $_FILES['image']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES['image']['tmp_name']);

                if (in_array($ext, $allowed) && $check !== false) {
                    $new_name = time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;
                    $targetPath = dirname(APPROOT) . "/public/uploads/" . $new_name;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                        $imgUrl = "/public/uploads/" . $new_name;
                    }
                } else {
                    echo "<script>alert('Lỗi: File không hợp lệ!'); window.history.back();</script>";
                    exit;
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

    // 4. XÓA SẢN PHẨM 
    public function delete($id) {
        $this->product->delete($id);
        header("Location: " . URLROOT . "/public/index.php?url=admin/product/list");
        exit;
    }
}
