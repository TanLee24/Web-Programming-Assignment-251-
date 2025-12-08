<?php
require_once APPROOT . '/models/Contact.php';

class ContactController {
    
    // Hiển thị form liên hệ
    public function form() {
        $data = ['title' => 'Liên hệ'];
        $this->loadView('public/contact', $data);
    }

    // Xử lý khi bấm nút Gửi
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $contactModel = new Contact;

            // 1. TỰ ĐỘNG SỬA LỖI TÊN INPUT
            // Kiểm tra xem form bên HTML đang dùng name="full_name" hay name="name"
            $name = !empty($_POST['full_name']) ? $_POST['full_name'] : ($_POST['name'] ?? '');
            
            $data = [
                'full_name' => $name,
                'email' => $_POST['email'] ?? '',
                'message' => $_POST['message'] ?? ''
            ];

            // 2. KIỂM TRA DỮ LIỆU RỖNG TRƯỚC KHI LƯU
            if (empty($data['full_name']) || empty($data['email'])) {
                 echo "<script>alert('Lỗi: Vui lòng điền tên và email!'); window.history.back();</script>";
                 exit;
            }

            // 3. GỌI MODEL ĐỂ LƯU
            if ($contactModel->save($data)) {
                // Thành công: Chuyển hướng và báo tin vui
                echo "<script>alert('Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm.'); window.location.href='" . URLROOT . "/public/index.php?url=pages/contact';</script>";
            } else {
                echo "<script>alert('Lỗi hệ thống: Không thể lưu vào database.'); window.history.back();</script>";
            }
        }
    }

    // Hàm hỗ trợ load view 
    public function loadView($viewPath, $data = []) {
        extract($data);
        if (file_exists('../app/views/' . $viewPath . '.php')) {
            ob_start();
            require_once '../app/views/' . $viewPath . '.php';
            $content = ob_get_clean();
            require_once '../app/views/layouts/main.php';
        } else {
            die("View không tồn tại: " . $viewPath);
        }
    }
}