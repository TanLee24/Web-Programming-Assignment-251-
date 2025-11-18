<?php
class Setting {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get($key) {
        $stmt = $this->db->dbh->prepare("SELECT setting_value FROM settings WHERE setting_key=?");
        $stmt->execute([$key]);
        return $stmt->fetch()->setting_value ?? null;
    }

    public function set($key, $value) {
        $stmt = $this->db->dbh->prepare("
            INSERT INTO settings (setting_key, setting_value) 
            VALUES (?, ?)
            ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)
        ");
        return $stmt->execute([$key, $value]);
    }
}
