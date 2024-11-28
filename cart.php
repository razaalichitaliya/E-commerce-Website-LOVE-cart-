<?php
session_start();
require_once("connection.php");
require_once("Product.php");  // Include the Product class

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "<p class='text-danger'>You must be logged in to view your cart.</p>";
    exit();
}

$userId = $_SESSION['userid'];

// Instantiate the Product class
$product = new Product($con, $userId);

// Fetch cart items with product details
$cartItems = $product->getCartItems(); // Method to fetch cart items

// Count the number of items in the cart
$cartCount = $product->getCartCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        .delete-item{
            margin-left:20px;
            margin-top:20px;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center text-dark mb-4"><pre>L O &hearts; E  D C a r t:</pre></h1>
        
        <?php 
        if ($cartItems->num_rows > 0) {
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
            while ($items = $cartItems->fetch_assoc()) {
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
                        <button class='btn btn-sm btn-danger delete-item mt-2' data-pid='$productId'>
                        <i class='bi bi-trash'></i> 
                    </button>    
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
        ?>
        
        <div class="text-right mt-4">
            <a href="index.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>

    <footer class="fot">
        <p class="text-white text-center m-0">Footer Content Here</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
$(document).ready(function() {
    // Handle quantity update
    $('.update-quantity').on('click', function() {
        var productId = $(this).data('pid');
        var action = $(this).data('action');
        var quantityElement = $('#quantity-' + productId);
        var itemTotalElement = $('#item-total-' + productId);
        var currentQuantity = parseInt(quantityElement.text());
        var productPrice = parseFloat(itemTotalElement.text()) / currentQuantity; // Extract price from total.

        // Determine the new quantity
        var newQuantity = action === 'increase' ? currentQuantity + 1 : Math.max(1, currentQuantity - 1);

        // Send AJAX request to update cart
        $.ajax({
            url: 'update_cart.php',
            method: 'POST',
            data: { productId: productId, quantity: newQuantity },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    // Update UI
                    quantityElement.text(newQuantity);
                    var newItemTotal = productPrice * newQuantity;
                    itemTotalElement.text(newItemTotal.toFixed(2) + ' $');
                    $('#grand-total').text(result.grandTotal);
                } else {
                    alert('Failed to update quantity.');
                }
            },
            error: function() {
                alert('An error occurred while updating quantity.');
            }
        });
    });

    // Handle delete item
    $('.delete-item').on('click', function() {
        var productId = $(this).data('pid');

        if (!confirm('Are you sure you want to remove this item from your cart?')) {
            return;
        }

        // Send AJAX request to delete item
        $.ajax({
            url: 'delete_item.php',
            method: 'POST',
            data: { productId: productId },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    // Remove row from table
                    $('#quantity-' + productId).closest('tr').remove();
                    $('#grand-total').text(result.grandTotal);

                    // If cart is empty, show a message
                    if ($('table tbody tr').length === 0) {
                        $('table').remove();
                        $('.container').append('<p class="text-center text-danger">Your cart is empty.</p>');
                    }
                } else {
                    alert('Failed to delete item.');
                }
            },
            error: function() {
                alert('An error occurred while deleting the item.');
            }
        });
    });
});
</script>

</body>
</html>
