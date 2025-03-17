<?php
session_start();

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../controller/PurchaseManager.php';

// use App\Controller\PurchaseManager;
use App\Config\Database;

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}
 
$db = (new Database())->connect();

$purchaseManager = new PurchaseManager($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['purchase_id'])) {
    $purchase_id = $_POST['purchase_id'];

    if ($purchaseManager->approveRequest($purchase_id)) {
        header("Refresh:0");
        exit();
    } else {
        echo "<script>alert('Error approving request.'); window.location.href='notifaction.php';</script>";
    }
}
?>
