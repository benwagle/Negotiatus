<?php
session_start();
require 'sessions.php';

$username = $_POST['user2'];
$password1= $_POST['pass1'];
$password2 = $_POST['pass2'];
$email = $_POST['email'];

if(($password1 != $password2) || strlen($password1)==0)
	{
	  header('Location: index.php', true, 302);
	  die();
	}

else if(strlen($username) > 30 || strlen($username) ==0 )
{
	header('Location: index.php', true, 302);
	die();
}
 
else if(strlen($email) ==0 )
{
	header('Location: index.php', true, 302);
	die();
 }


 $hash = hash('sha256', $password1);
 
 function salting()
 {
 	$string = md5(uniqid(rand(), true));
 	return substr($string, 0, 3);
 }
 
 function peppering()
 {
 $string = md5(uniqid(rand(), true));
 return substr($string, 0, 3);
 }
 
 $salt= salting();
 $pepper=peppering();
 $hash = hash('sha256', $salt . $hash . $pepper);
 $conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
 mysql_select_db("negotiatusBASE");
 $username= mysql_real_escape_string($username);
 $unique= mysql_query("SELECT * FROM users WHERE username = '". $username ."' OR email = '". $email ."'");
 
 if(mysql_num_rows($unique)==0)
   {
      mysql_query("INSERT INTO users (username, password, salt, pepper, email) VALUES ('" .$username. "', '" .$hash. "', '" .$salt. "', '" .$pepper. "', '" .$email. "')");
      validateUser($username, $data['email']);
	  header('Location: dashboard.php' , true, 302);
	}
 else
   {
     header('Location: index.php' , true, 302);
   }

 ?>