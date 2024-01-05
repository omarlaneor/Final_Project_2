<?php

$conn = mysqli_connect("localhost", "root", "", "university");
$id = $_GET['id'];
$sql = "SELECT * FROM clases WHERE id = $id";

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

    <div class="modal-edit-clases" data-clase-id="<?= $row['id']; ?>">
        <div class="modal_container-edit" style="width: 100%;">
        </div>


        <form class="modal-form" action="../controllers/editarAlumno.php" method="post" style="background-color: #c0b7b1; border: 2px solid #ccc; padding: 14px 30px 30px 30px;">

            <div class="header-form" style="text-align: right;">

                <a href="../views/modal-addAlumnos.php" style="display: inline-block; padding: 4px 10px; border-radius: 50%; background-color: red; color: #fff; text-decoration: none; margin-top: 20px;">x</a>

                <h2 style="display: flex;">Editar Clase</h2>
            </div>

            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <label for="clase" style="display: block; margin-bottom: 18px; padding-left: 20px; font-weight: bold;">Clase:
                <input type="text" name="clase" id="clase" placeholder="Clase" value="<?= $row['clase'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <label for="name" style="display: block; margin-bottom: 18px; padding-left: 20px; font-weight: bold;">Nombre Maestro:
                <input type="text" name="name" id="name" placeholder="Name" value="<?= $row['name'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <label for="apellido" style="display: block; padding-left: 20px; margin-bottom: 18px; font-weight: bold;">Apellido Maestro:
                <input type="text" name="apellido" id="apellido" placeholder="Apellido" value="<?= $row['apellido'] ?>" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </label>

            <div class="botones" style="text-align: right;">
                <a href="/views/modal-addAlumnos.php" class="modal_close_edit_alumn" style="display: inline-block; padding: 6px 12px; background-color: red; color: #fff; text-decoration: none; border-radius: 5px;">Close</a>
                <input type="submit" name="accion" class="modal_guardar" value="Guardar" style="display: inline-block; padding: 6px 12px; background-color: #00ced1; color: #fff; text-decoration: none; border-radius: 5px;">
            </div>

        </form>
    </div>
    </div>

    <script>
        const openModalEdits = [...document.querySelectorAll(".btnIcon")];
        const modalEdit = document.querySelector(".modal-edit-clase");
        const closeModalxEdit = document.querySelector(".modal_close_x_edit_alumn");
        const closeModalEdit = document.querySelector(".modal_close_edit_alumn");

        openModalEdits.forEach((openModalEdit) => {
            openModalEdit.addEventListener("click", (e) => {
                e.preventDefault();
                const claseId = openModalEdit.getAttribute("data-clase-id");
                const modalEdit = document.querySelector(`[data-clase-id="${claseId}"]`);

                modalEdit.classList.add("modal-edit-alumno--show");
            });
        });
    </script>

</body>

</html>