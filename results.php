<?php
$search1;
$url;
$conn = mysqli_connect("localhost", "root", "sexler", "Negotiatus");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$key = 'AIzaSyD292Hx2skndazhuPsirjsPGctTdKcgy8I';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search1=$_POST['search'];
    $search = urlencode($search1);
    $url = 'https://www.googleapis.com/shopping/search/v1/public/products?key=' . $key . '&country=US&q=' . $search . '&maxResults=12';
    //just send the url to the next page and using an id number parse the Json and get the item they want. 
    // no databasing needed i think. 
    mysqli_query($conn,"INSERT INTO Searches (search, resultsLink, count) VALUES ('".$search1."','".$url."', 0)");
    $data= file_get_contents($url);
    echo $data;
    }
    
?>