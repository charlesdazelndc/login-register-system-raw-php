<?php 
include('inc/header.php');
include('config/User.php');


 ?>


 <?php 
$user=new User();
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["submit"])) {
  $userReg=$user->UserRegistration($_POST);
}

  ?>

<div class="mainsection">
  <?php 
if (isset($userReg)) {
  echo $userReg;
}
   ?>

    <form action="" method="post">
      <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="form-group">
    <label for="username">username:</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="password">
  </div>
 
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
  
</div>


<?php include('inc/footer.php'); ?>