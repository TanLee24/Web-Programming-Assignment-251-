<?php
require_once APPROOT . "/models/Contact.php";

class AdminContactController {
    private $contactModel;

    public function __construct() {
        $this->checkAdminAccess();
        $this->contactModel = new Contact();
    }

    // Kiểm tra quyền Admin 
    private function checkAdminAccess() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            if (file_exists(APPROOT . '/views/errors/403.php')) {
                require_once APPROOT . '/views/errors/403.php';
            } else {
                echo "<h1>403 Forbidden</h1><p>Bạn không có quyền truy cập trang này!</p>";
            }
            exit;
        }
    }

    // 1. DANH SÁCH LIÊN HỆ
    public function list() {
        // Lấy tất cả liên hệ
        $contacts = $this->contactModel->all(); 
        $title = "Hộp thư liên hệ";

        // Load View
        $data = ['contacts' => $contacts, 'title' => $title];
        $this->loadView('admin/contacts/list', $data);
    }

    // 2. CẬP NHẬT TRẠNG THÁI 
    public function update_status() {
        // Lấy ID và Status từ URL (GET request)
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;

        // Danh sách trạng thái hợp lệ để bảo mật
        $validStatuses = ['unread', 'read', 'replied'];

        if ($id && in_array($status, $validStatuses)) {
            // Gọi Model cập nhật
            $this->contactModel->updateStatus($id, $status);
        }

        // Quay lại trang danh sách
        header("Location: " . URLROOT . "/public/index.php?url=admin/contact/list");
        exit;
    }

    // 3. XÓA LIÊN HỆ
    public function delete() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if ($id > 0) {
                $this->contactModel->delete($id);
            }
        }
        header("Location: " . URLROOT . "/public/index.php?url=admin/contact/list");
        exit;
    }

    // Hàm load view hỗ trợ
    private function loadView($viewPath, $data = []) {
        extract($data);
        $fileView = '../app/views/' . $viewPath . '.php';
        if (file_exists($fileView)) {
            ob_start();
            require_once $fileView;
            $content = ob_get_clean();
            require_once '../app/views/admin/layouts/admin_layout.php';
        } else {
            die("View không tồn tại: " . $viewPath);
        }
    }
}