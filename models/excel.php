<?php

require_once("../config/conn.php");

// Cabeceras para la descarga de Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=Maestros.xls");

?>

<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<title>Maestros</title>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 40%;
        }

        th,
        td {
            border: 1px solid #f1f1f1;
            text-align: left;
            padding: 4px;
        }

        th {
            background-color: #A5F8D3;
        }

        h4 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h4>Maestros de la Universidad</h4>
    <table class="tabla_maestros" id="tabla_maestros">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Fec. de Nacimiento</th>
                <th>Clase Asignada</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $conn = mysqli_connect("localhost", "root", "", "university");
            $sql = "SELECT maestros.id, maestros.name, maestros.lastname, maestros.email, maestros.direccion, maestros.fecha, maestros.id_clase FROM maestros";
            $dato = mysqli_query($conn, $sql);

            if ($dato->num_rows > 0) {
                while ($row = mysqli_fetch_array($dato)) {

                    $id = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['id']);
                    $name = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['name']);
                    $lastname = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['lastname']);
                    $email = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['email']);
                    $direccion = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['direccion']);
                    $fecha = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['fecha']);
                    $clase = iconv("UTF-8", "ISO-8859-1//TRANSLIT", getName($row['id_clase'], $conn));

            ?>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $name ?></td>
                        <td><?= $lastname ?></td>
                        <td><?= $email ?></td>
                        <td><?= $direccion ?></td>
                        <td><?= $fecha ?></td>
                        <td><?= $clase ?></td>
                <?php
                }
            }

            function getName($id_clase, $conn)
            {
                $query = mysqli_query($conn, "SELECT clase FROM clases WHERE id = '$id_clase'");
                $row = mysqli_fetch_array($query);
                return $row ? $row['clase'] : 'No asignada';
            }
                ?>
        </tbody>
    </table>

</body>

</html>