<?php
// include("includes/functions.php");
// ob_start();

// $email = $_SESSION['user_details']['email'];
// $query = "SELECT * FROM cartitems WHERE user_email = '$email' ";
// $exec_query = mysqli_query($connection,$query);
// $count = mysqli_num_rows($exec_query);
// $i = 0;
// if($count  >= 1){
//   while($row = mysqli_fetch_assoc($exec_query)){
//     $_SESSION['demo'][$i] = $row;
//     $i++;
//   }
// }

// //Get the details of all the products which are in cartitems table of database for this particular user and store them in SESSION['demo'] variable  and make another array ids container ids of the the products in cartitems table of this particlarr user logged in
// if(isset($_SESSION['demo'])){
//   $ids = array_column($_SESSION['demo'],'pid');

// }






// //Check each item in the current SESSION['cart'] and if that item is not already present in the table cartitems of that particular user then only add it else dont add

// if(count($_SESSION['cart']) >= 1){
// $email = $_SESSION['user_details']['email'];
// foreach ($_SESSION['cart'] as $key => $value) {
//   $pid = $value['pid'];
//   $pname = $value['pname'];
//   $pprice = $value['pprice'];
//   $pqty = $value['pqty'];
//   $ppic = $value['ppic'];
//   if(!in_array($pid,$ids)){
//     $query = "INSERT INTO cartitems (user_email,pid,pname,pprice,pqty,ppic) VALUES('$email','$pid','$pname','$pprice','$pqty','$ppic')";
//       $exec_query  = mysqli_query($connection,$query);
//       check_query($query);
//       session_destroy();
//       header("Location:login.php");
//   }
  
//   session_destroy();
//   header("Location:login.php");

// }
// }else{
  session_start();
  session_destroy();
  header("Location:login.php");




// session_destroy();
// header("Location:login.php");
?>