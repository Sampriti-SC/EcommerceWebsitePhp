<?php
include("includes/functions.php");
if(isset($_POST['register'])){
  $name = mysqli_real_escape_string($connection,$_POST['name']);
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $address = mysqli_real_escape_string($connection,$_POST['address']);
  $phone = mysqli_real_escape_string($connection,$_POST['phone']);
  $pass = mysqli_real_escape_string($connection,$_POST['pass']);
  $conpass = mysqli_real_escape_string($connection,$_POST['conpass']);

  if($pass !== $conpass){
    header("Location:signup.php?msg=Passwords don't match&alert=danger");
  }
  else{
    if(ctype_space($name)  || ctype_space($address) || ctype_space($email) || ctype_space($pass)  || ctype_space($conpass))
      {
        header("Location:signup.php?msg=Fields cannot be empty&alert=warning");
      }
   else{
      //Check if the user is already registered
          $query = "SELECT * FROM users WHERE email = '$email'";
          $check_email = mysqli_query($connection,$query);

          if(mysqli_num_rows($check_email) === 0)
          {
            $query = "INSERT INTO users (name,email,password,phone,address) VALUES ('$name','$email','$pass','$phone','$address')";
            $register_user = mysqli_query($connection,$query);
            check_query($register_user);
            header("Location:signup.php?msg=Registration successfull&alert=success");      

          }
          else{
            header("Location:signup.php?msg=Email already registered&alert=warning");
          } 
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
  <title>Signup Page</title>
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
        <li class="nav-item active">
          <a href="signup.php" class="nav-link pl-md-4">SIGNUP</a>
        </li>
        <li class="nav-item ">
          <a href="contact.php" class="nav-link pl-md-4">CONTACT US</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<section id="login-form" class="mt-5 pt-2">
<h1 class="display-4 text-center bg-primary pb-2"><span class="text-white "><i class="fas fa-user "></i> REGISTER HERE</span></h1>
  <div class="container">
  <div class="row no-gutters mt-3">
      <div class="col-lg-6 d-none d-lg-block">
        <img src="images/signupPage.jpg" alt="" class="img-fluid pt-4">
      </div>
      <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-0">
      <?php if(isset($_GET['msg']))
      { 
        $msg = $_GET['msg'];
        $alert = $_GET['alert'];
        echo "<div class='alert alert-{$alert}'>{$msg}</div>";  
      } ?>
        <form method="POST">
          <div class="form-group">
            <label for="name">Name*</label>
            <input type="text" id="name"  required class="form-control" name="name" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" id="email"  required class="form-control" name="email" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="password">Password*</label>
            <input type="password" name="pass" required class="form-control" id="password" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="conpass">Confirm Password*</label>
            <input type="password" name="conpass" required class="form-control" id="conpass" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="address">Address*</label>
            <textarea name="address" id="address" class="form-control" style="resize:none;"></textarea>
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" required class="form-control" id="phone" autocomplete="off">
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="register" value="Register">
        </form>
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