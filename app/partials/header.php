<nav id="nav" class="navbar navbar-expand-lg navbar-dark">
	<a class="navbar-brand" href="home.php">
		<img id="brand" class="img-fluid" src="">
		🔚
	</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">

			<li class="nav-item">
				<a class="nav-link" href="catalog.php">Catalog</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="../views/cart.php">Cart <span class="badge badge-dark" id="cart-count">
					<?php 
					if (isset($_SESSION['cart'])) {
						echo array_sum($_SESSION['cart']);
					}else {
						echo 0;
					}
					 ?>
				</span></a>
			</li>

			<!-- if logged in -->
			<?php if (isset($_SESSION['user_info'])) { ?>
			<li class="nav-item">
				<a class="nav-link" href="../controllers/logout.php">Logout</a>
			</li>
			
			<!-- if not logged in -->
			<?php } else { ?>
			<li class="nav-item">
				<a class="nav-link" href="login.php">Login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="register.php">Register</a>
			</li>

			<?php } ?>


			<li></li>

			
			
		</ul>

	</div>






</nav>