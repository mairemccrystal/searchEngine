<?php

$dbhost = "database-1.cacihsari076.us-east-1.rds.amazonaws.com";
   $dbname = "webscraper2";
   $dbusername = "admin";
   $dbpassword = "daveCutting123";

   $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

   $search = $_GET['q'];
   echo "<pre>";
   $searche = explode(" ", $search);

   $x = 0;
   $construct ="";
   foreach($searche as $term){
     $x++;
     if ($x == 1) {
       $construct .= "title LIKE '%$term%'";
     } else {
       $construct .= "OR title LIKE '%$term%'";
     }
   }

   $results = $pdo->query("SELECT * FROM webscraper2.index WHERE $construct");
   print_r($results->fetchAll());



 ?>

