<?php
namespace App\Controllers;

use PDO;

class QuizController {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function saveScore($user_id, $score, $total_questions) {
        $query = "INSERT INTO quiz_scores (user_id, score, total_questions, created_at) VALUES (:user_id, :score, :total_questions, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':score', $score, PDO::PARAM_INT);
        $stmt->bindParam(':total_questions', $total_questions, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
