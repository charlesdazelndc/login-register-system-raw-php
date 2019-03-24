<?php 

$filepath=realpath(dirname(__FILE__));
include_once $filepath.'/../config/session.php';
session::init();
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Register System</title>
  <link rel="stylesheet"  href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



</head>


<body>


  <div class="main">
<?php 

if (isset($_GET['action']) && $_GET['action']=='logout') {
  session::destroy();
}
 ?>

  <div class="container">

<header class="header">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <?php 
$id=session::get("id");
$userlogs=session::get("login");
if ($userlogs==true) {
  


   ?>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="profile.php?id=<?php echo $id; ?>">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="?action=logout">Logout</a>
    </li>
    <?php  
}else
{
    ?>
    <li class="nav-item">
      <a class="nav-link" href="Login.php">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="Register.php">Register</a>
    </li>
    
<?php  } ?>
  </ul>
</nav>
</header>