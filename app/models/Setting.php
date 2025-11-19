<?php
class Setting 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Database;
    }

    // Lấy giá trị theo key
    public function get($key) {
        $this->db->query("SELECT setting_value FROM settings WHERE setting_key = :key LIMIT 1");
        $this->db->bind(':key', $key);
        $row = $this->db->single();
        return $row ? $row->setting_value : '';
    }

    // Cập nhật hoặc tạo mới
    public function update($key, $value) 
    {
        // Kiểm tra tồn tại
        $this->db->query("SELECT setting_key FROM settings WHERE setting_key = :key LIMIT 1");
        $this->db->bind(':key', $key);
        $row = $this->db->single();

        if ($row) 
        {
            // UPDATE
            $this->db->query("UPDATE settings SET setting_value = :value WHERE setting_key = :key");
        } 
        else 
        {
            // INSERT
            $this->db->query("INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value)");
        }

        $this->db->bind(':key', $key);
        $this->db->bind(':value', $value);

        return $this->db->execute();
    }
}
