<div class="col-6 m-auto mt-5">
    <?php
if(isset($msg)){
    foreach($msg as $message){
        ?>
<div class="alert alert-danger" role="alert">
<?=$message?>
</div>
        <?php
    }
}
    ?>

<form method="post" action="includes/process.php?signup">

<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Full Name</label>
    <input type="text" class="form-control" name="full_name" id="exampleInputPassword1">
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name="email_id" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>


  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Referral Code</label>
    <input type="text" class="form-control" value="<?=isset($_GET['refcode'])?$_GET['refcode']:''?>" name="ref_code" id="exampleInputPassword1">
  </div>
 
  <button type="submit" class="btn btn-primary">Signup</button>
</form>
</div>