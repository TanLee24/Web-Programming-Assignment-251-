<?php
require_once APPROOT . "/models/Setting.php";

class AdminSettingsController {
    private $settingModel;

    public function __construct() {
        $this->settingModel = new Setting();
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

            // --- XỬ LÝ UPLOAD LOGO (Code chuẩn theo AdminProductController) ---
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
                $img = $_FILES['logo'];
                $filename = time() . "_" . basename($img['name']);

                // Đường dẫn vật lý
                $targetPath = dirname(APPROOT) . "/public/uploads/" . $filename;

                if (move_uploaded_file($img['tmp_name'], $targetPath)) {
                    // Đường dẫn URL lưu vào DB
                    // Lưu ý: Bên Product lưu "/public/uploads/..." nên ở đây cũng nên lưu như vậy để đồng bộ hiển thị
                    $logoUrl = "/public/uploads/" . $filename;
                    
                    $this->settingModel->update('logo_path', $logoUrl);
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
        
        // Nếu view của bạn dùng biến $data thì giữ nguyên, 
        // hoặc nếu view dùng biến lẻ ($company_name...) thì dùng extract($data);
        extract($data); 

        $title = "Cấu hình chung";

        ob_start();
        // Đường dẫn view chuẩn
        require APPROOT . "/views/admin/settings/setting.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }
}