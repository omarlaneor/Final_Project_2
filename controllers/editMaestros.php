<?php

$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $direccion = $_POST['direccion'];
    $fecha = $_POST['fecha'];
    $id_clase = $_POST['id_clase'];

    $check_query = "SELECT id FROM maestros WHERE id=?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, "i", $id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) == 0) {
        header("Location: ../views/modal-addMaestros.php?error=ID no válido");
        exit();
    }

    $query = "UPDATE maestros SET 
              email = ?, name = ?, lastname = ?, direccion = ?, fecha = ?, id_clase = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssssiii", $email, $name, $lastname, $direccion, $fecha, $id_clase, $id);

    if (mysqli_stmt_execute($stmt)) {

        header("Location: ../views/modal-addMaestros.php?success=Actualización exitosa");
        exit();
    } else {
        die("Error en la ejecución de la consulta: " . mysqli_error($conn));
    }


    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
