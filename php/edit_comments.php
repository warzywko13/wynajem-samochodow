<?php
   session_start();
   require('connect.php');

   if( isset($_POST['edit_comment']) && isset($_POST['car']) && isset($_POST['id']) ){
      $id = $_POST['id'];

      //pobieranie nicku z bazy do ifa
      $sql = "SELECT u.nick, c.id_nick FROM comments AS c JOIN users AS u ON c.id_nick = u.id WHERE c.id = '$id' LIMIT 1";
      $result = $mysqli -> query($sql);
      $row = $result->fetch_assoc();
      $nick = $row['nick'];

      //sprawdza czy nick jest równy osobie edytującej
      if($nick != $_SESSION['nick']){
         header('location:javascript://history.go(-1)');
         exit();
      }

      //przypisanie warotości
      $edit_comment = $_POST['edit_comment'];
      $car = $_POST['car'];
      $id_nick = $_SESSION['id_nick'];

      //update bazy
      $sql = "UPDATE comments SET comment='$edit_comment' WHERE id = $id AND id_nick = '$id_nick'";
      $result = $mysqli -> query($sql);

      header("location: ../ofer.php?car=$car");
      exit();
   }

   header('location:javascript://history.go(-1)');
   exit();
?>