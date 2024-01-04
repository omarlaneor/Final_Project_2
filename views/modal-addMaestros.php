<?php

session_start();

if ($_SESSION["correo"] === null) {
    header("location: ../views/login.php");
}


$conn = mysqli_connect("localhost", "root", "", "university");
$sql = "SELECT * FROM maestros";

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
    <link rel="stylesheet" href="/styles/modal-create-maestros.css">

    <title>Dashboard</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="/assets/rounded_no_background.svg" alt="Logo">
            <p>&nbsp;&nbsp;UNIVERSIDAD</p>
        </div>
        <div class="box1">
            <p>Maestros</p>
            <p>Bienvenido Administrador</p>
        </div>
        <div class="box2">
            <div class="menu-admin">
                <h5>MENÚ ADMINISTRACIÓN</h5>
                <div class="menuIcons"><a href="/views/dash-permisos.php"><img src="/assets/icono-permisos.svg" alt="Permisos">Permisos</a></div>
                <div class="menuIcons"><a href="/views/modal-addMaestros.php"><img src="/assets/icono-maestros.svg" alt="Maestros">Maestros</a></div>
                <div class="menuIcons"><a href="/views/modal-addAlumnos.php"><img src="/assets/icono-alumnos.svg" alt="Alumnos">Alumnos</a></div>
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
        <h1>Lista de Maestros</h1>
    </div>
    <div class="home-dashboard">
        <a href="../views/dashboardAdmin.php" class="actualPage">Home</a> / Dashboard
    </div>



    <div class="container">
        <div class="content">

            <div class="info">
                <h4>Información de Maestros</h4>
                <button type="submit" class="btnInfo">Agregar Maestro</button>
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

            <table class="maestros table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Fec. de Nacimiento</th>
                        <th>Clase Asignada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = mysqli_fetch_array($query)) : ?>

                        <tr>
                            <td> <?= $row['id'] ?></td>
                            <td><?= $row['name'] ?> <?= $row['lastname'] ?> </td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['direccion'] ?></td>
                            <td><?= $row['fecha'] ?></td>
                            <td><?= getName($row['id_clase'], $conn) ?></td>
                            <td class="acciones">
                                <a href="/controllers/editMaestros.php?id=<?= $row['id'] ?>" class="btnIcon">
                                    <img src="/assets/icono-editar-datos.svg" alt="Edit Info" class="editIcon">
                                </a>
                                <a href="/controllers/deleteMaestro.php?id=<?= $row['id'] ?>" class="btnIconDel" onclick="return confirmDeleting()">
                                    <img src="/assets/icono-delete.svg" alt="Delete Info" class="deleteIcon">
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

    <section class="modal">
        <div class="modal_container">

            <form class="modal-form" action="../controllers/addMaestros.php" method="post">

                <div class="header-form">
                    <h2>Agregar Maestro</h2>
                    <a href="#" class="modal_close_x">x</a>
                </div>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" placeholder=" Ingrese el correo electrónico" required>

                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" placeholder="Ingrese el nombre" required>

                <label for="lastname">Apellido:</label>
                <input type="text" id="lastname" name="lastname" placeholder="Ingrese el apellido" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <div class="clase-container">
                    <label for="id_clase">Clase Asignada:</label>
                    <select id="id_clase" name="id_clase" required>
                        <option value="0">Seleccione una clase...</option>
                        <?php
                        $query_clases = mysqli_query($conn, "SELECT * FROM clases");

                        while ($row_clase = mysqli_fetch_array($query_clases)) {
                            echo "<option value='" . $row_clase['id'] . "'>" . $row_clase['clase'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="botones">
                    <a href="#" class="modal_close">Close</a>
                    <input type="submit" class="modal_create" value="Create">
                </div>
            </form>
        </div>

    </section>

    <section class="modal-edit" id="editar <?= $row['id']; ?> ">
        <div class="modal_container-edit">

            <form class="modal-form-edit" action="../controllers/editMaestros.php" method="post">

                <div class="header-form-edit">
                    <h2>Editar Maestro</h2>
                    <a href="#" class="modal_close_x_edit">x</a>
                </div>

                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?= $row['email']; ?>">


                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name">

                <label for="lastname">Apellido:</label>
                <input type="text" id="lastname" name="lastname">

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion">

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <div class="clase-container-edit">
                    <label for="id_clase">Clase Asignada:</label>
                    <select id="id_clase" name="id_clase" required>
                        <option value="0">Seleccione una clase...</option>
                        <?php
                        $query_clases = mysqli_query($conn, "SELECT * FROM clases");

                        while ($row_clase = mysqli_fetch_array($query_clases)) {
                            echo "<option value='" . $row_clase['id'] . "'>" . $row_clase['clase'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="botones-edit">
                    <a href="#" class="modal_close_edit">Close</a>
                    <input type="submit" name="accion" class="modal_guardar" value="Guardar">
                </div>
            </form>
        </div>
    </section>

    <script src="/scripts/script.js"></script>
    <script src="/scripts/search.js"></script>

</body>


</html>