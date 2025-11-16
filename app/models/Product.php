<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function all($keyword = null) {
        if ($keyword) {
            $stmt = $this->db->dbh->prepare("SELECT * FROM products WHERE name LIKE ?");
            $stmt->execute(["%$keyword%"]);
        } else {
            $stmt = $this->db->dbh->prepare("SELECT * FROM products ORDER BY id DESC");
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->dbh->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $description, $price, $imgUrl) {
        $stmt = $this->db->dbh->prepare("
            INSERT INTO products (name, description, price, image_url) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$name, $description, $price, $imgUrl]);
    }

    public function update($id, $name, $description, $price, $imgUrl) {
        $stmt = $this->db->dbh->prepare("
            UPDATE products SET name=?, description=?, price=?, image_url=? 
            WHERE id=?
        ");
        return $stmt->execute([$name, $description, $price, $imgUrl, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->dbh->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([$id]);
    }
}
