<?php


$conexion = mysqli_connect("localhost", "root", "", "university");
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Listado_Permisos.xls");
?>


<table class="table table-striped table-dark " id="table_id">


    <thead>

        <h1> Administrador: Permisos para Usuarios</h1>
        <!--  <img src="logo-university" alt=""> -->

        <tr>

            <th>ID</th>
            <th>Email / Usuario</th>
            <th>Permiso</th>
            <th>Estado</th>


        </tr>
    </thead>
    <tbody>

        <?php

        $conn = mysqli_connect("localhost", "root", "", "university");
        $sql = "SELECT maestros.id, maestros.email, maestros.id_rol, maestros.estado
         FROM maestros";

        $dato = mysqli_query($conn, $sql);

        if ($dato->num_rows > 0) {
            while ($row = mysqli_fetch_array($dato)) {

        ?>
                <tr>
                    <td> <?= $row['id'] ?></td>
                    <td><?= $row['email'] ?></td>

                    <td><?= $row['estado'] ?></td>
                    <td><?= verRol($row['id_rol'], $conn) ?></td>



            <?php
            }
        }
        function verRol($id_rol, $conn)
        {
            $query = mysqli_query($conn, "SELECT rol FROM roles WHERE id = '$id_rol'");
            $row = mysqli_fetch_array($query);
            return $row ? $row['rol'] : 'No asignada';
        }
            ?>