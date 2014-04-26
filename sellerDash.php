<?php
session_start();
require 'sessions.php';

 if(isset($_GET['outszo']))
     logout();

?>

<html>
<head>

<title> Seller Dashboard </title>
<link rel="shortcut icon" href="favicon.png" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="home.js" type="text/javascript"></script>
<!-- <link rel="stylesheet" href="home.css"> -->
<link rel="stylesheet" href="containerTest.css">

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
    <div class="loginBox">
    
         <form class="loginText" action="login.php" method="post">
    		username:<input type="text" maxlength="30" name="user"/>
    		password:<input type="password" name="pass"/>
    		<input type="submit" value="Login"/>
         </form>
         
    </div>
     <div class= "menu" id="menu1">
    <?php 
     if(isLoggedIn()) 
          echo '<a href="index.php">search</a> |&nbsp <a href="dashboard.php">dashboard</a> |&nbsp<a href="?outszo">logout</a>';
    else
          echo '<div id="dispMen"> <a id="login" href="#">login</a>| <a id="register" href="register.php">register</a> </div> ';
     ?>
     </div>
</div> 

<div class="container" id="sidePage">
    <div id="splash">
    <p class="infoTitles" > Dashboard </p>
        <div id="l"></div>
        <div id="ml"></div>
        <div id="mr"></div>
        <div id="r"></div>
     </div>
</div>

</body>
</html>