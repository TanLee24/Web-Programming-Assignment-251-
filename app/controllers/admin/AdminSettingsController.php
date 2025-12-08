<?php
require_once APPROOT . "/models/Setting.php";

class AdminSettingsController {
    private $settingModel;

    public function __construct() {
        $this->checkAdminAccess();
        $this->settingModel = new Setting();
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

    // --- CẤU HÌNH CHUNG (Vừa hiển thị, vừa xử lý lưu) ---
    public function index() {
        // 1. XỬ LÝ POST (LƯU DỮ LIỆU)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Cập nhật thông tin văn bản
            $this->settingModel->update('company_name', $_POST['company_name'] ?? '');
            $this->settingModel->update('phone', $_POST['phone'] ?? '');
            $this->settingModel->update('address', $_POST['address'] ?? '');
            $this->settingModel->update('intro_text', $_POST['intro_text'] ?? '');

            // XỬ LÝ UPLOAD LOGO 
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']; // Logo có thể là SVG
                $filename = $_FILES['logo']['name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                
                // Lưu ý: getimagesize có thể không chạy với SVG, nên chỉ check với ảnh thường
                $check = ($ext === 'svg') ? true : getimagesize($_FILES['logo']['tmp_name']);

                if (in_array($ext, $allowed) && $check !== false) {
                    $new_name = "logo_" . time() . "." . $ext; // Đặt tên logo
                    $targetPath = dirname(APPROOT) . "/public/uploads/" . $new_name;

                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath)) {
                        $logoUrl = "/public/uploads/" . $new_name;
                        $this->settingModel->update('logo_path', $logoUrl);
                    }
                }
                else {
                    echo "<script>alert('Lỗi: File logo không hợp lệ!'); window.history.back();</script>";
                    exit;
                }
            }

            // Redirect lại trang settings
            header("Location: " . URLROOT . "/public/index.php?url=admin/settings/index");
            exit;
        }

        // 2. XỬ LÝ GET (HIỂN THỊ VIEW)
        // Lấy dữ liệu ra để điền vào form
        $data = [
            'company_name' => $this->settingModel->get('company_name'),
            'phone'        => $this->settingModel->get('phone'),
            'address'      => $this->settingModel->get('address'),
            'intro_text'   => $this->settingModel->get('intro_text'),
            'logo_path'    => $this->settingModel->get('logo_path')
        ];
        
        extract($data); 

        $title = "Cấu hình chung";

        ob_start();
        require APPROOT . "/views/admin/settings/setting.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }
}