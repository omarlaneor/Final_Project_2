<?php
$conn = mysqli_connect("localhost", "root", "", "university");

if (isset($_GET['id'])) {
    $id_clase = $_GET['id'];

    $query = "DELETE FROM clases WHERE id = '$id_clase'";
    if (mysqli_query($conn, $query)) {
        header("location: ../views/modal-classes.php");
    } else {
        echo "Error al eliminar la clase: " . mysqli_error($conn);
    }
} else {
    echo "ID de maestro no especificado";
}

mysqli_close($conn);
