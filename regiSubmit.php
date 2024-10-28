<?php
if(isset($_POST["email"]))
{
	$emailid = $_POST["email"];
	$name = $_POST["name"];
	$password = $_POST["psw"];
	$gander = $_POST["gender"];
	$city = $_POST["city"];
	
	require_once("connection.php");

	$query = "insert into registration (emailid, name, password, gander, city) values ('$emailid', '$name', '$password', '$gander', '$city')";

	try
	{
		$con->query($query);
		echo "Registration is Successful";
		echo "<br><a href='login.php'>Click here to login</a>";
	}
	catch(Exception $e)
	{
		echo "Duplicate username";
	}
}
?>