<?php 

session_start();

	function getCartCount() {
		return array_sum($_SESSION['cart']);
	}

	$item_id = $_POST['item_id'];
	$item_quantity = $_POST['item_quantity'];	

	if ($item_quantity == "0") {
		unset($_SESSION['cart'][$item_id]);
		$_SESSION['cart'][$item_id] = 0;
	} else {
		if (isset($_SESSION['cart'][$item_id])) {
			$_SESSION['cart'][$item_id] += $item_quantity;			
		}else {
			$_SESSION['cart'][$item_id] = $item_quantity;
		}
	}


	echo getCartCount();





 ?>