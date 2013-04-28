<?php

 $id= $_POST['id'];
 $title=$_POST['title'];
 $price=$_POST['price'];
 $image=$_POST['image'];
 $seller=$_POST['seller'];
 $id++;
 $conn = mysqli_connect("localhost", "root", "sexler", "Negotiatus");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
 mysqli_query($conn,"UPDATE products SET Image='".$image."', productName= '".$title."', Price= '".$price."', Seller= '".$seller."' WHERE id= '".$id."'");
 echo "cool";

 
 
?>