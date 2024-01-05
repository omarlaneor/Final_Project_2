<?php

$conn = mysqli_connect("localhost", "root", "", "university");
$id = $_GET['id'];
$sql = "SELECT * FROM maestros WHERE id = $id";

$query = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="display: flex; justify-content: center; align-items: center; background-color: #252627;">

    <div class="modal-edit" data-maestro-id="<?= $row['id']; ?>">
        <div class="modal_container-edit" style="width: 100%;">
        </div>


        <form class="modal-form-edit" action="../controllers/editMaestros.php" method="post" style="background-color: #c0b7b1; border: 2px solid #ccc; padding: 14px 30px 30px 30px;">

            <div class="header-form-edit" style="text-align: right;">

                <a href="../views/modal-addMaestros.php" style="display: inline-block; padding: 4px 10px; border-radius: 50%; background-color: red; color: #fff; text-decoration: none; margin-top: 20px;">x</a>

                <h2 style="display: flex;">Editar Maestro</h2>
            </div>

            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <label for="email" style="display: block; margin-bottom: 18px; padding-left: 20px; font-weight: bold;">Correo Electrónico:
                <input type="text" name="email" id="email" placeholder="Email" value="<?= $row['email'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <label for="name" style="display: block; margin-bottom: 18px; padding-left: 20px; font-weight: bold;">Nombre:
                <input type="text" name="name" id="name" placeholder="Nombre" value="<?= $row['name'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <label for="lastname" style="display: block; padding-left: 20px; margin-bottom: 18px; font-weight: bold;">Apellido:
                <input type="text" name="lastname" id="lastname" placeholder="Apellido" value="<?= $row['lastname'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <label for="direccion" style="display: block; margin-bottom: 18px; padding-left: 20px; font-weight: bold;">Dirección:
                <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?= $row['direccion'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <label for="fecha" style="display: block; margin-bottom: 18px; padding-left: 20px; font-weight: bold;">Fecha:
                <input type="date" name="fecha" id="fecha" placeholder="Fecha" value="<?= $row['fecha'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <div class="clase-container">
                <label for="id_clase" style="display: block; margin-bottom: 18px; padding-left: 20px; font-weight: bold;">Clase Asignada:
                    <select id="id_clase" name="id_clase" required style="width: 50%; padding: 8px; box-sizing: border-box;">
                        <option value="0">Seleccione una clase...</option>
                        <?php
                        $query_clases = mysqli_query($conn, "SELECT * FROM clases");

                        while ($row_clase = mysqli_fetch_array($query_clases)) {
                            echo "<option value='" . $row_clase['id'] . "'>" . $row_clase['clase'] . "</option>";
                        }
                        ?>
                    </select>
                </label>
            </div>

            <div class="botones" style="text-align: right;">
                <a href="/views/modal-addMaestros.php" class="modal_close_edit_alumn" style="display: inline-block; padding: 6px 12px; background-color: red; color: #fff; text-decoration: none; border-radius: 5px;">Close</a>
                <input type="submit" name="accion" class="modal_guardar" value="Guardar" style="display: inline-block; padding: 6px 12px; background-color: #00ced1; color: #fff; text-decoration: none; border-radius: 5px;">
            </div>

        </form>
    </div>
    </div>

    <script>
        const openModalEdits = [...document.querySelectorAll(".btnIcon")];
        const modalEdit = document.querySelector(".modal-edit");
        const closeModalxEdit = document.querySelector(".modal_close_x_edit_alumn");
        const closeModalEdit = document.querySelector(".modal_close_edit_alumn");

        openModalEdits.forEach((openModalEdit) => {
            openModalEdit.addEventListener("click", (e) => {
                e.preventDefault();
                const maestroId = openModalEdit.getAttribute("data-maestro-id");
                const modalEdit = document.querySelector(`[data-maestro-id="${maestroId}"]`);

                modalEdit.classList.add("modal-edit-alumno--show");
            });
        });
    </script>
</body>

</html>