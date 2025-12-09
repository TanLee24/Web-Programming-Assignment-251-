<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // 1. Đăng ký
    public function register($data) {
        $sql = "INSERT INTO users (username, email, password_hash, full_name, role, status, created_at) 
                VALUES (:username, :email, :pass, :fullname, 'member', 'active', NOW())";
        $this->db->query($sql);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['password']); 
        $this->db->bind(':fullname', $data['full_name']);
        return $this->db->execute();
    }

    // 2. Đăng nhập
    public function findUserByEmailOrUsername($input) {
        $this->db->query("SELECT * FROM users WHERE email = :email_val OR username = :user_val");
        $this->db->bind(':email_val', $input);
        $this->db->bind(':user_val', $input);
        return $this->db->single();
    }

    // 3. Kiểm tra user tồn tại
    public function checkUserExists($email, $username) {
        $this->db->query("SELECT id FROM users WHERE email = :email OR username = :username");
        $this->db->bind(':email', $email);
        $this->db->bind(':username', $username);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    // Lấy danh sách tất cả thành viên
    public function all() {
        $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Cập nhật trạng thái (Khóa/Mở khóa)
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE users SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Reset mật khẩu
    public function resetPassword($id, $hash) {
        $this->db->query("UPDATE users SET password_hash = :pass WHERE id = :id");
        $this->db->bind(':pass', $hash);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    // --- CÁC HÀM PHỤC VỤ QUÊN MẬT KHẨU ---

    public function findUserByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function createResetToken($userId, $token) {
        // 1. Xóa token cũ
        $this->db->query("DELETE FROM password_resets WHERE user_id = :user_id");
        $this->db->bind(':user_id', $userId);
        $this->db->execute();

        // 2. Tạo token mới
        // Thay vì dùng PHP date(), dùng hàm DATE_ADD(NOW(), ...) của MySQL
        // Điều này đảm bảo giờ tạo và giờ kiểm tra (NOW) luôn cùng một múi giờ
        $sql = "INSERT INTO password_resets (user_id, token, expires_at)
                VALUES (:user_id, :token, DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        
        $this->db->query($sql);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':token', $token);
        
        return $this->db->execute();
    }

    public function getUserIdByToken($token) {
        $this->db->query("SELECT user_id FROM password_resets WHERE token = :token AND expires_at > NOW()");
        $this->db->bind(':token', $token);
        $row = $this->db->single();
        return $row ? $row->user_id : false;
    }

    public function recoverPassword($userId, $newPasswordHash) {
        $this->db->query("UPDATE users SET password_hash = :password WHERE id = :id");
        $this->db->bind(':password', $newPasswordHash);
        $this->db->bind(':id', $userId);
        if ($this->db->execute()) {
            $this->db->query("DELETE FROM password_resets WHERE user_id = :user_id");
            $this->db->bind(':user_id', $userId);
            $this->db->execute();
            return true;
        }
        return false;
    }

        // Lấy thông tin user theo ID
    public function find($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Cập nhật thông tin profile
    public function update($id, $data) {
        // Tạo câu lệnh SQL động (chỉ cập nhật những gì thay đổi)
        $sql = "UPDATE users SET full_name = :full_name, email = :email";
        
        if (!empty($data['password'])) {
            $sql .= ", password_hash = :password";
        }
        if (!empty($data['avatar'])) {
            $sql .= ", avatar_url = :avatar";
        }
        
        $sql .= " WHERE id = :id";

        $this->db->query($sql);
        
        $this->db->bind(':id', $id);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        
        // Nếu có mật khẩu mới (đã hash từ controller) thì bind vào
        if (!empty($data['password'])) {
            $this->db->bind(':password', $data['password']);
        }
        // Nếu có avatar mới thì bind vào
        if (!empty($data['avatar'])) {
            $this->db->bind(':avatar', $data['avatar']);
        }

        return $this->db->execute();
    }

    // Phân trang cho danh sách thành viên
    // 1. Đếm tổng số thành viên
    public function countAll() {
        $this->db->query("SELECT COUNT(*) as total FROM users");
        $row = $this->db->single();
        return $row->total;
    }

    // 2. Lấy danh sách thành viên có phân trang
    public function getPaginated($limit, $offset) {
        $this->db->query("SELECT * FROM users ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
        
        // Bind tham số (ép kiểu int để tránh lỗi SQL)
        $this->db->bind(':limit', (int)$limit);
        $this->db->bind(':offset', (int)$offset);
        
        return $this->db->resultSet();
    }
}