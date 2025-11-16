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

    public function list() {
        $orders = $this->order->all();
        $title = "Quản lý đơn hàng";

        ob_start();
        require APPROOT . "/views/admin/orders/list.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function detail($id) {
        $order = $this->order->find($id);
        $items = $this->item->itemsOf($id);

        $title = "Chi tiết đơn hàng";

        ob_start();
        require APPROOT . "/views/admin/orders/detail.php";
        $content = ob_get_clean();

        require APPROOT . "/views/admin/layouts/admin_layout.php";
    }

    public function updateStatus($id) {
        $this->order->updateStatus($id, $_POST['status']);
        header("Location: /public/index.php?url=admin/order/detail/$id");
    }
}
