<?php
   session_start();
   require('connect.php');

   if(!isset($_SESSION['logIN'])){
      header('Location: ../index.php');
   }

   $id_nick = $_SESSION['id_nick'];

   //usunięcie wszystkich danych z komentarzy
   $sql = "DELETE FROM comments WHERE id_nick = $id_nick";
   $mysqli -> query($sql);

   //usunięcie danych z wynajęć
   $sql = "DELETE FROM rents WHERE id_nick = $id_nick";
   $mysqli -> query($sql);

   //usunięcie danych z admins
   $sql = "DELETE FROM admins WHERE id_nick = $id_nick";
   $mysqli -> query($sql);

   //usunięcie danych z konta
   $sql = "DELETE FROM users WHERE id = $id_nick";
   $mysqli -> query($sql);

   header('Location: logOUT.php');
   exit();
?>