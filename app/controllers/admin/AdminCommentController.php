<?php
require_once APPROOT . "/models/Comment.php";

class AdminCommentController {
    private $commentModel;

    public function __construct() {
        $this->commentModel = new Comment();
    }

    public function index() {
        $comments = $this->commentModel->all();
        $title = "Quản lý Bình luận";

        ob_start();
        require APPROOT . "/views/admin/comments/list.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $this->commentModel->delete($id);
        header("Location: " . URLROOT . "/public/index.php?url=admin/comment/index");
    }

    public function status() {
        $id = $_GET['id'] ?? 0;
        $val = $_GET['val'] ?? 0;
        
        $this->commentModel->updateStatus($id, $val);
        header("Location: " . URLROOT . "/public/index.php?url=admin/comment/index");
    }
}