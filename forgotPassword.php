<?php
include("includes/functions.php");
ob_start();
if(isset($_POST['otp'])){
  $email = $_POST['email'];
  //Check if the email is registered or not

  $query = "SELECT * FROM users WHERE email = '$email'";
  $exec = mysqli_query($connection,$query);
  check_query($exec);
  $count = mysqli_num_rows($exec);
  if($count == 0){
    header("Location:forgotPassword.php?error=Email not registered.");
  }else {
  $to = $email;
  $subject = "Password Change Verfication OTP";
  
  $code = rand(100000,999999);
  $_SESSION['passwordChange']['email'] = $email;
  $_SESSION['passwordChange']['code'] = $code; 
  $body = $code;
         
  $headers = "From:nirmalyaganguly1999@gmail.com";
           
  if( mail ($to,$subject,$body,$headers)) {
    header("Location:changePassByEmail.php");
    }else {
    header("forgotPassword.php?error=Email not sent.");
    }
  }
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

    <!--Ekko Lightbox Cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <!--Custom Stylesheet-->
  <link rel="stylesheet" href="css/style.css">
  <title>Bootstrap Theme</title>
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
        <li class="nav-item">
          <a href="index.php" class="nav-link pl-md-4">HOME</a>
        </li>
        <li class="nav-item ">
          <a href="about.php" class="nav-link pl-md-4">ABOUT US</a>
        </li>
        <!-- <li class="nav-item ">
          <a href="#" class="nav-link pl-md-4">SERVICES</a>
        </li>
        <li class="nav-item ">
          <a href="#" class="nav-link pl-md-4">BLOG</a>
        </li> -->
        <li class="nav-item">
          <a href="login.php" class="nav-link pl-md-4">LOGIN</a>
        </li>
        <li class="nav-item">
          <a href="signup.php" class="nav-link pl-md-4">SIGNUP</a>
        </li>
        <li class="nav-item ">
          <a href="contact.php" class="nav-link pl-md-4">CONTACT US</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<section id="login-form" class="mt-4 pt-4">
<h1 class="display-4 text-center mb-4 bg-warning py-3"><span class="text-white"><i class="fas fa-key"></i> FORGOT PASSWORD</span></h1>
  <div class="container">
 
    <div class="row mt-5">
      <div class="col-md-6 mx-auto">
        <div class="card card-body shadow">
          <form method="POST">
            <div class="form-group">
              <label for="Email">Enter Registered Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <input type="submit" class="btn btn-success btn-block" value="Send OTP" name="otp">
            <?php  
            if(isset($_GET['error'])){
              $msg = $_GET['error'];
              echo "<div class='alert alert-danger mt-2'>{$msg}</div>";
            }
            ?>
          </form>
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
  
      <!-- Get the current year for the copyright -->
    <script>
      $('#year').text(new Date().getFullYear());
    </script>

</body>

</html>