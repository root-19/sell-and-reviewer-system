<?php
session_start();
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controller/PurchaseManager.php';


use App\Config\Database;
$db = (new Database())->connect();
$purchaseManager = new PurchaseManager($db);
$requests = $purchaseManager->getRequestedMaterials();

$approvedTitle = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["purchase_id"])) {
    $purchaseId = $_POST["purchase_id"];

    $query = "SELECT m.title FROM materials m 
              JOIN purchases p ON m.id = p.material_id 
              WHERE p.id = :purchaseId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":purchaseId", $purchaseId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $approvedTitle = $result ? $result["title"] : "Unknown Title";

    if ($purchaseManager->approveRequest($purchaseId)) {
        $_SESSION["approved_title"] = $approvedTitle;
    
        header("Refresh:0");
        exit();
    } else {
        echo "<script>alert('Error approving request.');</script>";
    }
}

// Ipakita ang Title kung may approved
if (isset($_SESSION["approved_title"])) {
    $approvedTitle = $_SESSION["approved_title"];
    unset($_SESSION["approved_title"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

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

    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-4">📋 Pending Purchase Requests</h2>

            <!-- ✅ Message for Approved Title -->
            <?php if (!empty($approvedTitle)): ?>
                <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-400 rounded-lg text-center">
                    ✅ Successfully approved: <strong><?= htmlspecialchars($approvedTitle) ?></strong>
                </div>
            <?php endif; ?>

            <?php if (!empty($requests)): ?>
                <table class="w-full border-collapse border border-gray-300 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="border px-4 py-3">📦 Title</th>
                            <th class="border px-4 py-3">👤 User ID</th>
                            <th class="border px-4 py-3">✅ Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $request): ?>
                            <tr class="bg-gray-50 hover:bg-gray-100 transition duration-200">
                                <td class="border px-4 py-3"><?= htmlspecialchars($request['title']) ?></td>
                                <td class="border px-4 py-3"><?= htmlspecialchars($request['user_id']) ?></td>
                                <td class="border px-4 py-3 text-center">
                                    <form method="POST">
                                        <input type="hidden" name="purchase_id" value="<?= $request['purchase_id'] ?>">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-300">
                                            Approve
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-500 text-center py-6 text-lg">🚫 No pending requests.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
