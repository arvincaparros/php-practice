<?php 

	$server = 'localhost';
	$username = 'arvin';
	$password = '12345';
	$db_name = 'my_pizza';

	// Create connection
	$conn = mysqli_connect($server, $username, $password, $db_name);

	// Check connection
	if ($conn->connect_error) {
		echo 'Connection error: ' . mysqli_connect_error();
	}

?>