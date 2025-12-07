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

    public function add($orderId, $productId, $size, $qty, $price) 
    {
        $this->db->query("INSERT INTO order_items 
            (order_id, product_id, size, quantity, price_at_purchase) 
            VALUES (:oid, :pid, :size, :qty, :price)");

        $this->db->bind(':oid', $orderId);
        $this->db->bind(':pid', $productId);
        $this->db->bind(':size', $size);
        $this->db->bind(':qty', $qty);
        $this->db->bind(':price', $price);

        return $this->db->execute();
    }


    public function deleteByOrder($order_id) {
        $this->db->query("DELETE FROM order_items WHERE order_id = :oid");
        $this->db->bind(":oid", $order_id);
        return $this->db->execute();
    }

}