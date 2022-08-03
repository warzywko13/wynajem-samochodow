<?php
   session_start();
   require('php/connect.php');

   if(!isset($_SESSION['logIN'])){
      header('Location: index.php');
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
   <link rel="stylesheet" href="css/style.css">
   <title>Wybor auta</title>
   <!--End Css-->
</head>
<body>
   <nav>
      <div class="back">
         <a href="#" class="hidden">Powrót</a>
      </div>
  <div class="logo"> <p> Wynajem pojazdów</p> </div>
      <div class="user">
         <a href="user_settings.php"><i class="fas fa-cog"></i> Profil</a>
      </div>
      <div class="user">
         <a href="<?php echo 'php/logOUT.php' ?>"><i class="fas fa-sign-out-alt"></i> Wyloguj</a>
      </div>
   </nav>

   <main>
      <?php
         if( isset($_SESSION['admin']) ){
            echo "<a class='add_vehicle' href='php/car_add.php'><button>Dodaj pojazd</button></a>";
         }
      ?>

      <table class="mydatatable table">
         <thead>
            <tr>
               <th>Nazwa</th>
               <th>Kategoria</th>
               <th>Cena</th>
               <th>Podgląd</th>

               <?php
                  //jeśli user jest adminem
                  if( isset( $_SESSION['admin'] ) ){
                     echo "<th>Usuń</th>
                     <th>Edytuj</th>";
                  }
               ?>

            </tr>
         </thead>
         <tbody>
            <?php
               $sql = "SELECT c.id, c.name, c.cash, c.img, cc.category FROM cars AS c JOIN category AS cc ON c.id_category = cc.id";
               $result = $mysqli -> query($sql);

               while($row = $result->fetch_assoc()){
                  echo "<tr>";
                     echo "<td>".$row['name']."</td>";
                     echo "<td>".$row['category']."</td>";
                     echo "<td>".$row['cash']."$</td>";
                     echo "<td><a href='ofer.php?car=".$row['id']."'><i class='fas fa-eye'></i></a></td>";

                     //jeśli user jest adminem
                     if( isset($_SESSION['admin']) ){
                        echo "<td><a href='php/car_delete.php?car=".$row['id']."'><i class='fas fa-trash'></i></a></td>";
                        echo "<td><a href='php/car_edit.php?car=".$row['id']."'><i class='fas fa-edit'></i></a></td>";
                     }

                  echo "</tr>";
               }
            ?>
         </tbody>
      </table>
   </main>
   <!--Start Script-->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
      <script>
         $('.mydatatable').DataTable({
               "lengthChange": false,
               "info": false,
               "language": {
                  "processing":     "Przetwarzanie...",
                  "search":         "Szukaj:",
                  "lengthMenu":     "Pokaż _MENU_ pozycji",
                  "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
                  "infoEmpty":      "Pozycji 0 z 0 dostępnych",
                  "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
                  "infoPostFix":    "",
                  "loadingRecords": "Wczytywanie...",
                  "zeroRecords":    "Nie znaleziono pasujących pozycji",
                  "emptyTable":     "Brak danych",
                  "paginate": {
                     "first":      "Pierwsza",
                     "previous":   "<",
                     "next":       ">",
                     "last":       "Ostatnia"
                  },
                  "aria": {
                     "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
                     "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
                  }
               }
         });
      </script>
   <!--End Script-->
</body>
</html>