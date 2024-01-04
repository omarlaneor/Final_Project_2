<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/login.css">
    <title>Login
    </title>
</head>

<body>
    <form action="../index.php" method="post">
        <div class="logo-container">
            <div class="logo">
                <img src="/assets/logo-university_no_background.svg" alt="Logo Universidad">
            </div>
        </div>
        <div class="container">
            <p class="titulo">Bienvenido. Ingresa a tu cuenta</p>
            <div class="inputs">
                <input type="text" placeholder="Email" name="correo">
            </div>
            <div class="inputs">
                <input type="password" placeholder="Password" name="password">
            </div>
            <div class="btnIngresar">
                <a href="dashboard.php"><button type="submit" name="btnIngresar">Ingresar</button></a>
            </div>

        </div>
    </form>
</body>

</html>