
<?php

$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

if (!$conn) {
    die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}
?>