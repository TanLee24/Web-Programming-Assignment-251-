<?php
class Comment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Thêm bình luận (Lưu cả User ID và User Name)
    public function addComment($userId, $userName, $newsId, $content) {
        $sql = "INSERT INTO comments (user_id, user_name, commentable_id, commentable_type, content, status, created_at) 
                VALUES (:uid, :uname, :nid, 'news', :content, 'pending', NOW())";
        
        $this->db->query($sql);
        $this->db->bind(':uid', $userId);
        $this->db->bind(':uname', $userName); // Lưu tên vào bảng comments luôn
        $this->db->bind(':nid', $newsId);
        $this->db->bind(':content', $content);
        
        return $this->db->execute();
    }

    // Lấy danh sách bình luận (Có thể JOIN thêm users để lấy avatar nếu cần)
    public function getCommentsByPostId($newsId) {
        // JOIN để lấy thêm avatar_url từ bảng users
        $sql = "SELECT c.*, u.avatar_url 
                FROM comments c
                LEFT JOIN users u ON c.user_id = u.id
                WHERE c.commentable_type = 'news' 
                AND c.commentable_id = :id 
                ORDER BY c.created_at DESC";
        
        $this->db->query($sql);
        $this->db->bind(':id', $newsId);
        return $this->db->resultSet();
    }
}