<?php
   session_start();
   require('connect.php');

   if(isset($_GET['vkey'])){
      //Veryfikacja
      $vkey = $_GET['vkey'];
      $vkey = $mysqli -> real_escape_string($vkey);

      $sql = "SELECT email_key, validation FROM users WHERE email_key = '$vkey' AND validation = 0 LIMIT 1";
      $result = $mysqli -> query($sql);

      if($result -> num_rows == 1){
         //potwierdzenie emaila
         $sql = "UPDATE users SET validation = 1 WHERE email_key = '$vkey' LIMIT 1";
         $update = $mysqli -> query($sql);

         if(!$update){
            //$error = $mysqli -> error;
         }

      }else{
         $error = "Podane klucz jest nieprawidłowy lub już potwierdziłeś rejestracje!";
      }

   }else{
      $error = "Coś poszło nie tak :/";
   }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--Start Css-->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
   <link rel="stylesheet" href="../css/style.css">
   <title>Potwierdzenie rejestracji</title>
   <!--End Css-->
</head>
<body class="start-panel">
   <nav>
      <div class="back">
         <a href="#" class="hidden">Powrót</a>
      </div>
      
      <div class="user">
         <a href="<?php echo "../index.php"; ?>"><i class="fas fa-sign-out-alt"></i> Zaloguj się</a>
      </div>
   </nav>
   <main>
      <div class="thankyou">
         <h1>Rejestracja została potwierdzona!</h1>
         <?php
            if(isset($error)){
               echo "<p>$error</p>";
            }else{
               echo "<p>Możesz już zalogować się na swoje konto!</p>";
            }
         ?>
      </div>
   </main>
</body>
</html>