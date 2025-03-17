<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controller/MaterialController.php';

use App\Controllers\MaterialController;
use App\Config\Database;

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

// Create database connection
$db = (new Database())->connect();
$materialController = new MaterialController($db);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"];
    $name = $_POST["material_name"];
    $file = $_FILES["image"];
    $review = $_POST["material_review"];
    $price = $_POST["material_price"];

    $message = $materialController->uploadMaterial($user_id, $name, $file, $review, $price);

    // Reload the same page
    header("Refresh:0");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ABM Revires</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">ABM Revires</h1>
            <div class="space-x-6">
              <a href="dashboard" class="text-white hover:underline">Dashboard</a>
             <a href="Quiz" class="text-white hover:underline">Review quiz</a>
                <a href="flashcard" class="text-white hover:underline">review flashcard</a>
                <a href="sell-materials" class="text-white hover:underline">Sell Materials</a>
                <!-- <a href="notification" class="text-white hover:underline">Notification</a> -->
                <a href="notification" class="text-white hover:underline">Notification</a>
                <a href="leaderboard" class="text-white hover:underline">Leaderboard</a>
                <a href="logout" class="bg-red-500 px-4 py-2 rounded-lg text-white hover:bg-red-600">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800">Welcome, <?= $_SESSION["username"]; ?></h2>
        <p class="text-gray-600 mt-2">Explore and contribute to the platform!</p>
    </div>

    <!-- Sell Materials Section -->
    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-bold text-gray-800">Sell Your Materials</h2>
        <p class="text-gray-600">Upload materials, write a review, and sell to other users.</p>

        <form action="" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            <div>
                <label class="block text-gray-700 font-medium">Material Name</label>
                <input type="text" name="material_name" placeholder="Enter material name"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
        <label class="block text-gray-700 font-medium">Upload Images</label>
        <input type="file" name="image" accept="image/*" multiple required
            class="w-full border p-2 rounded-lg bg-gray-50">
    </div>

            <div>
                <label class="block text-gray-700 font-medium">Material Review</label>
                <textarea name="material_review" placeholder="Write a short review"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Price</label>
                <input type="number" name="material_price" placeholder="Enter price"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
            </div>

            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Post Material
            </button>
        </form>
    </div>

</body>
</html>
