<?php
$conn = mysqli_connect("localhost", "root", "", "university");

if (isset($_GET['id'])) {
    $id_alumno = $_GET['id'];

    $query = "DELETE FROM alumnos WHERE id = '$id_alumno'";
    if (mysqli_query($conn, $query)) {
        header("location: ../views/modal-addAlumnos.php");
    } else {
        echo "Error al eliminar al alumno: " . mysqli_error($conn);
    }
} else {
    echo "ID de alumno no especificado";
}

mysqli_close($conn);
