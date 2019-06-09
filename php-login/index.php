<?php
session_start();

require 'database.php';
//Si existe el usuarios
if(isset($_SESSION['users_id'])){
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['users_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC); //Obtiene los datos del usuario


    $user = null;
    //verifica si hay resultados
    if (count($results) > 0) {
      $user = $results;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to your app</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!--Llama a un codigo en especifico !-->
   <?php require 'partials/header.php'?> 
   <!--Si hay un usuario conectado muestra lo siguiente-->
    <?php if(!empty($user)):?>
    <br> Welcome. <?= $user['email']; ?>
    <br>Usuario numero: <?=$user['id'];?>
    <br>You are Successfully Logged In
    <a href="logout.php"> Logout </a>
    <!--De lo contrario si el usuario no esta logeado-->
    <?php else:?>
    <h1>Please Login or SignUp</h1>
    <a href="login.php">Login</a>
    <a href="signup.php">SignUp</a>
    <?php endif ?>
</body>
</html>

