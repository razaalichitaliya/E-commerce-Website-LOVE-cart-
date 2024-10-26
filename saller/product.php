<?php session_start(); 
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "seller") {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
</head>
<body>
    <div class="container mt-4">
        <?php 
            if (isset($_SESSION["login"]) && $_SESSION["login"] == "seller") {
                echo "<p class='alert alert-info'>Welcome " . $_SESSION["username"] . " | <a href='logout.php'>Logout</a></p>";
            }

            if (isset($_SESSION["message"])) {
                echo "<div class='alert alert-success'>" . $_SESSION["message"] . "</div>";
                unset($_SESSION["message"]);
            }

            require_once("../connection.php");
            $result = $con->query("SELECT * FROM products");
        ?>

        <h2 class="mb-3">Product List</h2>
        <table class="table table-bordered product-table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = $result->fetch_object()) { ?>
                    <tr>
                        <td><img src="../images/<?php echo $data->image; ?>" class="img-fluid" style="max-width: 100px;"></td>
                        <td class="product-name"><?php echo $data->productname; ?></td>
                        <td class="product-price"><?php echo $data->price; ?> $</td>
                        <td>
                            <a href="edit.php?pid=<?php echo $data->productid; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?pid=<?php echo $data->productid; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
            <a href="newproduct.php" class="btn btn-primary" style="margin-top: 1em;">Add New Product</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
