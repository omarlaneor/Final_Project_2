<?php
$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

$clase = $_POST['clase'];

$query_clase_nombre = mysqli_query($conn, "SELECT clase FROM clases WHERE id = '$id_clase'");
$row_clase_nombre = mysqli_fetch_array($query_clase_nombre);
$nombre_clase = $row_clase_nombre['clase'];

$query = "INSERT INTO clases VALUES ('', '$clase')";

if (mysqli_query($conn, $query)) {
    header("location: /views/modal-classes.php");
} else {
    echo "Error en el registro: " . mysqli_error($conn);
}

mysqli_close($conn);
