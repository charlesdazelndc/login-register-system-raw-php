<?php 

include('Database.php');
include_once('session.php');

/**
 * User class
 */


class User
{
    private $db;
    public function __construct()
    {
       $this->db=new Database(); 
    }


    public function UserRegistration($data)
    {
    	$name=$data['name'];
    	$username=$data['username'];
    	$email=$data['email'];
    	$password=md5($data['password']);
    	$check_mail=$this->emailcheck($email);

    	if ($name=="" OR $username=="" OR $email=="" OR $password=="") {
    		$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Feild must be not empty
    		</div>";
    		return $msg;
    	}

    	if ($username > 3) {
    		$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Username is too short
    		</div>";
    		return $msg;
    	}

    	if (filter_var($email,FILTER_VALIDATE_EMAIL)==false) {
    		$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Email is Error
    		</div>";
    		return $msg;
    		
    	}
    	if ($check_mail==true) {
    		$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Email is already exists
    		</div>";
    		return $msg;
    	}

   $sql="INSERT into login.user_tbl(name,username,email,password) values(:name,:username,:email,:password)";
   $query=$this->db->pdo->prepare($sql);
   $query->bindValue(':name',$name);
   $query->bindValue(':username',$username);
   $query->bindValue(':email',$email);
   $query->bindValue(':password',$password);
   $result=$query->execute();
   if ($result) {
   	$msg="<div class='alert alert-success'>
                   <strong>success!!</strong>Registered
    		</div>";
    		return $msg;
   }

   else{
   	$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Registration Not Complete
    		</div>";
    		return $msg;


   }

    }


public function emailcheck($email)
{
$sql="SELECT email from login.user_tbl where email = :email";
$query=$this->db->pdo->prepare($sql);
$query->bindValue(':email',$email);
$query->execute();
if ($query->rowCount() > 0) {
	return true;
}
else {
	return false;
}
}


public function getuserlogin($email,$password)
{
	$sql="SELECT * from login.user_tbl where email=:email and password=:password limit 1";
	$query=$this->db->pdo->prepare($sql);
    $query->bindValue(':email',$email);
    $query->bindValue(':password',$password);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);
   return $result;
}


public function Userlogin($data)
{
        $email=$data['email'];
    	$password=md5($data['password']);
    	$check_mail=$this->emailcheck($email);

    	if ($email=="" OR $password=="") {
    		$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Feild must be not empty
    		</div>";
    		return $msg;
    	}


    	if (filter_var($email,FILTER_VALIDATE_EMAIL)==false) {
    		$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Email is Error
    		</div>";
    		return $msg;
    		
    	}

$result=$this->getuserlogin($email,$password);
if ($result){
	session::init();
	session::set("login",true);
	session::set("id",$result->id);
	session::set("name",$result->name);
	session::set("username",$result->username);
	session::set("logmsg","<div class='alert alert-success'>
                   <strong>Congrates!!!</strong>Welcome
    		</div>");
	header("Location:index.php");
}
else {
	$msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>sorry u can not login
    		</div>";
    		return $msg;
}






}


public function selectfunc()
{
  $sql="SELECT * from login.user_tbl";
  $query=$this->db->pdo->prepare($sql);
  $query->execute();
  $result=$query->fetchAll();
  return $result;
}

public function getuserdata($id)
{

  $sql="SELECT * from login.user_tbl where id=:id limit 1";
  $query=$this->db->pdo->prepare($sql);
  $query->bindValue(':id',$id);
  $query->execute();
  $result=$query->fetch(PDO::FETCH_OBJ);
  return $result;

}


public function Userdataupdate($id,$data)
{
      $name=$data['name'];
      $username=$data['username'];
      $email=$data['email'];
      

      if ($name=="" OR $username=="" OR $email=="" ) {
        $msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Feild must be not empty
        </div>";
        return $msg;
      }

          

   $sql="UPDATE login.user_tbl set
    name=:name,
    username=:username, 
    email=:email
    where id=:id    
   ";
   $query=$this->db->pdo->prepare($sql);
   $query->bindValue(':name',$name);
   $query->bindValue(':username',$username);
   $query->bindValue(':email',$email);
   $query->bindValue(':id',$id);
   $result=$query->execute();
   if ($result) {
    $msg="<div class='alert alert-success'>
                   <strong>success!!</strong>updated
        </div>";
        return $msg;
   }

   else{
    $msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>updated Not Complete
        </div>";
        return $msg;


   }

}
public function chechpass($id,$oldpass)
{
$password=md5($oldpass);
$sql="SELECT password from login.user_tbl where id = :id and password=:password";
$query=$this->db->pdo->prepare($sql);
$query->bindValue(':id',$id);
$query->bindValue(':password',$password);
$query->execute();
if ($query->rowCount() > 0) {
  return true;
}
else {
  return false;
}
}


public function updatepass($id,$data)
{

      $oldpass=$data['oldpassword'];
      $newpass=$data['newpassword'];
      $chech_pass=$this->chechpass($id,$oldpass);
      
      

      if ($oldpass=="" OR $newpass=="" ) {
        $msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>Feild must be not empty
        </div>";
        return $msg;
      }

      if ($chech_pass==false) {
         $msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>password can not match
        </div>";
        return $msg;
      }

      $newpassword=md5($newpass);

          

   $sql="UPDATE login.user_tbl set
    password=:password
    
    where id=:id    
   ";
   $query=$this->db->pdo->prepare($sql);
   $query->bindValue(':password',$newpassword);
  ;
   $query->bindValue(':id',$id);
   $result=$query->execute();
   if ($result) {
    $msg="<div class='alert alert-success'>
                   <strong>success!!</strong>password updated
        </div>";
        return $msg;
   }

   else{
    $msg="<div class='alert alert-danger'>
                   <strong>ERROR!!</strong>updated Not Complete
        </div>";
        return $msg;


   }
}

}

 ?>