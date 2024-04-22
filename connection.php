<?php 
	$dbhost = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "project";

	$con = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

	if($con->connect_error)
	{
		die("There is some issue with database, please try again later");
	}
	?>