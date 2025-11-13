<?php
class PagesController {

    public function __construct() {
        // (Chúng ta sẽ nạp Model ở đây sau)
    }

    /**
     * Phương thức (action) cho Trang Chủ
     */
    public function home() {
        $data = [
            'title' => 'Trang Chủ Công Ty'
        ];
        
        // SỬA LỖI TẠI ĐÂY: Dùng -> thay vì .
        $this->loadView('public/home', $data);
    }

    /**
     * Phương thức (action) cho Trang Liên Hệ
     */
    public function contact() {
        $data = [
            'title' => 'Liên Hệ Chúng Tôi'
        ];
        
        // SỬA LỖI TẠI ĐÂY: Dùng -> thay vì .
        $this->loadView('public/contact', $data);
    }

    /**
     * HÀM LOADVIEW ĐÃ NÂNG CẤP (SỬ DỤNG LAYOUT)
     * Hàm này sẽ nạp main.php
     *
     * @param string $viewPath - Đường dẫn tới file view (ví dụ: 'public/home')
     * @param array $data - Dữ liệu muốn truyền ra view
     */
    public function loadView($viewPath, $data = []) {
        // Giải nén mảng $data thành các biến
        extract($data);
        
        // Đường dẫn đầy đủ tới file view (ví dụ: .../app/views/public/home.php)
        $fileView = '../app/views/' . $viewPath . '.php';

        if (file_exists($fileView)) {
            // 1. Bắt đầu bộ đệm đầu ra
            ob_start();
            
            // 2. Nạp file view (home.php hoặc contact.php)
            require_once $fileView;
            
            // 3. Lấy nội dung trong bộ đệm và gán vào biến $content
            $content = ob_get_clean();
            
            // 4. Nạp file layout chính (main.php)
            require_once '../app/views/layouts/main.php';

        } else {
            // Hiển thị lỗi nếu không tìm thấy file view
            die('Lỗi: Không tìm thấy file view "' . $viewPath . '"');
        }
    }
}