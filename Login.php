<?php 
include('inc/header.php');
include('config/User.php');


 ?>


 <?php 
$user=new User();
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["login"])) {
  $userlog=$user->Userlogin($_POST);
}

  ?>

<div class="mainsection">

  <?php 
if (isset($userlog)) {
  echo $userlog;
}

session::checklogin();
   ?>

    <form action="" method="post">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="password">
  </div>
 
  <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>
  
</div>


<?php include('inc/footer.php'); ?>