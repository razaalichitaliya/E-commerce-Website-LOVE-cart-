<?php
session_start();
if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
    
    // SQL queries to handle dependencies
    $deleteFromAddToCart = "DELETE FROM addtocart WHERE productid = '$pid'";
    $deleteProduct = "DELETE FROM products WHERE productid = '$pid'";

    try {
        // Include database connection
        require_once("../connection.php");

        // Delete related entries from the `addtocart` table first
        $con->query($deleteFromAddToCart);

        // Delete the product from the `products` table
        $con->query($deleteProduct);

        // Set success message
        $_SESSION["message"] = "Product deleted successfully!";
        header("location: product.php");
    } catch (Exception $e) {
        // Display error message
        echo "Some error occurred. Please try again. " . $e->getMessage();
    }
}
?>
