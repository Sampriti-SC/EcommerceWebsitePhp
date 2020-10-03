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

   <!--Slick Slider cdn css-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha256-3h45mwconzsKjTUULjY+EoEkoRhXcOIU4l5YAw2tSOU=" crossorigin="anonymous" />

   <!--Slick slider theme css cdn-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha256-etrwgFLGpqD4oNAFW08ZH9Bzif5ByXK2lXNHKy7LQGo=" crossorigin="anonymous" />

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
        <li class="nav-item active">
          <a href="#" class="nav-link pl-md-4">ABOUT US</a>
        </li>
        <?php if(isset($_SESSION['user_details'])) {
          echo"<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>PROFILE</a></li>";
        } else{
          echo"<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>LOGIN</a></li>";
        } ?>
        <li class="nav-item ">
          <a href="signup.php" class="nav-link pl-md-4">SIGNUP</a>
        </li>
        <li class="nav-item ">
          <a href="contact.php" class="nav-link pl-md-4">CONTACT US</a>
        </li>
        <?php if(isset($_SESSION['user_details'])){
          echo "<li class='nav-item'><a href='profile.php' class='nav-link pl-md-4'>LOGOUT</a></li>";
        } ?>
      </ul>
    </div>
  </div>
</nav>

<!--Page Header-->
<header id="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto text-center">
        <h1>About Us</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat hic sequi esse fuga facilis quibusdam.</p>
      </div>
    </div>
  </div>
</header>

<!--About-->
<section class="about py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-6 py-5">
        <h1>What We Do</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda dolorum facere ullam quaerat tenetur dolores placeat aliquid, beatae veniam consequatur itaque molestiae similique dicta! Itaque obcaecati saepe voluptatibus, modi optio quibusdam inventore enim explicabo amet. Eius, laudantium cumque tenetur, nobis vero, placeat obcaecati perspiciatis est autem corrupti harum quaerat porro.</p>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint eligendi placeat odit! Eius facere, deserunt nam expedita dicta est labore deleniti earum delectus sequi repudiandae quibusdam quo at quos sit possimus blanditiis placeat nesciunt dolor quisquam consequuntur ratione voluptatem molestias? Soluta quod dignissimos, id et dolorum temporibus eum veniam nesciunt?</p>
      </div>
      <div class="col-md-6">
        <img src="https://source.unsplash.com/random/700x700/?technology" class="img-fluid about-img rounded-circle d-none d-md-block" alt="">
      </div>
    </div>
  </div>
</section>

<!--Icon Boxes-->
<section id="icon-boxes" class="p-5">
  <div class="container">
    <!--First Row-->
    <div class="row mb-2">
      <div class="col-md-4">
        <div class="card bg-danger text-white text-center">
          <div class="card-body">
            <i class="fas fa-building fa-3x"></i>
            <h3>Sample Text</h3>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, earum?
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-dark text-white text-center">
          <div class="card-body">
            <i class="fas fa-bullhorn fa-3x"></i>
            <h3>Sample Text</h3>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, earum?
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-danger text-white text-center">
          <div class="card-body">
            <i class="fas fa-comments fa-3x"></i>
            <h3>Sample Text</h3>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, earum?
          </div>
        </div>
      </div>
    </div>

    <!--2nd Row-->
    <div class="row mb-2">
      <div class="col-md-4">
        <div class="card bg-dark text-white text-center">
          <div class="card-body">
            <i class="fas fa-box fa-3x"></i>
            <h3>Sample Text</h3>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, earum?
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-danger text-white text-center">
          <div class="card-body">
            <i class="fas fa-credit-card fa-3x"></i>
            <h3>Sample Text</h3>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, earum?
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-dark text-white text-center">
          <div class="card-body">
            <i class="fas fa-coffee fa-3x"></i>
            <h3>Sample Text</h3>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis, earum?
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Testimonials-->
<section id="testimonials" class="p-4 bg-dark text-white">
  <div class="container">
    <h1 class="text-center">Testimonials</h1>
    <div class="row text-center">
      <div class="col">
        <div class="slider">
          <div>
            <blockquote class="blockquote">
              <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, sequi!</p>
              <footer class="blockquote-footer">
                John Doe From
                <cite title="Company 1">Vompany 1</cite>
              </footer>
            </blockquote>
          </div>
          <div>
            <blockquote class="blockquote">
              <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, sequi!</p>
              <footer class="blockquote-footer">
                Sam Smith From
                <cite title="Company 2">Company 2</cite>
              </footer>
            </blockquote>
          </div>
          <div>
            <blockquote class="blockquote">
              <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, sequi!</p>
              <footer class="blockquote-footer">
                Samp Chak From
                <cite title="Company 3">Vompany 3</cite>
              </footer>
            </blockquote>
          </div>
        </div>
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
 
  <!--Slick slider js cdn-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha256-zUQGihTEkA4nkrgfbbAM1f3pxvnWiznBND+TuJoUv3M=" crossorigin="anonymous">
  </script>

    <!-- Get the current year for the copyright -->
  <script>
    $('#year').text(new Date().getFullYear());

    //For initialising the testimonial slider using slickslider
    $('.slider').slick({
      infinite:true,
      slideToShow:1,
      slideToScroll:1
    })



  </script>



</body>

</html>