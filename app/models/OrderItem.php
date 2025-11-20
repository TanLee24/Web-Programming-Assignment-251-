<?php
class OrderItem {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Đã sửa lỗi: Dùng query() và resultSet()
    public function itemsOf($orderId)
    {
        $this->db->query("
            SELECT 
                oi.*, 
                p.name AS product_name,
                p.image_url AS product_image,
                p.price AS product_price
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = :oid
        ");
        $this->db->bind(':oid', $orderId);
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

    // public function getByOrder($order_id) {
    //     $this->db->query("SELECT * FROM order_items WHERE order_id = :oid");
    //     $this->db->bind(":oid", $order_id);
    //     return $this->db->resultSet();
    // }

    public function deleteByOrder($order_id) {
        $this->db->query("DELETE FROM order_items WHERE order_id = :oid");
        $this->db->bind(":oid", $order_id);
        return $this->db->execute();
    }

}