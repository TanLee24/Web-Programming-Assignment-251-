<?php
require_once APPROOT . "/models/Contact.php";

class AdminContactController {
    private $contactModel;

    public function __construct() {
        $this->checkAdminAccess();
        $this->contactModel = new Contact();
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

    // --- 1. DANH SÁCH LIÊN HỆ ---
    // Đổi tên từ index() thành list() cho giống các controller kia
    public function list() {
        $contacts = $this->contactModel->all(); 
        $title = "Hộp thư liên hệ";

        ob_start();
        // Đường dẫn file view phải chính xác
        require APPROOT . "/views/admin/contacts/list.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    // --- 2. XÓA LIÊN HỆ ---
    public function delete() {
        // Lấy ID từ GET (giống các controller kia đang dùng pattern này hoặc truyền tham số)
        // Tuy nhiên để an toàn và giống AdminProduct, ta kiểm tra isset
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $this->contactModel->delete($id);
        }
        
        // Redirect về đúng route: admin/contact/list
        header("Location: " . URLROOT . "/public/index.php?url=admin/contact/list");
        exit;
    }
    
    // --- 3. ĐÁNH DẤU ĐÃ XEM ---
    public function mark_read() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $this->contactModel->updateStatus($id, 1);
        }
        
        header("Location: " . URLROOT . "/public/index.php?url=admin/contact/list");
        exit;
    }
}