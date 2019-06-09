<?php 
//Llamo a la base de datos
require 'database.php';

$message = '';
//Si no estan vacios los campos del formulario
    if(!empty($_POST['email']) && !empty($_POST['password'])){ 
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //Encriptar contraseña
        $stmt->bindParam(':password', $password);

        if($stmt->execute()){
            $message='Successfully created new user';
        }else{
            $message='Sorry there must have been an issue creating your account';
        }
    }
?>
<!--################################  HTML  ######################################################-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<!--Para no estar copiando y pegando codigo simplemente en una clase lo definimos y aqui lo llamamos-->
<?php require 'partials/header.php'?>
<!--Mostramos message para ver si se esta realizando todo normal-->
<?php if(!empty($message)):?>
    <p> <?= $message ?> </p>
    <?php endif; ?>



<h1>SignUp</h1>
<span>or <a href="login.php">login</a></span>

<form action="signup.php" method="POST">
<input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
<input type="submit" value="Submit">
</form>

</body>
</html>

