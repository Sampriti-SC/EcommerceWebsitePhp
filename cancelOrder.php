<?php
include("includes/functions.php");
$id = $_GET['id']; //Get the order id
//Increase product quantity in cartitems array

$query = "SELECT * FROM orders WHERE id = '$id'";
$exec = mysqli_query($connection,$query);
check_query($exec);
$row = mysqli_fetch_assoc($exec);
$pid = $row['prod_id'];
$pqty = $row['quantity'];
$query = "UPDATE products SET pqty = pqty + '$pqty' WHERE pid = '$pid'";
$exec = mysqli_query($connection,$query);
check_query($exec);

//Remove order from orders table
$query = "DELETE FROM orders WHERE id = '$id'";
$exec = mysqli_query($connection,$query);

 header("Location:myorders.php?msg=ORDER DELETED");

?>