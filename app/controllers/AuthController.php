<?php
require_once APPROOT . '/models/User.php';
class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // --- ĐĂNG KÝ ---
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'full_name' => trim($_POST['full_name']),
                'username'  => trim($_POST['username']),
                'email'     => trim($_POST['email']),
                'password'  => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'error'     => ''
            ];

            if (empty($data['email']) || empty($data['password']) || empty($data['username'])) {
                $data['error'] = "Vui lòng điền đầy đủ thông tin!";
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['error'] = "Mật khẩu xác nhận không khớp!";
            } elseif ($this->userModel->checkUserExists($data['email'], $data['username'])) {
                $data['error'] = "Email hoặc Tên tài khoản đã tồn tại!";
            }

            if (empty($data['error'])) {
                // Mã hóa password trước khi lưu
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    header('Location: ' . URLROOT . '/public/index.php?url=auth/login');
                    exit;
                } else {
                    $data['error'] = "Lỗi hệ thống, vui lòng thử lại.";
                }
            }

            $this->loadView('public/auth/register', $data);
        } else {
            $this->loadView('public/auth/register');
        }
    }

    // --- ĐĂNG NHẬP ---
    public function login() {
        // Khởi tạo data để tránh lỗi Undefined variable
        $data = [
            'email' => '',
            'password' => '',
            'error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['email'] = trim($_POST['email']);
            $data['password'] = trim($_POST['password']);

            $user = $this->userModel->findUserByEmailOrUsername($data['email']);

            if ($user) {
                if ($user->status === 'banned') {
                    $data['error'] = "Tài khoản của bạn đã bị khóa!";
                } elseif (password_verify($data['password'], $user->password_hash)) {
                    $this->createUserSession($user);
                } else {
                    $data['error'] = "Mật khẩu không chính xác!";
                }
            } else {
                $data['error'] = "Tài khoản không tồn tại!";
            }
        }
        $this->loadView('public/auth/login', $data);
    }

    // --- QUÊN MẬT KHẨU (Bước 1: Nhập Email) ---
    public function forgot_password() {
        $data = ['email' => '', 'error' => '', 'success' => ''];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['email'] = trim($_POST['email']);
            $user = $this->userModel->findUserByEmail($data['email']);

            if ($user) {
                // Tạo token
                $token = bin2hex(random_bytes(32));
                
                // Lưu token vào DB (cần đảm bảo Model có hàm createResetToken)
                if ($this->userModel->createResetToken($user->id, $token)) {
                    // Link reset
                    $resetLink = URLROOT . "/public/index.php?url=auth/reset_password/" . $token;
                    $data['success'] = "Link reset (Demo): <a href='$resetLink'>$resetLink</a>";
                } else {
                    $data['error'] = "Lỗi hệ thống.";
                }
            } else {
                $data['error'] = "Email không tồn tại.";
            }
        }
        $this->loadView('public/auth/forgot', $data);
    }

    // --- ĐẶT LẠI MẬT KHẨU (Bước 2: Nhập Pass mới) ---
    public function reset_password($token = null) {
        if (!$token) die("Token thiếu!");

        $data = ['token' => $token, 'error' => ''];
        
        // Kiểm tra token (Cần đảm bảo Model có hàm getUserIdByToken)
        $userId = $this->userModel->getUserIdByToken($token);
        if (!$userId) die("Link không hợp lệ hoặc hết hạn!");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pass = trim($_POST['password']);
            $confirm = trim($_POST['confirm_password']);

            if ($pass != $confirm) {
                $data['error'] = "Mật khẩu không khớp!";
            } else {
                $newHash = password_hash($pass, PASSWORD_DEFAULT);
                
                // Cập nhật pass (Cần đảm bảo Model có hàm recoverPassword)
                if ($this->userModel->recoverPassword($userId, $newHash)) {
                    $_SESSION['success_message'] = "Đổi mật khẩu thành công!";
                    header('Location: ' . URLROOT . '/public/index.php?url=auth/login');
                    exit;
                }
            }
        }
        $this->loadView('public/auth/reset', $data);
    }

    // --- HELPER ---
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->full_name;
        $_SESSION['user_role'] = $user->role;

        if ($user->role == 'admin') {
            header('Location: ' . URLROOT . '/public/index.php?url=admin/dashboard');
        } else {
            header('Location: ' . URLROOT . '/public/index.php');
        }
        exit;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ' . URLROOT . '/public/index.php');
        exit;
    }

    public function loadView($view, $data = []) {
        extract($data);
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exist.");
        }
    }
}