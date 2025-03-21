<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controller/MaterialController.php';

use App\Controllers\MaterialController;
use App\Config\Database;

// Create database connection
$db = (new Database())->connect();
$materialController = new MaterialController($db);

// Fetch all materials
$materials = $materialController->getAllMaterials();

// Handle file upload and purchase request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['receipt'])) {
    $material_id = $_POST['material_id'];
    $user_id = $_SESSION['user_id']; 
    $uploadDir = __DIR__ . "/uploads/";
    
    // Ensure upload directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = time() . "_" . basename($_FILES["receipt"]["name"]);
    $filePath = $uploadDir . $fileName;

    // Move uploaded file
    if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $filePath)) {
        // Insert purchase request with `request = 0` (Pending Approval)
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Materials | ABM Revires</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">ABM Revires</h1>
            <div class="space-x-6">
                <a href="dashboard" class="text-white hover:underline">Dashboard</a>
                <a href="Quiz" class="text-white hover:underline">Review Quiz</a>
                <a href="flashcard" class="text-white hover:underline">Review Flashcard</a>
                <a href="sell-materials" class="text-white hover:underline">Sell Materials</a>
                <a href="notification" class="text-white hover:underline">Notification</a>
                <a href="leaderboard" class="text-white hover:underline">Leaderboard</a>
                <a href="logout" class="bg-red-500 px-4 py-2 rounded-lg text-white hover:bg-red-600">Logout</a>
            </div>
        </div>
    </nav>
    
    <!-- Materials Listing -->
    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800">Available Materials</h2>
        <p class="text-gray-600">Browse materials uploaded by users.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <?php foreach ($materials as $material) : ?>
                <div class="bg-gray-50 p-4 shadow-md rounded-lg">
                    <img src="/app/controller/uploads/<?= htmlspecialchars($material['image']) ?>" 
                         alt="Material Image" 
                         class="w-full h-40 object-cover rounded-md">

                    <h3 class="text-lg font-semibold mt-2"> <?= htmlspecialchars($material['title']) ?> </h3>
                    <p class="text-gray-600"> <?= nl2br(htmlspecialchars($material['description'])) ?> </p>
                    <p class="text-blue-600 font-bold mt-2">Price: <?= htmlspecialchars($material['price']) ?> </p>
                    <p class="text-gray-500 text-sm mt-2">Uploaded by: 
    <span class="font-semibold"><?= htmlspecialchars($material['uploader_username']) ?></span>
</p>

                    <?php 
                    $current_user_id = $_SESSION['user_id'];
                    $isOwner = isset($material['user_id']) && $material['user_id'] == $current_user_id;
                    
                    if (!$isOwner): ?>
                        <!-- Buy Button -->
                        <form action="" method="POST" enctype="multipart/form-data" class="mt-3">
                            <input type="hidden" name="material_id" value="<?= $material['id'] ?>">
                            
                            <label class="block text-gray-600 text-sm">Upload GCash Receipt:</label>
                            <input type="file" name="receipt" required class="block w-full p-2 border border-gray-300 rounded-md mt-2">

                            <button type="submit" class="mt-3 w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Buy</button>
                        </form>
                    <?php else: ?>
                        <p class="text-gray-500 text-sm mt-2 font-semibold">This is your uploaded material.</p>
                    <?php endif; ?>

                    <!-- Show receipt download if approved -->
                    <?php
                    $isApproved = isset($material['request']) && $material['request'] == 1;
                    $isBuyer = isset($material['buyer_id']) && $material['buyer_id'] == $current_user_id;
                    
                    if ($isApproved && $isBuyer && !empty($material['receipt'])) { ?>
                        <a href="/app/controller/uploads/<?= htmlspecialchars($material['receipt']) ?>" 
                           download class="block mt-3 text-green-600 hover:underline">Download Receipt</a>
                    <?php } else { ?>
                        <p class="text-red-500 text-sm mt-2">Receipt not available for download.</p>
                    <?php } ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
