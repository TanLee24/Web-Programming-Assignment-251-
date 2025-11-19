<?php
require_once APPROOT . "/models/Setting.php";

class AdminAboutController 
{
    private $setting;

    public function __construct() 
    {
        $this->setting = new Setting();
    }

    // public function index() 
    // {
    //     // Xử lý khi bấm nút Lưu
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    //     {
    //         $content = $_POST['content']; // Nội dung từ CKEditor hoặc Textarea
    //         $this->setting->update('about_content', $content);
            
    //         // Thông báo thành công (tùy chọn)
    //         echo "<script>alert('Cập nhật thành công!');</script>";
    //     }

    //     // Lấy nội dung hiện tại để hiển thị vào form
    //     $currentContent = $this->setting->get('about_content');
    //     $title = "Quản lý trang Giới thiệu";

    //     ob_start();
    //     // Truyền biến $currentContent vào view
    //     require_once APPROOT . "/views/admin/about/edit.php";
    //     $content = ob_get_clean();

    //     require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    // }

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