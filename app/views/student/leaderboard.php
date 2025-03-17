<?php
require_once __DIR__ . '/../../models/User.php';
use App\models\User;
$userModel = new User();
$leaderboard = $userModel->getLeaderboard();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 ">
<nav class="bg-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">ABM Revires</h1>
            <div class="space-x-6">
              <a href="dashboard" class="text-white hover:underline">Dashboard</a>
             <a href="Quiz" class="text-white hover:underline">Review quiz</a>
                <a href="flashcard" class="text-white hover:underline">review flashcard</a>
                <a href="sell-materials" class="text-white hover:underline">Sell Materials</a>
                <!-- <a href="/buy-material" class="text-white hover:underline">Buy Materials</a> -->
                <a href="notification" class="text-white hover:underline">Notification</a>
                <a href="leaderboard" class="text-white hover:underline">Leaderboard</a>
                <a href="logout" class="bg-red-500 px-4 py-2 rounded-lg text-white hover:bg-red-600">Logout</a>
            </div>
        </div>
    </nav>
    <div class="max-w-3xl mx-auto bg-white p-5 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-5">🏆 Leaderboard 🏆</h1>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Rank</th>
                    <th class="border border-gray-300 p-2">User</th>
                    <th class="border border-gray-300 p-2">Total Score</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaderboard as $row) : ?>
                <tr class="text-center bg-white hover:bg-gray-100">
                    <td class="border border-gray-300 p-2"><?= $row['rank'] ?></td>
                    <td class="border border-gray-300 p-2 flex items-center justify-start space-x-3 p-2">
                        <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg">
                            <?= strtoupper(substr($row['username'], 0, 1)) ?>
                        </div>
                        <span><?= htmlspecialchars($row['username']) ?></span>
                    </td>
                    <td class="border border-gray-300 p-2"><?= $row['total_score'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
