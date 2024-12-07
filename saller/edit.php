<?php
session_start();
require_once("../connection.php");

// Initialize variables
$productname = "";
$price = "";
$imagepath = "";
$pid = $_GET["pid"];
//Used Database
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Product</h1>
        <form action="editsubmit.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productname">Product Name</label>
                <input type="text" name="productname" id="productname" class="form-control" value="<?= htmlspecialchars($productname) ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="<?= htmlspecialchars($price) ?>" required>
            </div>
            <div class="form-group">
                <label for="imagefile">Select Image</label>
                <input type="file" name="imagefile" id="imagefile" class="form-control-file">
                <!-- Display current image -->
                <?php if (!empty($imagepath)): ?>
                    <br>
                    <img src="../images/<?= htmlspecialchars($imagepath) ?>" alt="Current Image" width="100" class="img-thumbnail">
                <?php endif; ?>
            </div>
            <!-- Hidden field to store product ID -->
            <input type="hidden" name="pid" value="<?= htmlspecialchars($pid) ?>">
            <button type="submit" class="btn btn-primary">Update Product Details</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
