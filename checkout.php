<?php include("includes/functions.php");
if(!isset($_SESSION['user_details']))
{
  header("Location:login.php");
}


//Coming from bill.php page
if(isset($_POST['pay'])){
  $cust_name = $_POST['fullname'];
  $cust_mail = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $total = $_POST['totalamount'];
  
  }

if(isset($_POST['confirmPay'])){

  $product_ids_array = array_column($_SESSION['cart'],'pid');
  $product_names = array_column($_SESSION['cart'],'pname');
  $product_qty = array_column($_SESSION['cart'],'pqty');
  $cust_email = $_POST['cust_email'];

  $total_array = [];
  foreach ($_SESSION['cart'] as $key => $value) {
    $total = 0;
    $total += $value['pqty'] * $value['pprice'];
    array_push($total_array,$total);

  }

  for($i = 0;$i<count($product_ids_array);$i++){
    $orderid = "ORD".rand(1,999999999);
    $custname = $_POST['cust_name'];
    
    $prod_id = $product_ids_array[$i];
    $prod_name = $product_names[$i];
    $prod_qty = $product_qty[$i];
    $prod_total = $total_array[$i];
    $query = "INSERT INTO orders (orderid,cust_name,cust_email,prod_id,product_name,quantity,bill_time,total_price,Order_status) VALUES('$orderid','$custname','$cust_email','$prod_id','$prod_name','$prod_qty',now(),'$prod_total','Order Placed')";
    $exec_query = mysqli_query($connection,$query);
    check_query($exec_query);

    //UPDATE the quantity in the products table
    $query = "UPDATE products SET pqty = pqty - '$prod_qty' WHERE pid = '$prod_id'";
    $exec = mysqli_query($connection,$query);
    check_query($exec);

    
    
   
  }

  //Delete the cart items from cartitems array after successfull purchase
  $email = $_SESSION['user_details']['email'];
  for($i = 0 ; $i < count($product_ids_array);$i++){
    $pid = $product_ids_array[$i];
    $query = "DELETE FROM cartitems WHERE pid = '$pid' AND user_email = '$email'";
    $exec = mysqli_query($connection,$query);
    check_query($exec);
  }
  unset($_SESSION['cart']);
  header("Location:myorders.php?msg=PAYMENT SUCCESSFULL");

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!--Font Awesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
    <!--Bootstrap CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
    crossorigin="anonymous">

  <link rel="stylesheet" href="css/style.css">
  <title>Checkout Page</title>
  
  </head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a href="index.html" class="navbar-brand">ESTORE</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
          <a href="index.php" class="nav-link pl-md-4">HOME</a>
        </li>
        <li class="nav-item ">
          <a href="about.php" class="nav-link pl-md-4">ABOUT US</a>
        </li>
        <li class="nav-item ">
          <a href="contact.php" class="nav-link pl-md-4">CONTACT US</a>
        </li>
        <!-- <li class="nav-item ">
          <a href="#" class="nav-link pl-md-4">SERVICES</a>
        </li>
        <li class="nav-item ">
          <a href="#" class="nav-link pl-md-4">BLOG</a>
        </li> -->
        <?php if(isset($_SESSION['user_details'])) {
          echo"<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>PROFILE</a></li>";
          ?>
        <li class="nav-item ">
          <a href="shop.php" class="nav-link pl-md-4">SHOP</a>
        </li>
        <li class="nav-item ">
          <a href="logout.php" class="nav-link pl-md-4">LOGOUT</a>
        </li>

          <?php
        } ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 py-5">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-12 m-auto">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h4 class="lead text-center pt-2"><i class="fas fa-credit-card"></i> CONFIRM AND PAY</h4>
      </div>
      <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="">CUSTOMER NAME</label>
              <input type="text" class='form-control bg-light' disabled name="cust_name" id="cust_name" value="<?php echo $cust_name; ?>">
              <input type="hidden" class='form-control bg-light'  name="cust_name" id="cust_name" value="<?php echo $cust_name; ?>">
            </div>
            <div class="form-group">
              <label for="">CUSTOMER EMAIL</label>
              <input type="email" disabled class='form-control bg-light' id="cust_email" value="<?php echo $cust_mail; ?>">
              <input type="hidden" name="cust_email"  class='form-control ' id="cust_email" value="<?php echo $cust_mail; ?>">
            </div>
            <div class="form-group">
              <label for="">SHIPPING ADDRESS</label>
              <textarea name="address" id="" class="form-control bg-light" style="resize:none;" disabled><?php echo $address; ?></textarea>
            </div>
            <div class="row">
              <div class="col-6">
                <label for="">STATE</label>
                <input type="text" disabled name="state" value="<?php echo $state; ?>" class="form-control bg-light">
              </div>
              <div class="col-6">
                <label for="">CITY</label>
                <input type="text" disabled name="city" value="<?php echo $city; ?>" class="form-control bg-light">
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <label for="">Total Amount</label>
                <input type="text" name="total" value="<?php echo $total; ?>" class="form-control bg-light" disabled >
              </div>
            </div>
            <input type="submit" class="btn btn-success mt-2" name="confirmPay" value="Confirm And Pay">

          </form>
        <a href="bill.php" class="btn btn-outline-success mt-2"><i class="fas fa-arrow-left"></i> BACK TO BILL PAGE</a>
        </div>
      </div>
    </div>
  </div>

</div>
















    <!--Bootstrap Js-->
    <script src="js/jquery.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
      crossorigin="anonymous"></script>

  </body>
  
  </html>