<?php
require_once APPROOT . "/models/Setting.php";
require_once APPROOT . "/libraries/Database.php";

class AdminAboutController 
{
    private $db;

    public function __construct() 
    {
        $this->checkAdminAccess();
        $this->db = new Database();
    }

    public function index() 
    {
        $about = new stdClass();
        // Chỉ lấy Content từ DB
        $about->content = $this->getSettingValue('about_content');

        // Render View
        $data = ['about' => $about]; // Đóng gói data chuẩn hơn
        
        ob_start();
        require_once APPROOT . "/views/admin/about/edit.php";
        $content = ob_get_clean();

        require_once APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function update() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // Chỉ lấy Content từ Form
            $content = $_POST['content'] ?? '';

            // Chỉ lưu Content
            $this->saveSetting('about_content', $content);

            header("Location: " . URLROOT . "/public/index.php?url=admin/about/index");
            exit;
        }
        echo "Lỗi: Chỉ hỗ trợ POST";
    }

    // --- HELPER FUNCTIONS ---
    private function checkAdminAccess() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/public/index.php?url=auth/login");
            exit;
        }
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            if (file_exists(APPROOT . '/views/errors/403.php')) {
                require_once APPROOT . '/views/errors/403.php';
            } else {
                echo "<h1>403 Forbidden</h1><p>Bạn không có quyền truy cập trang này!</p>";
            }
            exit;
        }
    }

    private function getSettingValue($key) {
        $this->db->query("SELECT setting_value FROM settings WHERE setting_key = :key");
        $this->db->bind(':key', $key);
        $row = $this->db->single();
        return $row ? $row->setting_value : '';
    }

    private function saveSetting($key, $value) {
        $this->db->query("SELECT id FROM settings WHERE setting_key = :key");
        $this->db->bind(':key', $key);
        $exists = $this->db->single();

        if ($exists) {
            $this->db->query("UPDATE settings SET setting_value = :value, updated_at = NOW() WHERE setting_key = :key");
        } else {
            $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value)");
        }
        $this->db->bind(':key', $key);
        $this->db->bind(':value', $value);
        $this->db->execute();
    }
}