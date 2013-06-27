<?php 
session_start();

require 'sessions.php';
$conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
mysql_select_db("negotiatusBASE");
$prodd= "<div id='prodd'> <u>PRODUCT </u><br/> <br/>";
$list= " <div id='list'> <u>LIST PRICE</u> <br/><br/>";
$yours= " <div id='yours'> <u>YOUR PRICE</u><br/><br/>";
$result= mysql_query("SELECT * FROM negotiations WHERE user= '". $_SESSION['user']."'");

while($row=mysql_fetch_array($result))
  {
    $prodd= $prodd. "<a href=negotiate2.php?id=" . $row['id']. ">".$row['product']." </a> <br/><br/>"; 
    $list= $list . "$". $row['listPrice']." <br/><br/>";
    $yours= $yours. "$". $row['yourPrice']."<br/><br/>";
  }

$list= $list. "</div>"; 
$prodd= $prodd. "<a href='about.php'> ABOUT US </a>  </div>"; 
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
    <link rel="stylesheet" href="home.css">
<title> Dashboard </title>

</head>
<body>
<div class="header">
    <div class="logo"><a href="index.php"><img class= "logo" src="logo.png"></a></div>
    <?php 
     if(isLoggedIn()) 
          echo '<div id="menu2"> <a href="index.php">search</a> |&nbsp <a href="dashboard.php">dashboard</a> |&nbsp<a href="?outszo">logout</a></div>';
    else
          echo '<div id="menu"> <a id="login" href="#">login</a>/<a id="register" href="#">register</a>|&nbsp<a href="index.php">search</a></div>';
     ?>

<h1> Welcome <?= $_SESSION['user'] ?>!!! </h1>
</div> 

<?php 
  echo $prodd;
  echo $list;
  echo $yours;
  ?>

</body>
</html>