<?php
    session_start();
    require('php/connect.php');

    //SPRAWDZENIE CZY USER JEST ZALOGOWANY
    if(isset($_SESSION['logIN'])){
        header('Location: cars.php');
    }

?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Panel Logowania/Rejestracji</title>
</head>
<body class="start-panel">
    <?php 
        if(isset($_GET['r_error'])){
            echo '<form action="php/logIN.php" method="POST" id="login-panel" class="hidden">';
        }else{
            echo '<form action="php/logIN.php" method="POST" id="login-panel">';
        }
    ?>
        <h1>Panel Logowania</h1>
        <div class="buttons-center">
            <input class="input-text" type="text" name="l_login" placeholder="Login">
            <input class="input-text" type="password" name="l_password" placeholder="Hasło">
        </div>

        <?php
            if(isset($_GET['l_error'])){echo "<h2 class='error'>".$_GET['l_error']."</h2>";}
        ?>

        <div class="buttons-center">
            <input class="input-button" type="submit" value="Zaloguj">
            <input class="input-button" id="register" type="button" value="Zarejestruj">
        </div>
    </form>
    
    <?php 
        if(isset($_GET['r_error'])){
            echo '<form action="php/regIN.php" method="POST" id="register-panel">';
        }else{
            echo '<form action="php/regIN.php" method="POST" id="register-panel" class="hidden">';
        }
    ?>
    
        <h1>Panel Rejestracji</h1>
        <div class="buttons-center">
            <input class="input-text" type="text" name="r_login" placeholder="Login">
            <input class="input-text" type="password" name="r_password" placeholder="Hasło">
            <input class="input-text" type="password" name="r_password_repeat" placeholder="Powtórz Hasło">
            <input class="input-text" type="email" name="r_email" placeholder="E-mail">
        </div>

        <?php
            if(isset($_GET['r_error'])){echo "<h2 class='error'>".$_GET['r_error']."</h2>";}
        ?>

        <div class="buttons-center">
            <input class="input-button" id="login" type="button" value="Zaloguj">
            <input class="input-button" type="submit" value="Zarejestruj">
        </div>
    </form>
    <script src="js/index_switch.js"></script>
</body>
</html>