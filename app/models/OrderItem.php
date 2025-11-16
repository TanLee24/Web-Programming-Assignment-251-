<?php
class OrderItem {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function itemsOf($orderId) {
        $stmt = $this->db->dbh->prepare("
            SELECT order_items.*, products.name 
            FROM order_items
            JOIN products ON products.id = order_items.product_id
            WHERE order_id=?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }
}
