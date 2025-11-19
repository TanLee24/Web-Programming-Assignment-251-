<?php
class OrderItem {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Đã sửa lỗi: Dùng query() và resultSet()
    public function itemsOf($orderId) {
        $sql = "
            SELECT order_items.*, products.name 
            FROM order_items
            JOIN products ON products.id = order_items.product_id
            WHERE order_id = :orderId
        ";
        $this->db->query($sql);
        $this->db->bind(':orderId', $orderId);
        return $this->db->resultSet(); 
    }
    
    // Hàm này đã đúng từ trước
    public function add($orderId, $productId, $quantity, $price_at_purchase) {
        $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (:oid, :pid, :qty, :price_at_purchase)");
        $this->db->bind(':oid', $orderId);
        $this->db->bind(':pid', $productId);
        $this->db->bind(':qty', $quantity);
        $this->db->bind(':price_at_purchase', $price_at_purchase);
        return $this->db->execute();
    }
}