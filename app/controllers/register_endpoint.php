<?php 

require_once("./connect.php");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$username = $_POST['username'];
$password = sha1($_POST['password']);


$sql = "INSERT INTO users(firstname, lastname, email, address, username, password) VALUES ('$firstname', '$lastname', '$email', '$address', '$username', '$password')";

if (mysqli_query($conn, $sql)) {
	echo "success";
} else {
	echo mysqli_error($conn);
}




 ?>