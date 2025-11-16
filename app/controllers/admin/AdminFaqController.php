<?php
require_once APPROOT . "/models/Faq.php";

class AdminFaqController {
    private $faq;

    public function __construct() {
        $this->faq = new Faq();
    }

    public function list() {
        $faqs = $this->faq->all();
        $title = "Quản lý FAQ";
        
        ob_start();
        require_once APPROOT . "/views/admin/faq/list.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->faq->create($_POST['question'], $_POST['answer']);
            header("Location: /public/index.php?url=admin/faq/list");
            exit;
        }

        $title = "Thêm câu hỏi mới";

        ob_start();
        require_once APPROOT . "/views/admin/faq/create.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function edit($id) {
        $faq = $this->faq->find($id);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->faq->update($id, $_POST['question'], $_POST['answer']);
            header("Location: /public/index.php?url=admin/faq/list");
            exit;
        }

        $title = "Sửa câu hỏi";

        ob_start();
        require_once APPROOT . "/views/admin/faq/edit.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function delete($id) {
        $this->faq->delete($id);
        header("Location: /public/index.php?url=admin/faq/list");
    }
}
