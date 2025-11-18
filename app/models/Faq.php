<?php
class Faq {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function all() {
        $stmt = $this->db->dbh->prepare("SELECT * FROM faqs ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->dbh->prepare("SELECT * FROM faqs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($question, $answer) {
        $stmt = $this->db->dbh->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");
        return $stmt->execute([$question, $answer]);
    }

    public function update($id, $question, $answer) {
        $stmt = $this->db->dbh->prepare("UPDATE faqs SET question=?, answer=? WHERE id=?");
        return $stmt->execute([$question, $answer, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->dbh->prepare("DELETE FROM faqs WHERE id=?");
        return $stmt->execute([$id]);
    }
}