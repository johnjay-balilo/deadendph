<?php 

require_once './connect.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

$user_info = mysqli_fetch_assoc($result);


if (password_verify($password, $user_info['password'])) {
	$_SESSION['user_info'] = $user_info;
	$_SESSION['user'] = $username;
	echo $_SESSION['user_info'];
}else {
	$_SESSION['error_message'] = "Login failed";
	echo $_SESSION['error_message'];
}

// header("Location: ../../index.php")

?>