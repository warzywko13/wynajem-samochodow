<?php
   session_start();
   require('connect.php');
   
   //jeśli istnieje komentarz
   if( isset($_POST['new_comment']) && isset($_POST['car'])){
      $new_comment = $_POST['new_comment'];
      $login = $_SESSION['id_nick'];
      $car = $_POST['car'];
   
      $new_comment = $mysqli -> real_escape_string($new_comment);
   
      //jeśli komentarz jest pusty
      if( strlen($new_comment) <= 0){
         header('location:javascript://history.go(-1)');
         exit();
      }
   
      $sql = "INSERT INTO comments(id_nick, comment, id_name) VALUES ('$login','$new_comment','$car')";

      $result = $mysqli -> query($sql);

      header("location: ../ofer.php?car=".$car);
      exit();
   }

   header('location:javascript://history.go(-1)');
   exit();
?>