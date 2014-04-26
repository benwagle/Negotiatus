<?php
session_start();
require 'sessions.php';

if (isset($_POST) && isset($_POST['user2']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email'])) 
{
$username = $_POST['user2'];
$password1= $_POST['pass1'];
$password2 = $_POST['pass2'];
$email = $_POST['email'];

if(($password1 != $password2) || strlen($password1)==0)
	{
	  header('Location: register.php', true, 302);
	  die();
	}

else if(strlen($username) > 30 || strlen($username) ==0 )
{
	header('Location: register.php', true, 302);
	die();
}
 
else if(strlen($email) ==0 )
{
	header('Location: register.php', true, 302);
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
     echo '<script> nameTaken() </script>';
   }
}
 ?>
 
 
 
<html>
<head>
    <meta charset="utf-8" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="home.js" type="text/javascript"></script>
    
       <!--  MESSENGER ALERTS  -->
    <script src="HubSpot-messenger-90da009/build/js/messenger.min.js" type="text/javascript"></script>
    <script src="HubSpot-messenger-90da009/build/js/messenger-theme-future.js" type="text/javascript"></script>
     <link rel="stylesheet" href="HubSpot-messenger-90da009/build/css/messenger.css">
     <link rel="stylesheet" href="HubSpot-messenger-90da009/build/css/messenger-theme-air.css">
     <link rel="shortcut icon" href="favicon.png" />
   <!--  <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="containerTest.css">

    
<title> Negotiatus Registration</title>

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
 <p class="infoTitles" > Register </p>
<div class="contLeft" id="contactSplitRight">
<form class="registerText" action="register.php" method="post">
				<br/>
				<br/>
				<br/>
				<p class="regInp">username:<input type="text" maxlength="30" name="user2"/></p>
				<br/>
				<p class="regInp">email:<input type="text" maxlength="30" name="email"/></p>
				<br/>
				<p class="regInp">password:<input type="password" name="pass1"/></p>
				<br/>
				<p class="regInp">retype password:<input type="password" name="pass2"/></p>
				<br/>
				<div class="regInp" id="regButt"> <p class="infoTitles" id="registerButton"> Register! </p></div>
			 </form>
		 
			<a href="index.php"><p class="regInp" id="already"> Already have an account?</p></a>
			
</div>

<div class="contRight" id="contactSplitLeft">
</br>
</br>
</br>
 <p class="infoTitles" id="haveSomething"> 
   Welcome to the <br/> e-commerce revolution
    </p> 
   

</div>



</div>
</div>

</body>
</html>
