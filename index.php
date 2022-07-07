<?php

$mesto;
$remeslo;


$list_of_city = ["prachatice", "strakonice", "ceske_budejovice"];
$list_of_crafts = ["elektro", "instalater", "zednik", "obkladac", "strechy"];

require_once("include/head.php");
  
if(isset($_GET["mesto"]) && in_array($_GET["mesto"], $list_of_city)) {
   require_once("nav/nav_crafts.php");
} else {
   require_once("nav/nav_city.php");
} #if session id = admin -> show administration link

?>



<main class="container d-flex flex-wrap">


   
<?php   #list of craftsman or main

if(isset($_GET["mesto"]) && in_array($_GET["mesto"], $list_of_city)) {
   
   if(isset($_GET["remeslo"]) && in_array($_GET["remeslo"], $list_of_crafts)) {

      $dir = "city/".$_GET["mesto"]."/".$_GET["remeslo"];
      $crafts = scandir($dir);
      
      foreach($crafts as $craft) {
         
         if(!is_dir($craft)) {
            require_once($dir."/".$craft);
         }
      }
   }
}

?>



<?php require_once("include/footer.php") ?>