<?php

session_start();

if ($_SESSION["correo"] === null) {
    header("location: ../views/login.php");
}



$conn = mysqli_connect("localhost", "root", "", "university");

$sql = "SELECT clases.id AS id_clase, clases.clase, maestros.name, maestros.lastname
        FROM clases
        LEFT JOIN maestros ON clases.id = maestros.id_clase";

$query = mysqli_query($conn, $sql);

$sql_alumnos = "SELECT id_clase, COUNT(*) AS total_alumnos
                FROM alumnos
                GROUP BY id_clase";

$query_alumnos = mysqli_query($conn, $sql_alumnos);

$total_alumnos_por_clase = [];
while ($row_alumnos = mysqli_fetch_assoc($query_alumnos)) {
    $total_alumnos_por_clase[$row_alumnos['id_clase']] = $row_alumnos['total_alumnos'];
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/modal-addClases.css">

    <title>Dashboard</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="/assets/rounded_no_background.svg" alt="Logo">
            <p>&nbsp;&nbsp;UNIVERSIDAD</p>
        </div>
        <div class="box1">
            <p>Clases</p>
            <p>Bienvenido Administrador</p>
        </div>
        <div class="box2">
            <div class="menu-admin">
                <h5>MENÚ ADMINISTRACIÓN</h5>
                <div class="menuIcons"><a href="/views/dash-permisos.php"><img src="/assets/icono-permisos.svg" alt="Permisos">Permisos</a></div>
                <div class="menuIcons"><a href="/views/modal-addMaestros.php"><img src="/assets/icono-maestros.svg" alt="Maestros">Maestros</a></div>
                <div class="menuIcons"><a href="../views/modal-addAlumnos.php"><img src="/assets/icono-alumnos.svg" alt="Alumnos">Alumnos</a></div>
                <div class="menuIcons"><a href="/views/modal-classes.php"><img src="/assets/icono-clases.svg" alt="Clases">Clases</a></div>
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
                <li>Administrador &nbsp;&nbsp;&#x25BC;
                    <ul class="dropdown">
                        <li><a href="#"><img src="/assets/icono-profile.svg" alt="Profile Img">Profile</a></li>
                        <li><a href="/models/logout.php"><img src="/assets/icono-logout.svg" alt="Profile Img">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>


    <div class="dashboard-title">
        <h1>Lista de Clases</h1>
    </div>
    <div class="home-dashboard">
        <a href="../views/dashboardAdmin.php" class="actualPage">Home</a> / Dashboard
    </div>



    <div class="container">
        <div class="content">

            <div class="info">
                <h4>Información de Clases</h4>
                <button type="submit" class="btnInfo">Agregar Clase</button>
                </a>
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
                        <th>Clase</th>
                        <th>Maestro Asignado</th>
                        <th>Alumnos Inscritos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = mysqli_fetch_array($query)) : ?>

                        <tr>
                            <td><?= $row['id_clase'] ?></td>
                            <td><?= $row['clase'] ?></td>
                            <td><?= $row['name'] . ' ' . $row['lastname'] ?></td>
                            <td><?= isset($total_alumnos_por_clase[$row['id_clase']]) ? $total_alumnos_por_clase[$row['id_clase']] : 0 ?></td>

                            <td class="acciones">
                                <a href="/controllers/modal-editClasses.php?id=<?= isset($row['id']) ? $row['id'] : '' ?>" class="btnIcon" data-clase-id="<?= isset($row['id']) ? $row['id'] : ''; ?>">
                                    <img src="/assets/icono-editar-datos.svg" alt="Edit Info" class="editIcon">
                                </a>

                                <a href="/controllers/deleteClases.php?id=<?= $row['id_clase'] ?>" class="btnIcon" onclick="return confirmDeleting()">
                                    <img src="/assets/icono-delete.svg" alt="Delete Info" class="deleteIcon">
                                </a>

                            </td>
                        </tr>

                    <?php endwhile; ?>



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




    <!-- ************************************************************** ADD MODAL ************************************************************** -->


    <div class="modal-clase" id="modal-clase">
        <div class="modal_container">

            <form class="modal-form" action="../controllers/addClasses.php" method="post">

                <div class="header-form">
                    <h2>Agregar Clase</h2>
                    <a href="#" class="modal_clase_close_x">x</a>
                </div>

                <label for="clase">Nombre de la clase:</label>
                <input type="text" name="clase" id="clase" placeholder="Escribe el nombre de la clase...">

                <div class="clase-container">
                    <label for="id_maestro">Maestros disponibles para la clase:</label>
                    <select id="id_maestro" name="id_maestro" required>
                        <option value="0">Sin Asignar...</option>
                        <?php
                        $query_maestros = mysqli_query($conn, "SELECT * FROM maestros");

                        while ($row_maestro = mysqli_fetch_array($query_maestros)) {
                            echo "<option value='" . $row_maestro['id'] . "'>" . $row_maestro['name'] . " " . $row_maestro['lastname'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="botones">
                    <a href="#" class="modal_clase_close">Close</a>
                    <input type="submit" class="modal_create" value="Create">
                </div>
            </form>
        </div>

    </div>


    <!-- ************************************************************** EDIT MODAL ************************************************************** -->

    <!-- <script src="/scripts/editar.js"></script> -->

    <script>
        const openModals = [...document.querySelectorAll(".btnInfo")];
        const modal = document.getElementById("modal-clase");
        const closeModalx = document.querySelector(".modal_clase_close_x");
        const closeModal = document.querySelector(".modal_clase_close");

        openModals.forEach((openModal) => {
            openModal.addEventListener("click", (e) => {
                e.preventDefault();
                modal.classList.add("modal--show");
            });
        });

        closeModalx.addEventListener("click", (e) => {
            e.preventDefault();
            modal.classList.remove("modal--show");
        });

        closeModal.addEventListener("click", (e) => {
            e.preventDefault();
            modal.classList.remove("modal--show");
        });

        function confirmDeleting() {
            return confirm("¿Estás realmente seguro de eliminar esta clase?");
        }
    </script>

    <script src="/scripts/search.js"></script>

</body>


</html>