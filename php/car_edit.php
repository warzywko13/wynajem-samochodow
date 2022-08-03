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

   //jeśli formularz został wypełniony
   if( isset($_POST['name']) && isset($_POST['id_car']) && isset($_POST['category']) && isset($_POST['cash']) && isset($_POST['img']) && isset($_POST['engine']) && isset($_POST['v_max']) ){
      $name = $_POST['name'];
      $id_car = $_POST['id_car'];
      $cash = $_POST['cash'];
      $img = $_POST['img'];
      $category = $_POST['category'];
      $engine = $_POST['engine'];
      $v_max = $_POST['v_max'];


      $sql = array(
         "SET @id_category = (SELECT id FROM category WHERE category = '$category');",
         "UPDATE cars SET name='$name', id_category=@id_category, cash=$cash, img='$img' WHERE id = $id_car;",
         "UPDATE engine SET engine='$engine', v_max=$v_max WHERE id_name = $id_car;");

      foreach($sql as $row){
         $mysqli -> query($row);
      }

      header("location: ../cars.php");
      exit();
   }

   if( isset($_GET['car']) ){
      $id_car = $_GET['car'];
      //wyszukiwanie daynch z bazy
      $sql = "SELECT c.name, c.cash, c.img, c.id_category, e.engine, e.v_max FROM cars AS c JOIN engine AS e ON c.id = e.id_name WHERE c.id = $id_car";
      $result = $mysqli -> query($sql);
      $row = $result->fetch_assoc();

      $name = $row['name'];
      $cash = $row['cash'];
      $img = $row['img'];
      $category = $row['id_category'];
      $engine = $row['engine'];
      $v_max = $row['v_max'];
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
      <h1 class="text-center">Edytowanie samochodu</h1>

      <form action="car_edit.php" method="post">
         <div class="input-center">
            <input type="text" name="name" value="<?php echo $name;?>">
            <input type="number" name="id_car" class="hidden" value="<?php echo $id_car;?>">

            <?php
               //klasa pojazdu
               $sql = "SELECT id, category FROM category";
               $result = $mysqli -> query($sql);

               echo "<select name='category'>";

               while( $row = $result->fetch_assoc() ){
                  if(  $row['id'] == $id_category ){
                     echo "<option selected>".$row['category']."</option>";
                  }else{
                     echo "<option>".$row['category']."</option>";
                  }
               }

               echo "</select>";
            ?>

            <input type="number" name="cash" value="<?php echo $cash; ?>">
            <input type="text" name="img" value="<?php echo $img;  ?>">
            <input type="text" name="engine" value="<?php echo $engine;  ?>">
            <input type="text" name="v_max" value="<?php echo $v_max;  ?>">
            <input type="submit" value="Edytuj">
         </div>
      </form>
   </div>
</body>
</html>