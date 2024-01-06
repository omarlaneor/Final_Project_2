<?php

$server = "localhost";
$username = "root";
$pass = "";
$db = "university";

$conn = mysqli_connect("localhost", "root", "", "university");
$sql = "SELECT * FROM maestros";

$query = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($query);



if (!$conn) {
    die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}
?>

<!-- Pendiente por organizar -->


<div class="modal-edit" id="editar <?= $row['id']; ?> ">
    <div class="modal_container-edit">

        <form class="modal-form" action="../controllers/editMaestros.php" method="post">

            <div class="header-form">
                <h2>Editar Maestro</h2>
                <a href="../views/modal-addMaestros.php" class="modal_close_x_edit">x</a>
            </div>

            <input type="hidden" name="id" value="<?= $row['id']; ?>">

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?= $row['email']; ?>">


            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="<?= $row['name']; ?>">

            <label for="lastname">Apellido:</label>
            <input type="text" id="lastname" name="lastname" value="<?= $row['lastname']; ?>">

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?= $row['direccion']; ?>">

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <div class="clase-container">
                <label for="id_clase">Clase Asignada:</label>
                <select id="id_clase" name="id_clase" required>
                    <option value="0">Seleccione una clase...</option>
                    <?php
                    $query_clases = mysqli_query($conn, "SELECT * FROM clases");

                    while ($row_clase = mysqli_fetch_array($query_clases)) {
                        echo "<option value='" . $row_clase['id'] . "'>" . $row_clase['clase'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="botones">
                <a href="../views/modal-addMaestros.php" class="modal_close_edit">Close</a>
                <input type="submit" name="accion" class="modal_guardar" value="Guardar">
            </div>
        </form>
    </div>
</div>



<script src="/scripts/script.js"></script>
<script src="/scripts/search.js"></script>