<?php 

require_once './connect.php';
session_start();



$username = $_POST['username'];
$roles_id = $_POST['roles_id'];
// $username = "johnbalilo";
// $roles_id = 2;

if ($username == $_SESSION['user']) {
	die();
}

if ($roles_id == 1) {
	$roles_id = 2;
} else if ($roles_id == 2) {
	$roles_id = 1;
}

$sql = "UPDATE users SET roles_id='$roles_id' WHERE username='$username'";
$result = mysqli_query($conn, $sql);

$sql = "SELECT roles.name AS role FROM users JOIN roles ON(users.roles_id=roles.id) WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$new_roles_id = mysqli_fetch_assoc($result);

echo $new_roles_id['role'];




 ?>