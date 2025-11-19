<?php
// Nạp các Model cần thiết để lấy dữ liệu từ Database
require_once APPROOT . '/models/Setting.php';
require_once APPROOT . '/models/Faq.php';

class PagesController 
{
    private $settingModel;
    private $faqModel;

    public function __construct() 
    {
        // Khởi tạo các Model
        $this->settingModel = new Setting();
        $this->faqModel = new Faq();
    }

    // --- TRANG CHỦ ---
    public function home() 
    {
        $data = ['title' => 'Trang Chủ - Do & Tan Sneakers'];
        $this->loadView('public/home', $data);
    }

    // --- TRANG LIÊN HỆ (Giao diện) ---
    public function contact() 
    {
        $data = ['title' => 'Liên Hệ Chúng Tôi'];
        $this->loadView('public/contact', $data);
    }

    // --- TRANG GIỚI THIỆU (Công việc 2) ---
    public function about() 
    {
        // Lấy nội dung giới thiệu từ bảng settings
        $aboutTitle = $this->settingModel->get('about_title');
        $aboutContent = $this->settingModel->get('about_content');

        // Giá trị mặc định nếu Database chưa có gì
        if (empty($aboutTitle)) $aboutTitle = 'Về Chúng Tôi';
        if (empty($aboutContent)) $aboutContent = '<p>Đang cập nhật nội dung giới thiệu...</p>';

        $data = [
            'title' => $aboutTitle,
            'content' => $aboutContent
        ];
        $this->loadView('public/about', $data);
    }

    // --- TRANG HỎI ĐÁP / FAQ (Công việc 2) ---
    public function faq() 
    {
        // 1. Gọi Model để lấy toàn bộ danh sách câu hỏi từ Database
        $faqs = $this->faqModel->all();

        // 2. Chuẩn bị dữ liệu để gửi sang View
        $data = [
            'title' => 'Câu Hỏi Thường Gặp',
            'faqs' => $faqs // Biến này chứa mảng các câu hỏi
        ];

        // 3. Load giao diện faq.php
        $this->loadView('public/faq', $data);
    }

    // Hàm hỗ trợ load view (giữ nguyên như cũ)
    public function loadView($viewPath, $data = []) 
    {
        extract($data);
        $fileView = '../app/views/' . $viewPath . '.php';
        if (file_exists($fileView)) 
            {
            ob_start();
            require_once $fileView;
            $content = ob_get_clean();
            require_once '../app/views/layouts/main.php';
        } 
        else 
        {
            die('Lỗi: Không tìm thấy file view "' . $viewPath . '"');
        }
    }
}