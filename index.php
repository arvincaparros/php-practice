<?php 

	require('config/db.php');
	require('delete.php');

	// query for all pizza
	$sql = 'SELECT id, title, ingredients FROM pizzas';

	// make query and get result
	$result = mysqli_query($conn, $sql);

	// fetch result
	$datas = mysqli_fetch_all($result, MYSQLI_ASSOC);


	// close connection
	$conn->close();
	
?>
<!DOCTYPE html>
<html lang="en">

	<!-- Header Template -->
	<?php include('templates/header.php'); ?>

	<h1 class="text-center mt-4 mb-4">Arv's Pizza</h1>

	<div class="container col-sm-12 col-md-8 col-lg-12">

		<div class="d-flex justify-content-center">
			<?php foreach ($datas as $data): ?>
				<div class="card w-50 m-1">
					<div class="card-body">
						<h5 class="card-title"><?php echo htmlspecialchars($data['title']); ?></h5>
						<p class="card-text">
							<ul class="list-group">
								<li class="list-group-item active bg-secondary border-0">Ingredients:</li>
								<?php foreach(explode(',', $data['ingredients']) as $ingredient): ?>
								<li class="list-group-item"><?php echo htmlspecialchars($ingredient); ?></li>
								<?php endforeach; ?>
							</ul>
						</p>
					</div>
				
					<div class="d-flex align-items-center justify-content-end">
						<a href="details.php?id=<?php echo $data['id']; ?>" class="btn btn-primary more-info-btn">More Info</a>						
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>


	<?php include('templates/footer.php'); ?>
	<!-- Footer Template -->


</html>
