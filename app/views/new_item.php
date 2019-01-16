<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { 
	global $conn;

	if ($_SESSION['user'] !== "johnbalilo") {
		echo "Access denied.";
		echo "Notice: Undefined index: name in /opt/lampp/htdocs/deadend/app/controllers/process_add_item.php on line 6";
	} else {

	?>

	<div class="container">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
				<form action="../controllers/process_add_item.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name"> Name </label>
						<input type="text" class="form-control" name="name" id="name" required>
					</div>

					<div class="form-group">
						<label for="price"> Price </label>
						<input type="text" class="form-control" name="price" id="price" required>
					</div>

					<div class="form-group">
						<label for="description"> Description </label>
						<textarea type="text" class="form-control" name="description" id="description" required></textarea>
					</div>

					<div class="form-group">
						<label for="categories"> Category: </label>
						<select class="form-control col-8" name="category_id" id="categories" required>

							<?php 
							$sql = "SELECT * FROM categories";
							$categories = mysqli_query($conn, $sql);
							mysqli_fetch_assoc($categories);
							foreach ($categories as $category) {

								// extract is another way of getting data. It transforms the columns into variables
								extract($category);
								echo "<option value='$id'>$name</option>";
							} ?>

						</select>
					</div>

					<div class="form-group">
						<label for="image"> Image: </label>
						<input type="file" class="form-control" name="image" id="image" required>
					</div>

					<button type="submit" class="btn btn-block btn-primary"> Add New Item </button>




				</form>
			</div>
		</div>
	</div>










<?php }} ?>