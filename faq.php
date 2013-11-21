<?php
session_start();
require 'sessions.php';

require 'sendgrid-php/SendGrid_loader.php';
$sendgrid = new SendGrid('pennApps', 'hackathon2013');

if (isset($_POST) && isset($_POST['buyer2']) && isLoggedIn()) 
  {	
   /**************************       get all of the item information        ********************/
    $conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789");
 	mysql_select_db("negotiatusBASE");
 	$count=0;
	$search= mysql_real_escape_string($_POST['itemSearch']);
	$item1= $_POST['itemNum'];
 	$result=  mysql_query("SELECT * FROM Searches WHERE search='".$search."'");
 	/*
 	$title= $_POST['title1'];
 	$price= $_POST['price1'];;
 	$image= $_POST['image1'];;
 	$seller= $_POST['seller1'];;
 	$link= $_POST['link1'];;
 	*/
 	$title;
 	$price;
 	$image;
 	$seller;
 	$link;
 
 
 	while($row= mysql_fetch_array($result))
   	 {
    	$stuff= $row['resultsLink'];
      }
    
    $stuff = file_get_contents($stuff);
    $json = json_decode($stuff);
    
    foreach ($json->items as $item) 
    {
       if ($count == $item1)
         {
            $title= mysql_real_escape_string($item->product->title);
            $image= mysql_real_escape_string($item->product->images[0]->link);
            $price= $item->product->inventories[0]->price;
            $seller= mysql_real_escape_string($item->product->author->name);
            $link= mysql_real_escape_string($item->product->link);
            break;
          }
        
        $count++;
     }
 
   /****************************   finished collecting all the item info    *************************************************/
   
   
   $askPrice = $_POST['buyer2'];
   $usermail= $_SESSION['email'];
   $specifics=mysql_real_escape_string($_POST['buyer']);
   $rand= substr(str_shuffle(MD5(microtime())), 0, 12);
   //Insert the negotiation information into the database
   $insert = mysql_query("INSERT INTO negotiations (user, product, listPrice, yourPrice, userTalk, image, seller, sellerLink, random) VALUES ('" .$_SESSION['user']. "', '" .$title. "', '" .$price. "', '" .$askPrice. "', '" .$specifics. "', '" .$image. "', '" .$seller. "', '" .$link. "', '" .$rand. "')"); 
  
      
  //sending the email to neogtiatus
 	$mail = new SendGrid\Mail();
   	$mail->addTo('info@negotiatus.com')->
          setFrom($usermail)->
          setSubject('Negotiation requested!')->
          setHtml("<p>A user wants to buy '$title' from: $seller for $$askPrice. The specifics of their request are: $specifics. They can be contacted at $usermail.</p>");
	$sendgrid->web->send($mail);

  }
  
  
  
  if(isset($_GET['outszo']))
     logout();
?>

<html>
<head>
     <meta charset="utf-8" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="home.js" type="text/javascript"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" />
    
    
   <!--  MESSENGER ALERTS  -->
    <script src="HubSpot-messenger-90da009/build/js/messenger.min.js" type="text/javascript"></script>
    <script src="HubSpot-messenger-90da009/build/js/messenger-theme-future.js" type="text/javascript"></script>
     <link rel="stylesheet" href="HubSpot-messenger-90da009/build/css/messenger.css">
     <link rel="stylesheet" href="HubSpot-messenger-90da009/build/css/messenger-theme-air.css">
     
     <!-- <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="containerTest.css">
    
<title> Negotiatus FAQs </title>

<script>


$(document).ready(function(){
$(".test").css('display','none'); 
$(".qSecs").css('display','none'); 
$(".aboutMenus").css('display','none');
  
    $("#gen").click(function(){
    
      $("#generalQs").slideToggle();
      
    });
    
    
     $("#buyerQ").click(function(){
    
      $("#buyerQs").slideToggle();
      
  });
  
   $("#sellerQ").click(function(){
    
      $("#sellerQs").slideToggle();
      
  });
  
  
  $("#Q1").click(function(){
    
      $("#test1").slideToggle();

  });

  $("#Q2").click(function(){
	 
      $("#test2").slideToggle();

  });
  
    $("#Q3").click(function(){
	
      $("#test3").slideToggle();

  });
  
    $("#Q4").click(function(){
      $("#test4").slideToggle();

  });
  
    $("#Q5").click(function(){
      $("#test5").slideToggle();

  });
  
   $("#Q6").click(function(){
      $("#test6").slideToggle();

  });
  
   $("#Q7").click(function(){
      $("#test7").slideToggle();

  });
  
  $("#Q8").click(function(){
      $("#test8").slideToggle();

  });
  
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
    		<input type="text" maxlength="30" name="user" placeholder="username"/>
    		<input type="password" name="pass" placeholder="password"/>
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
	

<div id="FAQ">
    
    <p class="infoTitles"> FAQ </p>
    
	<div class="contLeft" id="faqLeft">
 
    <p class="faqSec" id="clickedQ"></p>
    
     <p  id="showAns"></p>
 
	</div>


	<div class="contRight" id="faqRight">

	<p class="faqSec" id="gen" >General</p>
	<font class= "qSecs" id="generalQs" color="black">
	<p class="Qs" id="Q1">What is Negotiatus?</p>
	<p class="Qs" id="Q2">What is the problem Negotiatus is trying to solve?</p>
	</font>
	
	 <p class="faqSec" id="buyerQ" >I'm a Buyer</p>
	<font class= "qSecs" id="buyerQs" color="black">
	<p class="Qs" id="Q3">What are the benefits of using Negotiatus? </p>
	<p class="Qs" id="Q4">How do I become a member? </p>
	<p class="Qs" id="Q5">How do I negotiate?</p>
	</font>
	
	<p class="faqSec" id="sellerQ" >I'm a Seller</p>
	<font class= "qSecs" id="sellerQs" color="black">
	<p class="Qs" id="Q6">What are the benefits of using Negotiatus? </p>
	<p class="Qs" id="Q7">How do I become a member?</p>
	<p class="Qs" id="Q8">How do I negotiate?</p>
	
	</font>

     </div>


</div>


</div>
</body>
</html>