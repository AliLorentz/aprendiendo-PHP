<?php

    session_start();
    require 'database.php';

    //Si no esta vacio manejar sus datos de el method POST
    if(!empty($_POST['email'])&& !empty($_POST['password'])){
        //Consulta
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message='';

        //Obtiene el id      y Compara la contraseña que esta colocando el usuario a la de la base de datos
        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['users_id']=$results['id'];
            header("Location: /php-login");
        }else{
            $message = 'Credenciales no existentes';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>

    <?php require 'partials/header.php'?>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">Register</a></span>
    <form action="login.php" method="POST">
        <input type="text" name="email" placeholder="Enter your Email"> 
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Send">
    </form>
</body>
</html>