<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="cart.css">
    <style>
        
    </style>
</head>
<body>
    <h1><pre>L O &hearts; E D  C a r t:</pre></h1>
    <?php 
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION["cart"];
        $total = 0; 
        echo "<table>";
        echo "<tr>";
        echo "<th>Product</th>";
        echo "<th>Price</th>";
        echo "</tr>";
        foreach($cart as $items){
            $productName = $items['productname'];
            $productPrice = $items['price'];
            $total = $total + $productPrice;
            echo "<tr>";
            echo "<td>$productName</td>";
            echo "<td>$productPrice $</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<h3>Total : $total $</h3>";
    } else {
        echo "Your cart is empty.";
    }
    ?>
</body>
</html>
