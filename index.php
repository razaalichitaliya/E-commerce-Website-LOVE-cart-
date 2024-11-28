<?php 
session_start();
require_once("connection.php");
require_once("Product.php");

// Check if the user is not logged in but has a cookie
if (!isset($_SESSION['login']) && isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    $query = $con->query("SELECT * FROM Registration WHERE userid='$userid'");

    if ($query->num_rows > 0) {
        $user = $query->fetch_assoc();
        $_SESSION['userid'] = $user['userid'];
        $_SESSION['username'] = $user['emailid'];
        $_SESSION['login'] = "customer";
    }
}

$product = new Product($con, $_SESSION['userid'] ?? '');

// Fetch products
$products = $product->getProducts();

// Count items in the cart for this user
$cart_count = $product->getCartCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L O &hearts; E C a r t</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    /* Main Styles */
body {
    background-color: #f4ßf4f4;
    font-family: Arial, sans-serif;
}

h1 {
    height: 50px;
    background-color: #007bff;
    padding: 5px;
    color: aliceblue;
    text-align: center;
    margin: 0;
}

.product-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px; /* Adjusts spacing between products */
}

.product {
    border: 1px solid #ddd;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease-in-out;
    background-color: #fff;
    width: 22%; /* Keeps the existing layout for larger screens */
    margin-bottom: 20px;
}

.product:hover {
    cursor: pointer;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.product-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.add-to-cart-btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    transition: background-color 0.3s ease-in-out;
    border-radius: 3px;
}

.add-to-cart-btn:hover {
    background-color: #0056b3;
    color: #fff;
}

.fot {
    margin-top: 10px;
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #007bff;
    color: white;
    text-align: center;
    padding: 10px;
}

@media (max-width: 768px) {
    .product {
        width: 48%; 
    }
    .product-image {
        height: 150px;
        width: 100%;
        object-fit: contain; 
    }
    .add-to-cart-btn {
        padding: 8px 16px;
        font-size: 14px;
    }

    
}



@media (max-width: 576px) {
    .product {
        width: 48%; 
    }
    .product-image {
        height: 120px;
    }
    .add-to-cart-btn {
        padding: 6px 12px;
        font-size: 12px;
    }
    .container {
        position: relative;
    }

    .container p {
        display: inline-block;
        margin: 0;
    }

    .btn-primary {
        position: absolute;
        right: 0;
        top: -27px;
        transform: translateY(50%); 
        margin-top: 0;
    }

    
}




    </style>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">

    <h1>L O &hearts; E C a r t</h1>
    
    <div class="container my-3">
        <?php 
            if(isset($_SESSION["login"]) && $_SESSION["login"] == "customer") {
                $email = $_SESSION["username"];
                $user_query = $con->query("SELECT name FROM Registration WHERE emailid='$email'");
                $user_data = $user_query->fetch_object();
                $name = $user_data->name;
                
                echo "<p>Welcome $name | <a href='logout.php'>Logout</a></p>";
            } else {
                echo "<a href='login.php'>Login</a>";
            }
        ?>
        <div class="text-right mb-3">
            <a href="cart.php" class="btn btn-primary">Cart: <?php echo $cart_count; ?></a>
        </div>

        <div class="product-container row">
            <?php while($data = $products->fetch_object()) { ?>
                <div class="product col-md-3">
                    <img src="images/<?php echo $data->image; ?>" alt="<?php echo $data->productname; ?>" class="product-image img-fluid">
                    <div class="product-content">
                        <div class="product-text">
                            <p><?php echo $data->productname; ?></p>
                            <p><?php echo $data->price; ?></p>
                        </div>
                        <a href="#" class="add-to-cart-btn" data-pid="<?php echo $data->productid; ?>">
                            <i class="bi bi-bag" style="font-size: 24px;"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="fot">Buy things for you and your beloved! &hearts;</div>

    <script>
    $(document).ready(function() {
        $('.add-to-cart-btn').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('pid');

            $.ajax({
                url: 'addtocart.php?pid=' + productId,
                type: 'GET',
                success: function(response) {
                    var result = JSON.parse(response);
                    alert(result.message);
                    if (result.status) {
                        var cartCount = parseInt($('.btn-primary').text().match(/\d+/)[0]) + 1;
                        $('.btn-primary').text('Cart: ' + cartCount);
                    }
                },
                error: function() {
                    alert('An error occurred while adding the product to cart.');
                }
            });
        });
    });
    </script>

</body>
</html>
