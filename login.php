<?php

session_start();
require 'sessions.php';

$user= $_POST['user'];
$password= $_POST['pass'];

$conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
mysql_select_db("negotiatusBASE");
$user = mysql_real_escape_string($user);
$result= mysql_query("SELECT password, salt, pepper, email FROM users WHERE username = '". $user ."'");

if(empty($result))
{
   header('Location: index.php', true, 302);
   die();
}

$data= mysql_fetch_array($result, MYSQL_ASSOC);
$hash= hash('sha256', $password);
$salt= $data['salt'];
$pepper= $data['pepper'];

$hash = hash('sha256', $salt . $hash . $pepper);


if($hash != $data['password'])
{

	header('Location: index.php', true, 302);
	die();
}

else
    
	validateUser($user, $data['email']);
	
if($_SESSION['user'] == "negoteam")
   header('Location: master.php' , true, 302);
   
else
 header('Location: dashboard.php' , true, 302);
 
 
?>