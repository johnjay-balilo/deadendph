<?php 

require_once("./connect.php");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$roles_id = 2;


$checkusername = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $checkusername);

$checkemail = "SELECT * FROM users WHERE email='$email'";
$result2 = mysqli_query($conn, $checkemail);

if(mysqli_num_rows($result) > 0) {
	die("user_exists");
} else if(mysqli_num_rows($result2) > 0) {
	die("email_exists");
} else {
	$sql_insert = "INSERT INTO users(firstname, lastname, email, address, username, password, roles_id) VALUES ('$firstname', '$lastname', '$email', '$address', '$username', '$password', '$roles_id')";
	mysqli_query($conn, $sql_insert);
}

mysqli_close($conn);




 ?>