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

    // =========================================================================
    // PHẦN 1: PUBLIC (GIỮ NGUYÊN CHỨC NĂNG CŨ)
    // =========================================================================

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
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: " . URLROOT . "/public/index.php?url=news/index"); exit; }

        $post = $this->newsModel->find($id);
        if (!$post) { header("Location: " . URLROOT . "/public/index.php?url=news/index"); exit; }

        $comments = $this->commentModel->getCommentsByPostId($id);

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

    // =========================================================================
    // PHẦN 2: ADMIN (THÊM MỚI ĐỂ QUẢN LÝ)
    // =========================================================================

    // 1. Danh sách bài viết (Admin List)
    public function list() {
        $keyword = $_GET['search'] ?? null;
        
        $newsList = $this->newsModel->all($keyword);

        $data = [
            'title' => 'Quản lý Tin tức',
            'newsList' => $newsList
        ];

        $this->loadView('admin/news/list', $data);
    }

    // 2. Thêm bài viết mới (Admin Create)
    public function create() {
        $data = [
            'title' => '',
            'content' => '',
            'featured_image_url' => '',
            'error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $imgUrl = '';

            // Xử lý upload ảnh
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                $file_name = time() . '_' . basename($_FILES["image"]["name"]);
                
                $target_file = dirname(dirname(dirname(__FILE__))) . "/public/" . $target_dir . $file_name;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $imgUrl = "/" . $target_dir . $file_name;
                }
            }

            if ($this->newsModel->create($title, $content, $imgUrl)) {
                header('Location: ' . URLROOT . '/public/index.php?url=admin/news/list');
                exit;
            } else {
                $data['error'] = 'Có lỗi xảy ra khi lưu bài viết.';
            }
        }

        $this->loadView('admin/news/create', $data);
    }

    // 3. Sửa bài viết (Admin Edit)
    public function edit() {
        // Kiểm tra ID
        if (!isset($_GET['id'])) {
            header('Location: ' . URLROOT . '/public/index.php?url=admin/news/list');
            exit;
        }

        $id = $_GET['id'];
        
        $news = $this->newsModel->getNewsById($id);

        if (!$news) {
            die('Bài viết không tồn tại');
        }

        $data = [
            'news' => $news,
            'title' => $news->title,
            'content' => $news->content,
            'featured_image_url' => $news->featured_image_url,
            'error' => ''
        ];

        // Xử lý khi bấm Lưu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['title'] = trim($_POST['title']);
            $data['content'] = trim($_POST['content']);
            // Tạo slug
            $data['slug'] = $this->newsModel->createSlug($data['title']);

            // Xử lý ảnh
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                $file_name = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = dirname(dirname(dirname(__FILE__))) . "/public/" . $target_dir . $file_name;
                
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $data['featured_image_url'] = "/" . $target_dir . $file_name;
                }
            }

            // Chuẩn bị dữ liệu cho hàm updateNews trong Model
            $updateData = [
                'id' => $id,
                'title' => $data['title'],
                'content' => $data['content'],
                'featured_image_url' => $data['featured_image_url'],
                'slug' => $data['slug']
            ];

            if ($this->newsModel->updateNews($updateData)) {
                header('Location: ' . URLROOT . '/public/index.php?url=admin/news/list');
                exit;
            } else {
                $data['error'] = 'Có lỗi xảy ra, vui lòng thử lại';
            }
        }

        // Dùng loadView thay vì view
        $this->loadView('admin/news/edit', $data);
    }

    // 4. Xóa bài viết (Admin Delete)
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->newsModel->delete($id);
        }
        header('Location: ' . URLROOT . '/public/index.php?url=admin/news/list');
        exit;
    }

    // =========================================================================
    // HÀM HỖ TRỢ LOAD VIEW (GIỮ NGUYÊN)
    // =========================================================================
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