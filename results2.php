<?php

require('lib/Semantics3.php');

$search1;
$url;
$conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
mysql_select_db("negotiatusBASE");
//$key = 'AIzaSyD292Hx2skndazhuPsirjsPGctTdKcgy8I';
$key='SEM33863F6DEE3EA822035D62FEDE1FA6352';
$secret= 'M2FhNjBmYWZkOTJlODg0NzcyZTgzZTdlYWVhOTlkNzA';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
	$requestor = new Semantics3_Products($key,$secret);
    $search1=$_POST['search'];
    
    //TWEAK TO GET MORE THAN 10 RESULTS
    $requestor->products_field("offset",9);
    $requestor->products_field("limit",9);
    
    $requestor->products_field("search", $search1);
    $results = $requestor->get_products();
    
   // mysql_query("INSERT INTO Searches (search, resultsLink, count) VALUES ('".mysql_real_escape_string($search1)."','".mysql_real_escape_string($url)."', 0)");
    
    echo $results;
    
    /* OLD GOOGLE API METHOD
    
    //$search = urlencode($search1);
    //$url = 'https://www.googleapis.com/shopping/search/v1/public/products?key=' . $key . '&country=US&q=' . $search . '&maxResults=100';
    //just send the url to the next page and using an id number parse the Json and get the item they want. 
    // no databasing needed i think. I WAS RIGHT!!!!!!!!!
    
    */
    
    //$data= file_get_contents($url);
    //echo $data;
    }