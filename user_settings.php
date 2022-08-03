<?php
   session_start();
   require('php/connect.php');

   if(!isset($_SESSION['logIN'])){
      header('Location: index.php');
   }

   $login = $_SESSION['nick'];

   //wyciąganie email i kasy z tabeli uzytkowników
   $sql = "SELECT email, cash FROM users WHERE nick = '$login'";
   $result = $mysqli -> query($sql);
   $row = $result->fetch_assoc();

   $email = $row['email'];
   $money = $row['cash'];
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
   <link rel="stylesheet" href="css/style.css">
   <title>Ustawienia konta</title>
   <!--End Css-->
</head>
<body>
   <nav>
      <div class="back">
         <a href="cars.php">Powrót</a>
      </div>

      <div class="user">
         <a href="#" class="hidden"><i class="fas fa-cog"></i></a>
      </div>
      <div class="user">
         <a href="php/logOUT.php"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
      </div>
   </nav>

   <h1 class="money">Stan Twojego Portfela: <?php echo $money; ?>$</h1>

   <div class="user_settings">
      <div class="left">
         <h1 class="text-center">Edytuj swoje dane</h1>
         <form action="php/user_change_nick.php" method="post">
            <div class="input-center">
               <input type="text" value="<?php echo $login; ?>" disabled="disabled">
               <input type="text" name="login" placeholder="Nowy Login">
            </div>

            <?php
               if( isset($_GET['n_error']) ){echo "<div class='error'>".$_GET['n_error']."</div>";}
            ?>

            <div class='buttons-center'>
               <input type="submit" value="Zmien" class="button">
            </div>
         </form>

         <form action="php/user_change_email.php" method="post">
            <div class="input-center">
               <input type="text" name="e_mail" value="<?php echo $email; ?>" readonly>
               <input type="text" name="new_e_mail" placeholder="Nowy e-mail">
            </div>

            <?php
               if( isset($_GET['e_error']) ){echo "<div class='error'>".$_GET['e_error']."</div>";}
            ?>
           
            <div class="buttons-center">
               <input type="submit" value="Zmien" class="button">
            </div>
         </form>

         <form action="php/user_change_password.php" method="post">
            <div class="input-center">
               <input type="password" name="old_password" placeholder="Stare Hasło">
               <input type="password" name="new_password" placeholder="Nowe Hasło">
               <input type="password" name="rep_new_password" placeholder="Powtórz Nowe Hasło">
            </div>

            <?php
            if( isset($_GET['p_error']) ){echo "<div class='error'>".$_GET['p_error']."</div>";}
            ?>

            <div class="buttons-center">
               <input type="submit" value="Zmien" class="button">
            </div>
         </form>

         <form action="php/user_delete_account.php" method="post">
            <div class="buttons-center">
               <input type="submit" value="Usun konto" class="button">
            </div>
         </form>
      </div>

      <div class="right">
         <h1 class="text-center">Wynajęte pojazdy!</h1>
         <?php
            echo "<table>
                     <tr>
                        <th>Pojazd</th>
                        <th>Dni</th>
                     </tr>";

            $sql = "SELECT c.name, r.days FROM rents AS r JOIN cars AS c ON r.id_cars = c.id WHERE r.id_nick = ".$_SESSION['id_nick'];
            $result = $mysqli -> query($sql);

            while( $row = $result->fetch_assoc() ){
               echo "<tr>
                        <td>".$row['name']."</td>
                        <td>".$row['days']."</td>
                     </tr>";
               
            }

            echo "</table>";
         ?>
      </div>
   </div>
</body>
</html>