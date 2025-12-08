<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function all($keyword = null, $brand = null) 
    {
        $sql = "SELECT * FROM products WHERE 1";

        if ($keyword) {
            $sql .= " AND name LIKE :keyword";
        }

        if ($brand) {
            $sql .= " AND brand = :brand";
        }

        $this->db->query($sql);

        if ($keyword) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        if ($brand) {
            $this->db->bind(':brand', $brand);
        }

        return $this->db->resultSet();
    }


    // Dùng query(), bind() và single()
    public function find($id) {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single(); // Lấy 1 sản phẩm
    }

    // Dùng query(), bind() và execute()
    public function create($name, $description, $price, $imgUrl, $brand) { // Đã thêm $brand
        $sql = "
            INSERT INTO products (name, description, price, image_url, brand) 
            VALUES (:name, :description, :price, :image_url, :brand)
        ";
        $this->db->query($sql);
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':image_url', $imgUrl);
        $this->db->bind(':brand', $brand); // Bind tham số mới
        
        return $this->db->execute();
    }

    // Dùng query(), bind() và execute()
    public function update($id, $name, $description, $price, $imgUrl, $brand) 
    { 
        $sql = "
            UPDATE products 
            SET name = :name, description = :description, price = :price, image_url = :image_url, brand = :brand 
            WHERE id = :id
        ";
        $this->db->query($sql);
        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':image_url', $imgUrl);
        $this->db->bind(':brand', $brand); // Bind tham số mới
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Dùng query(), bind() và execute()
    public function delete($id) 
    {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getUniqueBrands() 
    {
        $sql = "SELECT DISTINCT brand FROM products WHERE brand IS NOT NULL AND brand != '' ORDER BY brand ASC";
        $this->db->query($sql);
        return $this->db->resultSet(); // Trả về danh sách các hãng
    }

    public function getSizes($productId) 
    {
        $this->db->query("SELECT * FROM product_sizes WHERE product_id = :id ORDER BY size");
        $this->db->bind(':id', $productId);
        return $this->db->resultSet();
    }

}