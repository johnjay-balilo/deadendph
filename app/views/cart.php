<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { ?>

	<div class="container">

		<table class="table table-striped table-dark ">

			<?php 
			global $conn;
			$cart_total = 0; 
			?>

			<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) { ?>		

			<thead class="thead-light">
				<tr>
					<td class="item_name">Item Name</td>
					<td class="item_price">Item Price</td>
					<td>Item Quantity</td>
					<td>Item Subtotal</td>
					<td class="action">Action</td>
				</tr>
			</thead>

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
					<td class="action text-center">			
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
					<td class="text-right font-weight-bold" colspan="3">
						<button  id="empty_cart" class="btn btn-danger"> Empty cart </button>
					</td>
					<td class="text-right font-weight-bold"> Total </td>
					
					<td class="text-right font-weight-bold" id="total_price">
						<?php echo "&#165; " . number_format($cart_total, 2); ?>
					</td>
					<td>
						<a class="btn btn-primary" href="./checkout.php">
							Checkout
						</a>
					</td>
				</tr>
			</tfoot>

		</table>
	</div>

	






<?php } ?>