<?php 
session_start();

require 'sessions.php';
$conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
mysql_select_db("negotiatusBASE");
$prodd= "<div id='prodd'> <u>PRODUCT </u><br/> <br/>";
$list= " <div id='list'> <u>LIST PRICE</u> <br/><br/>";
$yours= " <div id='yours'> <u>YOUR PRICE</u><br/><br/>";
$result= mysql_query("SELECT * FROM negotiations WHERE user= '". $_SESSION['user']."'");
$count=0;
$level;

while($row=mysql_fetch_array($result))
  {
    if($count%2)
       $level="stripe";
    else
      $level="plain";
    $productName= $row['product'];
    if(strlen($productName) > 100)
    {
      $productName= substr($productName, 0, 90) . "...";
    }
    $prodd= $prodd. "<a class=".$level." href=negotiate2.php?id=" . $row['id']. ">".$productName." </a> <br/><br/>"; 
    $list= $list ."<p class=".$level."> $". $row['listPrice']." </p><br/>";
    $yours= $yours. "<p class=".$level.">$". $row['yourPrice']."</p><br/>";
    $count= $count+1;
  }

$list= $list. "</div>"; 
$prodd= $prodd. "</div>"; 
$yours= $yours. "</div>"; 

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
    <!-- <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="containerTest.css">

<title> Dashboard </title>


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


<div class="container" style="overflow:hidden;">
<div id="splash">
<p class="infoTitles"> Welcome <?= $_SESSION['user'] ?>! </p>



<?php 
  echo $prodd;
 echo $list;
 echo $yours;
  ?>
  
  
</div>
</div>
</body>
</html>