<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center text-dark mb-4"><pre>L O &hearts; E  D C a r t:</pre></h1>
        
        <?php 
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION["cart"];
            $total = 0; 
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>Product</th>";
            echo "<th>Price</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach($cart as $items){
                $productName = htmlspecialchars($items['productname']);
                $productPrice = htmlspecialchars($items['price']);
                $total += $productPrice;
                echo "<tr>";
                echo "<td>$productName</td>";
                echo "<td>$productPrice $</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<h3 class='text-right text-danger'>Total : $total $</h3>";
        } else {
            echo "<p class='text-center text-danger'>Your cart is empty.</p>";
        }
        ?>
        
        <div class="text-right mt-4">
            <a href="product.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>

    <footer class="fot">
        <p class="text-white text-center m-0">Footer Content Here</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
