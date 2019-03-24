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
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["submit"])) {
  $userdatass=$user->Userdataupdate($userid,$_POST);
}

  ?>


 
<div class="mainsection">

  <span class="card card-body bg-light">
  <?php 
    if (isset($userdatass)) {
 echo $userdatass; 
}

   ?>
</span>
 <?php 
 
$userdata=$user->getuserdata($userid);
if ($userdata) {
  ?>

    <form action="" method="post">
      <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $userdata->name;?>">
  </div>
  <div class="form-group">
    <label for="username">username:</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo $userdata->username;?>">
  </div>
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $userdata->email;?>">
  </div>
  <?php 
  $sessid=session::get("id");
  if ($userid==$sessid) {
    
  
   ?>
 
  <button type="submit" class="btn btn-primary" name="submit">Update</button>
  <a   class="btn btn-info" href="changespassword.php?id=<?php echo $userid; ?>" >Changepass</a>
<?php } ?>
</form>
  <?php } ?>
</div>


<?php include('inc/footer.php'); ?>