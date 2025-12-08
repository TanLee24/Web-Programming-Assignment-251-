<?php
require_once APPROOT . "/models/News.php";
require_once APPROOT . "/models/Comment.php";

class NewsController {
    private $newsModel;
    private $commentModel;

    public function __construct() {
        $this->newsModel = new News();
        $this->commentModel = new Comment();
    }

    // Trang danh sách tin tức (Public)
    public function index() {
        $keyword = $_GET['search'] ?? null;
        $newsList = $this->newsModel->all($keyword);
        
        $data = [
            'title' => 'Tin tức & Sự kiện',
            'newsList' => $newsList
        ];
        
        $this->loadView('public/news/news', $data);
    }

    // Trang chi tiết tin tức (Public)
    public function detail() {
        // 1. Ưu tiên tìm theo Slug (cho SEO)
        $slug = $_GET['slug'] ?? null;
        
        // 2. Dự phòng tìm theo ID (nếu lỡ link cũ còn tồn tại)
        $id = $_GET['id'] ?? null;

        $post = null;

        if ($slug) {
            $post = $this->newsModel->findBySlug($slug);
        } elseif ($id) {
            $post = $this->newsModel->find($id);
        }

        if (!$post) { 
            // Chuyển hướng về trang lỗi 404 nếu không thấy bài
            header("Location: " . URLROOT . "/public/index.php?url=pages/error"); 
            exit; 
        }

        // Lấy bình luận 
        $comments = $this->commentModel->getCommentsByPostId($post->id);

        $data = [
            'title' => $post->title,
            'post' => $post,
            'comments' => $comments
        ];
        
        $this->loadView('public/news/news_detail', $data);
    }

    // Xử lý gửi bình luận (Public)
    public function comment() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newsId = $_POST['news_id'] ?? null;
            $content = $_POST['content'] ?? '';
            $userId = $_SESSION['user_id'];
            $userName = $_SESSION['user_name']; 

            if ($newsId && !empty($content)) {
                $this->commentModel->addComment($userId, $userName, $newsId, 'news', $content);
            }
            header("Location: " . URLROOT . "/public/index.php?url=news/detail&id=" . $newsId);
            exit;
        }
    }

    // HÀM HỖ TRỢ LOAD VIEW (GIỮ NGUYÊN)
    public function loadView($viewPath, $data = []) {
        extract($data);
        $fileView = '../app/views/' . $viewPath . '.php';

        if (file_exists($fileView)) {
            ob_start();
            require_once $fileView;
            $content = ob_get_clean();
            
            require_once '../app/views/layouts/main.php';
        } else {
            die('Lỗi: Không tìm thấy file view "' . $viewPath . '"');
        }
    }
}