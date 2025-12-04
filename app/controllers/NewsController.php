<?php
// 1. Gọi các Model cần thiết
require_once APPROOT . "/models/News.php";
require_once APPROOT . "/models/Comment.php";

class NewsController {
    private $newsModel;
    private $commentModel;

    public function __construct() {
        $this->newsModel = new News();
        $this->commentModel = new Comment();
    }

    // --- 1. TRANG DANH SÁCH TIN TỨC ---
    public function index() {
        // Lấy từ khóa tìm kiếm
        $keyword = $_GET['search'] ?? null;
        
        // Lấy dữ liệu từ Database
        $newsList = $this->newsModel->all($keyword);
        
        // Chuẩn bị dữ liệu gửi sang View
        $data = [
            'title' => 'Tin tức & Sự kiện',
            'newsList' => $newsList
        ];

        // Gọi view bằng hàm chuẩn (giống ProductsController)
        // Đường dẫn này trỏ tới: app/views/public/news/news.php
        $this->loadView('public/news/news', $data);
    }

    // --- 2. TRANG CHI TIẾT TIN TỨC ---
    public function detail() {
        // Lấy ID từ URL
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: " . URLROOT . "/public/index.php?url=news/index");
            exit;
        }

        // Lấy thông tin bài viết
        $post = $this->newsModel->find($id);

        // Kiểm tra nếu bài viết không tồn tại
        if (!$post) {
            // Có thể redirect hoặc hiện thông báo
            header("Location: " . URLROOT . "/public/index.php?url=news/index");
            exit;
        }

        // Lấy danh sách bình luận
        $comments = $this->commentModel->getCommentsByPostId($id);

        $data = [
            'title' => $post->title,
            'post' => $post,
            'comments' => $comments
        ];

        // Gọi view: app/views/public/news/news_detail.php
        $this->loadView('public/news/news_detail', $data);
    }

    // --- 3. XỬ LÝ GỬI BÌNH LUẬN ---
    public function comment() {
        // Kiểm tra Login: Nếu chưa có session user_id thì bắt ra login
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newsId = $_POST['news_id'] ?? null;
            $content = $_POST['content'] ?? '';
            
            // Lấy thông tin từ Session (An toàn hơn lấy từ Form)
            $userId = $_SESSION['user_id'];
            $userName = $_SESSION['user_name']; 

            if ($newsId && !empty($content)) {
                // Gọi hàm model đã update ở bước 2
                $this->commentModel->addComment($userId, $userName, $newsId, $content);
            }

            // Quay lại trang chi tiết bài viết
            header("Location: " . URLROOT . "/public/index.php?url=news/detail&id=" . $newsId);
            exit;
        }
    }

    // --- HÀM HỖ TRỢ LOAD VIEW (Chuẩn giống ProductsController) ---
    public function loadView($viewPath, $data = []) {
        // Giải nén mảng $data thành các biến ($title, $post, $newsList...)
        extract($data);
        
        // Đường dẫn tới file view
        $fileView = '../app/views/' . $viewPath . '.php';

        if (file_exists($fileView)) {
            // 1. Bắt đầu bộ đệm
            ob_start();
            
            // 2. Nạp nội dung view
            require_once $fileView;
            
            // 3. Lấy nội dung gán vào biến $content
            $content = ob_get_clean();
            
            // 4. Nạp layout chính để hiển thị
            require_once '../app/views/layouts/main.php';

        } else {
            die('Lỗi: Không tìm thấy file view "' . $viewPath . '"');
        }
    }
}