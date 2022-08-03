<?php
   session_start();
   require('php/connect.php');

   if(!isset($_SESSION['logIN'])){
      header('Location: index.php');
      exit();
   }

   if(!isset($_GET['car'])){
      header('Location: cars.php');
      exit();
   }

   $car = $_GET['car'];

   $sql = "SELECT c.name, c.cash, c.img, e.engine, v_max FROM cars AS c JOIN engine AS e ON e.id_name = c.id WHERE c.id = '$car'";
   $result = $mysqli -> query($sql);

   $row = $result->fetch_assoc();

   /*Dane z bazy*/
   $id_nazwa = $row['name'];
   $cena = $row['cash'];
   $silnik = $row['engine'];
   $v_max = $row['v_max'];

?>
<!DOCTYPE html>
<html lang="pl">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--Start Css-->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
   <link rel="stylesheet" href="css/style.css">
   <title>Wybor auta</title>
   <!--End Css-->
</head>
<body>
   <nav>
      <div class="back">
         <a href="cars.php">Powrót</a>
      </div>

      <div class="user">
         <a href="user_settings.php"><i class="fas fa-cog"></i> Profil</a>
      </div>
      <div class="user">
         <a href="php/logOUT.php"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
      </div>
   </nav>

   <div class="parent">
      <div class="div2">
         <table>
            <tr>
               <th>Silnik</th>
               <th>V-max</th>
            </tr>
            <tr>
               <td><?php echo $silnik; ?></td>
               <td id="calc_vmax"><?php echo $v_max; ?></td>
            </tr>
         </table>
      </div>

      <div class="div3">
         <img src="<?php echo $row['img']; ?>">

         <h3>Cena: <span id="cost" name="cost"><?php echo $cena; ?>$</span></h3>

         <form action="php/rent.php" method="post">
            <div class="selection-area">
               <label for="cars">Poziom auta:</label>
               
               <?php
                  $sql = "SELECT package, cost FROM packages";
                  $result = $mysqli -> query($sql);

                  echo "<select name='package' id='package'>";

                  while( $row = $result->fetch_assoc() ){
                     echo "<option value='".$row['cost']."'>".$row['package']."</option>";
                  }

                  echo "</select>";
               ?>
      <br><br>
               <label for="days">Ilość dni:</label>
      
               <select name="days" id="days">
                  <option value="<?php echo $cena*1; ?>">1</option>
                  <option value="<?php echo $cena*2; ?>">2</option>
                  <option value="<?php echo $cena*3; ?>">3</option>
                  <option value="<?php echo $cena*4; ?>">4</option>
                  <option value="<?php echo $cena*5; ?>">5</option>
                  <option value="<?php echo $cena*6; ?>">6</option>
                  <option value="<?php echo $cena*7; ?>">7</option>
               </select>
            </div>

            <input class="hidden" type="text" name="car" value="<?php echo $car; ?>">
   
            <div class="buttons-center">
               <input type="submit" id="wynajmij" value="Wynajmij">
            </div>

            <?php
               if( isset($_GET['o_error']) ){
                  echo "<div class='error'>".$_GET['o_error']."</div>";
               }
            ?>

         </form>
      </div>

      <div class="div4">
         <table>
            <tr>
               <th>Tuning</th>
               <th>Poziom</th>
            </tr>
            <tr>
               <td>Skrzynia</td>
               <td id="gear">1 lvl</td>
            </tr>
            <tr>
               <td>Cooler</td>
               <td id="cooler">1 lvl</td>
            </tr>
            <tr>
               <td>Chip</td>
               <td id="chip">1 lvl</td>
            </tr>
         </table>
      </div>
   </div>

   <div class="comments-area">
      <h1>Komentarze:</h1>

      <?php

         if(isset($_GET['edit']) && isset($_GET['id'])){
            $id = $_GET['id'];
            $id = $mysqli -> real_escape_string($id);

            $sql = "SELECT * FROM comments WHERE id = '$id' LIMIT 1";
            $result = $mysqli -> query($sql);

            $row = $result->fetch_assoc();
            $comments = $row['comment'];

            echo "<form action='php/edit_comments.php' method='post'>
                     <textarea name='edit_comment' id='new_comment'>$comments</textarea>
                     <input type='text' name='id' value='$id' class='hidden'>
                     <input type='text' name='car' value='$car' class='hidden'>
                     <div class='buttons-center'>
                        <input type='submit' id='wstaw' value='Edytuj komentarz'>
                     </div>
                  </form>";
         }else{
            echo "<form action='php/add_comments.php' method='post'>
                     <textarea name='new_comment' id='new_comment'></textarea>
                     <input type='text' name='car' value='$car' class='hidden'>
                     <div class='buttons-center'>
                        <input type='submit' id='wstaw' value='Wstaw komentarz'>
                     </div>
                  </form>";
         }
      ?>

      <!-- Z tego składa się komentarz --> 
      <?php

         $sql = "SELECT c.id, u.nick, c.comment, ca.name FROM comments AS c JOIN users AS u ON c.id_nick = u.id JOIN cars AS ca ON ca.id = c.id_name WHERE ca.name = '$id_nazwa' ORDER BY c.id DESC";

         $result = $mysqli -> query($sql);

         while( $row = $result->fetch_assoc() ){
            $id = $row['id'];
            $nick = $row['nick'];
            $komentarz = $row['comment'];
            $nazwa = $row['name'];

            echo "<div class='comments-data'>
                     <div class='user'>
                        <i class='fas fa-user'></i>
                        <h3>$nick</h3>
                     </div>

                     <div class='comments'>".nl2br($komentarz)."</div>";

                     //jeśli to jest komentarz usera a zarazem jest adminem lub jeśli to usera ale nie jest adminem
                     if( ( $_SESSION['nick'] == $nick && isset($_SESSION['admin']) ) || ( $_SESSION['nick'] == $nick && !isset($_SESSION['admin']) ) ){
                        echo "<dir class='settings'>
                           <a href='php/del_comments.php?nick=$nick&car=$car&id=$id'><i class='fas fa-trash'></i></a>
                           <a href='ofer.php?car=$car&edit=true&id=$id'><i class='fas fa-edit'></i></a>
                        </dir>";
                     }

                     //jeśli jest tylko adminem
                     if( isset($_SESSION['admin']) && $_SESSION['nick'] != $nick){
                        echo "<dir class='settings'>
                           <a href='php/del_comments.php?nick=$nick&car=$car&id=$id'><i class='fas fa-trash'></i></a>
                        </dir>";
                     }
            echo "</div>";
         }
      ?>
      <!-- /Z tego składa się komentarz -->
         
   </div>

   <script src="js/cost_calc.js"></script>
</body>
</html>