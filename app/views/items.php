<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { 
	global $conn;

	if ($_SESSION['user_info']['roles_id'] == 2) {
		header("Location: ./error.php");
	} else if ($_SESSION['user_info']['roles_id'] == 1) { ?>

	<div class="container">
		<div class="row">
			<div class="col">
				<a href="./new_item.php" class="btn btn-primary"> Add New Item </a>
			</div>
			
		</div>
		
		<div class="row">
			<?php 

			$sql = "SELECT * FROM items";
			$items = mysqli_query($conn, $sql);

			foreach ($items as $item) { ?>

				<div class="col-lg-3 col-md-6 item-card">
					<div class="card h-100 bg-secondary">
						<img src="../assets/images/<?php if ($item['image_path'] == ""){echo "noimage.jpg";}else{echo $item['image_path'];} ?>" class="card-img-top">
						<div class="card-body">
							<h4 class="card-title"> <?php echo $item['name']; ?> </h4>
							<p class="card-text"> <?php echo $item['description']; ?> </p>
							<p class="card-text"> Price: <?php echo $item['price']; ?> </p>

							<input type="hidden" value="<?php echo $item['id']; ?>">
						</div> <!-- end card body -->

						<div class="card-footer">
							<a href="./edit_item.php?id=<?php echo $item['id']; ?>" class="btn btn-primary mr-1"> Edit Item </a>							<!-- <form method="POST" action="./edit_item.php">
								<input type="hidden" id="id" name="id" value="<?php echo $item['id']; ?>">
								<button class="btn btn-primary mr-1"> Edit Item </button>
							</form> -->
							<input type="hidden" name="image_path" >

							<button type="button" class="btn btn-danger delete-item" data-id="<?php echo $item['id']; ?>" data-path="<?php echo $item['image_path']; ?>"> Delete Item </button>
							
						</div>
					</div> <!-- end card -->
				</div> <!-- end col -->				
			<?php } ?>			
		</div>
	</div>

<?php }
} ?>