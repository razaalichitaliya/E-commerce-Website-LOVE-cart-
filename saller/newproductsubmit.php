<?php
session_start();
if(isset($_POST["productname"]))
{
	$productname = $_POST["productname"];
	$price = $_POST["price"];
	$imagepath = "";
	// Validation
	require_once("../connection.php");

	$target_dir = "../images/"; // Specify the directory where the file will be placed
	$target_file = $target_dir . basename($_FILES["imagefile"]["name"]); // Path of the file to be uploaded
	$imagepath = $_FILES["imagefile"]["name"];
    $check = getimagesize($_FILES["imagefile"]["tmp_name"]);
    if ($check !== false) {
        move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
    }

	$query = "insert into products (productname, price, image) values ('$productname', '$price', '$imagepath')";

	try
	{
		$con->query($query);
		$_SESSION["message"] = "Product is added Successfully";
		header("location: product.php");
	}
	catch(Exception $e)
	{
		echo "Some error occured. Please try again";
	}
}
?>