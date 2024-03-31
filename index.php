<?php
session_start();
if(isset($_SESSION['msg'])){
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}
if(isset($_SESSION['userdata'])){
    $user = $_SESSION['userdata'][0];
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referral</title>
    <link rel="icon" href="images/logo_img.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light bg-light shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo_img.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
      Admin
     
    <div>
 
     <?php
     if(isset($_SESSION['userdata'])){
         ?>
    <a href="includes/process.php?logout" class="btn btn-sm btn-danger">Logout</a>

         <?php
     }else{
         ?>
<a href="?login" class="btn btn-sm btn-primary">Login</a>
    <a href="?signup" class="btn btn-sm btn-primary">Signup</a>
         <?php
     }
     ?>
    

</div>
   

  </div>
  
</nav>

<div class="container">
<?php
if(isset($_GET['signup']) || isset($_GET['refcode'])&& !isset($_SESSION['userdata'])){
    include('includes/register.php');
}else if(isset($_GET['login']) && !isset($_SESSION['userdata'])){
    include('includes/login.php');
}else if(isset($_SESSION['userdata'])){
    include('includes/home.php');
    
}else{
    include('includes/login.php');

}
?>


</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>