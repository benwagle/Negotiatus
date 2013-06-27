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
  
   if($insert)
      echo '<script> alert("AWESOME!!! Negotiation received.") </script>';
  
  else
      echo '<script> alert("Sorry, this item does not seem to be negotiable right now. Please try another item, or try again later.") </script>';
      
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
    <link rel="stylesheet" href="home.css">
<title> Negotiatus Homepage </title>

</head>
<body>

<div class="header">
    <a href="index.php"><img class= "logo" src="logo.png"></a>
    <div id="loginBox">
    
         <form id="loginText" action="login.php" method="post">
    		username:<input type="text" maxlength="30" name="user"/>
    		password:<input type="password" name="pass"/>
    		<input type="submit" value="Login"/>
         </form>
         
         <form id="registerText" action="register.php" method="post">
    		username:<input type="text" maxlength="30" name="user2"/>
    		email:<input type="text" maxlength="30" name="email"/>
    		<br/>
    		password:<input type="password" name="pass1"/>
    		retype password:<input type="password" name="pass2"/>
    		<br/>
    		<input type="submit" value="Register"/>
         </form>
         
    </div>
    <?php 
     if(isLoggedIn()) 
          echo '<div id="menu2"> <a href="index.php">search</a> |&nbsp <a href="dashboard.php">dashboard</a> |&nbsp<a href="?outszo">logout</a></div>';
    else
          echo '<div id="menu"> <a id="login" href="#">login</a>/ <a id="register" href="#">register</a> </div>';
     ?>
</div>  
<p>&nbsp<p>

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


 <header>
        <form action="" id="searching" method="get">
		<input class= "search1" type="text" id="q" name="q" placeholder="what do you want to buy?" style="width:80%;"> </input> <img id="preload" alt="preload" src=""/>
         <h5>Powered by Google</h5>
        </form>
</header>     
     
<div class="negotiate2" id="negotiate2">
     <div class="photos">  </div>
           <div class="itemInfo"> 
   				<p class="prodTitle"></p>
  		    	<p class="price"> </p> 
          		<form action="" method="post">
          		 	<input class="buyer" name= "buyer" id="buyer" placeholder="size/quanity/color/etc..."></input>           		 	           		 	
           		 	<hr class="info"></hr>
           			<br>
           			<br>
           				<div class ="bubble" id="bubble">
                  		  <b><?= $_SESSION['user'] ?> </b> would like to buy this product and would like to pay: $<input type="text" name="buyer2" class= "buyer2" id="buyer2" maxlength="20"/> per item. 
						</div>
						<div class= "negButton"><input type="submit" class="negotiate" id="negotiate" value="NEGOTIATE" /> </div>
						<input id= "itemNum" value="" name= "itemNum"/>
						<input id= "itemSearch" value="" name= "itemSearch"/>
					</form>
					
					<div class= "cancelBtn">
				    
     			 		<button class= "cancel" id="cancel"> CANCEL </button> 
     			 </div> 
     			 <?php
						if(!isLoggedIn())
						{
				    	echo '<div id="menu3"> <a id="login" href="#">login</a>/<a id="register" href="#">register</a></div>
				           <script>
				                $(".negButton").css("display", "none");
				            </script>';
				    
				    	}	
				    	?>
    	     </div>
    	   <p class="sellerPage">For more item information, <a href= "" target= "_blank" >click here</a> for the seller's site </p>
     </div>
</div>


<div id="products">

            <!-- The product list will go here -->
        
</div>
<button id="prev"> PREV </button><button id="next"> NEXT </button>
<p id="message">

            <!-- Error messages will be displayed here -->
</p>

<img id="splash" src="splashshot.png">
<!-- <p style="margin-left:10%;"><font color="white">Featured Sellers</font><p> 

<hr class="main"/>

<div class="sellers">
      <div class="topLeft"><div class="opacity">Mets Stuff</div></div>
      <div class="topRight"><div class="opacity">Seller #1</div></div>
      <div class="bottomLeft"><div class="opacity">Seller #2</div></div>
      <div class="bottomRight"><div class="opacity">Seller #3</div></div>
</div>
<div class="ads"><img id="ad" src="http://www.lindsayburoker.com/wp-content/uploads/2012/03/advertising-ebooks-authors.jpg"></div>
-->
<h2></h2>

</body>
</html>