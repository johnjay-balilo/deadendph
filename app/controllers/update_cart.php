<?php 

session_start();

	function getCartCount() {
		return array_sum($_SESSION['cart']);
	}

	$item_id = $_POST['item_id'];
	$item_quantity = $_POST['item_quantity'];
	$update_flag = $_POST['update_from_cart_page'];

	if ($update_flag == 0) {	
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

	} else if ($update_flag == 1) {
		$_SESSION['cart'][$item_id] = $item_quantity;

	} else if ($update_flag == 2) {
		unset($_SESSION['cart'][$item_id]);

	} else if ($update_flag == 3) {
		unset($_SESSION['cart']);
	
	}
	
	echo getCartCount();





 ?>