<?php require_once("../partials/template.php") ?>

<?php function get_page_content() { ?>

	<?php if (isset($_SESSION['user_info'])) {
		header("Location: ../../index.php");
	} ?>
	
	<form id="register_form">
		<h1 class="text-center">Register</h1>

		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="firstname"> First Name: </label>
						<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter first name">
						<small class="error"> </small>
					</div>

					<div class="form-group">
						<label for="lastname"> Last Name: </label>
						<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter last name">
						<small class="error"> </small>
					</div>

					<div class="form-group">
						<label for="email"> Email: </label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
						<small class="error"> </small>
					</div>

					<div class="form-group">
						<label for="address"> Address: </label>
						<input type="text" name="address" id="address" class="form-control" placeholder="Enter address">
						<small class="error"> </small>
					</div>
				</div>



				<div class="col-6">
					<div class="form-group">
						<label for="username"> Username: </label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Enter username">
						<small class="error"> </small>
					</div>

					<div class="form-group">
						<label for="password"> Password: </label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
						<small class="error"> </small>
					</div>

					<div class="form-group">
						<label for="cpassword"> Confirm Password: </label>
						<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm password">
						<small class="error"> </small>
					</div>					
				</div>
			</div>
		</div>		

		<button id="register" class="btn btn-outline-light btn-block"> Register </button>

	</form>

<?php } ?>