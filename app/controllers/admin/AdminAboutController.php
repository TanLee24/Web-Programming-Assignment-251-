<?php
require_once APPROOT . "/models/Setting.php";

class AdminAboutController 
{
    private $setting;

    public function __construct() 
    {
        // --- GỌI HÀM KIỂM TRA QUYỀN ---
        // Hàm này sẽ chạy đầu tiên. Nếu không phải admin, code bên dưới sẽ không bao giờ chạy.
        $this->checkAdminAccess();
        $this->setting = new Setting();
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

    public function index() 
    {
        $currentContent = $this->setting->get('about_content');
        $title = "Quản lý trang Giới thiệu";

        ob_start();
        require_once APPROOT . "/views/admin/about/edit.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }


    public function update() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $content = $_POST['content'];
            $this->setting->update('about_content', $content);

            header("Location: " . URLROOT . "/public/index.php?url=admin/about/index");
            exit;
        }

        echo "Lỗi: Chỉ hỗ trợ POST";
    }
}