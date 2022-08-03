<?php
   session_start();
   require('connect.php');
   
   if(!isset($_SESSION['logIN'])){
      header('Location: index.php');
   }

   if(isset($_POST['login'])){
      $old_nick = $_SESSION['nick'];
      $new_login = $_POST['login'];

      if (strlen($new_login) <= 3) {
         $error = "Nowy nick zawiera jakiś błąd!";
         
         header("location: ../user_settings.php?n_error=$error");
         exit();
      }
          
      //update nowego nicku do bazy
      $sql = "UPDATE users SET nick = '$new_login' WHERE nick = '$old_nick'";
      $result = $mysqli -> query($sql);

      //update nicku w sesji
      $_SESSION['nick'] = $new_login;

      header('location: ../user_settings.php');
      exit();
   }

   header('location:javascript://history.go(-1)');
   exit();
?>