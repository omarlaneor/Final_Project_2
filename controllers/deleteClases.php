<?php
$conn = mysqli_connect("localhost", "root", "", "university");

if (isset($_GET['id'])) {
    $id_clase = $_GET['id'];

    $query_verificacion = "SELECT COUNT(*) AS total_alumnos FROM alumnos WHERE id_clase = '$id_clase'";
    $result_verificacion = mysqli_query($conn, $query_verificacion);
    $row_verificacion = mysqli_fetch_assoc($result_verificacion);

    if ($row_verificacion['total_alumnos'] > 0) {

        echo '<script>alert("No puedes eliminar una clase que tiene alumnos registrados. Por favor, revisa e intenta nuevamente."); window.location.href="../views/modal-classes.php";</script>';
    } else {
        $query_clase = "DELETE FROM clases WHERE id = '$id_clase'";
        if (mysqli_query($conn, $query_clase)) {
            header("location: ../views/modal-classes.php");
        } else {
            echo "Error al eliminar la clase: " . mysqli_error($conn);
        }
    }
} else {
    echo "ID de clase no especificado";
}

mysqli_close($conn);
