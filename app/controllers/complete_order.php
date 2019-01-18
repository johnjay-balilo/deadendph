<?php 

require_once './connect.php';
session_start();

$order_id = $_POST['order_id'];

$sql = "UPDATE orders SET status_id=2 WHERE id=$order_id";
mysqli_query($conn, $sql);

$sql = "SELECT name FROM statuses WHERE id=(SELECT status_id FROM orders WHERE id=$order_id)";
$result = mysqli_query($conn, $sql);

echo mysqli_fetch_assoc($result)['name'];




 ?>