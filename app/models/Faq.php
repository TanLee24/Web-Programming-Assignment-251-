<?php
class Faq 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Database;
    }

    // Get all questions
    public function all() 
    {
        $this->db->query("SELECT * FROM faqs ORDER BY id DESC");
        return $this->db->resultSet(); // Use resultSet() to get list
    }

    // Find one question by ID
    public function find($id) 
    {
        $this->db->query("SELECT * FROM faqs WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single(); // Use single() to get one row
    }

    // Create new question
    public function create($question, $answer) 
    {
        $this->db->query("INSERT INTO faqs (question, answer) VALUES (:question, :answer)");
        $this->db->bind(':question', $question);
        $this->db->bind(':answer', $answer);
        return $this->db->execute();
    }

    // Update question
    public function update($id, $question, $answer) 
    {
        $this->db->query("UPDATE faqs SET question = :question, answer = :answer WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':question', $question);
        $this->db->bind(':answer', $answer);
        return $this->db->execute();
    }

    // Delete question
    public function delete($id) 
    {
        $this->db->query("DELETE FROM faqs WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}