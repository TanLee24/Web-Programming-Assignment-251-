<?php
require_once APPROOT . "/models/Setting.php";

class AdminAboutController {
    private $setting;

    public function __construct() {
        $this->setting = new Setting();
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->setting->set("about_page_content", $_POST['content']);
            header("Location: /public/index.php?url=admin/about/edit");
            exit;
        }

        $contentValue = $this->setting->get("about_page_content");
        $title = "Chỉnh sửa trang Giới thiệu";

        ob_start();
        require_once APPROOT . "/views/admin/about/edit.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }
}
