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
    
    <link rel="shortcut icon" href="favicon.png" />
   <!--  MESSENGER ALERTS  -->
    <script src="HubSpot-messenger-90da009/build/js/messenger.min.js" type="text/javascript"></script>
    <script src="HubSpot-messenger-90da009/build/js/messenger-theme-future.js" type="text/javascript"></script>
     <link rel="stylesheet" href="HubSpot-messenger-90da009/build/css/messenger.css">
     <link rel="stylesheet" href="HubSpot-messenger-90da009/build/css/messenger-theme-air.css">
     
     <!-- <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="containerTest.css">
    
<title> About Homepage </title>

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

	<div id=aboutUs>
    
    <p class="infoTitles"> History </p>
	<p class="about">
	The idea started years ago. I was at work alternating stares between another cup of coffee and a Bloomberg screen, when I overheard a coworker shopping for a new sofa. 
	After the cascade of profanities subsided, he announced to the group, "These couches are perfect, but if i even go $50 over the budget my wife will lose it." 
	To which I responded, "Then ask for the couch. For $50 less."

	<br/>
	<br/>
	In that moment the true strength of financial markets became apparent. 
	You don't need to understand a bid/ask spread or the EMH to appreciate the efficiency of financial markets. 
	All you need to know is buyers and sellers let each other know exactly what price they will be willing to pay/accept in order to facilitate deals. 
	Financial markets are dynamic and practical, and there had to be a way to bring this concept to the retail market. 

	<br/>
	<br/>
	This contemplation turned into a hobby. The hobby turned into a passion. 
	The passion turned into Negotiatus, an ecommerce platform that improves the dialogue between buyers and sellers. 
	Buyers get the products they love for the prices they want. Sellers use custom analytics to gauge demand in real time and identify optimal prices for their goods or services. 
	The breadth of Negotiatus is expansive. Negotiatus can be used for any purchase. Negotiatus should be used for every purchase. Because in life, everything is negotiable...
	</p>
	
</div>


</div>
 


</div>
</body>
</html>