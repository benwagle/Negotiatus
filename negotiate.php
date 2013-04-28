<?php


$conn = mysqli_connect("localhost", "root", "sexler", "Negotiatus");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 $count=0;
 $search= $_GET['search'];
 $item1= $_GET['id'];
 $result=  mysqli_query($conn,"SELECT * FROM Searches WHERE search='".$search."'");
 $title1;
 $price1;
 $image1;
 $seller1;
 while($row= mysqli_fetch_array($result))
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
          }
        
        $count++;
     }
?>

<html>
<head>
     <meta charset="utf-8" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
     <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" />
    <link rel="stylesheet" href="home.css">
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
   <p class="price"> List Price: $<?= $price ?></p> 
   <input class="buyer"></input> 
    <hr class="info"/>
    <div class= "chat">
     I would like to buy this product and I would like to pay: $<input class="buyer"></input> per item.
    <button class= "neg" type="submit">NEGOTIATE </button>
    </div>
</div>
</div>
</body>
</html>