<?php include("includes/functions.php");
if(!isset($_SESSION['user_details']))
{
  header("Location:login.php");
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
  <title>Profile Page</title>
  
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

<section id="checkout-section" class="mt-5 py-5">
  <div class="container">
    <div class="row">
        <div class="col-12 col-md-12 col-sm-12 col-lg-6 bg-light px-5 py-4">
          <form action="payNowCheckout.php" method="post" autocomplete="off">
            <p class="lead">Contact Information</p>
            <input type="email" name="email" value="<?php echo $_SESSION['user_details']['email']; ?>" placeholder="Enter your email" class="form-control">
            <hr>
            <p class="lead">Full Name & Shipping Address</p>
            <div class="row mb-4">
              <div class="col-12">
                <input type="text" name="fullname"value="<?php echo $_SESSION['user_details']['name']; ?>" placeholder="Enter Fullname" class="form-control">
              </div>
              
            </div>
            <div class="form-group">
              <textarea name="address" class="form-control"  placeholder="Enter Address" style="resize:none;"><?php echo $_SESSION['user_details']['address']; ?></textarea>
            </div>
           
            <div class="form-group">
              <select name="city" id="" class="form-control">
                <option value="Kolkata" selected>Kolkata</option>
                <option value="Delhi">Delhi</option>
                <option value="Chennai">Chennai</option>
                <option value="Mumbai">Mumbai</option>
              </select>
            </div>
            <div class="row">
              <div class="col-4">
                <input type="text" name="country" value="India" class="form-control">
              </div>
              <div class="col-4">
                <select name="state" id="" class="form-control">
                  <option value="West Bengal">West Bengal</option>
                </select>
              </div>
              <div class="col-4">
                <input type="text" class="form-control" name="pincode" placeholder="Pincode">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <p class="lead">GRAND TOTAL($)</p>
              <?php /*
              $total = 0;
              foreach ($_SESSION['cart'] as $key => $value) {
                $prod_total = $value['pprice'] * $value['pqty'];
                $total = $total + $prod_total;
                
              }
              */
              if(isset($_GET['buyItNowId'])){
                $ID = $_GET['buyItNowId'];
                $query = "SELECT * FROM products WHERE pid = '$ID'";
                $getProduct = mysqli_query($connection,$query);
                $productDetails = mysqli_fetch_assoc($getProduct);
                $priceOfProduct = $productDetails['pprice'];
              }
              ?>

              <input type="text" class="form-control" value="<?php echo $priceOfProduct; ?>" disabled style="border:none;" name="total">
              <input type="hidden" class="form-control" value="<?php echo $priceOfProduct; ?>"  style="border:none;" name="totalamount">


            </div>
            <input type="hidden" name="id" value="<?php echo $ID; ?>">
            <input type="submit" name="payNow" class="btn btn-success mt-2 btn-block " value="PAY NOW">

          </form>
          <a href="cart.php" class="btn btn-outline-success mt-1"><i class="fas fa-arrow-left"></i> BACK TO CART</a>
        </div>

        <div class="col-12 col-md-12 col-sm-12 col-lg-6">
          <div class="row  ml-lg-2">
            <table class="table text-center table-striped">
              <thead class="bg-success text-white">
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
              </thead>
              <tbody id="main">
                <?php
                
                  $pname = $productDetails['pname'];
                  $pprice = $productDetails['pprice'];
                  $pqty = 1;
                  $ptotal =  $pprice * 1;
                  $ppic = $productDetails['pimage'];
                  echo"<tr>";
                  echo "<td class='text-center'><p id='pname'>{$pname}</p><img src='prod_pics/{$ppic}' class='img-fluid' style='width:100px;'></td>";
                  echo "<td>{$pprice}</td>";
                  echo "<td>{$pqty}</td>";
                  echo "<td>{$ptotal}</td>";
                  echo"</tr>";
                
                
                ?>
               
              </tbody>
              
            </table>
           
          
          </div>
         
         
        </div>
    </div>

  </div>
</section>



    <!--Bootstrap Js-->
    <script src="js/jquery.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
      crossorigin="anonymous"></script>

    
  </body>
  
  </html>