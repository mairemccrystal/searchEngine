<?php

$dbhost = "database-1.cacihsari076.us-east-1.rds.amazonaws.com";
   $dbname = "webscraper2";
   $dbusername = "admin";
   $dbpassword = "daveCutting123";

   $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

   $search = $_GET['q'];
   
   $searche = explode(" ", $search);

   $x = 0;
   $construct ="";
   foreach($searche as $term){
     $x++;
     if ($x == 1) {
       $construct .= "title LIKE '%$term%' OR description LIKE '%$term%' OR keywords LIKE '%$term%'";
     } else {
       $construct .= "AND title LIKE '%$term%' OR description LIKE '%$term%' OR keywords LIKE '%$term%";
     }
   }

   $results = $pdo->query("SELECT * FROM webscraper2.index WHERE $construct");
   

   if ($results->rowCount() == 0){
     echo "0 results for your query! <hr />";
   } else {
     echo $results->rowCount()." results found for your query! <hr />";
   }

echo "<pre>";
   print_r($results->fetchAll());
 



 ?>

