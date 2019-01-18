<?php 

require_once './connect.php';
session_start();

$image_path = $_POST['image_path'];

unlink('../assets/images/'.$image_path);

$sql = "UPDATE items SET image_path='' WHERE image_path='$image_path'";
mysqli_query($conn, $sql);

header("Location: ".$_SERVER['HTTP_REFERER']);






 ?>