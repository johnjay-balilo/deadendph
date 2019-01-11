<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { ?>

	<div class="container-fluid">
		<div class="jumbotron bg-dark text-light">
			
			<h1>
				<?php 
				if (isset($_SESSION['user_info'])) {
					echo "Hello, ".$_SESSION['user_info']['username'];
				} else {
					echo "Deadend";
				}
				 ?>				 	
			</h1>

			<p>Back</p>


		</div> <!-- end jumbo -->
	</div> <!-- end contianer -->








<?php } ?>