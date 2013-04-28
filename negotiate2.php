<?php

  
 $conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789");
 mysql_select_db("negotiatusBASE");
 $count=0;
 $search= $_GET['search'];
 $item1= $_GET['id'];
 $result=  mysql_query("SELECT * FROM Searches WHERE search='".$search."'");
 $title1;
 $price1;
 $image1;
 $seller1;
 
 
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
            $title= $item->product->title;
            $image= $item->product->images[0]->link;
            $price= $item->product->inventories[0]->price;
            $seller= $item->product->author->name;
            $link= $item->product->link;
          }
        
        $count++;
     }
     
require 'sendgrid-php/SendGrid_loader.php';
$sendgrid = new SendGrid('pennApps', 'hackathon2013');


if (isset($_POST) && isset($_POST['buyer2'])) 
  {	
  	$askPrice = $_POST['buyer2'];
  	$usermail= $_POST['email'];
  	$specifics=$_POST['buyer'];
 	$mail = new SendGrid\Mail();
   	$mail->addTo('info@negotiatus.com')->
          setFrom($usermail)->
          setSubject('Negotiation requested!')->
          setHtml("<p>A user wants to buy '$title' from: $seller for $$askPrice. The specifics of their request are: $specifics. They can be contacted at $usermail.</p>");
	$sendgrid->web->send($mail);
	
  }
  
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
    <div class="menu">
         <a href="index.php" >search</a> |&nbsp  <a href="dashboard.html">dashboard</a>
    </div>
</div>  

<div class="negotiate">
     <div class="photos" style= "background-image: url(<?= $image ?>); background-repeat: no-repeat; background-size:contain">  </div>
           <div class="itemInfo"> 
   				<p class="prodTitle"><?= $title ?></p>
  		    	<p class="price"> List Price: $<?= $price ?>&nbsp&nbsp</p> 
          		<form action="" method="post">
          		 	<input class="buyer" name= "buyer" id="buyer" placeholder="size/quanity/color/etc..."></input> 
           		 	<hr class="info"/>
           			<div class= "chat" id="chat">
           			<br>
           			<br>
                  		<input class="email" name= "email" id="email" placeholder="Enter email address"> would like to buy this product and would like to pay: $<input type="text" name="buyer2" id="buyer2" maxlength="20"> per item.
						<input type="submit" id="negotiate" value="Negotiate" onclick="message()">
				    </div>
     			</form>
    	   </div>
    	   <p class="sellerPage">For more item information, <a href= "<?= $link ?>" target= "_blank" >click here</a> for the seller's site </p>
     </div>
</div>
</body>
</html>