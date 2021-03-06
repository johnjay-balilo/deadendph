<?php $page_title = "Catalog" ?>
<?php require_once '../partials/template.php'; ?>

<?php function get_page_content() { 
	global $conn;?>

	<?php if (isset($_SESSION['user_info']) && $_SESSION['user_info']['roles_id'] == 1) {
		header("Location: ./error.php");
	} else { ?>

	<div class="container-fluid">
		<div class="row">

			<div class="col-2">				
				<div class="list-group">
					<h4>Categories</h4>

					<a class="list-group-item list-group-item-action<?php if(!isset($_GET['id'])){echo " active2";}?>" href="catalog.php"> All </a>
					
					<?php 

					$sql = "SELECT * FROM categories";
					$categories = mysqli_query($conn, $sql);

					foreach ($categories as $category) { ?>

						<a class="list-group-item list-group-item-action

						<?php if($_GET['id']==$category['id']) { echo " active2"; } ?>

						" href="catalog.php?id=

						<?php echo $category['id']; ?>

						">

						<?php echo $category['name']; ?>

						</a>

					<?php } ?>
					
				</div> <!-- end list group -->

				<div class="list-group">

					<h4> Sort </h4>

					<a class="list-group-item list-group-item-action <?php if($_SESSION['s']=="asc") { echo " active2"; } ?>" href="../controllers/sort.php?sort=asc"> Lowest to Highest </a>
					<a class="list-group-item list-group-item-action <?php if($_SESSION['s']=="desc") { echo " active2"; } ?>" href="../controllers/sort.php?sort=desc"> Highest to Lowest </a>

				</div> <!-- end list group -->

				<div>
					<a href="../controllers/sort_session_destroy.php"> Reset Sort </a>
				</div>


				
			</div> <!-- end col -->

			<div class="col-10">
				<div class="row">

					<?php 

					$sql = "SELECT * FROM items";

					if (isset($_GET['id'])) {
						$sql .= " WHERE category_id=".$_GET['id'];
					}

					if (isset($_SESSION['sort'])) {
						$sql .= $_SESSION['sort'];
					}

					$items = mysqli_query($conn, $sql);
					
					foreach ($items as $item) { ?>
						<div class="col-lg-3 col-md-3">
							<div class="card h-100 bg-secondary">
								<img class="card-img-top" src="../assets/images/<?php if ($item['image_path'] == ""){echo "noimage.jpg";}else{echo $item['image_path'];} ?>">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $item['name']; ?>
									</h5> <!-- end card title -->
									<p class="card-text">
										<?php echo $item['description']; ?>
										<br>
										<?php echo $item['price']; ?>
									</p> <!-- end card text -->
								</div> <!-- end card body -->
								<div class="card-footer container-fluid">
									<div class="row">
										<div class="quantity">
											<input type="number" class="form-control" value="1" min="1">
										</div>
										<div class="add">
											<button type="submit" class="add-to-cart btn btn-block btn-outline-light" data-id="<?php echo $item['id'] ?>"> Add to Cart </button>
										</div>
									</div> <!-- end row -->
								</div> <!-- end card footer -->	
							</div> <!-- end card -->
						</div> <!-- end col -->
					<? } ?>
	
				</div> <!-- end row -->
			</div> <!-- end col -->
		</div> <!-- end row -->
	</div> <!-- end container -->










<?php }
} ?>