<?php 

require_once './connect.php';
session_start();

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];
$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "./../assets/images/".$image);

$sql = "INSERT INTO items (name, price, description, image_path, category_id) VALUES('$name', $price, '$description', '$image', $category_id)";
$result = mysqli_query($conn, $sql);

header("Location: ../views/items.php");






 ?>