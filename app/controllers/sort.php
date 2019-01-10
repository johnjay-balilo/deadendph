<?php 

session_start();

if (isset($_GET['sort'])) {
	$sort = $_GET['sort'];

	if ($sort == "asc") {
		$_SESSION['sort'] = " ORDER BY price ASC";
		$_SESSION['s'] = "asc";
	}else if ($sort == "desc") {
		$_SESSION['sort'] = " ORDER BY price DESC";
		$_SESSION['s'] = "desc";
	}
}



header("Location: ".$_SERVER["HTTP_REFERER"]) ;





 ?>