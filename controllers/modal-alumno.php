<?php



$conn = mysqli_connect("localhost", "root", "", "university");
$sql = "SELECT * FROM alumnos";

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

<body>

    <div class="modal-edit-alumno" data-alumno-id="<?= $row['id']; ?>">
        <div class="modal_container-edit" style="justify-content: center;">

            <form class="modal-form" action="../controllers/editarAlumno.php" method="post">

                <div class="header-form">
                    <h2>Editar Alumno</h2>
                    <a href="../views/modal-addAlumnos.php" style="display: inline-block; padding: 4px 4px; border-radius: 50%; background-color: red; color: #fff; text-decoration: none; border-radius: 5px;" class="modal_close_x_edit_alumn" data-dismiss="modal">x</a>
                </div>
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <label for="nombre" style="display: block; margin-bottom: 8px; padding-left: 20px; font-weight: bold;">Nombre:
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?= $row['nombre'] ?>" style="width: 20%; padding: 8px; box-sizing: border-box;">
                </label>

                <label for="apellido" style="display: block; margin-bottom: 8px; padding-left: 20px; font-weight: bold;">Apellido:
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" value="<?= $row['apellido'] ?>" style="width: 20%; padding: 8px; box-sizing: border-box;">
                </label>

                <label for="ciudad" style="display: block; padding-left: 20px; margin-bottom: 8px; font-weight: bold;">Ciudad:
                    <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" value="<?= $row['ciudad'] ?>" style="width: 20%; padding: 8px; box-sizing: border-box;">
                </label>

                <label for="telefono" style="display: block; margin-bottom: 8px; padding-left: 20px; font-weight: bold;">Teléfono:
                    <input type="text" name="telefono" id="telefono" placeholder="Telefono" value="<?= $row['telefono'] ?>" style="width: 20%; padding: 8px; box-sizing: border-box;">
                </label>

                <div class="clase-container">
                    <label for="id_clase" style="display: block; margin-bottom: 8px; padding-left: 20px; font-weight: bold;">Clase Asignada:
                        <select id="id_clase" name="id_clase" required style="width: 14%; padding: 8px; box-sizing: border-box;">
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

                <div class="botones">
                    <a href="/views/modal-addAlumnos.php" class="modal_close_edit_alumn" style="display: inline-block; padding: 10px 20px; background-color: red; color: #fff; text-decoration: none; border-radius: 5px;">Close</a>
                    <input type="submit" name="accion" class="modal_guardar" value="Guardar" style="display: inline-block; padding: 10px 20px; background-color: #00ced1; color: #fff; text-decoration: none; border-radius: 5px;">
                </div>

            </form>
        </div>
    </div>

    <script>
        const openModalEdits = [...document.querySelectorAll(".btnIcon")];
        const modalEdit = document.querySelector(".modal-edit-alumno");
        const closeModalxEdit = document.querySelector(".modal_close_x_edit_alumn");
        const closeModalEdit = document.querySelector(".modal_close_edit_alumn");

        openModalEdits.forEach((openModalEdit) => {
            openModalEdit.addEventListener("click", (e) => {
                e.preventDefault();
                const alumnoId = openModalEdit.getAttribute("data-alumno-id");
                const modalEdit = document.querySelector(`[data-alumno-id="${alumnoId}"]`);

                modalEdit.classList.add("modal-edit-alumno--show");
            });
        });
    </script>

</body>

</html>