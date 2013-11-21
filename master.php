<?php 
session_start();

require 'sessions.php';
$conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
mysql_select_db("negotiatusBASE");
$use= "<div id='use'>  USER <br/><br/>";
$mail= "<div id='mail'>  EMAIL <br/><br/>";
$prodd= "<div id='prodd'>  PRODUCT <br/><br/>";
$list= "<div id='list'>  LIST PRICE <br/><br/>";
$yours= "<div id='yours'>  YOUR PRICE <br/><br/>";
//$sell= "<div id='sell'>  SELLER <br/><br/>";
//$site= "<div id='site'>  SELLER SITE <br/><br/> ";
$room= "<div id='room'>  Negotiation Room <br/><br/>";
$result= mysql_query("SELECT * FROM negotiations");

while($row=mysql_fetch_array($result))
  {
    $email = mysql_query("SELECT email FROM users WHERE username = '".$row['user']."' ");
    $data= mysql_fetch_array($email, MYSQL_ASSOC);
    
        $productName= $row['product'];
    if(strlen($productName) > 30)
    {
      $productName= substr($productName, 0, 30) . "...";
    }
    
    
    $use= $use. $row['user']." <br/><br/>";
	$mail= $mail. $data['email']  ." <br/><br/>";
	$prodd= $prodd .$productName."<br/><br/>";
	$list= $list. " $". $row['listPrice']." <br/><br/>";
	$yours= $yours."$". $row['yourPrice']."<br/><br/>";
	//$sell= $sell. $row['seller']." <br/><br/>";
	//$site= $site. "<a href=". $row['sellerLink']."> LINK </a> <br/><br/>";
	$room= $room. "<a href=sellerView.php?id=". $row['random']."> LINK "." </a> <br/><br/>";
  }

$list= $list. "</div>"; 
$prodd= $prodd. " </div>"; 
$yours= $yours. "</div>"; 
$mail= $mail. "</div>"; 
//$sell= $sell. "</div>"; 
//$site= $site. "</div>"; 
$use= $use. "</div>"; 

 if(isset($_GET['outszo']))
     logout();
?>

<html>
<head>
     <meta charset="utf-8" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="home.js" type="text/javascript"></script>
     <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" />
    
    
    <!-- <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="containerTest.css">

<title>  Master Dashboard </title>

</head>
<body>

<div class="header">
    <div class="logo"><img class= "logo" src="Logo_small.png"></div>
    <?php 
     if(isLoggedIn()) 
          echo '<div class="menu" id="menu1"><a href="?outszo">logout</a></div>';
    ?>
  
<h1> Welcome <?= $_SESSION['user'] ?>!!! </h1>
</div>

<div class="container" style="overflow:hidden;">


<?php 
  echo $use;
  echo $mail;
  echo $prodd;
  echo $list;
  echo $yours;
  //echo $sell;
  //echo $site;
  echo $room;
  ?>

</div>
</body>
</html>