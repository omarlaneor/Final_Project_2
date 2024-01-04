<?php

$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $id_clase = $_POST['id_clase'];

    // Actualizar la información en la base de datos
    $query = "UPDATE maestros SET 
              email = '$email',
              name = '$name',
              lastname = '$lastname',
              direccion = '$direccion',
              fecha = '$fecha',
              id_clase = '$id_clase'
              WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Éxito al actualizar, redirigir o mostrar un mensaje
        header('Location: ../views/modal-addMaestros.php'); // Cambia la ruta según tu estructura de archivos
        exit();
    } else {
        // Error al actualizar, mostrar mensaje de error
        echo "Error al actualizar la información. Por favor, inténtalo de nuevo.";
    }
} else {
    // Redirigir si se intenta acceder directamente a este archivo sin enviar el formulario
    header('Location: ../index.php'); // Cambia la ruta según tu estructura de archivos
    exit();
}
