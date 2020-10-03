<?php
include("includes/connection.php");

if(isset($_POST['newsletter'])){
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $name = mysqli_real_escape_string($connection,$_POST['name']);
  if(ctype_space($email) || ctype_space($name)){
    header("Location:index.php?msg=Fields empty&type=danger");
  }else{
    $query = "INSERT INTO newsletter (name,email) VALUES('$name','$email')";
    $exec = mysqli_query($connection,$query);
    if(!$exec){
      die("Query Failed".mysqli_error($connection));
    }
    else{
      header("Location:index.php?msg=Registered To Newsletter&type=success");
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

    <!--Slick Slider CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"  crossorigin="anonymous" />
    <!--Custom Stylesheet-->
  <link rel="stylesheet" href="css/style.css">
  <style>
    #slide-show img{
      width:200px;
      height:auto;
    }
  </style>
  <title>Bootstrap Theme</title>
</head>

<body>
 
  <!--Navigation Bar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a href="index.html" class="navbar-brand">ESTORE</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
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
        <?php if(isset($_SESSION['user_details'])) {
          echo"<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>PROFILE</a></li>";
          echo"<li class='nav-item'><a href='shop.php' class='nav-link pl-md-4'>SHOP</a></li>";
        } else{
          echo"<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>LOGIN</a></li>";
        } ?>
        <li class="nav-item">
          <a href="signup.php" class="nav-link pl-md-4">SIGNUP</a>
        </li>
        <li class="nav-item ">
          <a href="contact.php" class="nav-link pl-md-4">CONTACT US</a>
        </li>
        <?php if(isset($_SESSION['user_details'])){
          echo "<li class='nav-item'><a href='logout.php' class='nav-link pl-md-4'>LOGOUT</a></li>";
        } ?>
      </ul>
    </div>
  </div>
</nav>

<!--Showcase Section-->
<section id="showCase" class="mt-5">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <!--First Carousel Item-->
      <div class="carousel-item carousel-image-1 active">
        <div class="container">
          <div class="carousel-caption d-none d-sm-block text-right mb-5">
            <h1 class="display-3">Ready To Shop ?</h1>
            <p class="lead">Login and view all our top quality products and start shopping ...</p>
            <?php 
              if(isset($_SESSION['user_details'])){
                echo "<a href='shop.php' class='btn btn-success btn-lg'>SHOP NOW</a>";
              }else{
                echo "<a href='login.php' class='btn btn-success btn-lg'>LOGIN</a>";
              }
            ?>
          </div>
        </div>
      </div>

      <!--Second Carousel Item-->
      <div class="carousel-item carousel-image-2">
        <div class="container">
          <div class="carousel-caption d-none d-sm-block mb-5">
            <h1 class="display-3">Don't have an account ?</h1>
            <p class="lead">If you dont have an account then hurry up and create one to start shopping..</p>
            <a href="signup.php" class="btn btn-primary btn-lg">Signup</a>
          </div>
        </div>
      </div>

      <!--Third Carousel Item-->
      <div class="carousel-item carousel-image-3" style="background:url('images/img3.jpg');	background-position: 50% 20%;
">
        <div class="container">
          <div class="carousel-caption d-none d-sm-block text-right mb-5">
            <h1 class="display-3">Facing Issues ?</h1>
            <p class="lead">Contact us by simply clicking on the contact us button and we will reach out to you as soon as possible.</p>
            <a href="contact.php" class="btn btn-warning btn-lg">Contact Us</a>
          </div>
        </div>
      </div>
    </div>

    <a href="#myCarousel" data-slide="prev" class="carousel-control-prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a href="#myCarousel" data-slide="next" class="carousel-control-next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
</section>

<!--Home icons section-->
<section class="home-icons py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-2 text-center">
        <i class="fas fa-cart-plus fa-3x mb-2 text-success"></i>
        <h3>Top Quality Products</h3>
        <p>We provide the best quality products available with utmost care.</p>
      </div>
      <div class="col-md-4 mb-2 text-center">
        <i class="fas fa-truck fa-3x mb-2 text-success"></i>
        <h3>Ligtning Fast Delivery</h3>
        <p>We provide one of the fastest and safest deliveries possible.</p>
      </div>
      <div class="col-md-4 mb-2 text-center">
        <i class="fas fa-exchange-alt fa-3x mb-2 text-success"></i>
        <h3>Easy Exchange</h3>
        <p>Our exchange procedure is the easiest and most reliable.</p>
      </div>
    </div>
  </div>
</section>


<!--Home Heading Section With Dark Overlay-->
<section id="home-heading" class="py-5">
  <div class="dark-overlay">
    <div class="row">
      <div class="col">
        <div class="container">
          <h1 class="pt-5">Are You Ready To Shop With Us ?</h1>
          <p class="d-none d-md-block">Have an Account ? Want to start shopping ? </p>
          <a href="shop.php" class="btn btn-success mb-2">Start Shopping</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Info Section-->
<section id="info" class="py-5 ">
  <div class="container">
    <div class="row">
      <div class="col-md-6 align-self-center">
        <h3>About Our Site</h3>
        <p>Want To know more about what we do and how we operate ? </p>
        <a href="about.php" class="btn btn-outline-danger btn-lg">Learn More</a>
      </div>
      <div class="col-md-6">
        <img src="images/laptop.png" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</section>

<!--Video Play section-->
<section id="video-play">
  <div class="dark-overlay">
    <div class="row">
      <div class="col">
        <div class="container p-5">
          <a href="#" class="video" data-toggle="modal" data-target="#videoModal" data-video="https://www.youtube.com/embed/CqlsgjnePmg">
            <i class="fas fa-play fa-3x" style="color:#fff;"></i>
          </a>
          <h1 class="mt-2">See What We Do</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Modal to play the video-->
<div class="modal fade" id="videoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
        <iframe src="" frameborder="0" height="350" width="100%" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>

<!--Image Galerry using lightbox-->
<section id="slide-show" class="py-5 d-none d-lg-block ml-lg-5">
  <div class="container">
    <div class="slider"> 
      <div class="items ml-5">
        <img src="prod_pics/mobile01.jpeg" alt="" style="width:100px;height:auto">
      </div>
      <div class="items ml-md-3 ml-xl-4">
        <img src="prod_pics/mobile02.jpeg" alt="" style="width:100px;height:auto">
      </div>
      <div class="items">
        <img src="prod_pics/mobile03.jpeg" alt="" style="width:100px;height:auto">
      </div>
      <div class="items">
        <img src="prod_pics/mobile04.jpeg" alt="" style="width:100px;height:auto">
      </div>
      <div class="items">
        <img src="prod_pics/mobile05.jpeg" alt="" style="width:100px;height:auto">
      </div>
      <div class="items">
        <img src="prod_pics/mobile06.jpeg" alt="" style="width:100px;height:auto">
      </div>
      <div class="items pt-5 mr-3" >
        <img src="prod_pics/laptop01.jpeg" alt="" style="width:200px;height:auto"  >
      </div>
      <div class="items pt-5 mr-3">
        <img src="prod_pics/laptop02.jpeg" alt="" style="width:200px;height:auto" >
      </div>
      <div class="items pt-5 mr-4">
        <img src="prod_pics/laptop03.jpeg" alt="" style="width:200px;height:auto" >
      </div>
    </div>
  </div>
</section>

<!--NewsLetter Section-->
<section id="newsletter" class="p-5 text-center bg-dark text-white">
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Sign Up For Our NewsLetter</h1>
        <p class="mb-4">Signup to our newsletter so that we can keep you updated about our recent products releases and many more offers.</p>
        <form  class="form-inline justify-content-center" method="post">
          <input type="text" class="mb-2 mr-2 form-control" placeholder="Enter Name" required name="name">
          <input type="email" class="mb-2 mr-2 form-control" placeholder="Enter Email" required name="email">
          <input type="submit" class="btn btn-primary mb-2" name="newsletter" value="Subscribe">
        </form>
        <?php 
          if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            $type = $_GET['type'];

            echo "<div class='alert alert-{$type} mx-auto mt-3' id='alert' style='width:350px;'>{$msg}</div>";
          }
        ?>
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
    <!--Ekko lightbox Js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

    <!-- Get the current year for the copyright -->
  <script>
    $('#year').text(new Date().getFullYear());
  </script>


    <!--Configure carousel slider-->
  <script>
    $('.carousel').carousel({
      interval:6000,
      pause:'hover'
    });
  </script>

  <!--Light box code-->
  <script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
  </script>

<!--Video play with autoplay from stack overflow--> 
  <script>
    
    $(function () {
      // Auto play modal video
      $(".video").click(function () {
        var theModal = $(this).data("target"),
          videoSRC = $(this).attr("data-video"),
          videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
        $(theModal + ' iframe').attr('src', videoSRCauto);
        $(theModal + ' button.close').click(function () {
          $(theModal + ' iframe').attr('src', videoSRC);
        });
      });
    });

  </script>
  <!--Slick slider js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

  <script>
  

    $(".slider").slick({
      slidesToShow:4,
      slidesToScroll:1,
      dots:true,
      autoplay:true,
      speed:500,
    });



  </script>






</body>

</html>