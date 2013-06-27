<?php
  
 $conn = mysql_connect("negotiatusBASE.db.8689925.hostedresource.com", "negotiatusBASE", "Yeknod!6789");
 mysql_select_db("negotiatusBASE");
 $count=0;
 $search= $_POST['search'];
 $item1= $_POST ['id'];
 print_r("string");
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
            $data= $title+";;" + $image+';;'+$price+';;'+$seller+';;'+$link;
          }
        
        $count++;
     }
     

     
?>
