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

    // Lấy danh sách bình luận kèm theo Avatar từ bảng Users
    public function getCommentsByPostId($newsId) {
        $this->db->query("
            SELECT c.*, u.avatar_url, u.full_name, u.username 
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.commentable_id = :newsId 
            AND c.commentable_type = 'news'
            ORDER BY c.created_at DESC
        ");
        
        $this->db->bind(':newsId', $newsId);
        return $this->db->resultSet();
    }
}