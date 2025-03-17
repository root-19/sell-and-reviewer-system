<?php
session_start();
require_once __DIR__ . '/../../config/Database.php';

use App\Config\Database;
$db = (new Database())->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['receipt'])) {
    $material_id = $_POST['material_id'];
    $user_id = $_SESSION['user_id']; // Get logged-in user ID
    $uploadDir = __DIR__ . "/uploads/";
    
    // Ensure upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["receipt"]["name"]); // Unique filename
    $filePath = $uploadDir . $fileName;

    // Move uploaded file
    if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $filePath)) {
        // Insert purchase request with `request` defaulting to false
        $query = "INSERT INTO purchases (user_id, material_id, receipt, request) VALUES (:user_id, :material_id, :receipt, 0)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":material_id", $material_id);
        $stmt->bindParam(":receipt", $fileName);

        if ($stmt->execute()) {
            // Update `buyer_id` in materials table
            $updateQuery = "UPDATE materials SET buyer_id = :buyer_id WHERE id = :material_id";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bindParam(":buyer_id", $user_id);
            $updateStmt->bindParam(":material_id", $material_id);
            $updateStmt->execute();

            echo "<script>alert('Purchase request submitted! Waiting for approval.'); window.location.href='/sell-material';</script>";
        } else {
            echo "<script>alert('Database error. Try again!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error uploading receipt. Try again!'); window.history.back();</script>";
    }
}
?>
