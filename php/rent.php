<?php
   session_start();
   require('connect.php');

   if( isset($_POST['package']) && isset($_POST['days']) && isset($_POST['car'])){
      //dane z formularza
      $package = $_POST['package'];
      $car = $_POST['car'];
      $days = $_POST['days']; //liczba dni wraz z ceną auta
      $user = $_SESSION['id_nick'];

      //zabezpieczenie przed wstrzykiwaniem
      $package = $mysqli -> real_escape_string($package);
      $days = $mysqli -> real_escape_string($days);
      $car = $mysqli -> real_escape_string($car);
      
      //pobranie z package jego id oraz ceny

      $sql = "SELECT id FROM packages WHERE cost = $package";
      $result = $mysqli -> query($sql);
      $row = $result ->fetch_assoc();
      
      $id_package = $row['id'];

      //pobranie kasy uzytkownika z bazy
      $sql = "SELECT cash FROM users WHERE id = '$user' LIMIT 1";
      $result = $mysqli -> query($sql);
      $row = $result ->fetch_assoc();

      $user_money = $row['cash'];
      
      //obliczenie kosztu
      $sql = "SELECT cash FROM cars WHERE id = '$car'";
      $result = $mysqli -> query($sql);
      $row = $result ->fetch_assoc();

      $car_cost = $row['cash'];
      $days = $days/$car_cost; //naprawiona ilość dni

      //cała cena wraz z dniami oraz pakietem
      $full_car_cost = ($car_cost*$days) + $package;
      
      //sprawdzenie czy usera stać
      if($user_money < $full_car_cost){
         $o_error = "Nie stać cie na wynajem tego pojazdu!";

         echo $full_car_cost."<br>";
         echo $user_money;

         header("location: ../ofer.php?car=$car&o_error=$o_error");
         exit();
      }
      
      //usunięcie kasy z konta gracza
      $user_money = $user_money - $full_car_cost;
      $sql = "UPDATE users SET cash = $user_money";
      $mysqli -> query($sql);

      //dodaniedo bazy wynajęcia
      $sql = "INSERT INTO rents (id_nick, days, id_package, id_cars) VALUES($user, $days, $id_package, $car)";
      $result = $mysqli -> query($sql);

      //przeniesienie na stronę z podziękowaniem za wynajem
      header('location: rent_thanks.php');
      exit();
   }

   header('location:javascript://history.go(-1)');
   exit();
?>