<?php
require_once APPROOT . "/models/Comment.php";

class AdminCommentController {
    private $commentModel;

    public function __construct() {
        $this->checkAdminAccess();
        $this->commentModel = new Comment();
    }

    private function checkAdminAccess() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            if (file_exists(APPROOT . '/views/errors/403.php')) {
                require_once APPROOT . '/views/errors/403.php';
            } else {
                echo "<h1>403 Forbidden</h1><p>Bạn không có quyền truy cập trang này!</p>";
            }
            exit;
        }
    }

    public function index() {
        // CẤU HÌNH PHÂN TRANG 
        $limit = 5; // Số bình luận trên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        
        $offset = ($page - 1) * $limit;

        // Lấy tổng số dòng để tính tổng số trang
        $totalRecords = $this->commentModel->countAll();
        $totalPages = ceil($totalRecords / $limit);

        // Lấy dữ liệu theo trang 
        $comments = $this->commentModel->getCommentsPaginated($limit, $offset);

        $title = "Quản lý Bình luận";

        ob_start();
        // Truyền thêm $page và $totalPages sang View
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