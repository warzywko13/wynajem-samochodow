<?php
   session_start();
   require('connect.php');

   if(isset($_GET['email'])){
      $email = $_GET['email'];
   }else{
      header("../Location: index.php");
   }
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
   <main>
      <div class="thankyou">
         <h1>Dziękuję za rejestracje!</h1>
         <p>Wiadomość potwierdzająca rejestracje została wysłana na twoje konto e-mail: </p>
         <p><?php echo $email;?></p>
      </div>
   </main>
</body>
</html>