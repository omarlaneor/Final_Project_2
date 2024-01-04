
<?php

$correo = $_POST['correo'];
$password = $_POST['password'];
session_start();

$_SESSION['correo'] = $correo;

$conn = mysqli_connect("localhost", "root", "", "university");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$sql = "SELECT * FROM usuarios WHERE correo='$correo' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_array($result);

    if (password_verify($password, $row['password'])) {
        if ($row['rol_id'] == 1) { // administrador
            header("location:../views/dashboardAdmin.php");
        } else if ($row['rol_id'] == 2) { // maestro
            header("location:../views/dash-maestros.php");
        } else if ($row['rol_id'] == 3) { // alumno
            header("location:../views/dash-alumnos.php");
        }
    } else {
        header('location:../views/login.php');
    }
} else {
    header('location:../views/login.php');
}

mysqli_free_result($result);
mysqli_close($conn);

?>