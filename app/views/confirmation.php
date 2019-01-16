<?php require_once '../partials/template.php' ?>

<?php function get_page_content() { ?>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1> Confirmation Page </h1>
			</div>
			
		</div>
		<div class="row">
			<div class="col-12">
				<h3> Reference No.: <?php echo $_SESSION['new_txn_number']; ?> </h3>
				<?php unset($_SESSION['new_txn_number']); ?>

				<p> Thank you for shopping. Your order is being processed. </p>

				<a class="btn btn-primary" href="./catalog.php"> Continue Shopping </a>
				
				
			</div>
		</div>
	</div>








	





<?php } ?>