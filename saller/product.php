<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php 
		if(isset($_SESSION["login"]) && $_SESSION["login"] == "seller")
		{
			echo "<p>Welcome ".$_SESSION["username"]. " | <a href='logout.php'>Logout</a></p>";
			
		}

		if(isset($_SESSION["message"]))
		{
			echo "<p>". $_SESSION["message"]. "</p>";
			unset($_SESSION["message"]);
		}
		require_once("../connection.php");
		$result = $con->query("select * from products");
		echo "<table class='product-table'><tr><th>Image</th><th>Product Name</th><th>Price</th><th>Edit/Delete</th>";
		while($data = $result->fetch_object())
		{
			echo "<tr>";
			echo "<td><img src='../images/$data->image' class='product-image'></td>";
			echo "<td class='product-name'>$data->productname</td>";;
			echo "<td class='product-price'> $data->price $</td>";
			echo "<td><a href='edit.php?pid=$data->productid' class='add-to-cart-button'>Edit</a> <a href='delete.php?pid=$data->productid' class='add-to-cart-button'>Delete</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<div><a href='newproduct.php' class='add-to-cart-button' style='margin-top: 1em;'>Add New Product</a></div>";

	?>
</body>
</html>