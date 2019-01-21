<?php $page_title = "Users" ?>
<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { 
	global $conn; ?>

	<?php if (isset($_SESSION['user_info']) && $_SESSION['user_info']['roles_id'] == 1) { ?>

		<div class="container-fluid">
			<h4 class="text-center"> User Admin Page </h4>
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<table id="users_table" class="table table-responsive table-striped">
						<thead>
							<tr>
								<th> Username </th>
								<th> First Name </th>
								<th> Last Name </th>
								<th> Email </th>
								<th> Role </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							<?php

							$sql = "SELECT *, roles.name AS role FROM users JOIN roles ON(users.roles_id=roles.id)";
							$users = mysqli_query($conn, $sql);
							foreach ($users as $user) { ?>
								<tr>
									<td class="username"><?php echo $user['username']; ?></td>
									<td class="firstname"><?php echo $user['firstname']; ?></td>
									<td><?php echo $user['lastname']; ?></td>
									<td><?php echo $user['email']; ?></td>
									<td class="role"><?php echo $user['role']; ?></td>
									<td>										
										<button type="button" roles_id="<?php echo $user['roles_id']; ?>" class="btn btn-danger grant-admin" <?php if ($user['role'] == "user"){echo "style='display:none;'";} ?> <?php if ($user['username'] == $_SESSION['user']){echo "hidden";} ?> > Revoke Admin </button>									
										<button type="button" roles_id="<?php echo $user['roles_id']; ?>" class="btn btn-primary grant-admin" <?php if ($user['role'] == "admin"){echo "style='display:none;'";} ?> <?php if ($user['username'] == $_SESSION['user']){echo "hidden";} ?> > Make Admin </button>										
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