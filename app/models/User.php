<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Register User
    public function register(array $data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        // Bind values
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail(string $email)
    {
        $this->db->query('SELECT * FROM users where email = :email');
        // Bind values
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}