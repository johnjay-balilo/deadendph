<?php 

require_once './connect.php';

session_start();

$id = $_POST['user_id'];
$old_password = $_POST['old_password'];
$new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);


if (password_verify($old_password, $_SESSION['user_info']['password'])) {
	echo "correct password";

	$sql = "UPDATE users SET password='$new_password' WHERE id=$id";
	mysqli_query($conn, $sql);

	$sql = "SELECT password FROM users WHERE id=$id";
	$result = mysqli_query($conn, $sql);

	$_SESSION['user_info']['password'] = mysqli_fetch_assoc($result)['password'];
} else {
	echo "incorrect password";
}



 ?>