<?php 

session_start();
unset($_SESSION['sort']);
unset($_SESSION['s']);
// session_unset();

header("Location: ".$_SERVER["HTTP_REFERER"]) ;

 ?>