<?php ob_start(); ?>
<?php 
include("includes/functions.php");
$pid = $_GET['pid'];
$query = "SELECT pqty FROM products WHERE pid = '$pid'";
$exec = mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($exec);
$max_pqty = $row['pqty'];
$email = $_SESSION['user_details']['email'];

if($_GET['action'] === 'delete'){
for($i = 0;$i < count($_SESSION['cart']);$i++){
  if($_SESSION['cart'][$i]['pid'] === $pid){

    $query = "DELETE FROM cartitems WHERE pid = '$pid' AND user_email = '$email'";
    $delete_query = mysqli_query($connection,$query);
    check_query($query);

    
    unset($_SESSION['cart'][$i]);
    // header("Location:cart.php");
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location:cart.php");
  }
}
}

if($_GET['action'] === 'reduce'){
  for($i = 0;$i < count($_SESSION['cart']);$i++){
    if($_SESSION['cart'][$i]['pid'] === $pid){
      
      if($_SESSION['cart'][$i][pqty] != 1){
      $_SESSION['cart'][$i]['pqty'] -= 1;

      $query = "UPDATE cartitems SET pqty = pqty - 1  WHERE pid = '$pid'  AND user_email = '$email'";
      $reduce_query = mysqli_query($connection,$query);
      check_query($query);
      header("Location:cart.php");
    }else{
      header("Location:cart.php");
    }
  }
}
}

if($_GET['action'] === 'increase'){
  for($i = 0;$i < count($_SESSION['cart']);$i++){
    if($_SESSION['cart'][$i]['pid'] === $pid){
      
      if($_SESSION['cart'][$i]['pqty'] < $max_pqty){
      $_SESSION['cart'][$i]['pqty'] += 1;

      $query = "UPDATE cartitems SET pqty = pqty + 1  WHERE pid = '$pid'  AND user_email = '$email'";
      $reduce_query = mysqli_query($connection,$query);
      check_query($query);
      }
      header("Location:cart.php");
    }
  }
}














?>