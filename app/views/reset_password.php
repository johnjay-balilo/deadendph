<?php $page_title = "Reset Password" ?>
<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { ?>

	<?php if (isset($_SESSION['user_info'])) {
		header("Location: ../../index.php");
	} ?>

	<div id="login_form" class="container-fluid">
		<h1 class="text-center">Reset Password</h1>

		<div id="alert" class="alert hidden"></div>

		<form id="reset_password_form">
			<div class="form-group">
				<p class="error"> </p>
				<label> Username: </label>
				<input id="username" type="text" name="username" class="form-control">	
			</div>
			<div class="form-group">
				<label> First Name: </label>
				<input id="firstname" type="text" name="firstname" class="form-control">
			</div>
			<div class="form-group">
				<label> Last Name: </label>
				<input id="lastname" type="text" name="lastname" class="form-control">
			</div>
			<div class="form-group">
				<label> Email: </label>
				<input id="email" type="email" name="email" class="form-control">
			</div>
			<br>
			<div class="row text-center">
				<button type="submit" class="btn btn-block btn-outline-secondary" id="reset_password_btn"> Reset Password </button>
			</div>

		</form>
		
	</div> <!-- end container -->





<?php } ?>