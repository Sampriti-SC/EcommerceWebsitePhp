<?php include("includes/connection.php") ; ?>
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

    <!--Custom Stylesheet-->
  <link rel="stylesheet" href="css/style.css">
  <title>Bootstrap Theme</title>
</head>

<body>
 
  <!--Navigation Bar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <li class="nav-item">
          <a href="about.php" class="nav-link pl-md-4">ABOUT US</a>
        </li>
        <?php if(isset($_SESSION['user_details'])) {
          echo"<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>PROFILE</a></li>";
        } else{
          echo"<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>LOGIN</a></li>";
        } ?>
        <li class="nav-item ">
          <a href="signup.php" class="nav-link pl-md-4">SIGNUP</a>
        </li>
        <li class="nav-item active">
          <a href="#" class="nav-link pl-md-4">CONTACT US</a>
        </li>
        <?php if(isset($_SESSION['user_details'])){
          echo "<li class='nav-item'><a href='logout.php' class='nav-link pl-md-4'>LOGOUT</a></li>";
        } ?>
      </ul>
    </div>
  </div>
</nav>

<!--Page Header-->
<header id="page-header" class="bg-dark text-white">
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto text-center">
        <h1>Contact Us</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat hic sequi esse fuga facilis quibusdam.</p>
      </div>
    </div>
  </div>
</header>

<!-- Contact Section -->
<section id="contact py-3" class="mt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card p-4">
          <h4>Get in Touch</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, illum!</p>
          <h4>Address</h4>
          <p>478, ABC Road,Kolkata India</p>
          <h4>Email</h4>
          <p>test@test.com</p>
          <h4>Phone</h4>
          <p>9785478541</p>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card p-4">
          <div class="card-body">
            <h3 class="text-center">Please fill out this form to contact us</h3>
            <hr>
            <form action="">
              <div class="row">
              
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter FirstName">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter LastName">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter Email">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Mobile Number">
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea class="form-control" style="resize: none;" placeholder="Message"></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <input type="submit" class="btn btn-outline-danger btn-block" value="Submit">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!--Our Staff Section-->
<section id="staff" class="py-5 bg-dark text-white text-center mt-3">
  <div class="container">
    <h1>Our Staff</h1>
    <hr>
    <div class="row">
      <div class="col-md-4 mb-2">
        <img src="images/person2.jpg" class="img fluid rounded-circle" alt="">
        <h4>Sampriti Chakraborty</h4>
        <small>Front End Developer</small>
      </div>
      <div class="col-md-4 mb-2">
        <img src="images/person3.jpg" class="img fluid rounded-circle" alt="">
        <h4>Nirmalya Ganguly</h4>
        <small>Front End Developer</small>
      </div>
      <div class="col-md-4 mb-2">
        <img src="images/person4.jpg" class="img fluid rounded-circle" alt="">
        <h4>Sampriti Chakraborty</h4>
        <small>Front End Developer</small>
      </div>
    </div>
  </div>
</section>

<!--Footer Section-->
<section id="footer" class="p-3 text-center">
  <div class="container">
    <div class="row">
      <div class="col">
        <p>Copyright &copy; <span id="year"></span>  E-Kart</p>
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