<?php
class Contact {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Hàm này đang được gọi và gây lỗi nếu SQL sai
    public function all() {
        $this->db->query("SELECT * FROM contacts ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function save($data) {
        $this->db->query("INSERT INTO contacts (name, email, message, created_at) VALUES (:name, :email, :message, NOW())");
        $this->db->bind(':name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':message', $data['message']);
        return $this->db->execute();
    }
    
    // Hàm updateStatus để tính năng "Đánh dấu đã đọc" hoạt động
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE contacts SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM contacts WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Phân trang cho trang quản trị liên hệ
    // 1. Đếm tổng số liên hệ
    public function countAll() {
        $this->db->query("SELECT COUNT(*) as total FROM contacts");
        $row = $this->db->single();
        return $row->total;
    }

    // 2. Lấy danh sách liên hệ có phân trang
    public function getPaginated($limit, $offset) {
        // Thay vì lấy tất cả, ta thêm LIMIT và OFFSET
        $this->db->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
        
        // Quan trọng: Ép kiểu int để tránh lỗi SQL
        $this->db->bind(':limit', (int)$limit);
        $this->db->bind(':offset', (int)$offset);
        
        return $this->db->resultSet();
    }
}