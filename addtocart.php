<?php
session_start();
require_once("connection.php");

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "customer") {
    echo json_encode(["message" => "Please log in to add items to your cart.", "status" => false]);
    exit();
}

$email = $_SESSION["username"];
$user_query = $con->query("SELECT userid FROM Registration WHERE emailid='$email'");
$user_data = $user_query->fetch_object();
$userid = $user_data->userid;

// Check if product ID is provided in the URL
if (isset($_GET['pid'])) {
    $productid = (int)$_GET['pid'];

    // Check if the product is already in the user's cart
    $productSql = $con->query("SELECT COUNT(*) AS row_count FROM addtocart WHERE userid = '$userid' AND productid = '$productid'");
    $product_data = $productSql->fetch_assoc();
    $product_count = $product_data['row_count'];

    if ($product_count > 0) {
        echo json_encode(["message" => "Product already in cart.", "status" => false]);
        exit();
    }

    // Insert the `userid` and `productid` into the `addtocart` table
    $add_query = $con->prepare("INSERT INTO addtocart (userid, productid) VALUES (?, ?)");
    $add_query->bind_param("ii", $userid, $productid);
    $add_query->execute();
    
    if ($add_query->affected_rows > 0) {
        echo json_encode(["message" => "Product added to cart!", "status" => true]);
    } else {
        echo json_encode(["message" => "Failed to add product to cart.", "status" => false]);
    }
    
    $add_query->close();
} else {
    echo json_encode(["message" => "Product ID not provided.", "status" => false]);
}
?>
