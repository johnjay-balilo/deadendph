<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { 
	global $conn; ?>

	<?php if (isset($_SESSION['user_info']) && $_SESSION['user_info']['roles_id'] == 1) { ?>

		<div class="container-fluid">
			<h4 class="text-center"> Order Admin Page </h4>
			<div class="row">
				<div class="col-sm-8 offset-sm-2 table-responsive">
					<table id="users_table" class="table table-striped mx-auto text-center">
						<thead>
							<tr>
								<th> Transaction Code </th>
								<th> Status </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							<?php

							$sql = "SELECT *, statuses.name AS status, orders.id AS order_id FROM orders JOIN statuses ON(orders.status_id=statuses.id) ORDER BY status DESC";
							$users = mysqli_query($conn, $sql);
							echo mysqli_error($conn);
							foreach ($users as $user) { ?>
								<tr>
									<td class="transaction_code"><?php echo $user['transaction_code']; ?></td>
									<td class="status"><?php echo $user['status']; ?></td>						
									<td>
										<?php if ($user['status'] == "pending"): ?>
										<button type="button" class="btn btn-success complete-order" order-id="<?php echo $user['order_id']; ?>"> Complete Order </button>									
										<button type="button" class="btn btn-danger cancel-order" order-id="<?php echo $user['order_id']; ?>"> Cancel Order </button>										
										<?php endif; ?>					
									</td>
								</tr>							 	
							<?php } ?>
						</tbody>
					</table>
					
				</div> <!-- end col -->
			</div> <!-- end row -->
		</div> <!-- end container -->



	<?php } else { 
		header("Location: ./error.php"); ?>





<?php }
} ?>