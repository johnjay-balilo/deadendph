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

			<?php if (isset($_SESSION['user_info'])) { ?>
			<li class="nav-item <?php if($page_title == "Profile"){ echo "active";} ?>">
				<a id="profile_link" class="nav-link" href="../views/profile.php">Welcome, <?php echo $_SESSION['user_info']['firstname']; ?></a>
			</li>
			<?php } ?>

			<?php if (isset($_SESSION['user_info']) && $_SESSION['user_info']['roles_id'] == 1) { ?>
			<li class="nav-item <?php if($page_title == "Users"){ echo "active";} ?>">
				<a id="users_link" class="nav-link" href="../views/users.php"> Users </a>
			</li>

			<li class="nav-item <?php if($page_title == "Orders"){ echo "active";} ?>">
				<a class="nav-link" href="../views/orders.php"> Orders </a>
			</li>

			<li class="nav-item <?php if($page_title == "Items"){ echo "active";} ?>">
				<a class="nav-link" href="../views/items.php"> Items </a>
			</li>
			<?php } ?>

			<?php if (!isset($_SESSION['user_info']) || $_SESSION['user_info']['roles_id'] == 2) { ?>
			<li class="nav-item <?php if($page_title == "Catalog"){ echo "active";} ?>">
				<a class="nav-link" href="catalog.php">Catalog</a>
			</li>

			<li class="nav-item <?php if($page_title == "Cart"){ echo "active";} ?>">
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
			<?php } ?>
			

			<!-- if logged in -->
			<?php if (isset($_SESSION['user_info'])) { ?>
			<li class="nav-item">
				<a class="nav-link" href="../controllers/logout.php">Logout</a>
			</li>
			
			<!-- if not logged in -->
			<?php } else { ?>
			<li class="nav-item <?php if($page_title == "Login"){ echo "active";} ?>">
				<a class="nav-link" href="login.php">Login</a>
			</li>
			<li class="nav-item <?php if($page_title == "Register"){ echo "active";} ?>">
				<a class="nav-link" href="register.php">Register</a>
			</li>

			<?php } ?>


			<li></li>

			
			
		</ul>

	</div>






</nav>