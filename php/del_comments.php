<?php
   session_start();
   require('connect.php');

   if(isset($_GET['nick']) && isset($_GET['car']) && isset($_GET['id'])){
      if($_GET['nick'] == $_SESSION['nick'] || isset($_SESSION['admin'])){
         $nick = $_GET['nick'];
         $car = $_GET['car'];
         $id = $_GET['id'];

         $id = $mysqli -> real_escape_string($id);

         $sql = "DELETE FROM comments WHERE id = '$id'";

         $result = $mysqli -> query($sql);
         header("location: ../ofer.php?car=$car");
         exit();
      }
   }

   header('location:javascript://history.go(-1)');
   exit();
?>