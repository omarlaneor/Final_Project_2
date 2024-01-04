<?php
$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

$email = $_POST['email'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$direccion = $_POST['direccion'];
$fecha = $_POST['fecha'];
$id_clase = $_POST['id_clase'];

$query_clase_nombre = mysqli_query($conn, "SELECT clase FROM clases WHERE id = '$id_clase'");
$row_clase_nombre = mysqli_fetch_array($query_clase_nombre);
$nombre_clase = $row_clase_nombre['clase'];

$query = "INSERT INTO maestros (id, email, name, lastname, direccion, fecha, id_clase)
VALUES ('NULL', '$email', '$name', '$lastname', '$direccion', '$fecha', '$id_clase')";

if (mysqli_query($conn, $query)) {
    header("location: /views/modal-addMaestros.php");
} else {
    echo "Error en el registro: " . mysqli_error($conn);
}

mysqli_close($conn);
