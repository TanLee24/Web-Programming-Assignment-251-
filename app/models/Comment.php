<?php
class Comment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // PHẦN 1: DÀNH CHO KHÁCH HÀNG 
    // Hàm thêm bình luận
    public function addComment($userId, $userName, $itemId, $type, $content) {
        $sql = "INSERT INTO comments (user_id, user_name, commentable_id, commentable_type, content, status, created_at) 
                VALUES (:uid, :uname, :nid, :type, :content, 1, NOW())";
        
        $this->db->query($sql);
        $this->db->bind(':uid', $userId);
        $this->db->bind(':uname', $userName);
        $this->db->bind(':nid', $itemId);
        $this->db->bind(':type', $type);
        $this->db->bind(':content', $content);
        
        return $this->db->execute();
    }

    // Hàm lấy danh sách comment ra trang chi tiết
    public function getCommentsByPostId($newsId) {
        $this->db->query("
            SELECT c.*, u.avatar_url, u.full_name, u.username 
            FROM comments c
            LEFT JOIN users u ON c.user_id = u.id
            WHERE c.commentable_id = :newsId 
            AND c.commentable_type = 'news'
            AND c.status = 1  -- [QUAN TRỌNG] Chỉ lấy bình luận có status = 1 (Hiện)
            ORDER BY c.created_at DESC
        ");
        
        $this->db->bind(':newsId', $newsId);
        return $this->db->resultSet();
    }

    // PHẦN 2: DÀNH CHO ADMIN (Lấy hết để quản lý)
    // 1. Hàm đếm tổng số lượng bình luận (để tính số trang)
    public function countAll() {
        $this->db->query("SELECT COUNT(*) as total FROM comments");
        $row = $this->db->single();
        return $row->total;
    }

    // 2. Hàm lấy danh sách có phân trang 
    public function getCommentsPaginated($limit, $offset) {
        // Copy y nguyên câu lệnh SQL join phức tạp từ hàm all() cũ
        // Chỉ thêm LIMIT và OFFSET vào cuối
        $sql = "SELECT 
                    c.*, 
                    u.full_name, 
                    u.email,
                    CASE 
                        WHEN c.commentable_type = 'news' THEN n.title 
                        WHEN c.commentable_type = 'product' THEN p.name 
                        ELSE 'Không xác định'
                    END as item_name
                FROM comments c
                LEFT JOIN users u ON c.user_id = u.id
                LEFT JOIN news n ON (c.commentable_id = n.id AND c.commentable_type = 'news')
                LEFT JOIN products p ON (c.commentable_id = p.id AND c.commentable_type = 'product')
                ORDER BY c.created_at DESC
                LIMIT :limit OFFSET :offset";

        $this->db->query($sql);
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);
        
        return $this->db->resultSet();
    }

    public function all() {
        // Admin cần thấy cả ẩn và hiện nên KHÔNG có điều kiện status = 1 ở đây
        $sql = "SELECT 
                    c.*, 
                    u.full_name, 
                    u.email,
                    CASE 
                        WHEN c.commentable_type = 'news' THEN n.title 
                        WHEN c.commentable_type = 'product' THEN p.name 
                        ELSE 'Không xác định'
                    END as item_name
                FROM comments c
                LEFT JOIN users u ON c.user_id = u.id
                LEFT JOIN news n ON (c.commentable_id = n.id AND c.commentable_type = 'news')
                LEFT JOIN products p ON (c.commentable_id = p.id AND c.commentable_type = 'product')
                ORDER BY c.created_at DESC";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM comments WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function updateStatus($id, $status) {
        $this->db->query("UPDATE comments SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}