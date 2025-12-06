<?php
// Gọi các Model cần thiết
require_once APPROOT . "/models/News.php";
require_once APPROOT . "/models/Comment.php";

class NewsController {
    private $newsModel;
    private $commentModel;

    public function __construct() {
        $this->newsModel = new News();
        $this->commentModel = new Comment();
        
        // Khởi động session nếu chưa có (để dùng cho Auth và CSRF)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // =========================================================================
    // PHẦN 0: CÁC HÀM BẢO MẬT (HELPER METHODS)
    // =========================================================================

    // 1. Kiểm tra quyền Admin (Chặn truy cập trái phép)
    private function checkAdmin() {
        // Nếu chưa đăng nhập hoặc role không phải admin
        if (!isset($_SESSION['user_id']) || empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            // Hủy session và đá về trang login hoặc trang chủ
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }
    }

    // 2. Tạo CSRF Token (Chống tấn công giả mạo)
    private function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // 3. Kiểm tra CSRF Token khi nhận POST
    private function validateCsrfToken() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Lỗi bảo mật: CSRF Token không hợp lệ! (Vui lòng reload trang)');
            }
        }
    }

    // =========================================================================
    // PHẦN 1: PUBLIC (DÀNH CHO NGƯỜI DÙNG)
    // =========================================================================

    public function index() {
        $keyword = $_GET['search'] ?? null;
        // XSS Protection: Filter keyword hiển thị ra view (nếu view có echo lại)
        $keyword = htmlspecialchars($keyword ?? '', ENT_QUOTES, 'UTF-8');
        
        $newsList = $this->newsModel->all($keyword);
        
        $data = [
            'title' => 'Tin tức & Sự kiện',
            'newsList' => $newsList
        ];
        
        $this->loadView('public/news/news', $data);
    }

    public function detail() {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: " . URLROOT . "/public/index.php?url=news/index"); exit; }

        $post = $this->newsModel->find($id);
        if (!$post) { header("Location: " . URLROOT . "/public/index.php?url=news/index"); exit; }

        $comments = $this->commentModel->getCommentsByPostId($id);

        // Tạo token để form bình luận sử dụng
        $data = [
            'title' => $post->title,
            'post' => $post,
            'comments' => $comments,
            'csrf_token' => $this->generateCsrfToken() // Truyền token sang View
        ];
        
        $this->loadView('public/news/news_detail', $data);
    }

    public function comment() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // BẢO MẬT: Kiểm tra CSRF
            $this->validateCsrfToken();

            $newsId = $_POST['news_id'] ?? null;
            $content = trim($_POST['content'] ?? '');
            $userId = $_SESSION['user_id'];

            if ($newsId && !empty($content)) {
                // Nội dung sẽ được lưu thô, nhưng View phải dùng htmlspecialchars khi hiển thị
                $this->commentModel->addComment($userId, $newsId, $content);
            }
            header("Location: " . URLROOT . "/public/index.php?url=news/detail&id=" . $newsId);
            exit;
        }
    }

    // =========================================================================
    // PHẦN 2: ADMIN (ĐÃ BỔ SUNG BẢO MẬT)
    // =========================================================================

    // 1. Danh sách bài viết
    public function list() {
        // BẢO MẬT: Chỉ Admin mới được vào
        $this->checkAdmin();

        $keyword = $_GET['search'] ?? null;
        $newsList = $this->newsModel->all($keyword);

        // Tạo token cho các nút Xóa (nếu xóa bằng Form POST)
        $data = [
            'title' => 'Quản lý Tin tức',
            'newsList' => $newsList,
            'csrf_token' => $this->generateCsrfToken()
        ];

        $this->loadView('admin/news/list', $data);
    }

    // 2. Thêm bài viết mới
    public function create() {
        // BẢO MẬT: Chỉ Admin mới được vào
        $this->checkAdmin();

        $data = [
            'title' => '',
            'content' => '',
            'featured_image_url' => '',
            'error' => '',
            'csrf_token' => $this->generateCsrfToken() // Token cho form
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // BẢO MẬT: Kiểm tra CSRF
            $this->validateCsrfToken();

            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $imgUrl = '';

            // --- XỬ LÝ UPLOAD ẢNH (BẢO MẬT CAO) ---
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                $max_size = 2 * 1024 * 1024; // 2MB

                $file_tmp = $_FILES['image']['tmp_name'];
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (!in_array($file_ext, $allowed_types)) {
                    $data['error'] = "Chỉ chấp nhận file ảnh (JPG, JPEG, PNG, GIF).";
                    $this->loadView('admin/news/create', $data); return;
                }

                if ($file_size > $max_size) {
                    $data['error'] = "File quá lớn. Vui lòng chọn ảnh dưới 2MB.";
                    $this->loadView('admin/news/create', $data); return;
                }

                $check = getimagesize($file_tmp);
                if ($check === false) {
                    $data['error'] = "File không phải là ảnh hợp lệ.";
                    $this->loadView('admin/news/create', $data); return;
                }

                // Tên file ngẫu nhiên an toàn
                $new_file_name = time() . '_' . uniqid() . '.' . $file_ext;
                $target_file = dirname(dirname(dirname(__FILE__))) . "/public/" . $target_dir . $new_file_name;
                
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $imgUrl = "/" . $target_dir . $new_file_name;
                } else {
                    $data['error'] = "Có lỗi xảy ra khi upload file.";
                    $this->loadView('admin/news/create', $data); return;
                }
            }
            // --- KẾT THÚC UPLOAD ---

            if ($this->newsModel->create($title, $content, $imgUrl)) {
                header('Location: ' . URLROOT . '/public/index.php?url=admin/news/list');
                exit;
            } else {
                $data['error'] = 'Có lỗi xảy ra khi lưu bài viết.';
            }
        }

        $this->loadView('admin/news/create', $data);
    }

    // 3. Sửa bài viết
    public function edit() {
        // BẢO MẬT: Chỉ Admin mới được vào
        $this->checkAdmin();

        if (!isset($_GET['id'])) {
            header('Location: ' . URLROOT . '/public/index.php?url=admin/news/list');
            exit;
        }

        $id = $_GET['id'];
        $news = $this->newsModel->getNewsById($id);

        if (!$news) { die('Bài viết không tồn tại'); }

        $data = [
            'news' => $news,
            'title' => $news->title,
            'content' => $news->content,
            'featured_image_url' => $news->featured_image_url,
            'error' => '',
            'csrf_token' => $this->generateCsrfToken() // Token cho form
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // BẢO MẬT: Kiểm tra CSRF
            $this->validateCsrfToken();

            $data['title'] = trim($_POST['title']);
            $data['content'] = trim($_POST['content']);
            $data['slug'] = $this->newsModel->createSlug($data['title']);

            // --- XỬ LÝ UPLOAD ẢNH (BẢO MẬT CAO) ---
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
                $max_size = 2 * 1024 * 1024;

                $file_tmp = $_FILES['image']['tmp_name'];
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (!in_array($file_ext, $allowed_types)) {
                    $data['error'] = "Chỉ chấp nhận file ảnh (JPG, JPEG, PNG, GIF).";
                    $this->loadView('admin/news/edit', $data); return;
                }

                if ($file_size > $max_size) {
                    $data['error'] = "File quá lớn. Vui lòng chọn ảnh dưới 2MB.";
                    $this->loadView('admin/news/edit', $data); return;
                }

                $check = getimagesize($file_tmp);
                if ($check === false) {
                    $data['error'] = "File không phải là ảnh hợp lệ.";
                    $this->loadView('admin/news/edit', $data); return;
                }

                $new_file_name = time() . '_' . uniqid() . '.' . $file_ext;
                $target_file = dirname(dirname(dirname(__FILE__))) . "/public/" . $target_dir . $new_file_name;
                
                if (move_uploaded_file($file_tmp, $target_file)) {
                    // Nếu cần: Xóa ảnh cũ ở đây (nếu tồn tại)
                    $imgUrl = "/" . $target_dir . $new_file_name;
                    $data['featured_image_url'] = $imgUrl; // Cập nhật URL ảnh mới
                } else {
                    $data['error'] = "Có lỗi xảy ra khi upload file.";
                    $this->loadView('admin/news/edit', $data); return;
                }
            }
            // --- KẾT THÚC UPLOAD ---

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

        $this->loadView('admin/news/edit', $data);
    }

    // 4. Xóa bài viết (Admin Delete) - CHUYỂN SANG POST ĐỂ BẢO MẬT
    public function delete() {
        // BẢO MẬT: Chỉ Admin mới được vào
        $this->checkAdmin();

        // BẢO MẬT: Chỉ chấp nhận phương thức POST để tránh CSRF qua link
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // BẢO MẬT: Kiểm tra CSRF
            $this->validateCsrfToken();

            // Lấy ID từ POST thay vì GET
            $id = $_POST['id'] ?? null; 

            if ($id) {
                // (Tùy chọn) Xóa ảnh vật lý nếu cần trước khi xóa DB
                // $news = $this->newsModel->find($id);
                // if ($news && file_exists(...)) unlink(...);

                $this->newsModel->delete($id);
            }
        }
        
        header('Location: ' . URLROOT . '/public/index.php?url=admin/news/list');
        exit;
    }

    // =========================================================================
    // HÀM LOAD VIEW
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