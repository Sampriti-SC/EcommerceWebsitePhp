<?php include("includes/functions.php");
if(!isset($_SESSION['user_details']))
{
  header("Location:login.php");
}

if(isset($_POST['addtocart'])){ // I have clicked on add to cart button
  $id = $_POST['pid'];  //Store the id of the product on which we click add to cart
  $query = "SELECT * FROM products WHERE pid = '$id'";//Get the details of the product which we want to add to our cart
  $get_product_details = mysqli_query($connection,$query);
  $row = mysqli_fetch_assoc($get_product_details);//This row contains all details of the product which we want to add to our cart
  $pname = $row['pname'];
  $pprice  = $row['pprice'];
  $ppic = $row['pimage'];
  //Store product name ,product price and product image in variables

  //FOR CARTITEMS TABLE
  //Since when we logout our session is destroyed so we need to update in the cartitems table also to store the cart products of a particular user
  $email = $_SESSION['user_details']['email'];
  $query = "SELECT * FROM cartitems WHERE pid = '$id' AND user_email ='$email' ";
  $exec = mysqli_query($connection,$query);
  check_query($exec);
  if(mysqli_num_rows($exec) == 0){
      $query = "INSERT INTO cartitems (user_email,pid,pname,pprice,ppic,pqty) VALUES('$email','$id','$pname','$pprice','$ppic',1)";
      $exec = mysqli_query($connection,$query);
      check_query($exec);
  }else{
    $query = "UPDATE cartitems SET pqty = pqty + 1 WHERE pid = '$id' AND user_email = '$email'";
    $exec = mysqli_query($connection,$query);
    check_query($exec);

  }

//FOR SESSION

  $product_ids = array();  //declare products_ids as an empty array


  if(isset($_SESSION['cart'])){  //There are items in the cart and cart is not empty
    $count = count($_SESSION['cart']);
    //Counts the number of elemnts in an array

    $product_ids = array_column($_SESSION['cart'],'pid');
    if(!in_array($id,$product_ids)){
      $_SESSION['cart'][$count] = array(
        'pid'=> $id,
        'pname' => $pname,
        'pprice' => $pprice,
        'ppic' => $ppic,
        'pqty' => 1
      );
    }
    else{
      for($i = 0; $i < count($product_ids);$i++)
			{ 
				if($product_ids[$i] === $id)
				{
					$_SESSION['cart'][$i]['pqty'] += 1;
				}
      }
      
    }

  }
  else{  //The shopping cart is empty
    // If shopping cart does not exist create first product with index 0
      $_SESSION['cart'][0] = array
      (
        'pid' => $id,
        'pname' => $pname,
        'pprice' => $pprice,
        'ppic' => $ppic,
        'pqty' => 1
      );

      
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


<section class="mt-5 py-3">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 t p-lg-5 py-sm-3 bg-light" >
        <div class="category-box">
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
      </div>
      <?php
      $pid = $_GET['pid']; //Store the id received from shop.php page
      $query = "SELECT * FROM products WHERE pid = '$pid'";
      $get_product_details = mysqli_query($connection,$query);
      check_query($get_product_details);
      $row=mysqli_fetch_assoc($get_product_details);
      $p_cat = $row['pcategory'];  //We store the category id of the chosen product
      ?>
      <div class="col-12 col-sm-12 col-md-9">
       <div class="row">
          <div class="col-sm-12 col-lg-6 col-md-8 text-center">
            <img src="prod_pics/<?php echo $row['pimage']; ?>" alt=""  style="width:400px;">
          </div>
          <div class="col-sm-12 col-lg-6 col-md-4 py-3 text-center">
            <h1 class="display-4 mt-2"><?php echo $row['pname']; ?></h1>
            <p class="lead">$<?php echo $row['pprice']; ?></p>


            <form action="" method="POST">
              <input type="hidden" name="pid" value=<?php echo $row['pid']; ?>>
             <!-- <p><a href="#" class="btn btn-danger btn-lg">ADD TO CART</a></p>  -->

            

             <!-- <input type='submit' class='btn btn-danger btn-lg' value='ADD TO CART' name='addtocart'> -->
             <input type='submit' class='btn btn-danger btn-lg' value='ADD TO CART' name='addtocart' id="addtocart">
             
              <p class='mt-2' id="buyitnow"><a href='buyItNow.php?buyItNowId=<?php echo $pid; ?>' class='btn btn-outline-danger btn-lg'>BUY IT NOW</a></p>
            </form>


            <p id="added" class="text-danger"></p>
            

            <?php
              $max_quantity = $row['pqty']; //This is the maximum avalaible quantity for a particular product 
              if($max_quantity == 0){
                echo "<script>
                document.querySelector('#addtocart').style.display='none';
                document.querySelector('#buyitnow').style.display='none';
                 </script>";
                echo "<p class='lead text-danger'><b>SOLD OUT</b></p>";
              }
            ?>

            <?php
            if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key => $value){
              if($value['pid'] == $pid){
                //get that product quantity from database
                $query = "SELECT pqty FROM products WHERE pid = '$pid'";
                $exec = mysqli_query($connection,$query);
                $row = mysqli_fetch_assoc($exec);
                $max_pqty = $row['pqty'];

                //----------------------- ------------------
                if($value['pqty'] == $max_pqty){
                  echo "<span class='text-danger'>MAX ITEMS ALREADY ADDED TO CART</span>";
                  echo "<script>
                    document.querySelector('#addtocart').style.display='none';
                    document.querySelector('#buyitnow').style.display='none';
                  </script>";
                  echo "<p class='lead text-danger'>OUT OF STOCK</p>";
                break;
                }
                
              }
            }
          }
            ?>


            <?php 
            if(isset($_SESSION['cart']) && count($_SESSION['cart'])){
              echo '<p class="lead">GO TO CART</p>';
              echo '<a href="cart.php" class="btn btn-outline-primary btn-sm">MY CART</a>';
            }
            ?>
            
          </div>
       </div>
       <hr>
       <div class="row">
          <div class="col-12 px-lg-5 px-md-5 ">
            <p class="lead">Product Description</p>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus provident, commodi velit totam, obcaecati pariatur non laudantium iure aliquid sit doloremque hic asperiores quo aliquam ab tempora veritatis adipisci corrupti.</p>
          </div>
       </div>
       <hr>
       <div class="row">
          <div class="col-12 px-lg-5 px-md-5 ">
            <p class="lead">You may also like</p>
            
          </div>
       </div>
       <div class="row">

          <?php 
            $query = "SELECT * FROM products WHERE pid != '$pid' AND pcategory ='$p_cat' LIMIT 4 ";
            $get_remaining_products = mysqli_query($connection,$query);
            check_query($get_remaining_products);
            while($row = mysqli_fetch_assoc($get_remaining_products)){ ?>
            <div class="col-sm-12 col-lg-3 col-md-4  ">
              <div class="card" style="border:none;">
                <img src="prod_pics/<?php echo $row['pimage']; ?>" alt="" class="img-fluid">
                <div class="card-body text-center">
                  <p class="lead">$<?php echo $row['pprice']; ?></p>
                  <a href="product.php?pid=<?php echo $row['pid']; ?>" class="btn btn-outline-danger btn-block">VIEW</a>
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
    </script>
  
  </body>
  
  </html>