<?php
class AdminDashboardController {

    public function __construct() {
        // BẮT BUỘC: Kiểm tra quyền Admin ngay khi khởi tạo
        $this->checkAdminAccess();
    }

    // --- HÀM BẢO MẬT (Copy từ các controller khác sang) ---
    private function checkAdminAccess() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            echo "<h1>403 Forbidden</h1><p>Bạn không có quyền truy cập!</p>";
            exit;
        }
    }
    
    public function index() {
        $title = "Admin Dashboard";

        ob_start();
        require APPROOT . "/views/admin/dashboard/index.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }
}
