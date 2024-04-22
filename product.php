<?php 
    session_start();

    require_once("connection.php");
    $result = $con->query("SELECT * FROM products");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> L O &hearts; E C a r t</title>
    <link rel="stylesheet" href="ind3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <h1><pre>L O &hearts; E   C a r t</pre></h1>
    <?php 
    
        if(isset($_SESSION["login"]) && $_SESSION["login"] == "customer") {
            // Fetching user's name from the Registration table based on email
            $email = $_SESSION["username"];
            $user_query = $con->query("SELECT name FROM Registration WHERE emailid='$email'");
            $user_data = $user_query->fetch_object();
            $name = $user_data->name;
            
            echo "<p>Welcome ".$name. " | <a href='logout.php'>Logout</a></p>";
        } else {
            echo "<a href='login.php'>Login</a></p>";
        }
        $cart_count = 0;
        if(isset($_SESSION["cart"])) {
            $cart_count = count($_SESSION["cart"]);
        }
    ?>
    <div class="cart-link">
        <a href="cart.php">Cart: <?php echo $cart_count; ?></a>
    </div>
    <div class="productContainer">
        <?php while($data = $result->fetch_object()) { ?>
            <div class="product">
                <img src="images/<?php echo $data->image; ?>" alt="<?php echo $data->productname; ?>" class="product-image">
                <div class="product-content">
                    <div class="product-text">
                        <p><?php echo $data->productname; ?></p>
                        <p><?php echo $data->price; ?></p>
                    </div>
                    <div class="btn">
                        <a href="addtocart.php?pid=<?php echo $data->productid; ?>" class="add-to-cart-btn">
                            <i class="bi bi-bag" style="font-size: 24px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Display the count of items in the cart with a link to the cart page -->
    
    <div class="fot">Buy things for you and your beloved! &hearts;</div>
</body>
</html>
