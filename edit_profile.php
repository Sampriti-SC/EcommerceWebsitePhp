<?php ob_start(); ?>
<?php include("includes/functions.php");

if(!isset($_SESSION['user_details']))
{
  header("Location:login.php");
}

if(isset($_POST['Update'])){
  $fullname = mysqli_real_escape_string($connection,$_POST['fullname']);
  $address = mysqli_real_escape_string($connection,$_POST['address']);
  $mobile = mysqli_real_escape_string($connection,$_POST['mobile']);

  if(trim($fullname) === '' || trim($address)===''  || trim($mobile) ===''){
    header("Location:edit_profile.php?msg=Fields cannot be empty&alert=warning");
  }
  else{
    $email = $_SESSION['user_details']['email'];
    $update_query = "UPDATE users SET name = '$fullname' , address = '$address' , phone = '$mobile' WHERE email = '$email'";

    $exec_query = mysqli_query($connection,$update_query);
    check_query($exec_query);
    $get_new_details = "SELECT * FROM users WHERE email = '$email'";
    $exec_query = mysqli_query($connection,$get_new_details);
    check_query($exec_query);
    $_SESSION['user_details'] = mysqli_fetch_assoc($exec_query);
    header("Location:edit_profile.php?msg=Profile Updated successfully&alert=success");
  }
}
?>

<?php


// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
  $check = getimagesize($_FILES["ppic"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    // echo "File is not an image.";
    $uploadOk = 0;
  }
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["ppic"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// Check file size
if ($_FILES["ppic"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["ppic"]["tmp_name"], $target_file)) {
    //Update pppic in databse 
   $image_name =  $_FILES['ppic']['name'];
   $email = $_SESSION['user_details']['email'];
   $query = "UPDATE users SET ppic = '$image_name' WHERE email = '$email' ";
   $update_ppic = mysqli_query($connection,$query);
   $_SESSION['user_details']['ppic'] = $image_name;
   header("Location:edit_profile.php?msg=Image uploaded&alert=success");
  } else {
    echo "Sorry, there was an error uploading your file.";
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

  <link rel="stylesheet" href="css/style.css">
  <title>Edit Profile Page</title>
 
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
        <li class="nav-item">
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

<section id="edit_profile" class="mt-2 py-4">
<h1 class="display-4 text-center bg-warning py-4 text-white"><i class="fas fa-user-circle"></i> EDIT PROFILE</h1>

  <div class="container">
    <div class="row">
      <div class="col-md-5 py-5">
        <div class="card text-center">
          <div class="card-header">
            <h4><i class="fas fa-image"></i> PROFILE PICTURE</h4>
          </div>
          
          <div class="card-body">
          <img src="images/<?php echo $_SESSION['user_details']['ppic']; ?>" alt="" class="img-fluid" style="width:250px;">
          <!-- Image upload form -->
          <form action="" enctype="multipart/form-data" method="post">
            <!-- <div class="form-group">
              <label>Select Image</label>
              <input type="file" name="ppic" class="form-control">
            </div>
             -->
            <div class="input-group mb-3 mt-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile02" name="ppic" class="form-control" required>
                <label class="custom-file-label" for="inputGroupFile02">Select Picture</label>
              </div>
            </div>
            <input type="submit" name="upload" class="btn btn-block btn-warning" value="Upload">
          </form>


          </div>
        </div>
      </div>
      <div class=" col-12 col-md-7 py-5">
        <?php 
          if(isset($_GET['msg'])){
            $msg = $_GET['msg'];
            $alert = $_GET['alert'];
            echo "<div class='alert alert-{$alert}'>{$msg}</div>";
          }
        ?>
        <form action="" method="POST">
          <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION['user_details']['name']; ?>" id="fullname" name="fullname">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
           <textarea name="address" id="address" class="form-control" style="resize:none;"><?php echo $_SESSION['user_details']['address']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="number">Mobile Number</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION['user_details']['phone']; ?>" id="number" name="mobile">
          </div>
          <input type="submit" class="btn btn-outline-primary btn-block" name="Update" value="Update">
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

      setTimeout(() => {
        const alertDiv = document.querySelector('.alert');
        if(alertDiv !== null)
        alertDiv.remove();        
      }, 3000);
    </script>
  
  </body>
  
  </html>