<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 500px;
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
            font-weight: bold;
        }

        .form-check-label {
            font-weight: normal;
        }

        .btn-primary {
            width: 100%;
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container form-container">
        <h1>Registration Form</h1>
        <form action="regiSubmit.php" method="post">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="psw" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter password" name="psw" id="psw" required>
            </div>

            <div class="form-group">
                <label for="psw-repeat" class="form-label">Confirm password</label>
                <input type="password" class="form-control" placeholder="Confirm password" name="psw-repeat" id="psw-repeat" required>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="0">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="1">
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" placeholder="Enter city" name="city" id="city" required>
            </div>

            

            

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

</body>
</html>
