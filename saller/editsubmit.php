<?php
session_start();
require_once("../connection.php");

if (isset($_POST["productname"])) {
    $productname = $_POST["productname"];
    $price = $_POST["price"];
    $pid = $_POST["pid"];
    
    // Initialize the variable for image path
    $imagepath = "";

    // Retrieve the current image from the database
    $query = "SELECT image FROM products WHERE productid = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentImage = $row["image"]; // Get the current image path
    } else {
        echo "Product not found!";
        exit();
    }

    // Check if a new image file was uploaded without errors
    if ($_FILES["imagefile"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "../images/"; // Specify the directory where the file will be placed
        $target_file = $target_dir . basename($_FILES["imagefile"]["name"]); // Path of the file to be uploaded
        $imagepath = $_FILES["imagefile"]["name"];
        $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
        
        if ($check !== false) {
            // Move the uploaded file
            if (move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file)) {
                // Successfully uploaded the new image
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    } else {
        // If no new image is uploaded, keep the current image
        $imagepath = $currentImage;
    }

    // Update the product details
    $query = "UPDATE products SET productname=?, price=?, image=? WHERE productid=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssi", $productname, $price, $imagepath, $pid);

    try {
        $stmt->execute();
        $_SESSION["message"] = "Product is updated successfully.";
        header("location: index.php");
        exit();
    } catch (Exception $e) {
        echo "Some error occurred. Please try again.";
    }
}
?>
