<?php
session_start();
require 'sessions.php';

 $conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789");
 mysql_select_db("negotiatusBASE");
 $id= $_GET['id'];
 $result=  mysql_query("SELECT * FROM negotiations WHERE id='".$id."' AND user='" . $_SESSION['user']. "'");
 $title;
 $price;
 $image;
 $seller;
 
 
 if(!empty($result))
    {
      $data= mysql_fetch_array($result, MYSQL_ASSOC);
      $title= $data['product'];
      $image= $data['image'];
      $price= $data['listPrice'];
      $seller= $data['seller'];
      $link= $data['sellerLink'];
     }
     
require 'sendgrid-php/SendGrid_loader.php';
$sendgrid = new SendGrid('pennApps', 'hackathon2013');


if (isset($_POST) && isset($_POST['buyer2'])) 
  {	
  	$askPrice = $_POST['buyer2'];
  	$usermail= $_SESSION['email'];
  	$specifics=$_POST['buyer'];
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

<script>
    
function message()
  {
  /*
    Messenger.options = 
     {
		extraClasses: 'messenger-fixed messenger-on-top',
		theme: 'future'
      }

   Messenger().post({
  message: "Your negotiation has been received!",
  hideAfter: 10,
});
*/
alert("Negotiation received!");
   }
</script>

<html>
<head>
     <meta charset="utf-8" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="HubSpot-messenger-1618c83/build/js/messenger.min.js"></script>
    <script src="HubSpot-messenger-1618c83/build/js/messenger-theme-future.js"></script>
     <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" />
    <link rel="stylesheet" href="home.css">
     <link rel="stylesheet" href="HubSpot-messenger-1618c83/build/css/messenger.css">
      <link rel="stylesheet" href="HubSpot-messenger-1618c83/build/css/messenger-theme-future.css">
<title> Negotiation Room </title>

</head>
<body>
<div class="header">
    <div class="logo"><a href="index.php"><img class= "logo" src="logo.png"></a></div>
     <?php 
     if(isLoggedIn()) 
          echo '<div id="menu2"> <a href="index.php">search</a> |&nbsp <a href="dashboard.php">dashboard</a> |&nbsp<a href="?outszo">logout</a></div>';
    else
          echo '<div id="menu"> <a id="login" href="#">login</a>/<a id="register" href="#">register</a></div>';
     ?>
</div>  

<div id="negotiate3">
     <div class="photos" style= "background-image: url(<?= $image ?>); background-repeat: no-repeat; background-size:contain">  </div>
           <div class="itemInfo"> 
   				<p class="prodTitle"><?= $title ?></p>
  		    	<p class="price">List: $<?= $price ?> </p> 
          		<form action="" method="post">
          		 	<input class="buyer" name= "buyer" id="buyer" placeholder="size/quanity/color/etc..."></input> 
           		 	
           		 	
           		 	<hr class="info"></hr>
           		 
           			
           			<br>
           			<br>
           				<div class ="bubble" id="bubble">
                  		  <b><?= $_SESSION['user'] ?> </b> would like to buy this product and would like to pay: $<input type="text" name="buyer2" class= "buyer2" id="buyer2" maxlength="20"/> per item. 
						</div>
						<div class= "negButton"><input type="submit" class="negotiate" id="negotiate" value="NEGOTIATE" /> </div>
						
					</form>
				     
    	     </div>
    	   <p class="sellerPage">For more item information, <a href= "<?= $link ?>" target= "_blank" >click here</a> for the seller's site </p>
     </div>
</div>

<a style="position:fixed; bottom:0;" href="about.php"> ABOUT US </a>

</body>
</html>