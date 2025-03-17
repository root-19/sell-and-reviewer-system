<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/Database.php';
use App\Controllers\MaterialController;
use App\Config\Database;

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Create database connection
$db = (new Database())->connect();
$materialController = new MaterialController($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"];
    $name = $_POST["material_name"];
    $files = $_FILES["material_images"]; // Multiple files
    $review = $_POST["material_review"];
    $price = $_POST["material_price"];

    $message = $materialController->uploadMaterial($user_id, $name, $files, $review, $price);

    // Redirect back with success/error message
    header("Location: dashboard.php?message=" . urlencode($message));
    exit();
}
