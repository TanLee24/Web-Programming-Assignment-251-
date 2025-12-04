<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Đăng ký tài khoản
    public function register($data) {
        // Lưu ý: Insert vào cột 'password_hash' đúng như trong database
        $sql = "INSERT INTO users (username, email, password_hash, full_name, role, status, created_at) 
                VALUES (:username, :email, :pass, :fullname, 'member', 'active', NOW())";
        
        $this->db->query($sql);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        // Mã hóa mật khẩu
        $this->db->bind(':pass', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':fullname', $data['full_name']);

        return $this->db->execute();
    }

    // 2. Tìm user để đăng nhập (Sửa lỗi Invalid parameter number)
    public function findUserByEmailOrUsername($input) {
        // Dùng 2 placeholder khác nhau để tránh lỗi PDO
        $this->db->query("SELECT * FROM users WHERE email = :email_val OR username = :user_val");
        
        // Gán giá trị $input cho cả 2 chỗ
        $this->db->bind(':email_val', $input);
        $this->db->bind(':user_val', $input);
        
        return $this->db->single();
    }

    // Kiểm tra trùng lặp khi đăng ký
    public function checkUserExists($email, $username) {
        $this->db->query("SELECT id FROM users WHERE email = :email OR username = :username");
        $this->db->bind(':email', $email);
        $this->db->bind(':username', $username);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    // 4. Lấy thông tin user theo ID
    public function find($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // 5. Cập nhật thông tin profile
    public function update($id, $data) {
        // Tạo câu SQL động tùy thuộc vào có đổi mật khẩu/avatar hay không
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
        
        if (!empty($data['password'])) {
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        }
        if (!empty($data['avatar'])) {
            $this->db->bind(':avatar', $data['avatar']);
        }

        return $this->db->execute();
    }

    // --- PHẦN DÀNH CHO ADMIN ---

    // 6. Lấy danh sách tất cả thành viên
    public function all() {
        $this->db->query("SELECT * FROM users ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // 7. Cập nhật trạng thái (Khóa/Mở khóa)
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE users SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // 8. Reset mật khẩu
    public function resetPassword($id, $hash) {
        $this->db->query("UPDATE users SET password_hash = :pass WHERE id = :id");
        $this->db->bind(':pass', $hash);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}