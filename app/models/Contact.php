<?php
require_once APPROOT . '/libraries/Database.php';

class Contact
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function save($data)
    {
        $sql = "INSERT INTO contacts (name, email, message)
                VALUES (:name, :email, :message)";

        $this->db->query($sql);
        $this->db->bind(':name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':message', $data['message']);

        return $this->db->execute();
    }
}
