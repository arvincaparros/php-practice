<?php  
	
	require('config/db.php');

	// Check if GET request id is set
	if (isset($_GET['id'])) {

		// Scape all specail character
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		
		// sql query
		$sql = "SELECT * FROM pizzas WHERE id = '$id'";

		// Get result
		$result = mysqli_query($conn, $sql);

		// Fetch result in array format
		$pizza = mysqli_fetch_assoc($result);

		// Free the memory
		mysqli_free_result($result);

		//close conenction
		$conn->close();

	}

	

?>


<!DOCTYPE html>
<html lang="en">
	<!-- Header Template -->
	<?php include('templates/header.php'); ?>

	<div class="container text-center mt-5 mb-4">
		<div class="d-flex justify-content-center align-items-center">
			<div class="card col-5 p-4">
				<div class="card-body">
					<?php if ($pizza): ?>
					<h4 class="card-title"><?php echo htmlspecialchars(strtoupper($pizza['title'])); ?></h4>
					<p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
					<p><?php echo htmlspecialchars(date($pizza['created_at'])); ?></p>
					<h5>Ingredients:</h5>
					<p class="card-text"><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
					<?php else: ?>
						<h5>No Data Found</h5>
					<?php endif; ?>
				</div>
				<hr>
				<div class="d-flex align-items-center justify-content-center">
					<!-- Update Button -->					
					<a href="update.php?id=<?php echo $pizza['id']; ?>" class="card-link btn btn-success w-50 m-1">Edit</a>

					<!-- Delete trigger modal -->
					<button type="button" class="btn btn-danger w-50 m-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
					  Delete
					</button>



					<!-- Modal -->
					<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <p>Are you sure to delete the item?</p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					        <a href="delete.php?id=<?php echo $pizza['id']; ?>" class="card-link btn btn-danger">Remove</a>
					      </div>
					    </div>
					  </div>
					</div>
										
				</div>
			</div>
		</div>
		
	
	</div>


	<?php include('templates/footer.php'); ?>
	<!-- Footer Template -->
</html>