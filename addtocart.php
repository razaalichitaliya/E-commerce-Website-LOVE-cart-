<?php
session_start();

// Include your database connection file here
require_once("connection.php");

if(isset($_GET["pid"])) {
    $product_id = $_GET['pid'];

    // Fetch product details from the database based on the product ID
    $query = "SELECT productname, price FROM products WHERE productid = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['productname'];
        $product_price = $row['price'];

        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
            $newProduct = array('productname' => $product_name, 'price' => $product_price);
            array_push($cart, $newProduct);
            $_SESSION["cart"] = $cart;
        } else {
            $cart = array(array('productname' => $product_name, 'price' => $product_price));
            $_SESSION["cart"] = $cart;
        }
    }
}

header("location: product.php");
?>
