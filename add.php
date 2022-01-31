<?php 

	require('config/db.php');
	
	$email = $title = $ingredients = '';
	$errors = ['email' => '', 'title' => '', 'ingredients' => ''];
	
	// Check if the variable is set or exist
	if (isset($_POST['submit'])) {

		// Email validation
		if (empty($_POST['email'])) {
			$errors['email'] = "<span class='alert alert-danger form-control p-2'>Email is required.</span>";
		} else {
			// convert special character to html intities
			$email = $_POST['email'];
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				htmlspecialchars($email);
			} else {
				$errors['email'] = "<span class='alert alert-danger form-control p-2'>Invalid email address.</span>";
			}
		}

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

			// insert data from form
			$sql = "INSERT INTO pizzas (title, ingredients, email) 
			VALUES ('$title', '$ingredients', '$email')";

			if ($conn->query($sql) === true) {
				header('Location: index.php');
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
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
				<label for="email" class="form-label">Email</label><br>
				<?php echo $errors['email']; ?>
				<input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-control">
			</div>
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
			
			<input type="submit" name="submit" value="Submit" class="form-control bg-dark mt-4 p-2 text-light">
		</form>
	</section>

	<?php include('templates/footer.php'); ?>
	<!-- Footer Template -->

</html>