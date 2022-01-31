<?php  
	
	session_start();

	$user_name = $_SESSION['name'];

?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap Link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<!-- CSS -->
	<link rel="stylesheet" href="style.css">

	<!-- Title -->
	<title>Pizza</title>
	
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
	<div class="container">
		<a href="index.php" class="navbar-brand m-1">Arv's Pizza</a>
		<ul class="navbar-nav">
			<div class="d-flex">
				<li class="nav-item">
					<a href="#" disabled="disabled" class="nav-link m-1">Hello, <span class="text-light"><?php echo htmlspecialchars($user_name); ?></span></a>
				</li>
				
				<li class="nav-item m-1"><a href="add.php" class="btn btn-warning">Add Pizza</a></li>
			</div>
			
		</ul>
	</div>
</nav>

