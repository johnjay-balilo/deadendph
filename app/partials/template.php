<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compantible" content="IE=Edge">

	<!-- css -->
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- custom css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

	<!-- js -->
	<!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<!-- popper -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<!-- bootstrap -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<!-- fav icon -->
	<link rel="icon" type="text/css" href="../assets/images/d.jpg">

	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	<title> Deadend </title>
</head>
<body>


	<?php require_once("header.php"); ?>
	<?php require_once("../controllers/connect.php"); ?>

	<?php 

		get_page_content();

		mysqli_close($conn);

	 ?>

	<?php require_once("footer.php"); ?>


</body>
</html>