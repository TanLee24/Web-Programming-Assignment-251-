<?php
require_once APPROOT . "/models/Order.php";
require_once APPROOT . "/models/OrderItem.php";

class AdminOrderController {
    private $order;
    private $item;

    public function __construct() {
        $this->order = new Order();
        $this->item = new OrderItem();
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
        // Xóa tất cả item trước
        $this->item->deleteByOrder($id);

        // Xóa đơn chính
        $this->order->delete($id);

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
