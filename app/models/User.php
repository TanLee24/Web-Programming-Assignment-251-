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
}