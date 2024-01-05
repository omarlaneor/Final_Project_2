<?php
$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $clase = $_POST['clase'];

    $check_query = "SELECT id FROM clases WHERE id=?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, "i", $id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) == 0) {
        header("Location: ../views/modal-classes.php?error=ID no válido");
        exit();
    }

    $query = "UPDATE clases SET clase=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "si", $clase, $id);

    if (mysqli_stmt_execute($stmt)) {

        header("Location: ../views/modal-classes.php?success=Actualización exitosa");
        exit();
    } else {
        die("Error en la ejecución de la consulta: " . mysqli_error($conn));
    }


    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
