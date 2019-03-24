<?php 
include 'inc/header.php'; 
include 'config/User.php';
session::checksession();
?>

<div class="mainsection">
<?php 
$logmsg=session::get("logmsg");
if (isset($logmsg)) {
  echo $logmsg;
  
}
?>

<span class="card card-body bg-light">
  <?php 
     $usernames=session::get("username");
if (isset($usernames)) {
 echo 'Welcome !!!'.$usernames; 
}

   ?>
</span>


	  <table class="table table-hover">
 
    <thead>
      <tr>
        <th>Serial</th>
        <th>Name</th>
        <th>UserName</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
   
$user=new User();
$userindex=$user->selectfunc();
if ($userindex) {
  $i=0;
foreach ($userindex as $value) {
  $i++;

     ?>
    
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $value['name']; ?></td>
        <td><?php echo $value['username']; ?></td>
        <td><?php echo $value['email']; ?></td>
       
        <td>
        	<a href="profile.php?id=<?php echo $value['id']; ?>" class="btn btn-primary">View</a>
        </td>

        

      </tr>
      
      <?php  }}else {
        
      

       ?>
       <tr>
         <td><h2>data can not found........</h2></td>
       </tr>
       <?php 
}
        ?>


    </tbody>
  </table>
	
</div>


<?php include('inc/footer.php'); ?>