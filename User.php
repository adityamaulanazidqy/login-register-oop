<?php
require_once 'Database.php';

class User
{
    private $conn;
    private $table_name = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($username, $email, $password)
    {
        $query = "INSERT INTO $this->table_name (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $password_hash);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM $this->table_name WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }
}
