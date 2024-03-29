<?php

session_start();

if ($_SESSION["correo"] === null) {
    header("location: ../views/login.php");
}



$conn = mysqli_connect("localhost", "root", "", "university");
$sql = "SELECT * FROM alumnos";

$query = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/modal-create-alumnos.css">

    <title>Dashboard</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="/assets/rounded_no_background.svg" alt="Logo">
            <p>&nbsp;&nbsp;UNIVERSIDAD</p>
        </div>
        <div class="box1">
            <p>Alumnos</p>
            <p>Bienvenido Maestro Querido</p>
        </div>
        <div class="box2">
            <div class="menu-admin">
                <h5>MENÚ MAESTROS</h5>
                <div class="menuIcons"><a href="../views/maestro-alumno.php"><img src="/assets/icono-alumnos.svg" alt="Alumnos">Alumnos</a></div>
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
                <li>Maestro &nbsp;&nbsp;&#x25BC;
                    <ul class="dropdown">
                        <li><a href="#"><img src="/assets/icono-profile.svg" alt="Profile Img">Profile</a></li>
                        <li><a href="/models/logout.php"><img src="/assets/icono-logout.svg" alt="Profile Img">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <div class="dashboard-title">
        <h1>Alumnos de la clase </h1>
    </div>
    <div class="home-dashboard">
        <a href="../views/dash-maestros.php" class="actualPage">Home</a> / Dashboard
    </div>



    <div class="container">
        <div class="content">

            <div class="info">
                <h4>Información de Alumnos</h4>
            </div>


            <div class="linksContainer">
                <ul class="links">
                    <li><a class="linkOpc" href="#">Copy</a></li>
                    <li><a class="linkOpc" href="/models/excel.php">Excel</a></li>
                    <li><a class="linkOpc" href="/models/pdf.php">PDF</a></li>
                    <li><a class="linkOpc" href="#">Column visibility &#x25BC;</a></li>
                </ul>

                <form action="/buscar" method="GET">
                    <label for="busqueda">Search:</label>
                    <input type="text" id="busqueda" data-table="table_id" name="q" placeholder="Escribe aquí...">
                </form>

            </div>

            <table class="clases table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre del Alumno</th>
                        <th>Calificación</th>
                        <th>Mensajes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = mysqli_fetch_array($query)) : ?>

                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nombre'] ?> <?= $row['apellido'] ?> </td>
                            <td>0.00</td>
                            <td class="mensajes">
                                <p>No hay mensajes</p>
                            </td>

                            <td class="acciones">
                                <a href="#" class="btnIcon">
                                    <img src="/assets/icono-edit.svg" alt="Edit Info" class="editIcon">
                                </a>
                                <a href="#" class="btnIconDel">
                                    <img src="/assets/icono-enviar.svg" alt="Delete Info" class="deleteIcon">
                                </a>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                    <?php
                    function getName($id_clase, $conn)
                    {
                        $query = mysqli_query($conn, "SELECT clase FROM clases WHERE id = '$id_clase'");
                        $row = mysqli_fetch_array($query);
                        return $row ? $row['clase'] : 'No asignada';
                    }
                    ?>

                </tbody>
            </table>

            <div class="pagination">
                <button>PREV</button>
                <button>1</button>
                <button>2</button>
                <button>NEXT</button>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-left">Copyright (C) 2014-2021 <span class="footer-left1" style="color: #337ab7;">AdminLTE.io.</span>
            <span>All rights reserved.</span>
        </div>
        <div class="footer-right">Created by Omar Osorio / Funval 2023-2024</div>
    </div>

    <script src="/scripts/search.js"></script>

</body>


</html>