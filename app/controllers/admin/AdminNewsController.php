<?php
require_once APPROOT . "/models/News.php";

class AdminNewsController {
    private $newsModel;

    public function __construct() {
        $this->checkAdminAccess();
        $this->newsModel = new News();
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

    // 1. Danh sách tin tức
    public function list() {
        $keyword = $_GET['search'] ?? null;
        $newsList = $this->newsModel->all($keyword);
        $title = "Quản lý Tin tức";

        // Load View Admin
        ob_start();
        require APPROOT . "/views/admin/news/list.php"; 
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // 2. Thêm bài viết
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content']; 
            $imgUrl = "";

            // Xử lý upload ảnh
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

            $this->newsModel->create($title, $content, $imgUrl);
            header("Location: " . URLROOT . "/public/index.php?url=admin/news/list");
            exit;
        }

        $title = "Thêm tin tức mới";
        ob_start();
        require APPROOT . "/views/admin/news/create.php"; 
        $content = ob_get_clean();
        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // 3. Sửa bài viết
    public function edit() {
        $id = $_GET['id'] ?? null;
        $news = $this->newsModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $imgUrl = $news->featured_image_url;
            
            // Giữ ảnh cũ nếu không up ảnh mới
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

            $this->newsModel->update($id, $title, $content, $imgUrl);
            header("Location: " . URLROOT . "/public/index.php?url=admin/news/list");
            exit;
        }

        $title = "Sửa bài viết";
        ob_start();
        require APPROOT . "/views/admin/news/edit.php"; 
        $content = ob_get_clean();
        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // 4. Xóa bài viết
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->newsModel->delete($id);
        }
        header("Location: " . URLROOT . "/public/index.php?url=admin/news/list");
        exit;
    }
}