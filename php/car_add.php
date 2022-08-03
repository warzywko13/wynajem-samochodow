<?php
   session_start();
   require('connect.php');

   if(!isset($_SESSION['logIN'])){
      header('Location: index.php');
      exit();
   }

   //sprawdzanie czy user jest adminem
   if( !isset($_SESSION['admin']) ){
      header('Location: ../cars.php');
      exit();
   }

   //sprawdzamy czy pole formularz został wypełniony
   if( isset($_POST['car_name']) && isset($_POST['category']) && isset($_POST['cash']) && isset($_POST['link']) && isset($_POST['engine']) && isset($_POST['v_max']) ){
      $car_name = $_POST['car_name'];
      $category = $_POST['category'];
      $cash = $_POST['cash'];
      $link = $_POST['link'];
      $engine = $_POST['engine'];
      $v_max = $_POST['v_max'];

      //zabezpieczenie przed wstrzykiwaniem
      $car_name = $mysqli -> real_escape_string($car_name);
      $category = $mysqli -> real_escape_string($category);
      $cash = $mysqli -> real_escape_string($cash);
      $link = $mysqli -> real_escape_string($link);
      $engine = $mysqli -> real_escape_string($engine);
      $v_max = $mysqli -> real_escape_string($v_max);

      //dodanie do bazy (dodanie do bazy cars oraz engine)
      $sql = array(
         "SET @category = (SELECT id FROM category WHERE category = '$category')", 
         "INSERT INTO cars(name, id_category, cash, img) VALUES ('$car_name', @category, $cash, '$link')",
         "SET @car = (SELECT id FROM cars WHERE name = '$car_name')",
         "INSERT INTO engine(id_name, engine, v_max) VALUES (@car, '$engine', $v_max);");

         foreach($sql as $row){
            $mysqli -> query($row);
         }
      
      //powrót do cars.php
      header("location: ../cars.php");
      exit();
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
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css"/>
   <link rel="stylesheet" href="../css/style.css">
   <title>Wybor auta</title>
   <!--End Css-->
</head>
<body>
   <nav>
      <div class="back">
         <a href="../cars.php">Powrót</a>
      </div>

      <div class="user">
         <a href="../user_settings.php"><i class="fas fa-cog"></i> Profil</a>
      </div>
      <div class="user">
         <a href="<?php echo 'php/logOUT.php' ?>"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
      </div>
   </nav>
      <div class="add_car">
         <h1 class="text-center">Dodawanie samochodu</h1>

         <form action="car_add.php" method="post">
         <div class="input-center">
            <input type="text" name="car_name" placeholder="nazwa pojazdu">

               <?php
               //klasa pojazdu
               $sql = "SELECT category FROM category";
               $result = $mysqli -> query($sql);

               echo "<select name='category'>";

               while( $row = $result->fetch_assoc() ){
                  echo "<option>".$row['category']."</option>";
               }

               echo "</select>";
            ?>

      
            <input type="number" name="cash" placeholder="Koszt">
            <input type="text" name="link" placeholder="Adres obrazu">
            <input type="text" name="engine" placeholder="Silnik">
            <input type="text" name="v_max" placeholder="V-max">

            <input type="submit" value="Dodaj">
         </div>
      </form>
   </div>
</body>
</html>