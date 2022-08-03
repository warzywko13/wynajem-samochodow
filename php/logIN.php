<?php
   session_start();
   require('connect.php');

   if(isset($_SESSION['logIN'])){
      header('Location: ../cars.php');
   }

   //wszystkie dane do logowania
   if(isset($_POST['l_login']) && isset($_POST['l_password'])){
      $login = $_POST['l_login'];
      $password = $_POST['l_password'];

      if(strlen($login) <= 0 || strlen($password) <= 0){
         header('Location: ../index.php?l_error=true');
      }

      //Zabezpieczenie przed wstrzykiwaniem php
      $login = $mysqli -> real_escape_string($login);
      $password = $mysqli -> real_escape_string($password);

      //Kodowanie md5 hasła
      $new_password = md5(md5($password));

      $sql = "SELECT * FROM users WHERE nick = '$login' AND pass = '$new_password'";
      $result = $mysqli -> query($sql);

      //Jeśli dane są poprawne
      if($result -> num_rows > 0){
         $row = $result->fetch_assoc(); 

         if($row['validation'] == 0){
            $error = "Nie potwierdziłeś e-maila!";
            header('Location: ../index.php?l_error='.$error);
            exit();  
         }

         $_SESSION['logIN'] = true;
         $_SESSION['nick'] = $login;
         $_SESSION['id_nick'] = $row['id'];

         //sprawdzanie czy user jest adminem
         $sql = "SELECT id_nick FROM admins WHERE id_nick = '".$_SESSION['id_nick']."'";
         $result = $mysqli -> query($sql);

         if($result -> num_rows > 0){
            $_SESSION['admin'] = true;
         }

         header('Location: ../cars.php');
      }else{
         $error = "Błędny login lub hasło!";
         header('Location: ../index.php?l_error='.$error);
      }
   }
?>