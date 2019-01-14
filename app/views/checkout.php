<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { 
	global $conn; ?>

	<?php 

	if (!isset($_SESSION['user_info'])) {
		header("Location: ./login.php");
	} else { ?>

		<div>
			<h1>Welcome to your checkout page.</h1>
		</div>

		<form method="POST" action="../controllers/placeorder.php">
			<div class="container">
				<div class="row mt-4">
					<div class="col-4">
						<div class="form-group">
							<label for="addressLine1"> Shipping Address </label>
							<input type="text" class="form-control" name="addressLine1" value="<?php echo $_SESSION['user_info']['address']; ?>">
						</div> <!-- end form group -->
					</div> <!-- end col -->
				</div> <!-- end row -->
				<div class="row">
					<h4> Order Summary </h4>
				</div>

				<div class="row">					
					<div class="col-sm-6">
						<p> Total </p>
					</div> <!-- end col -->
					<div class="col-sm-6" id="total_price">

						<?php 
						$cart_total = 0;
						foreach ($_SESSION['cart'] as $id => $quantity) {
							$sql = "SELECT * FROM items WHERE id=$id";
							$result = mysqli_query($conn, $sql);
							$item = mysqli_fetch_assoc($result);
							$subtotal = $quantity * $item['price'];
							$cart_total += $subtotal;
						}
						echo $cart_total;
						?>						
						
					</div> <!-- end col -->
				</div> <!-- end row -->

				<hr>
				<button type="submit" class="btn btn-primary btn-block"> Place Order Now </button>

				<div class="row cart-items mt-4">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-dark" id="cart-items">

							<thead>
								<tr class="text-center">
									<th colspan="2"> Item Name </th>
									<th> Item Price </th>
									<th> Item Quantity </th>
									<th> Subtotal </th>
								</tr>
							</thead>

							<tbody>
								<?php 
								foreach ($_SESSION['cart'] as $id => $qty) {
									$sql = "SELECT * FROM items WHERE id=$id";
									$result = mysqli_query($conn, $sql);
									$item = mysqli_fetch_assoc($result);
								?>

								<tr>
									<td colspan="2"> <?php echo $item['name']; ?> </td>
									<td> <?php echo $item['price']; ?> </td>
									<td> <?php echo $qty ?> </td>
									<td> <?php echo $qty * $item['price']; ?> </td>
								</tr>
									
								<?php } ?>
							</tbody>

						</table>
					</div>
				</div>

			</div> <!-- end container -->
		</form>





	<?php } ?>













<?php } ?>