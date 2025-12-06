<?php
class NewsletterController {
    private $newsletterModel;

    public function __construct() {
        // Load model Newsletter
        // Lưu ý: Hàm này tùy thuộc vào cách core MVC của bạn load model.
        // Thường là $this->newsletterModel = $this->model('Newsletter'); 
        // Hoặc nếu bạn tự require:
        require_once APPROOT . '/models/Newsletter.php';
        $this->newsletterModel = new Newsletter();
    }

    public function subscribe() {
        // Chỉ chấp nhận method POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            return;
        }

        // Đặt header trả về JSON
        header('Content-Type: application/json');

        $email = trim($_POST['email'] ?? '');

        // 1. Validate Email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Email không hợp lệ!']);
            return;
        }

        // 2. Kiểm tra tồn tại
        if ($this->newsletterModel->checkEmailExists($email)) {
            echo json_encode(['status' => 'warning', 'message' => 'Email này đã đăng ký rồi!']);
            return;
        }

        // 3. Thêm mới
        if ($this->newsletterModel->addSubscriber($email)) {
            echo json_encode(['status' => 'success', 'message' => 'Đăng ký thành công!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống, thử lại sau.']);
        }
    }
}