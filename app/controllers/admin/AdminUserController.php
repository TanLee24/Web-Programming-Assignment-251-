<?php
require_once APPROOT . '/models/User.php';

class AdminUserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // 1. Danh sách thành viên
    public function index() {
        $users = $this->userModel->all();
        $data = [
            'users' => $users,
            'title' => 'Quản lý thành viên'
        ];
        $this->loadView('admin/users/list', $data);
    }

    // 2. Khóa / Mở khóa thành viên
    public function ban() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $user = $this->userModel->find($id);
            
            // Bảo vệ: Không cho phép khóa tài khoản Admin
            if ($user->role === 'admin') {
                echo "<script>alert('Không thể khóa tài khoản Admin!'); window.location.href='" . URLROOT . "/public/index.php?url=admin/user/index';</script>";
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
        $id = $_GET['id'] ?? null;
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