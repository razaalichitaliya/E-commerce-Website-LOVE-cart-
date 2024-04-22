<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
	<link rel="stylesheet" href="../style.css">
</head>
<body>

	<form action="newproductsubmit.php" method="POST" enctype="multipart/form-data">
	<table class="registration-table">

	<tr>
		<td colspan="2">	<h1>Add New Product</h1></td>
	</tr>
	<tr>
		<td><label for="productname">Product name</label></td>
	<td><input type="text" name="productname" id="productname"></td>
	</tr>
	


	<tr>
		<td><label for="price">Price</label></td>
	<td><input type="text" name="price" id="price"></td>
	</tr>

	<tr>
		<td><label for="imagefile">Select Image</label></td>
	<td><input type="file" name="imagefile" id="imagefile"></td>
	</tr>
	<tr><td></td><td><input type="submit" value="Add Product"></td></tr>
	</table>
	</form>
</body>
</html>