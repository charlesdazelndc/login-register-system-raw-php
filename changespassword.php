<?php 
include('inc/header.php');
include('config/User.php');
session::checksession();
$user=new User();


 ?>

 <?php 
if (isset($_GET['id'])) {
  $userid=(int)$_GET['id'];
}

$sessid=session::get("id");
  if ($userid!=$sessid) {
    header('Location:index.php');
    }
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["submit"])) {
  $updatepass=$user->updatepass($userid,$_POST);
}

  ?>


 
<div class="mainsection">

 <?php 

if (isset($updatepass)) {
  echo $updatepass;
}
  ?>


    <form action="" method="post">
      <div class="form-group">
    <label for="password">Old Password:</label>
    <input type="password" class="form-control" id="oldpassword" name="oldpassword" >
  </div>

  <div class="form-group">
    <label for="password">New Password:</label>
    <input type="password" class="form-control" id="newpassword" name="newpassword" >
  </div>
 
 
  <button type="submit" class="btn btn-primary" name="submit">Update Password</button>


</form>
 
</div>


<?php include('inc/footer.php'); ?>