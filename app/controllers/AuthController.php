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
            // Lấy dữ liệu từ form
            $data = [
                'full_name' => trim($_POST['full_name']),
                'username'  => trim($_POST['username']),
                'email'     => trim($_POST['email']),
                'password'  => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'error'     => ''
            ];

            // Validate cơ bản
            if (empty($data['email']) || empty($data['password']) || empty($data['username'])) {
                $data['error'] = "Vui lòng điền đầy đủ thông tin!";
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['error'] = "Mật khẩu xác nhận không khớp!";
            } elseif ($this->userModel->checkUserExists($data['email'], $data['username'])) {
                $data['error'] = "Email hoặc Tên tài khoản đã tồn tại!";
            }

            // Nếu không lỗi -> Đăng ký
            if (empty($data['error'])) {
                if ($this->userModel->register($data)) {
                    // Đăng ký xong chuyển qua trang Login
                    header('Location: ' . URLROOT . '/public/index.php?url=auth/login');
                    exit;
                } else {
                    $data['error'] = "Lỗi hệ thống, vui lòng thử lại.";
                }
            }

            // Có lỗi thì hiện lại form kèm lỗi
            $this->loadView('public/auth/register', $data);
        } else {
            $this->loadView('public/auth/register');
        }
    }

    // --- ĐĂNG NHẬP ---
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $emailOrUsername = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Tìm user trong DB
            $user = $this->userModel->findUserByEmailOrUsername($emailOrUsername);

            if ($user) {
                // 1. KIỂM TRA TRẠNG THÁI TRƯỚC (Code mới thêm)
                if ($user->status === 'banned') {
                    $data['error'] = "Tài khoản của bạn đã bị khóa do vi phạm chính sách!";
                    $this->loadView('public/auth/login', $data);
                    return; // Dừng lại, không cho đi tiếp
                }

                // 2. Kiểm tra mật khẩu (Code cũ)
                if (password_verify($password, $user->password_hash)) {
                    $this->createUserSession($user);
                } else {
                    $data['error'] = "Mật khẩu không chính xác!";
                    $this->loadView('public/auth/login', $data);
                }
            } else {
                $data['error'] = "Tài khoản không tồn tại!";
                $this->loadView('public/auth/login', $data);
            }
        } else {
            $this->loadView('public/auth/login');
        }
    }

    // --- ĐĂNG XUẤT ---
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        header('Location: ' . URLROOT . '/public/index.php');
        exit;
    }

    // Hàm load view (giữ nguyên cấu trúc của bạn)
    public function loadView($view, $data = []) {
        extract($data);
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        }
    }

    // Hàm tạo Session sau khi đăng nhập thành công
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->full_name;
        $_SESSION['user_role'] = $user->role;
        
        // Chuyển hướng về trang chủ
        header('Location: ' . URLROOT . '/public/index.php');
        exit;
    }
}