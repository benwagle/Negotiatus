<?php

session_start();
require 'sessions.php';

if (isset($_POST) && isset($_POST['user'])) 
{
$user= $_POST['user'];
$password= $_POST['pass'];

$conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
mysql_select_db("negotiatusBASE");
$user = mysql_real_escape_string($user);
$result= mysql_query("SELECT password, salt, pepper, email FROM users WHERE username = '". $user ."'");

if(empty($result))
{
	header('Location: login.php' , true, 302);
   die();
}

$data= mysql_fetch_array($result, MYSQL_ASSOC);
$hash= hash('sha256', $password);
$salt= $data['salt'];
$pepper= $data['pepper'];

$hash = hash('sha256', $salt . $hash . $pepper);


if($hash != $data['password'])
{
    header('Location: login.php' , true, 302);
	die();
}

else
    
	validateUser($user, $data['email']);
	
if($_SESSION['user'] == "negoteam")
   header('Location: master.php' , true, 302);
   
else
 header('Location: dashboard.php' , true, 302);
 
 }
?>

<html>
<head>
    <meta charset="utf-8" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="home.js" type="text/javascript"></script>
    
     
     
   <!--  <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="containerTest.css">

    
<title> Negotiatus Login Failed </title>

<script>


$(document).ready(function(){
$(".aboutMenus").css('display','none');
  

  $("#bottom").click(function(){
      $(".aboutMenus").slideToggle();

  });
  
});

</script>

</head>
<body> 

<div class="header">
<div class= "menu" id="bottom"> about us</div>
 	 <a href="about.php"><p class="aboutMenus">history</p></a>
 	<a href="faq.php"><p class="aboutMenus">faqs</p></a>
 	<a href="contact.php"><p class="aboutMenus">contact us</p></a>
 	    
 	 <a href="index.php"><img class= "logo" src="Logo_small.png"></a>
</div> 

<div class="container" id="sidePage"> 

<div id="splash"> 

	<div class="loginBox" id="failedBox">
		<div id="explain">
		<div class="name" > Negotiatus Login </div>
		<hr class="log"/>
		<div class="name">
		The email and password combination entered is not correct. <br/> Please try again.  
		</div>
		</div>
			 <form class="loginText" id="failedText" action="login.php" method="post">
				username:<input type="text" maxlength="30" name="user"/>
				password:<input type="password" name="pass"/>
				<input type="submit" value="Login"/>
			 </form>
		 
			<div id="regLink">
			 <a  href="register.php">Sign up for Negotiatus</a>
			</div>
         
	</div>
</div>	
</div>
</body>
</html>