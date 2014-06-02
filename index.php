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
 	$title= mysql_real_escape_string($_POST['title1']);
 	$price= mysql_real_escape_string($_POST['price1']);
 	$image= mysql_real_escape_string($_POST['image1']);
 	//$seller= mysql_real_escape_string($_POST['seller1']);
 	$link= mysql_real_escape_string($_POST['link1']);
 
  
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
  
  
  /************* Send info for manually getting item information **************/
  if (isset($_POST)  && isset($_POST['q']) && isLoggedIn())
   {
      $name= $_SESSION['user'];
      $item = $_POST['q'];
      $usermail= $_SESSION['email'];
      $mail = new SendGrid\Mail();
   	  $mail->addTo('info@negotiatus.com')->
          setFrom($usermail)->
          setSubject('Negotiation requested!')->
          setHtml("<p>The item link is '$item' and the username is '$name' </p>");
	  $sendgrid->web->send($mail);
    
   }
  
  /********* LOGOUT ***********/
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
    
<title> Negotiatus Homepage </title>

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



 <header>
 
 
 
        <form action="index.php" method="post" id="searching">
		<input class= "search1" type="text" id="q" name="q" placeholder="paste your item link here"> </input> 
        </form>
</header>  
  
<div class="container" style="height:600px; min-height:600px;">
 

<!-- <gcse:search></gcse:search> --!> 
<!--<form method="get" action="http://www.google.com/shopping"/> 
<input id= "search1" type="text" name="q" value="search" />
<input id = "go" type="submit" value="Search" /> 
<p>&nbsp<p>

<iframe class="test" src=""></iframe>--!>


<!-- BING search method --!>
<!-- <h3 class="search"> Search Powered by Bing</h3> 
 <form method="POST" action="bing_basic.php"> 
 <br/> 
 <input id= "search1" name="query" type="text" value="search" /> 
 <input id = "go" name="bt_search" type="button" value="Search" /> 
 <br /><br /> 
 </form> 
<div class="results">{RESULTS}</div> --!>




<div class="negotiate" id="negotiate2">
     <div class="photos"><img src="" id="itemPic"></div>
           <div class="itemInfo"> 
   				<p class="prodTitle"></p>
   				<br/>
  		    	<p class="price"> </p> 

				 <form action="index.php" method="post" id="negForm">
          		 	<input class="buyer" name= "buyer" id="buyer" placeholder="size/quanity/color/etc..."></input>           		 	           		 	
           		 	<hr class="info"></hr>
           			<br>
           			<br>
           				<div class ="bubble" id="bubble">
                  		 <p class="offer"> <b><?= $_SESSION['user'] ?> </b> is offering:  $<input type="text" name="buyer2" class= "buyer2" id="buyer2" maxlength="20"/> per item. </p>
						</div>
						<!--	<img src="textbox3.png">  -->
						<div class="negButton"><img src="negBttn.png" width="150px" height="75px"></div>
						
						<input id= "title1" value="" name= "title1"/>
						<input id= "price1" value="" name= "price1"/>
						<input id= "image1" value="" name= "image1"/>
						<input id= "link1" value="" name= "link1"/>
					</form>

					<br/>
					<br/>
     			 <?php
						if(!isLoggedIn())
						{
				    	echo '<div class="menu" id="menu3"> <a id="login" href="#">login</a>|<a id="register" href="register.php">register</a></div>
				           <script>
				                $(".negButton").css("display", "none");
				            </script>';
				    
				    	}	
				    	?>
    	     </div>
    	     <div id="cancel"><img src="circleX.png" width="30px" height="30px"></div>
    	   <p class="sellerPage" id="sellerPage">For more item information, <a href= "" target= "_blank" >click here</a> for the seller's site </p>
</div>


<div id="splash"> 

<div id="products">
  
		<?php
		if(isLoggedIn())
			echo '<p class="infoTitles"> Welcome '. $_SESSION["user"] .'! </p></br>';
        ?>
        
        <!-- The product list will go here -->
</div>

<div id="prev"> <img src="prev_button_small.png" > </div> <div id="next"> <img src="next_button_small.png" > </div>
<p id="message">

            <!-- Error messages will be displayed here -->
</p>

  <?php
        if(!isLoggedIn())
        {
		 echo  '<div id="cont">
				 <p class="infoTitles"> How it Works </p> 
				<div id="trip"> 
				<img class="instructions" src="initiate.png"> <img class="instructions" src="negotiate.png"> <img class="instructions" src="luxuriate.png"> 
				</div> 
	
			   </div>';
		}
    ?>

 </div>
 
</div>
<!-- <p style="margin-left:10%;"><font color="white">Featured Sellers</font><p> 

<hr class="main"/>

<div class="sellers">
      <div class="topLeft"><div class="opacity">Mets Stuff</div></div>
      <div class="topRight"><div class="opacity">Seller #1</div></div>
      <div class="bottomLeft"><div class="opacity">Seller #2</div></div>
      <div class="bottomRight"><div class="opacity">Seller #3</div></div>
</div>
<div class="ads"><img id="ad" src="http://www.lindsayburoker.com/wp-content/uploads/2012/03/advertising-ebooks-authors.jpg"></div>

<h2></h2>
-->

</div>
</body>

<script>
 function dash(data)
   {
     var n= 0;
     var html = ' <a class="product" id = "'+n+'" data-price= "'+data['listPrice']+ '" href="#" >';
	 html += '<img title= "'+data['product']+'" alt="'+data['product']+'" src="'+ data['image']+'"/>';
	 html+='<span>'+data['product']+'</span></a> ';
	 $('#products').append(html);	 
   }
</script>

<?php
if(isLoggedIn())
  {
    $conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
    mysql_select_db("negotiatusBASE");
    $result= mysql_query("SELECT listPrice, product, image FROM negotiations WHERE user= '". $_SESSION['user']."'");
    $count=0;
    while($row=mysql_fetch_array($result))
     {
        $row= json_encode($row);
         echo '<script> dash('.$row.'); </script>'; 
      }  
  }
?>

</html>