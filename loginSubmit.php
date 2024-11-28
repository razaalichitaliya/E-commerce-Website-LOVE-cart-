<?php

session_start();

if (isset($_POST["email"])) {
    $emailid = $_POST["email"];
    $password = $_POST["Password"];

    require_once("connection.php");

    $query = "SELECT * FROM registration WHERE emailid='$emailid' AND password='$password'";

    try {
        $result = $con->query($query);

        if ($data = $result->fetch_object()) {
            // Set session variables
            $_SESSION["login"] = "customer";
            $_SESSION["username"] = $data->emailid;
            $_SESSION["userid"] = $data->userid;

            // If "Remember Me" is checked, set a cookie
            if (isset($_POST["remember_me"])) {
                setcookie("user_login", $data->emailid, time() + (86400 * 30), "/"); // Cookie expires in 30 days
            }

            header("location: index.php");
        } else {
            echo 'Incorrect username or password. Please try again';
            echo '<a href="login.php">Click here to login again</a>';
        }
    } catch (Exception $e) {
        echo "Error occurred: " . $e->getMessage();
    }
}