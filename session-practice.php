<?php 

	if (isset($_POST['submit'])) {
		
		session_start();

		$_SESSION['name'] = $_POST['name'];


		header('Location: index.php');
	}


?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap Link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Session</title>
</head>
<body>

	<div class="container d-flex justify-content-center align-items-center">
		<div class="col-8 mt-4">
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
				<div class="form-group">
					<input class="form-control" type="text" name="name" placeholder="Enter your name">
				</div>
				<input class="btn btn-primary w-25 mt-2" type="submit" name="submit" value="submit">
			</form>
		</div>
	</div>

</body>
</html>