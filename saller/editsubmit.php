<?php
session_start();
if(isset($_POST["productname"]))
{
    $productname = $_POST["productname"];
    $price = $_POST["price"];
    $imagepath = "";
    $pid = $_POST["pid"];
    // Validation
    require_once("../connection.php");

    // Check if file was uploaded without errors
    if($_FILES["imagefile"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "../images/"; // Specify the directory where the file will be placed
        $target_file = $target_dir . basename($_FILES["imagefile"]["name"]); // Path of the file to be uploaded
        $imagepath = $_FILES["imagefile"]["name"];
        $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
        if ($check !== false) {
            move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
        } else {
            echo "File is not an image.";
            exit();
        }
    }

    $query = "UPDATE products SET productname=?, price=?, image=? WHERE productid=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssi", $productname, $price, $imagepath, $pid);

    try
    {
        $stmt->execute();
        $_SESSION["message"] = "Product is updated Successfully";
        header("location: product.php");
        exit();
    }
    catch(Exception $e)
    {
        echo "Some error occurred. Please try again";
    }
}
?>
