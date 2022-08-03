<?php
   session_start();
   require('connect.php');
      
   if(!isset($_SESSION['logIN'])){
      header('Location: ../index.php');
   }

   if( isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['rep_new_password']) ){
      $old_password = $_POST['old_password'];
      $new_password = $_POST['new_password'];
      $rep_new_password = $_POST['rep_new_password'];
      $login = $_SESSION['nick'];

      //zabezpiecznie przed wstrzykiwaniem
      $old_password = $mysqli -> real_escape_string($old_password);
      $new_password = $mysqli -> real_escape_string($new_password);
      $rep_new_password = $mysqli -> real_escape_string($rep_new_password);

      //zakodowanie w celu porównania z bazą
      $old_password = md5(md5($old_password));

      //sprawdzenie czy stare hasło jest poprawne
      $sql = "SELECT pass FROM users WHERE nick = '$login' AND pass = '$old_password'";
      $result = $mysqli -> query($sql);
      $row = $result->fetch_assoc();
      
      if( $old_password !== $row['pass']){
         $error = "Niepoprawne stare hasło!";

         header("location: ../user_settings.php?p_error=$error");
         exit();
      }

      //sprawdzenie czy nowe hasła są takie same
      if($new_password !== $rep_new_password){
         $error = "Nowe hasła nie są takie same!";

         header("location: ../user_settings.php?p_error=$error");
         exit();
      }

      //zakodowanie hasła do md5
      $new_password = md5(md5($new_password));

      //update hasła
      $sql = "UPDATE users SET pass = '$new_password' WHERE nick = '$login' LIMIT 1";
      $result = $mysqli -> query($sql);

      header('location: ../user_settings.php');
      exit();
   }

   header('location:javascript://history.go(-1)');
   exit();
?>