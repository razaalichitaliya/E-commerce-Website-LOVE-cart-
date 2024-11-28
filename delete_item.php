<?php
session_start();
require_once("connection.php");

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['userid'];
$productId = $_POST['productId'];

// Delete the item from the cart
$sql = "DELETE FROM addtocart WHERE userid = ? AND productid = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $userId, $productId);
$stmt->execute();

// Recalculate the grand total after deletion
$grandTotal = 0;

$sql = "SELECT a.quantity, p.price FROM addtocart a 
        JOIN products p ON a.productid = p.productid 
        WHERE a.userid = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

while ($item = $result->fetch_assoc()) {
    $itemTotal = $item['quantity'] * $item['price'];
    $grandTotal += $itemTotal;
}

echo json_encode([
    'success' => true,
    'grandTotal' => $grandTotal
]);
?>
