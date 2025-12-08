<?php
require_once APPROOT . '/models/User.php';

class ProfileController {
    private $userModel;

    public function __construct() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . URLROOT . '/public/index.php?url=auth/login');
            exit;
        }
        $this->userModel = new User();
    }

    public function index() {
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->find($userId);
        
        $data = [
            'user' => $user,
            'title' => 'Thông tin tài khoản',
            'success' => '',
            'error' => ''
        ];

        // Xử lý khi Submit Form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $updateData = [
                'full_name' => trim($_POST['full_name']),
                'email'     => trim($_POST['email']),
                'password'  => '',
                'avatar'    => ''
            ];

            // Xử lý đổi mật khẩu
            if (!empty($_POST['new_password'])) {
                if ($_POST['new_password'] === $_POST['confirm_password']) {
                    $updateData['password'] = $_POST['new_password'];
                } else {
                    $data['error'] = "Mật khẩu xác nhận không khớp!";
                }
            }

            // Xử lý Upload Avatar
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                // 1. Danh sách đuôi file cho phép
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $filename = $_FILES['avatar']['name'];
                $filesize = $_FILES['avatar']['size'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // 2. Kiểm tra MIME Type thực tế của file (Chống file giả mạo)
                $checkImage = getimagesize($_FILES['avatar']['tmp_name']);

                if (!in_array($ext, $allowed)) {
                    $data['error'] = "Chỉ chấp nhận file ảnh (JPG, PNG, GIF)!";
                } elseif ($checkImage === false) {
                    $data['error'] = "File không phải là ảnh hợp lệ!";
                } elseif ($filesize > 5 * 1024 * 1024) {
                    $data['error'] = "File ảnh quá lớn (Max 5MB)";
                } else {
                    // 3. Đặt tên file ngẫu nhiên để bảo mật
                    $newFilename = "avatar_" . $userId . "_" . bin2hex(random_bytes(8)) . "." . $ext;
                    
                    // Đường dẫn vật lý trên server
                    $uploadDir = dirname(dirname(dirname(__FILE__))) . "/public/uploads/avatars/";
                    
                    if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $newFilename)) {
                        $updateData['avatar'] = "uploads/avatars/" . $newFilename;
                    } else {
                        $data['error'] = "Lỗi khi tải ảnh lên server.";
                    }
                }
            }

            if (empty($data['error'])) {
                if ($this->userModel->update($userId, $updateData)) {
                    $data['success'] = "Cập nhật thông tin thành công!";
                    $_SESSION['user_name'] = $updateData['full_name'];
                    $data['user'] = $this->userModel->find($userId);
                } else {
                    $data['error'] = "Đã có lỗi xảy ra.";
                }
            }
        }

        $this->loadView('public/auth/profile', $data);
    }

    // --- HÀM LOAD VIEW  ---
    public function loadView($viewPath, $data = []) {
        extract($data);
        $fileView = '../app/views/' . $viewPath . '.php';

        if (file_exists($fileView)) {
            // 1. Bắt đầu bộ đệm
            ob_start();
            
            // 2. Nạp nội dung view con (profile)
            require_once $fileView;
            
            // 3. Lưu nội dung vào biến $content
            $content = ob_get_clean();
            
            // 4. Nạp Layout chính (Chứa CSS, Header, Footer)
            require_once '../app/views/layouts/main.php';
        } else {
            die("File view không tồn tại: " . $viewPath);
        }
    }
}