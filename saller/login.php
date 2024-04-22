<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
	<link rel="stylesheet" href="../css2.css">
</head>
<body>

	<form action="loginSubmit.php" method="POST">
		<h1>Login</h1>
	
		<label for="email">Email</label>
		<input type="text" name="email" id="email">
	
		<label for="Password">Password</label>
		<input type="password" name="Password" id="Password">
	
		<input type="submit" value="Login">
		
		<p>New user? <a href="../register.php">Register here</a></p>
		<p>login As Buyer<a href="../login.php">Login</a></p>

	</form>
</body>
</html>
