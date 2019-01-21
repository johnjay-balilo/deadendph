<?php $page_title = "Edit Item" ?>
<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { 
	global $conn;

	if ($_SESSION['user_info']['roles_id'] == 2) {
		header("Location: ./error.php");
	} else if ($_SESSION['user_info']['roles_id'] == 1) {

		$id = $_GET['id'];
		// $id = $_POST['id'];
		$sql = "SELECT * FROM items WHERE id=$id";
		$result = mysqli_query($conn, $sql);
		$item = mysqli_fetch_assoc($result);
	?>

	<div class="container">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
				<form action="../controllers/process_edit_item.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" id="id" value="<?php echo $item['id']; ?>">					

					<div class="form-group">
						<label for="name"> Name </label>
						<input type="text" class="form-control" name="name" id="name" value="<?php echo $item['name']; ?>" required>
					</div>

					<div class="form-group">
						<label for="price"> Price </label>
						<input type="number" class="form-control" name="price" id="price" value="<?php echo $item['price']; ?>" required>
					</div>

					<div class="form-group">
						<label for="description"> Description </label>
						<textarea type="text" class="form-control" name="description" id="description" required><?php echo $item['description']; ?></textarea>
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

								$selected = $item['category_id'] == $id ? "selected": ""; // ternary operator
								echo "<option value='$id' $selected>$name</option>";
								// if ($id == $item['category_id']) {
								// 	echo "<option value='$id' selected>$name</option>";
								// } else {
								// 	echo "<option value='$id'>$name</option>";
								// }
								
							} ?>

						</select>
					</div>

					<div class="form-group">
						<label for="image"> Image: </label>
						<div class="form-control">

							<img src="../assets/images/<?php if ($item['image_path'] == ""){echo "noimage.jpg";}else{echo $item['image_path'];} ?>" class="img-fluid edit-item-image">
							<br><br>
							<div class="row">								
								<div class="col-9">
									<input type="file" class="form-control" name="image" id="image">
								</div>
								<div class="col-3">
									<button type="submit" class="btn btn-danger" form="unlink-form">Unlink Image</button>
								</div>
							</div>
							
											
							
						</div>
						
					</div>

					<button type="submit" class="btn btn-block btn-primary"> Edit Item </button>

				</form>
				<form id="unlink-form" method="POST" action="../controllers/unlink_image.php">
					<input type="hidden" name="image_path" value="<?php echo $item['image_path']; ?>">					
				</form>
			</div>
		</div>
	</div>



<?php }

} ?>