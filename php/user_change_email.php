<?php
   session_start();
   require('connect.php');

   if(!isset($_SESSION['logIN'])){
      header('Location: ../index.php');
   }

   if( isset($_POST['e_mail']) && isset($_POST['new_e_mail']) ){
      $old_email = $_POST['e_mail'];
      $new_email = $_POST['new_e_mail'];
      $nick = $_SESSION['nick'];

      //zabezpieczenie przed wstrzykiwaniem
      $old_email= $mysqli -> real_escape_string($old_email);
      $new_email = $mysqli -> real_escape_string($new_email);

      //pobranie z bazy emaila i porównanie z tym
      $sql = "SELECT email FROM users WHERE nick = '$nick'";
      $result = $mysqli -> query($sql);
      $row = $result -> fetch_assoc();

      if($old_email !== $row['email']){
         $error = "Podany stary e-mail nie jest taki sam jak w bazie!";

         header("location: ../user_settings.php?e_error=$error");
         exit();
      }

      //sprawdzenie emaila czy składa się z @ itp.
      if (filter_var($new_email, FILTER_VALIDATE_EMAIL) == FALSE) {
         $error = "Nowy e-mail zawiera jakiś błąd!";
         
         header("location: ../user_settings.php?e_error=$error");
         exit();
      }

      //update do bazy
      $sql = "UPDATE users SET email = '$new_email' WHERE nick = '$nick'";
      $result = $mysqli -> query($sql);

      header("location: ../user_settings.php");
      exit();
   }

   header('location:javascript://history.go(-1)');
   exit();
?>