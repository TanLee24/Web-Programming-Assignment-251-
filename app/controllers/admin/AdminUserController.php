<?php
require_once APPROOT . '/models/User.php';

class AdminUserController {
    private $userModel;

    public function __construct() {
        $this->checkAdminAccess();
        $this->userModel = new User();
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

    // 1. Danh sách thành viên
    public function index() {
        // CẤU HÌNH PHÂN TRANG 
        $limit = 5; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        
        $offset = ($page - 1) * $limit;

        // 1. Lấy tổng số user
        $totalRecords = $this->userModel->countAll();
        $totalPages = ceil($totalRecords / $limit);

        // 2. Lấy dữ liệu phân trang
        $users = $this->userModel->getPaginated($limit, $offset);
        // ---------------------------

        $data = [
            'users' => $users,
            'title' => 'Quản lý thành viên',
            'page' => $page,            // Truyền sang view
            'totalPages' => $totalPages // Truyền sang view
        ];
        $this->loadView('admin/users/list', $data);
    }

    // 2. Khóa / Mở khóa thành viên
    public function ban() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if ($id) {
            $user = $this->userModel->find($id);
            
            // Bảo vệ: Không cho phép khóa tài khoản Admin
            if ($user->role === 'admin') {
                echo "<script>alert('Không thể khóa tài khoản Admin!'); 
                window.location.href='" . URLROOT . "/public/index.php?url=admin/user/index';</script>";
                exit;
            }

            // Đảo ngược trạng thái
            $newStatus = ($user->status === 'active') ? 'banned' : 'active';
            $this->userModel->updateStatus($id, $newStatus);
        }
        
        header('Location: ' . URLROOT . '/public/index.php?url=admin/user/index');
    }

    // 3. Reset mật khẩu về mặc định (123456)
    public function reset() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
        
        if ($id) {
            $defaultPass = '123456';
            $hash = password_hash($defaultPass, PASSWORD_DEFAULT);
            
            $this->userModel->resetPassword($id, $hash);
            
            echo "<script>alert('Đã reset mật khẩu thành công về: 123456'); window.location.href='" . URLROOT . "/public/index.php?url=admin/user/index';</script>";
            exit;
        }
        header('Location: ' . URLROOT . '/public/index.php?url=admin/user/index');
    }

    private function loadView($viewPath, $data = []) {
        extract($data);
        $fileView = '../app/views/' . $viewPath . '.php';
        if (file_exists($fileView)) {
            ob_start();
            require_once $fileView;
            $content = ob_get_clean();
            require_once '../app/views/admin/layouts/admin_layout.php';
        }
    }
}