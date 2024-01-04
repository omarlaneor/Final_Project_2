<?php
$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");

// Verificar la conexión exitosa
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $id_clase = $_POST['id_clase'];

    // Verificar la existencia del ID utilizando una consulta preparada
    $check_query = "SELECT id FROM alumnos WHERE id=?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, "i", $id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    // Si no existe el ID, puedes manejar el error o redirigir
    if (mysqli_stmt_num_rows($check_stmt) == 0) {
        header("Location: ../views/modal-addAlumnos.php?error=ID no válido");
        exit();
    }

    // Usamos consultas preparadas para prevenir la inyección de SQL
    $query = "UPDATE alumnos SET nombre=?, apellido=?, ciudad=?, telefono=?, id_clase=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssssii", $nombre, $apellido, $ciudad, $telefono, $id_clase, $id);

    if (mysqli_stmt_execute($stmt)) {
        // Redirigir después de la actualización exitosa
        header("Location: ../views/modal-addAlumnos.php?success=Actualización exitosa");
        exit();
    } else {
        die("Error en la ejecución de la consulta: " . mysqli_error($conn));
    }

    // Cerramos la consulta preparada y la conexión
    mysqli_stmt_close($stmt);
}

// Cerrar la conexión si no estás utilizando persistencia de conexiones
mysqli_close($conn);
