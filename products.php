<?php

require 'sessions.php';

require 'sendgrid-php/SendGrid_loader.php';
$sendgrid = new SendGrid('pennApps', 'hackathon2013');

if (isset($_POST) && !empty($_POST["buyer2"]) && isLoggedIn()) 
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
  
     
?>
