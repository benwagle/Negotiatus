<?php

$conn;
function connect()
{
   try{
     $con= mysqli_connect("localhost", "root", "sexler");
     mysql_select_db("Negotiatus", $conn);
     return $conn;
     
     } catc(Exception $e) {
     		return false;
      }
    }

function query1($query, $conn) 
{
   $result= mysql_query($query, $conn)
       return $result;
       
}

function get($tableName, $conn, $limit= 12)
{
   try{
       $result= query1("Select * FROM $tableName ORDER BY id DESC LIMIT $limit", $conn);
       if($result ==FALSE)
       			return FALSE;
       	return $result;
       	}catch (Exception $e) 
       	 {
       	   return $e;
       	   }
       	}
       	
function get_by_id($id, $conn)
{
  $query= query1("Select * FROM products WHERE id = '$id' Limit 1", $conn);
     if ($query) 
       return mysql_fetch_array($query);
 }


?>