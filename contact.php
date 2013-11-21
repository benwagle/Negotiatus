<?php
session_start();
require 'sessions.php';

 if(isset($_GET['outszo']))
     logout();

?>

<html>
<head>

<title> Contact Negotiatus </title>

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
 <p class="infoTitles" > Contact Us </p>
<div class="contLeft" id="contactSplitRight">
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<p class="underStuff">General Question?  <a href="faq.php" class="emailLink"> Check this out </a></p>
<br/>
<p class="underStuff" id="sumSpec">Something Specific? <a class="emailLink"> info@negotiatus.com</a> </p> 
<br/>

<div id="social">
<p id="letsSocial">Let's Get Social.</p> 
<div id= "socialLogo" >
<a href="https://www.facebook.com/Negotiatus"><img src="fb_logo.png"><a> <a href="https://twitter.com/negotiatus"><img  src="twit_logo.png"></a>
</div>
</div>

</div>

<div class="contRight" id="contactSplitLeft">
</br>
</br>
</br>
 <p class="infoTitles" id="haveSomething"> 
   Have something to say?
    </p> 
   <p class="underStuff">Let's discuss. We like to talk. And we like to listen. </p>

</div>



</div>
</div>
</body>
</html>