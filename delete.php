<?php 
	
	require('config/db.php');

	if (isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET["id"]);

		// query to delete record
		$sql = "DELETE FROM pizzas WHERE id = '$id'";

		if ($conn->query($sql) === true) {
			header("Location: index.php");
		} else {
			echo "Error delelting record " . $conn->error;
		}

		//close conenction
		$conn->close();
	}
	

?>

