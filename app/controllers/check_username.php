<?php 

require_once('./connect.php');

$username = $_POST['username'];

$sql = "SELECT username FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	echo 'taken';
} else {
	echo 'available';
}


mysqli_close($conn);



 ?>