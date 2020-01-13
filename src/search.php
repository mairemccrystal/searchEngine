<?php

$dbhost = "database-1.cacihsari076.us-east-1.rds.amazonaws.com";
   $dbname = "webscraper2";
   $dbusername = "admin";
   $dbpassword = "daveCutting123";

   $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

   $dbhost2 = "adsdb.cacihsari076.us-east-1.rds.amazonaws.com";
   $dbname2 = "ads";
   $dbusername2 = "admin";
   $dbpassword2 = "daveCutting123";

   $pdo2 = new PDO("mysql:host=$dbhost2;dbname=$dbname2", $dbusername2, $dbpassword2);

   $search = $_GET['q'];

   $searche = explode(" ", $search);

   $x = 0;
   $construct ="";
   foreach($searche as $term){
     $x++;
     if ($x == 1) {
       $construct .= "title LIKE CONCAT('%',:search$x,'%') OR description LIKE CONCAT('%',:search$x,'%') OR keywords LIKE CONCAT('%',:search$x,'%')";
     } else {
       $construct .= "AND title LIKE CONCAT('%',:search$x,'%') OR description LIKE CONCAT('%',:search$x,'%') OR keywords LIKE CONCAT('%',:search$x,'%')";
     }
     $params[":search$x"] = $term;
   }

   $results = $pdo->prepare("SELECT * FROM webscraper2.index WHERE $construct");
   $results->execute($params);

   $ads = $pdo2->prepare("SELECT * FROM ads.adverts WHERE $construct");
   $ads->execute($params);


   if ($results->rowCount() == 0){
     echo "0 results for your query! <hr />";
   } else {
     echo $results->rowCount()." results found for your query! <hr />";
   }

echo <<<HTML
<a href="http://onvictinitor.com/afu.php?zoneid=3025641" style="background-color:#ffffa0">This is a dynamic sponsered ad link! </a>
<script data-cfasync='false' type='text/javascript' src='//p380963.clksite.com/adServe/banners?tid=380963_747845_1&type=slider&side=right&size=9&position=top'></script>
HTML;

  echo "<br/>";
  echo "<br/>";

echo "<p3> The following links are sponsered links: <p3>";

foreach($ads->fetchAll() as $ad){
  echo "<br/>";
  echo "<br/>";
  echo "<p3> Sponsored link:  <p3>";
  echo $ad["title"]."<br/>";
  echo $ad["description"]."<br/>";
  echo $ad["url"]."<br/>";
}

  echo "<br/>";
echo "<p3> End of sponsored links <p3>";
  echo "<br/>";
    echo "<br/>";
    echo "<hr />";

foreach($results->fetchAll() as $result){
  echo $result["title"]."<br/>";
  echo $result["description"]."<br/>";
  echo $result["url"]."<br/>";
  echo "<hr />";
}



 ?>
