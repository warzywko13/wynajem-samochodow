<?php
   session_start();
   require('connect.php');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--Start Css-->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
   <link rel="stylesheet" href="../css/style.css">
   <title>Dziękujemy</title>
   <!--End Css-->
</head>
<body class="start-panel">
   <nav>
      <div class="back">
         <a href="../cars.php">Powrót</a>
      </div>

      <div class="user">
         <a href="../user_settings.php"><i class="fas fa-cog"></i></a>
      </div>
      <div class="user">
         <a href="<?php echo "logOUT.php"; ?>"><i class="fas fa-sign-out-alt"></i> Wyloguj się</a>
      </div>
   </nav>
   <main>
      <div class="thankyou">
         <h1>Dziękuję za wynajem auta!</h1>
         <p>Kliknij w zębatke aby zobaczyć wynajęte auta!</p>
         <p></p>
      </div>
   </main>
</body>
</html>