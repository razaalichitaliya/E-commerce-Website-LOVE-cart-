<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-label {
            color: #555;
        }

        .form-control {
            box-shadow: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-footer {
            margin-top: 20px;
            text-align: center;
        }

        .form-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <form action="loginSubmit.php" method="POST">
            <h1>Login</h1>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="Password" class="form-label">Password</label>
                <input type="password" name="Password" id="Password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>

            <div class="form-footer">
                <p>New user? <a href="register.php">Register here</a></p>
                <p>Login As Seller: <a href="saller/login.php">Login Here</a></p>
            </div>
        </form>
    </div>

</body>
</html>
