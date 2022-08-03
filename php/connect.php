<?php
   $server = "localhost";
   $user = "root";
   $password = "";
   $database = "projekt_studia";

   $mysqli = NEW MySQLi($server, $user, $password, $database);

   if($mysqli -> connect_error){
      die("Connection failed: " . $mysqli->connect_error);
   }

   //echo "Connected successfully";
?>