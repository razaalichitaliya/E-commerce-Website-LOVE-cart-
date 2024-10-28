<?php 
session_start();
require_once("connection.php"); 

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "<p class='text-danger'>You must be logged in to view your cart.</p>";
    exit();
}

$userId = $_SESSION['userid'];

// Query to fetch cart items with product details
$sql = "SELECT a.productid, a.quantity, p.productname, p.price 
        FROM addtocart a 
        JOIN products p ON a.productid = p.productid 
        WHERE a.userid = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
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
        if ($result->num_rows > 0) {
            $total = 0; 
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>Product</th>";
            echo "<th>Price</th>";
            echo "<th>Quantity</th>";
            echo "<th>Total</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($items = $result->fetch_assoc()) {
                $productId = $items['productid'];
                $productName = htmlspecialchars($items['productname']);
                $productPrice = htmlspecialchars($items['price']);
                $quantity = htmlspecialchars($items['quantity']);
                
                // Calculate total for this item
                $itemTotal = $productPrice * $quantity;
                $total += $itemTotal;

                echo "<tr>";
                echo "<td>$productName</td>";
                echo "<td>$productPrice $</td>";
                echo "<td>
                        <div class='d-flex align-items-center'>
                            <button class='btn btn-sm btn-secondary update-quantity' data-pid='$productId' data-action='decrease'>-</button>
                            <span class='mx-2' id='quantity-$productId'>$quantity</span>
                            <button class='btn btn-sm btn-secondary update-quantity' data-pid='$productId' data-action='increase'>+</button>
                        </div>
                      </td>";
                echo "<td id='item-total-$productId'>$itemTotal $</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "<h3 class='text-right text-danger'>Grand Total : <span id='grand-total'>$total</span> $</h3>";
        } else {
            echo "<p class='text-center text-danger'>Your cart is empty.</p>";
        }
        $stmt->close();
        ?>
        
        <div class="text-right mt-4">
            <a href="product.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>

    <footer class="fot">
        <p class="text-white text-center m-0">Footer Content Here</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.update-quantity').on('click', function() {
            var productId = $(this).data('pid');
            var action = $(this).data('action');
            var quantityElement = $('#quantity-' + productId);
            var currentQuantity = parseInt(quantityElement.text());

            // Calculate new quantity based on action
            var newQuantity = action === 'increase' ? currentQuantity + 1 : Math.max(1, currentQuantity - 1);

            // Update quantity and total via AJAX
            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: { productId: productId, quantity: newQuantity },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Update displayed quantity and item total
                        quantityElement.text(newQuantity);
                        $('#item-total-' + productId).text(result.itemTotal + ' $');
                        $('#grand-total').text(result.grandTotal);
                    } else {
                        alert('Failed to update cart. Please try again.');
                    }
                },
                error: function() {
                    alert('An error occurred.');
                }
            });
        });
    });
    </script>
</body>
</html>
