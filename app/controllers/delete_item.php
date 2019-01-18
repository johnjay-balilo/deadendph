<?php 

require_once './connect.php';
session_start();

$id = $_POST['item_id'];
$image_path = $_POST['image_path'];

$sql = "DELETE FROM items WHERE id=$id";
$result = mysqli_query($conn, $sql);
echo mysqli_error($conn);

if (mysqli_error($conn) == "") {
	unlink('../assets/images/'.$image_path);
}



 ?>