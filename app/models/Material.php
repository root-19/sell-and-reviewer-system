<?php
namespace App\Models;

use PDO;
use PDOException;

class Material {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Save material to database
    public function addMaterial($user_id, $name, $image, $review, $price) {
        try {
            $query = "INSERT INTO materials (user_id, material_name, material_image, material_review, material_price) 
                      VALUES (:user_id, :name, :image, :review, :price)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'user_id' => $user_id,
                'name' => $name,
                'image' => $image,
                'review' => $review,
                'price' => $price
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
