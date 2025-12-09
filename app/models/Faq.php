<?php
class Faq 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Database;
    }

    // Lấy tất cả câu hỏi
    public function all() 
    {
        $this->db->query("SELECT * FROM faqs ORDER BY id DESC");
        return $this->db->resultSet(); // Sử dụng resultSet() để lấy danh sách
    }

    // Tìm một câu hỏi theo ID
    public function find($id) 
    {
        $this->db->query("SELECT * FROM faqs WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single(); // Sử dụng single() để lấy một dòng
    }

    // Tạo câu hỏi mới
    public function create($question, $answer) 
    {
        $this->db->query("INSERT INTO faqs (question, answer) VALUES (:question, :answer)");
        $this->db->bind(':question', $question);
        $this->db->bind(':answer', $answer);
        return $this->db->execute();
    }

    // Cập nhật câu hỏi
    public function update($id, $question, $answer) 
    {
        $this->db->query("UPDATE faqs SET question = :question, answer = :answer WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':question', $question);
        $this->db->bind(':answer', $answer);
        return $this->db->execute();
    }

    // Xóa câu hỏi
    public function delete($id) 
    {
        $this->db->query("DELETE FROM faqs WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Phân trang cho trang quản trị FAQ
    // 1. Đếm tổng số câu hỏi
    public function countAll() {
        $this->db->query("SELECT COUNT(*) as total FROM faqs");
        $row = $this->db->single();
        return $row->total;
    }

    // 2. Lấy danh sách câu hỏi có phân trang
    public function getPaginated($limit, $offset) {
        $this->db->query("SELECT * FROM faqs ORDER BY id DESC LIMIT :limit OFFSET :offset");
        
        // Quan trọng: Ép kiểu int để tránh lỗi SQL
        $this->db->bind(':limit', (int)$limit);
        $this->db->bind(':offset', (int)$offset);
        
        return $this->db->resultSet();
    }
}