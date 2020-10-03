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


<section id="myorders" class='my-5 py-5'>
  <div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto">
        <?php if(isset($_GET['msg'])){
          $msg = $_GET['msg'];
          echo "<div class='alert alert-success' id='message'>{$msg}</div>";
        }   
        ?>
          <table class="table text-center table-striped">
            <thead class="bg-success text-white">
              <tr>
                <th>ORDER ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>PRODUCT</th>
                <th>QUANTITY</th>
                <th>TOTAL</th>
                <th>STATUS</th>
                <th>Cancel</th>
              </tr>
            </thead>
            <tbody>
              <?php  
                $email = $_SESSION['user_details']['email'];
                $query = "SELECT * FROM orders WHERE cust_email = '$email'";
                $exec = mysqli_query($connection,$query);
                check_query($exec);
                while($row = mysqli_fetch_assoc($exec)){
                  $id = $row['id'];
                  ?>
                    <tr>
                      <td><?php echo $row['orderid']; ?></td>
                      <td><?php echo $row['cust_name']; ?></td>
                      <td><?php echo $row['cust_email']; ?></td>
                      <td><?php echo $row['product_name']; ?></td>
                      <td><?php echo $row['quantity']; ?></td>
                      <td><?php echo $row['total_price']; ?></td>
                      <td><?php echo $row['Order_status']; ?></td>
                      <td><a href="cancelOrder.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm text-white"><i class="fas fa-trash"></i> CANCEL</a></td>
                    </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
          <a href="shop.php" class="btn btn-outline-primary mt-2"><i class="fas fa-arrow-left"></i> SHOP MORE</a>
          <a href="cart.php" class="btn btn-success mt-2"><i class="fas fa-cart-plus"></i> MY CART</a>
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
    <script src="js/app.js"></script>
    <script>
    if(document.querySelector("#message")){
      setTimeout(() => {
	window.open('myorders.php', '_self');
}, 4000);
    }

    </script>

  </body>
  
  </html>