<?php
class Order {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function all() {
        $stmt = $this->db->dbh->prepare("
            SELECT orders.*, users.username 
            FROM orders
            JOIN users ON orders.user_id = users.id
            ORDER BY id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->dbh->prepare("SELECT * FROM orders WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->dbh->prepare("UPDATE orders SET status=? WHERE id=?");
        return $stmt->execute([$status, $id]);
    }
}
