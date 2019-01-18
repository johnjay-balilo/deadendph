<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { 
	global $conn;?>

	<?php if (isset($_SESSION['user_info']) && $_SESSION['user_info']['roles_id'] == 1) {
		header("Location: ./error.php");
	} else { ?>

	<div class="container">

		<table class="table table-striped table-dark ">

			<?php 
			global $conn;
			$cart_total = 0; 
			?>				

			<thead class="thead-light">
				<tr>
					<td class="item_name">Item Name</td>
					<td class="item_price">Item Price</td>
					<td>Item Quantity</td>
					<td>Item Subtotal</td>
					<td class="action">Action</td>
				</tr>
			</thead>

			<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) { ?>	

			<tbody>
				<?php 

				foreach ($_SESSION['cart'] as $id => $qty) {
					$sql = "SELECT * FROM items WHERE id='$id'";
					$result = mysqli_query($conn, $sql);
					$item = mysqli_fetch_assoc($result);
					$subtotal = $qty * $item['price'];
					$cart_total += $subtotal;
				 ?>

				<tr id="row-<?php echo $item['id']; ?>" data-id="<?php echo $item['id']; ?>">
					<td class="item_name text-center">
						<?php echo $item['name']; ?>
						<br>
						<img class="cart_img" src="../assets/images/<?php echo $item['image_path']; ?>">
					</td>
					<td class="item_price" price="<?php echo $item['price']; ?>">
						<?php echo "&#165; ".$item['price']; ?>
					</td>
					<td class="item_quantity">
						<input type="number" class="form-control item_quantity_value" data-id="<?php echo $item['id']; ?>" min="1" value="<?php echo $qty; ?>">	
					</td>
					<td class="item_subtotal">
						<?php echo bcadd($subtotal, 0, 2) ?>						
					</td>
					<td class="action">			
						<button class="btn btn-danger remove-from-cart" data-dismiss="modal" data-id="<?php echo $item['id']; ?>"> Remove from cart </button>
					</td>
				</tr>

				
				<?php } ?>

			</tbody>
			<?php  ?>



				

			<?php } else { ?>

				<tr>
					<td class="text-center" colspan="6"> No items in cart </td>
				</tr>

			<?php } ?>

			<tfoot>
				<tr>
					<td class="text-right font-weight-bold" colspan="2">
						<button  id="empty_cart" class="btn btn-danger"> Empty cart </button>
					</td>
					<td class="text-right font-weight-bold"> Total </td>
					
					<td class="text-right font-weight-bold" id="total_price">
						<?php echo "&#165; " . number_format($cart_total, 2); ?>
					</td>
					<td>

						<?php if (isset($_SESSION['user'])) { ?>
							<a class="btn btn-primary" href="./checkout.php">
								Checkout
							</a>
						<?php } else { ?>						
							<button type="button" id="checkout" class="btn btn-primary" data-toggle="modal" data-target="#login-modal"> Checkout </button>

							<div id="login-modal" class="modal fade">
								<div class="modal-dialog" role="document">

									<div class="modal-content bg-dark">
										<header class="modal-header">
											<h5 class="modal-title"> It seems you are not logged in! </h5>
											<button class="close" data-dismiss="modal">
												<span> &times; </span>
											</button>
										</header> <!-- end modal header -->

										<div class="modal-body">
											<form>
												<div class="form-group">
													<p class="error"> </p>
													<label> Username:  </label>
													<input id="username" type="text" name="username" class="form-control">	
												</div>
												<div class="form-group">
													<label> Password:  </label>
													<input id="password" type="password" name="password" class="form-control">
												</div>

												<div class="text-center py-4 row">
													<div class="col-6">
														<a href="register.php" class="btn btn-block btn-outline-secondary"> Register </a>
													</div>
													<div class="col-6">
														<button id="login" class="btn btn-block btn-outline-light"> Login </button>
													</div>
												</div>
											</form>
										</div> <!-- end modal body -->										
									</div>
								</div>
							</div> <!-- end modal -->

						<?php } ?>
					</td>
				</tr>
			</tfoot>

		</table>
	</div>

	






<?php }
} ?>