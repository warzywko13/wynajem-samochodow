<?php
   session_start();
   require('connect.php');

   if(!isset($_SESSION['logIN'])){
      header('Location: ../index.php');
      exit();
   }

   //sprawdzanie czy user jest adminem
   if( !isset($_SESSION['admin']) ){
      header('Location: ../cars.php');
      exit();
   }

   //sprawdzanie czy istnieje id car do usunięcia
   if( isset($_GET['car']) ){
      $car = $_GET['car'];

      //zabezpieczenie przed wstrzykiwaniem
      $car = $mysqli -> real_escape_string($car);

      //usunięcie car z bazy
      $sql = array(
         "DELETE FROM comments WHERE id_name = $car",
         "DELETE FROM rents WHERE id_cars = $car",
         "DELETE FROM engine WHERE id_name = $car",
         "DELETE FROM cars WHERE id = $car LIMIT 1");

      foreach($sql as $row){
         $mysqli -> query($row);
         echo $mysqli->error;
      }

      //powrót do cars.php
      header('location: ../cars.php');
      exit();
   }

   header('location:javascript://history.go(-1)');
   exit();
?>