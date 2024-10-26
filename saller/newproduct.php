<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add New Product</title>
	<!-- Bootstrap CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
	<div class="card">
		<div class="card-body">
			<h1 class="text-center mb-4">Add New Product</h1>
			<form action="newproductsubmit.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="productname">Product Name</label>
					<input type="text" class="form-control" name="productname" id="productname" required>
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<input type="text" class="form-control" name="price" id="price" required>
				</div>
				<div class="form-group">
					<label for="imagefile">Select Image</label>
					<input type="file" class="form-control-file" name="imagefile" id="imagefile">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary">Add Product</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
