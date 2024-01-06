<?php
$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

$clase = $_POST['clase'];

// Asegúrate de tener el ID del maestro seleccionado
$id_maestro = $_POST['id_maestro'];

// Obtener el nombre y apellido del maestro
$query_maestro_nombre = mysqli_query($conn, "SELECT name, lastname FROM maestros WHERE id = '$id_maestro'");
$row_maestro_nombre = mysqli_fetch_array($query_maestro_nombre);
$nombre_maestro = $row_maestro_nombre['name'] . " " . $row_maestro_nombre['lastname'];

// Prepara la consulta para insertar en la tabla de clases
$query = "INSERT INTO clases (clase, maestro_asignado) VALUES ('$clase', '$nombre_maestro')";

if (mysqli_query($conn, $query)) {
    header("location: /views/modal-classes.php");
} else {
    echo "Error en el registro: " . mysqli_error($conn);
}

mysqli_close($conn);
