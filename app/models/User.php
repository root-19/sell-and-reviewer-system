<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function register($username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            return true;
        }
        return false;
    }

    public function getLeaderboard() {
        $sql = "
            SELECT 
                users.id, 
                users.username, 
                SUM(quiz_scores.score) AS total_score,
                RANK() OVER (ORDER BY SUM(quiz_scores.score) DESC) AS rank
            FROM users
            JOIN quiz_scores ON users.id = quiz_scores.user_id
            GROUP BY users.id, users.username
            ORDER BY total_score DESC
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
