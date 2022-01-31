<?php  

	require('config/db.php');
	
	$email = $title = $ingredients = '';
	$errors = ['email' => '', 'title' => '', 'ingredients' => ''];
	

	// query for all pizza
	$sql = 'SELECT id, title, ingredients FROM pizzas';

	// make query and get result
	$result = mysqli_query($conn, $sql);

	// fetch result
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	foreach ($pizzas as $pizza) {
		$title = $pizza['title'];
		$ingredients = $pizza['ingredients'];
	}


	// Check if the variable is set or exist
	if (isset($_POST['update'])) {

		// Title validation
		if (empty($_POST['title'])) {
			$errors['title'] = "<span class='alert alert-danger form-control p-2'>Title is required.</span>";
		} else {
			// convert special character to html intities
			$title = $_POST['title'];
			// check the title if letters and spaces only
			if (preg_match('/^[a-zA-Z\s]+$/', $title)) {
				htmlspecialchars($title);
			} else {
				$errors['title'] = "<span class='alert alert-danger form-control p-2'>Title must be letters and spaces only</span>";
			}
		}

		// Ingredients validation
		if (empty($_POST['ingredients'])) {
			$errors['ingredients'] = "<span class='alert alert-danger form-control p-2'>Atleast one ingredients is required.</span>";
		} else {
			// convert special character to html intities
			$ingredients = $_POST['ingredients'];
			if (preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
				htmlspecialchars($ingredients);
			} else {
				$errors['ingredients'] = "<span class='alert alert-danger form-control p-2'>ingredients must be comma seprated.</span>";
			}
		}

		if (!array_filter($errors)) {

			$id = mysqli_real_escape_string($conn, $_GET["id"]);

			// query to delete record
			$sql = "UPDATE pizzas SET title = '$title', ingredients = '$ingredients' WHERE id = '$id'";

			if ($conn->query($sql) === true) {
				header("Location: index.php");
			} else {
				echo "Error updating record " . $conn->error;
			}

		}
		
		$conn->close();
		
		
	}
	// End of POST


?>

<!DOCTYPE html>
<html lang="en">

	<!-- Header Template -->
	<?php include('templates/header.php'); ?>


	<section class="container d-flex flex-column align-items-center mt-4 mb-4">

		<h4>Add a Pizza</h4>
		
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="col-sm-12 col-md-12 col-lg-8 ">
			
			<div class="mb-2">
				<label for="title" class="form-label">Pizza Title</label><br>
				<?php echo $errors['title']; ?>
				<input type="text" name="title" id="title"  value="<?php echo $title; ?>" class="form-control">
			</div>

			<div class="mb-2">
				<label for="ingredients" class="form-label">Ingredients (comma seperated)</label><br>
				<?php echo $errors['ingredients']; ?>
				<input type="text" name="ingredients" id="ingredients" value="<?php echo $ingredients; ?>" class="form-control">
			</div>
			
			<input type="submit" name="update" value="Update" class="form-control bg-dark mt-4 p-2 text-light">
		</form>
	</section>

	<?php include('templates/footer.php'); ?>
	<!-- Footer Template -->

</html>