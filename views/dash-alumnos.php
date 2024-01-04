<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/dashboardAdmin.css">
    <link rel="stylesheet" href="/styles/dashAdminSmall.css">
    <title>Dashboard</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="/assets/logo-university_no_background.svg" alt="Logo">
            <p>&nbsp;&nbsp;UNIVERSIDAD</p>
        </div>
        <div class="box1">
            <p>Bienvenido Alumno</p>
        </div>
        <div class="box2">
            <div class="menu-admin">
                <h5>MENÚ ALUMNOS</h5>
                <div class="menuIcons"><a href="#"><img src="/assets/icono-edit.svg" alt="Materias Alumno">Materias</a></div>

            </div>
        </div>
    </div>

    <div class="header">
        <div class="menu">
            <ul>
                <li class="menuBar">&#9776;</li>
                <li>HOME</li>
            </ul>
        </div>

        <div class="rol">
            <ul>
                <li>Alumno &nbsp;&nbsp;&#x25BC;
                    <ul class="dropdown">
                        <li><a href="#"><img src="/assets/icono-profile.svg" alt="Profile Img">Profile</a></li>
                        <li><a href="/models/logout.php"><img src="/assets/icono-logout.svg" alt="Profile Img">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <div class="dashboard-title">
        <h1>Dashboard</h1>
    </div>
    <div class="home-dashboard">
        <a href="/views/dash-alumnos.php" class="actualPage">Home</a> / Dashboard
    </div>



    <div class="container">
        <div class="content">

            <div class="dashboard-subtitle">Bienvenido Estudiante Universidad</div>
            <div class="dashboard-text">Recuerda revisar siempre tus materias registradas y las calificaciones.<br>
                Si tienes alguna inconformidad, recuerda consultar con tu maestro asignado.</div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-left">Copyright (C) 2014-2021 <span class="footer-left1" style="color: #337ab7;">AdminLTE.io.</span>
            <span>All rights reserved.</span>
        </div>
        <div class="footer-right">Created by Omar Osorio / Funval 2023-2024</div>
    </div>


</body>


</html>