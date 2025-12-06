<?php
class Newsletter {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Kiểm tra email đã tồn tại chưa
    public function checkEmailExists($email) {
        $this->db->query("SELECT id FROM newsletter_subscribers WHERE email = :email");
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    // Thêm email mới
    public function addSubscriber($email) {
        $this->db->query("INSERT INTO newsletter_subscribers (email) VALUES (:email)");
        $this->db->bind(':email', $email);
        return $this->db->execute();
    }
}