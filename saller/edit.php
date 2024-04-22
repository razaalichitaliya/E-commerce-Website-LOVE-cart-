<?php
session_start();
require_once("../connection.php");

// Initialize variables
$productname = "";
$price = "";
$imagepath = "";
$pid = $_GET["pid"];

// Retrieve product details from the database
$query = "SELECT * FROM products WHERE productid = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    // Fetch product details
    $row = $result->fetch_assoc();
    $productname = $row["productname"];
    $price = $row["price"];
    $imagepath = $row["image"];
} else {
    // Handle case where product with given ID is not found
    echo "Product not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="omd5.css">
</head>
<body>

    <form action="editsubmit.php" method="POST" enctype="multipart/form-data">
        <table class="registration-table">
            <tr>
                <td colspan="2"><h1>Edit Product</h1></td>
            </tr>
            <tr>
                <td><label for="productname">Product name</label></td>
                <td><input type="text" name="productname" id="productname" value="<?= $productname ?>"></td>
            </tr>
            <tr>
                <td><label for="price">Price</label></td>
                <td><input type="text" name="price" id="price" value="<?= $price ?>"></td>
            </tr>
            <tr>
                <td><label for="imagefile">Select Image</label></td>
                <td>
                    <input type="file" name="imagefile" id="imagefile">
                    <!-- Display current image -->
                    <?php if(!empty($imagepath)): ?>
                        <br>
                        <img src="../images/<?= $imagepath ?>" alt="Current Image" width="100">
                    <?php endif; ?>
                </td>
            </tr>
            <!-- Hidden field to store product ID -->
            <input type="hidden" name="pid" value="<?= $pid ?>">
            <tr><td></td><td><input type="submit" value="Update Product Details"></td></tr>
        </table>
    </form>
</body>
</html>
