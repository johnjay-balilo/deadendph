<?php 

require_once './connect.php';
session_start();

$id = $_POST['id'];
$name = mysqli_real_escape_string($conn, $_POST['name']);
$price = $_POST['price'];
$description = mysqli_real_escape_string($conn, $_POST['description']);
$category_id = $_POST['category_id'];
$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "./../assets/images/".$image);

if ($image == "") {
	$sql = "UPDATE items SET name='$name', price=$price, description='$description', category_id='$category_id' WHERE id=$id";
}else{
	$sql = "UPDATE items SET name='$name', price=$price, description='$description', image_path='$image', category_id='$category_id' WHERE id=$id";
}

mysqli_query($conn, $sql);

header("Location: ../views/items.php");






 ?>