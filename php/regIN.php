<?php
   session_start();
   require('connect.php');

   if(isset($_SESSION['logIN'])){
      header('Location: ../cars.php');
   }

   if(isset($_POST['r_login']) && isset($_POST['r_password']) && isset($_POST['r_password_repeat']) && isset($_POST['r_email'])){
      $login = $_POST['r_login'];
      $password = $_POST['r_password'];
      $password_repeat = $_POST['r_password_repeat'];
      $email = $_POST['r_email'];

      if(strlen($login) <= 5 && strlen($login) >= 20){
         $error = "Twój nick musi mieć od 5 do 10 liter!";
         header('Location: ../index.php?r_error='.$error);
         exit();
      }elseif(strlen($password) < 5){
         $error = "Twoje hasło musi być dłuższe niż 5 liter!";
         header('Location: ../index.php?r_error='.$error);
         exit();
      }elseif($password != $password_repeat){
         $error = "Hasła są różne!";
         header('Location: ../index.php?r_error='.$error);
         exit();
      }elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE ){
         $error = "Niepoprawny adres e-mail!";
         header('Location: ../index.php?r_error='.$error);
         exit();
      }else{
         $login = $mysqli -> real_escape_string($login);
         $email = $mysqli -> real_escape_string($email);
         $password = $mysqli -> real_escape_string($password);

         //Sprawdzenie czy podany nick już nie występuje w bazie
         $sql = "SELECT * FROM users WHERE nick = '$login' OR email = '$email'";
         $result = $mysqli -> query($sql);

         if($result -> num_rows > 0){
            $error = "Podany login lub e-mail występują już w bazie!";
            header('Location: ../index.php?r_error='.$error);
            exit();
         }

         //Generuj klucz
         $vkey = md5(time().$login);
         
         //Hashowanie md5 hasła
         $password = md5(md5($password));

         //Dane do bazy
         $sql = "INSERT INTO users (nick, pass, email, email_key) VALUES ('$login', '$password', '$email', '$vkey')";
         $insert = $mysqli -> query($sql);

         if($insert){
            //Email
            $to = $email;
            $subject = "Email verification";
            $message = "<a href='http://localhost/studia_projekt_beta/php/verify.php?vkey=$vkey'>Kliknij tutaj aby potwierdzić rejestracje</a>";
            $headers = "From: warzywko13@yahoo.com \r\n";
            $headers .= "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";

            mail($to, $subject, $message, $headers);

            header('location: thankYou.php?email='.$email);
         }
      }
   }
?>