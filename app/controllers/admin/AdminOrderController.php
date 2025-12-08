<?php
require_once APPROOT . "/models/Order.php";
require_once APPROOT . "/models/OrderItem.php";

class AdminOrderController {
    private $order;
    private $item;

    public function __construct() {
        $this->checkAdminAccess();
        $this->order = new Order();
        $this->item = new OrderItem();
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

    public function list() 
    {
        $orders = $this->order->all();
        $this->loadView("admin/orders/list", ["orders" => $orders, "title" => "Quản lý đơn hàng"]);
    }

    public function detail($id) 
    {
        $order = $this->order->find($id);
        $items = $this->item->itemsOf($id);

        $this->loadView("admin/orders/detail", [
            "order" => $order,
            "items" => $items,
            "title" => "Chi tiết đơn hàng"
        ]);
    }


    public function updateStatus() 
    {
        $id = $_POST["order_id"];
        $status = $_POST["status"];

        $this->order->updateStatus($id, $status);

        header("Location: " . URLROOT . "/public/index.php?url=admin/order/list");
        exit;
    }

    
    public function delete($id) {
        $id = (int)$id;

        if ($id > 0) {
            // Xóa chi tiết đơn hàng trước (bảng con - order_items)
            $this->item->deleteByOrder($id);

            // Sau đó mới xóa đơn hàng chính (bảng cha - orders)
            $this->order->delete($id);
        }

        header("Location: " . URLROOT . "/public/index.php?url=admin/order/list");
        exit;
    }

    private function loadView($viewPath, $data = []) {
        extract($data);

        ob_start();
        require APPROOT . "/views/" . $viewPath . ".php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

}
