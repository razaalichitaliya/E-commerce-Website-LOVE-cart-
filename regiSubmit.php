<?php
if(isset($_POST["email"])){
	$emailid = $_POST["email"];
	$name = $_POST["name"];
	$password = $_POST["psw"];
	$gander = $_POST["gender"];
	$city = $_POST["city"];

	$eroor = [];

	if (empty($name) || empty($password) || empty($gander) || empty($city)) {
		$eroor[] = "All Fields are Required"; 
	}
	if (!filter_var($emailid,FILTER_VALIDATE_EMAIL)) {
		$eroor[] = "Invalid Email"; 
	}
	if (strlen($password) < 6){
		$eroor[] = "Password Must Be Atlest 6 Characters"; 
	}
	

	//checking if the error array is empty
	if (!empty($eroor)){

		foreach ($eroor as $er){
			echo "<p>$er</p>"; 
		}
		exit();
	}else{
		require_once("connection.php");
		$query = "insert into registration (emailid, name, password, gander, city) values ('$emailid', '$name', '$password', '$gander', '$city')";
		try{
		$con->query($query);
		echo "Registration is Successful";
		echo "<br><a href='login.php'>Click here to login</a>";
		}
	catch(Exception $e){
		echo "Duplicate username";
		}
	}	
}
?>