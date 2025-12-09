<?php
require_once APPROOT . "/models/Faq.php";

class AdminFaqController {
    private $faq;

    public function __construct() {
        $this->checkAdminAccess();
        $this->faq = new Faq();
    }

    // ĐỊNH NGHĨA HÀM KIỂM TRA (Bảo Mật)
    private function checkAdminAccess() 
    {
        // 1. Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }

        // 2. Kiểm tra quyền Admin
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            
            // HIỆN LỖI 403 
            
            // Gửi mã phản hồi HTTP 403 cho trình duyệt (quan trọng cho SEO/Bot)
            http_response_code(403);
            
            // Load file giao diện lỗi vừa tạo
            if (file_exists(APPROOT . '/views/errors/403.php')) {
                require_once APPROOT . '/views/errors/403.php';
            } else {
                // Dự phòng nếu chưa tạo file view
                echo "<h1>403 Forbidden</h1><p>Bạn không có quyền truy cập trang này!</p>";
            }
            
            // Dừng code ngay lập tức để không lộ nội dung trang Admin
            exit;
        }
    }

    // 1. Danh sách FAQ 
    public function list() {
        // CẤU HÌNH PHÂN TRANG 
        $limit = 5; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        
        $offset = ($page - 1) * $limit;

        // 1. Lấy tổng số câu hỏi
        $totalRecords = $this->faq->countAll();
        $totalPages = ceil($totalRecords / $limit);

        // 2. Lấy dữ liệu phân trang 
        $faqs = $this->faq->getPaginated($limit, $offset);

        $title = "Quản lý FAQ";
        
        // Load View
        ob_start();
        // Truyền thêm biến $page và $totalPages sang View
        require_once APPROOT . "/views/admin/faq/list.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->faq->create($_POST['question'], $_POST['answer']);
            header("Location: " . URLROOT . "/public/index.php?url=admin/faq/list");
            exit;
        }

        $title = "Thêm câu hỏi mới";

        ob_start();
        require_once APPROOT . "/views/admin/faq/create.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function edit($id) {
        $id = (int)$id;
        $faq = $this->faq->find($id);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $question = htmlspecialchars(trim($_POST['question']));
            $answer = htmlspecialchars(trim($_POST['answer']));
            
            $this->faq->update($id, $question, $answer);
            header("Location: " . URLROOT . "/public/index.php?url=admin/faq/list");
            exit;
        }

        $title = "Sửa câu hỏi";

        ob_start();
        require_once APPROOT . "/views/admin/faq/edit.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function delete($id) {
        $id = (int)$id; 
        if ($id > 0) {
            $this->faq->delete($id);
        }
        header("Location: " . URLROOT . "/public/index.php?url=admin/faq/list");
    }
}
