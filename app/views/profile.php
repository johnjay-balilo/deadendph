<?php $page_title = "Profile" ?>
<?php require_once "../partials/template.php"; ?>
<?php function get_page_content(){
	global $conn;
 ?>
<?php $user = $_SESSION['user']; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3">
				<div class="list-group" id="list-tab" role="tablist">
					<a class="list-group-item list-group-item-action list-group-item-dark active" href="#profile" data-toggle="list" role="tab">
						User Information
					</a>
					<a class="list-group-item list-group-item-action list-group-item-dark" href="#change_pass" data-toggle="list" role="tab">
						Change Password
					</a>
					<a class="list-group-item list-group-item-action list-group-item-dark <?php if($_SESSION['user'] == 1) {echo "disabled";} ?>" href="#history" data-toggle="list" role="tab">
						Order History
					</a>
				</div>
			</div>

			<div class="col-lg-7">
				<div class="tab-content">
					<div class="tab-pane show active fade" id="profile" role="tabpanel">
						<h3>User Information</h3>
						<form id="update_user_details" action="../controllers/update_profile.php" method="POST">
							<div class="container">
								<input type="text" class="form-control" name="user_id" value="<?php echo $_SESSION['user_info']['id']; ?>" hidden>
								<label for="username"> Username </label>
								<input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['user']; ?>" disabled>
								<span class="validation error"></span><br>
								<label for="firstname"> First Name </label>
								<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['user_info']['firstname']; ?>">
								<span class="validation error"></span><br>
								<label for="lastname"> Last Name </label>
								<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['user_info']['lastname']; ?>">
								<span class="validation error"></span><br>
								<label for="email"> E-mail Address </label>
								<input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user_info']['email']; ?>">
								<span class="validation error"></span><br>
								<label for="address"> Address </label>
								<input type="text" class="form-control" id="address" name="address" value="<?php echo $_SESSION['user_info']['address']; ?>">
								<span class="validation error"></span><br>
								<br>
								<button type="submit" class="btn btn-primary mb-5" id="update_info">Update Info</button>
							</div>
						</form>
					</div>

					<div class="tab-pane fade" id="change_pass" role="tabpanel">
						<h3> Change Password </h3>
						<form id="change_password">
							<div class="container">
								<input type="text" class="form-control" name="user_id" value="<?php echo $_SESSION['user_info']['id']; ?>" hidden>

								<label for="old_password"> Old Password </label>
								<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter your old password">
								<span class="validation error"></span><br>

								<label for="new_password"> New Password </label>
								<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password">
								<span class="validation error"></span><br>

								<label for="cnew_password"> Confirm New Password </label>
								<input type="password" class="form-control" id="cnew_password" name="cnew_password" placeholder="Confirm your new password">
								<span class="validation error"></span><br>

								<button type="submit" class="btn btn-primary mb-5" id="change_password_btn"> Change Password </button>
							</div>
						</form>
					</div>

					<div class="tab-pane fade" id="history" role="tabpanel">
						<div class="row">
							<div class="col-md-6">
								<h3>Order History</h3>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr class="text-center">
										<th>Transaction Number</th>
										<th>Purchase Date</th>
										<th>Status</th>
										<th>Payment Mode</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$user_id = $_SESSION['user_info']['id'];

									$sql = "SELECT *, statuses.name AS 'status_name', payment_modes.name AS 'payment_mode_name' FROM orders JOIN payment_modes JOIN statuses ON(orders.payment_mode_id=payment_modes.id AND orders.status_id=statuses.id) WHERE user_id=$user_id";
									$transactions = mysqli_query($conn, $sql);

									foreach ($transactions as $transaction) { ?>
										<tr>
                                      		<td><?php echo $transaction['transaction_code'] ?></td>
                                      		<td><?php echo $transaction['purchase_date'] ?></td>
                                      		<td><?php echo $transaction['status_name'] ?></td>
                                      		<td><?php echo $transaction['payment_mode_name'] ?></td>
                                      		<td><?php echo $transaction['total'] ?></td>
                                      	</tr>
										
									<?php }	?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
