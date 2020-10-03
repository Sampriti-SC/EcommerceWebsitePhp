<?php include("includes/functions.php");
//For multiple headers in a page
ob_start();

if(!isset($_SESSION['user_details']))
{
  header("Location:login.php");
}
if(!isset($_SESSION['cart']) && count($_SESSION['cart']) < 1){
  header("Location:profile.php");
}

if(isset($_POST['checkout'])){
  header("Location:bill.php");
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
        <li>
          <a href="#"><i class="fas fa-cart-plus text-white" style="padding-top:10px;padding-left:2px;"></i>
            <span class="text-white"><?php if(isset($_SESSION['cart'])) { echo count($_SESSION['cart']) ;} else{ echo 0;} ?></span>
          </a>
        </li>

          <?php
        } ?>
      </ul>
    </div>
  </div>
</nav>


<section class=" py-1">
<h2 class="display-4 text-center mt-5 bg-success text-white py-2">My Cart <i class="fas fa-shopping-cart"></i></h2>
  <div class="container mt-2">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3 p-lg-5 py-sm-3 bg-light">

        <div class="category-box">
        <h3 class="lead">Categories</h3>
        <hr>
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

      <div class="col-12 col-sm-12 col-md-9 py-lg-3 py-sm-3">
      
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="tbody">
          <?php 
          $email = $_SESSION['user_details']['email'];
          foreach ($_SESSION['cart'] as $key => $value) {
            $prod_id = $value['pid'];
            $pname = $value['pname'];
            $pprice = $value['pprice'];
            $pqty = $value['pqty'];
            $ppic = $value['ppic'];
            $query = "SELECT * FROM products WHERE pid = '$prod_id'";
            $exec = mysqli_query($connection,$query);
            check_query($exec);
            $row = mysqli_fetch_assoc($exec);
            $database_qty = $row['pqty'];
            
            if($database_qty < $pqty){
              for($i = 0;$i<count($_SESSION['cart']);$i++){
                if($_SESSION['cart'][$i]['pid'] == $prod_id){
                  $_SESSION['cart'][$i]['pqty'] = $database_qty;
                }
              }

              $query = "UPDATE cartitems SET pqty = '$database_qty' WHERE pid = '$prod_id' AND user_email = '$email'";
              $exec = mysqli_query($connection,$query);
              check_query($exec);
            }
            ?>
            <tr>
              <td>
                <div class="row">
                  <div class="col-lg-4 col-4">
                    <img src="prod_pics/<?php echo $ppic; ?>" alt="" class="img-fluid" style="width:100px;">
                  </div>
                  <div class="col-lg-8 col-8">
                    <p class="pt-lg-3 pt-2" id="pname"><a style="text-decoration:none;" href="product.php?pid=<?php echo $prod_id; ?>"><?php echo $pname; ?></a></p>
                    <input type="hidden" id="pid" value="<?php echo $prod_id; ?>">
                    <a href="deleteFromCart.php?pid=<?php echo $prod_id; ?>&action=delete" class="btn btn-outline-danger btn-sm">REMOVE</a>
                    
                  </div>
                </div>
              </td>
              <td><p class="pt-lg-3 pt-2" id="price"><?php echo $pprice; ?></p></td>
              <td><p class="pt-lg-3 pt-2"id="quantity" ><?php echo $pqty; ?></p><a href="deleteFromCart.php?pid=<?php echo $prod_id; ?>&action=increase" style="border:1px solid #0f0f0f"><i class="fas fa-plus p-1"></i></a>   <a href="deleteFromCart.php?pid=<?php echo $prod_id; ?>&action=reduce" style="border:1px solid #0f0f0f"><i class="fas fa-minus p-1"></i></a>  </td>
              <td><p class="pt-lg-3 pt-2" id="total"></p></td></td>

            </tr>
            <?php
          }



          ?>
          </tbody>
        </table>

        <div class="total-price text-center" >
        <?php if(count($_SESSION['cart'])){ ?> 

          <p class="lead text-center"><b>Your Total</b>  = $<span id="grandTotal"></span></p>
         
          <a href="shop.php" class="btn btn-outline-success"><i class="fas fa-shopping-cart"></i>SHOP MORE</a>
          <form method="post">
          <!-- To send the grandTotal to checkout.php page via get request -->
            <input type="hidden" id="hidden" name="amount">
            <!-- <a href="checkout.php?" class="btn btn-outline-primary" type="submit">CHECKOUT</a> -->
            <input type="submit" class="btn btn-outline-primary mt-2" name="checkout" value="CHECKOUT">
            
          </form>
          <?php
            // if(isset($_POST['checkout'])){
            //   $final_amnt = $_POST['amount'];
            //   $_SESSION['user_details']['total'] = $final_amnt;
            //   header("Location:checkout.php");
            // }
          ?>
          
        <?php } ?>
          
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
  
      <script src="js/app3.js"></script>
      <!-- Get the current year for the copyright -->
    <script>
      $('#year').text(new Date().getFullYear());
      let all_trs = document.querySelectorAll("#tbody tr ");
      setInterval(() => {
        for(let i =0;i<all_trs.length;i++){
          let price = all_trs[i].querySelector("#price");
           let qty = all_trs[i].querySelector("#quantity");
          let total = all_trs[i].querySelector("#total");
          total.textContent = price.textContent * parseInt(qty.textContent);
          
          
        }
        
      }, 1000);

      let grandTotal = 0;
      
      setInterval(() => {
        for(let tr of all_trs){
        let price = tr.querySelector("#price");
        let qty = tr.querySelector("#quantity");
        let total = tr.querySelector("#total");
        grandTotal += price.textContent * parseInt(qty.textContent);
        let span = document.querySelector("#grandTotal");
        span.textContent = grandTotal;
        document.querySelector("#hidden").value = grandTotal;
        
      }
      grandTotal = 0;
        
      }, 1000);
      



      
      



    </script>
  
  </body>
  
  </html>