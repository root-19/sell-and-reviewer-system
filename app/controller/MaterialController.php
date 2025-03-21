<?php
namespace App\Controllers;

use App\Models\Material;
use PDO;

class MaterialController {
    private $db;
    private $materialModel;

    public function __construct($db) {
        $this->db = $db; // Store database connection
        $this->materialModel = new Material($db);
    }

    public function uploadMaterial($user_id, $name, $file, $review, $price) {
        $uploadDir = __DIR__ . "/uploads/";

        // Ensure upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Validate file input
        if (!isset($file["name"]) || !isset($file["tmp_name"]) || empty($file["name"])) {
            return "No file uploaded.";
        }

        $fileName = time() . "_" . basename($file["name"]); // Unique filename
        $filePath = $uploadDir . $fileName;

        // Check if the file was uploaded successfully
        if (move_uploaded_file($file["tmp_name"], $filePath)) {
            $query = "INSERT INTO materials (user_id, title, description, image, price) 
                      VALUES (:user_id, :title, :description, :image, :price)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":title", $name);
            $stmt->bindParam(":description", $review);
            $stmt->bindParam(":image", $fileName); // Save only filename, not full path
            $stmt->bindParam(":price", $price);

            if ($stmt->execute()) {
                return "Material uploaded successfully!";
            } else {
                return "Database error.";
            }
        } else {
            return "Error uploading material.";
        }
    }

    // ✅ Merged both queries into one getAllMaterials() function
    public function getAllMaterials() {
        $query = "SELECT m.*, 
                         COALESCE(p.receipt, '') AS receipt, 
                         COALESCE(p.request, 0) AS request, 
                         COALESCE(p.user_id, 0) AS buyer_id, 
                         COALESCE(buyer.username, '') AS buyer_username,
                         uploader.username AS uploader_username
                  FROM materials m
                  LEFT JOIN purchases p ON m.id = p.material_id
                  LEFT JOIN users buyer ON p.user_id = buyer.id  -- Buyer info
                  LEFT JOIN users uploader ON m.user_id = uploader.id  -- Uploader info
                  ORDER BY m.created_at DESC";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
 

    public function approvePurchase($purchase_id, $user_id) {
        // Update request status
        $query = "UPDATE purchases SET request = 1 WHERE id = :purchase_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":purchase_id", $purchase_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            // Insert notification
            $notifQuery = "INSERT INTO notifications (user_id, message) VALUES (:user_id, 'Your purchase request has been approved!')";
            $notifStmt = $this->db->prepare($notifQuery);
            $notifStmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $notifStmt->execute();
    
            return "Purchase approved and notification sent!";
        } else {
            return "Error updating request.";
        }
    }
        public function getPendingRequests() {
            $query = "SELECT p.id, p.user_id, p.material_id, m.material_name, u.username
                      FROM purchases p
                      JOIN materials m ON p.material_id = m.id
                      JOIN users u ON p.user_id = u.id
                      WHERE p.request = 0";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
}

