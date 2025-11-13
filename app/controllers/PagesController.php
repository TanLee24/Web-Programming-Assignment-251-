<?php
class PagesController {
    
    public function __construct() {
        // (Chúng ta sẽ nạp model ở đây sau)
    }

    // Hàm xử lý cho Trang Chủ
    public function home() {
        // (Chúng ta sẽ lấy dữ liệu từ model sau)
        $data = [
            'title' => 'Chào mừng đến với Trang Chủ'
        ];

        // Nạp View của trang chủ
        $this->loadView('public/home', $data);
    }

    // Hàm xử lý cho Trang Liên Hệ
    public function contact() {
        $data = [
            'title' => 'Trang Liên Hệ'
        ];
        $this->loadView('public/contact', $data);
    }

    // Hàm helper để nạp View (tạm thời)
    public function loadView($viewPath, $data = []) {
        // Biến các key của mảng $data thành các biến
        extract($data);
        
        // Kiểm tra file view có tồn tại không
        if (file_exists('../app/views/' . $viewPath . '.php')) {
            require_once '../app/views/' . $viewPath . '.php';
        } else {
            die('View không tồn tại.');
        }
    }
}