<?php

session_start();
require 'sessions.php';

require_once 'Amazon-ECS-PHP-Library/lib/AmazonECS.class.php';
require 'sendgrid-php/SendGrid_loader.php';
$sendgrid = new SendGrid('pennApps', 'hackathon2013');

//require('lib/Semantics3.php');

$search1;
$search1=$_POST['search'];
$page=2;
if(strpos( $search1, "http") !== False) 
   {
     if(strpos( $search1,"amazon.com") !== False)
      {
		$items= explode( "www.amazon.com",$search1);
		$items= explode( "/",$items[1]);
		$search1= $items[3];
		$page=1;
	  }
	  
	}
	
//$url;
$key= "AKIAJQ2ELXIWFWOZXONQ";
$sec= "omH451F8M20lJXR3NK+nGhnM1sEK8Fg07/55hTo3";
$assoc= "negotiatus-20";

$conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789") or die(mysql_error());
mysql_select_db("negotiatusBASE");


$client = new AmazonECS($key, $sec, 'com', $assoc);
$client->category("All");
$client->responseGroup('Large');
$client->returnType(AmazonECS::RETURN_TYPE_ARRAY);

$client->page($page);

$response_final = $client->search($search1);

echo json_encode($response_final);

/********* Semantics3 Code ******************* /
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

******************** END SEMANTICS3 CODE *****************************/

   /************* OLD GOOGLE API METHOD ***************************** /
    
    //$search = urlencode($search1);
    //$url = 'https://www.googleapis.com/shopping/search/v1/public/products?key=' . $key . '&country=US&q=' . $search . '&maxResults=100';
    //just send the url to the next page and using an id number parse the Json and get the item they want. 
    // no databasing needed i think. I WAS RIGHT!!!!!!!!!
    
    */
    
    //$data= file_get_contents($url);
    //echo $data;
?>