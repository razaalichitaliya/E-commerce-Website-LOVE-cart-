<?php 
session_start();
require_once("connection.php");

// Fetch products
$result = $con->query("SELECT * FROM products");

// Get userid from session
$userid = $_SESSION['userid'];

// Count items in the cart for this user
$cart_query = $con->query("SELECT COUNT(*) AS row_count FROM addtocart WHERE userid = '$userid'");
$cart_count = 0;

if ($cart_query) {
    $cart_data = $cart_query->fetch_assoc();
    $cart_count = $cart_data['row_count'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> L O &hearts; E C a r t</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
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
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 10px;
        }
        .product {
            width: 200px;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
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
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        .add-to-cart-btn {
            align-self: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease-in-out;
            border-radius: 3px;
        }
        .add-to-cart-btn:hover {
            background-color: #fff;
            color: #007bff;
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
    </style>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">

    <h1><pre>L O &hearts; E   C a r t</pre></h1>
    
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
            <?php while($data = $result->fetch_object()) { ?>
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
