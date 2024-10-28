<?php
session_start();
require_once("connection.php");

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

$userId = $_SESSION['userid'];
$productId = $_POST['productId'];
$newQuantity = $_POST['quantity'];

// Update the quantity in the database
$sql = "UPDATE addtocart SET quantity = ? WHERE userid = ? AND productid = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("iii", $newQuantity, $userId, $productId);
$stmt->execute();

// Recalculate the item and grand total
$itemTotal = 0;
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
    'itemTotal' => $itemTotal,
    'grandTotal' => $grandTotal
]);
?>
