<?php

$dbhost = "database-1.cacihsari076.us-east-1.rds.amazonaws.com";
   $dbname = "webscraper2";
   $dbusername = "admin";
   $dbpassword = "daveCutting123";

   $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

   $search = $_GET['q'];
   $results = $pdo->query("SELECT * FROm webscraper2.index");
   print_r($results->fetchAll());




 ?>
