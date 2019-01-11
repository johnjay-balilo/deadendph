<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { ?>

	<div id="login_form" class="container-fluid">
		<h1 class="text-center">Login</h1>

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

		
	</div> <!-- end container -->





<?php } ?>