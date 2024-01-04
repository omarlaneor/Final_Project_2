<?php
$conn = mysqli_connect("localhost", "root", "", "university");

if (isset($_GET['id'])) {
    $id_maestro = $_GET['id'];

    $query = "DELETE FROM maestros WHERE id = '$id_maestro'";
    if (mysqli_query($conn, $query)) {
        header("location: ../views/modal-addMaestros.php");
    } else {
        echo "Error al eliminar la clase: " . mysqli_error($conn);
    }
} else {
    echo "ID de maestro no especificado";
}

mysqli_close($conn);
