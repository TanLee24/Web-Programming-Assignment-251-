<?php
require_once APPROOT . "/models/Contact.php";

class AdminContactController {
    private $contactModel;

    public function __construct() {
        $this->contactModel = new Contact();
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