<?php
class Order {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // 1. Lấy tất cả đơn hàng (dùng query và resultSet)
    public function all() {
        $sql = "
            SELECT orders.*, users.username 
            FROM orders
            LEFT JOIN users ON orders.user_id = users.id
            ORDER BY id DESC
        ";
        $this->db->query($sql);
        return $this->db->resultSet(); // Lấy danh sách nhiều dòng
    }

    // 2. Tìm một đơn hàng theo ID (dùng query, bind và single)
    public function find($id) {
        $this->db->query("SELECT * FROM orders WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single(); // Lấy một dòng duy nhất
    }

    // 3. Cập nhật trạng thái (dùng query, bind và execute)
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE orders SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // 4. Tạo đơn hàng mới (dùng wrapper methods)
    public function create($userId, $fullname, $phone, $address, $total, $note = '') {
        $sql = "INSERT INTO orders (user_id, fullname, phone, address, total_amount, note, status, created_at) 
                VALUES (:user_id, :fullname, :phone, :address, :total, :note, 'pending', NOW())";
        
        $this->db->query($sql);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':fullname', $fullname);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':address', $address);
        $this->db->bind(':total', $total);
        $this->db->bind(':note', $note);
        
        if ($this->db->execute()) {
            // Lấy ID vừa tạo.
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function delete($id) {
        $this->db->query("DELETE FROM orders WHERE id = :id");
        $this->db->bind(":id", $id);
        return $this->db->execute();
    }
}