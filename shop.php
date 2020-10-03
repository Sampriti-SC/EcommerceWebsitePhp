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
        <li class="nav-item active">
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

<section class="mt-5 py-3">
  <div class="container mt-3">
    <div class="row">
      <div class="col-12 col-md-3  p-lg-5 py-3 bg-light">
        <div class="category-box ">
          <?php  
            $query = "SELECT * FROM category";
            $get_categories = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($get_categories)){
              $cat_id = $row['cid'];
              $cat_name = $row['cname'];
              echo "<p style='padding-bottom:5px;'><a style='text-decoration:none;color:#000;' href='shop.php?cid={$cat_id}'>{$cat_name}</a></p>";
              echo "<hr>";
            }
          ?>
         
        </div>
        <div class="filter">
            <p class="lead"><b class="text-primary">Filter by Price</b><i class="fas fa-filter text-primary"></i></p>
            
              <input type="text" class="form-control mb-2" placeholder="Enter lower limit" id="lower">
              <p id="lower_error"></p>
              <input type="text" class="form-control mb-2" placeholder="Enter upper limit" id="upper">
              <p id="lower_error"></p>
              <button class="btn btn-outline-primary btn-block" id="filterButton" >Filter</button>
           
        </div>
      </div>

      <div class="col-12  col-md-9">
            <?php
              if(isset($_GET['cid'])){
                $cid = $_GET['cid'];
                $query = "SELECT * FROM products WHERE pcategory = '$cid'";
              }else{
                $query = "SELECT * FROM products WHERE pcategory = 1";
            } ?>
      <div class="row mb-2">
        <div class="col-lg-6 col-12 mb-2"><input type="text" id="search" placeholder="Search By Name" class="form-control" autocomplete="off" onkeyup="search()"></div>
      </div>
        <div class="row" id="productsRow">
         
            <?php
              $get_products = mysqli_query($connection,$query);
              while($row = mysqli_fetch_assoc($get_products)){
                $pid = $row['pid'];
                $qty = $row['pqty'];
                ?>
                <div class="col-md-6 col-lg-4 col-sm-6 col-6 mb-3 text-center">
                  <div class="card " style="border:none;">
                    <img src="prod_pics/<?php echo $row['pimage']; ?>" alt="" class="card-img-top">
                    <div class="card-body">
                      <p class="lead"><a href="product.php?pid=<?php echo $pid; ?>" style='text-decoration:none;'><?php echo $row['pname']; ?></a></p>
                      <p class="lead">$ <span id="price_of_product"><?php echo $row['pprice']; ?></span></p>

                      
                      <?php if($qty >= 1){

                        //If quantity of product is more than or equal to 1 
                        echo "<a href='product.php?pid={$pid}' class='btn btn-outline-danger btn-block'>VIEW</a>";
                      }else{
                        echo "<p class='text-danger'>SOLD OUT</p>";
                      } 
                      ?>
                    </div>
                  </div>
                </div>
              <?php }
          ?>
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

    //Seacrh  
      const filterButton = document.querySelector("#filterButton");
      filterButton.addEventListener("click",function(e){
        let lower = document.querySelector("#lower").value;
        let upper = document.querySelector("#upper").value;
        
        const productsRow = document.querySelector('#productsRow');

        const allCards = productsRow.querySelectorAll('.card');
        for (card of allCards) {
          let cardBody = card.querySelector('.card-body');
          let allParas = cardBody.querySelectorAll('p');
          let prodPrice = parseInt(allParas[1].querySelector("#price_of_product").textContent) ;
          if (prodPrice <= upper  && prodPrice >= lower) {
            allParas[1].parentElement.parentElement.parentElement.style.display = '';
          } else {
            allParas[1].parentElement.parentElement.parentElement.style.display = 'none';
          }
        }
      });
    </script>
    <script src="js/search.js"></script>
   
  </body>
  
  </html>