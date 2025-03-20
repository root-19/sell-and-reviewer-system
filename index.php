<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/controller/AuthController.php';
use App\Controllers\AuthController;

$authController = new AuthController();

// Fix: Parse the correct path
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");

// Debugging (remove after testing)
// var_dump($uri);

switch ($uri) {
    case "":
    case "index.php": // ✅ Handles direct access
        require_once __DIR__ . '/app/views/login.php';
        exit();
    case "login":
        require_once __DIR__ . '/app/views/login.php';
        exit();
        case "register":
            require_once __DIR__ . '/app/views/register.php';
            exit();
    case "dashboard":
        require_once __DIR__ . '/app/views/student/dashboard.php';
        exit();
    case "sell-materials":
        require_once __DIR__ . '/app/views/student/sell-materials.php';
        exit();
        case "Quiz":
            require_once __DIR__ . '/app/views/student/Quiz.php';
            exit();
            case "notification":
                require_once __DIR__ . '/app/views/student/notification.php';
                exit();
            case "leaderboard":
                require_once __DIR__ . '/app/views/student/leaderboard.php';
                exit();
                case "approve_request":
                    require_once __DIR__ . '/app/views/student/approve_request.php';
                    exit();
            case "flashcard":
                require_once __DIR__ . '/app/views/student/flashcard.php';
                exit();
    case "logout":
        require_once __DIR__ . '/app/views/student/logout.php';
        exit();
    case "register-user":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $authController->register();
        }
        exit();
    case "login-user":
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $authController->login();
        }
        exit();
      
    default:
        echo "404 - Page Not Found";
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ABM Revires</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center bg-white p-10 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-4">Welcome to <span class="text-blue-500">ABM Revires</span></h1>
        <p class="text-gray-600 mb-6">Your trusted platform for reviews and sellers</p>

        <div class="space-x-4">
            <a href="../app/views/register.php" class="px-6 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">Seller Register</a>
            <a href="../app/views/login.php" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">Login</a>
        </div>
    </div>
</body>
</html>
