<?php

$conn = mysqli_connect("localhost", "root", "", "university");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    $password = $row['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $updateSql = "UPDATE usuarios SET password = '$hashedPassword' WHERE id = " . $row['id'];
    mysqli_query($conn, $updateSql);
}

mysqli_free_result($result);
mysqli_close($conn);

echo "Contraseñas actualizadas con éxito!";
