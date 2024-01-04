<form class="modal-form" action="../controller/controller_maestros.php" method="post">

    <div class="header-form">
        <h2>Editar Permiso</h2>
        <a href="#" class="modal_close_x">x</a>
    </div>

    <label for="email">Email de usuario:</label>
    <input type="email" id="email" name="email">

    <div class="rol-container">
        <label for="rol">Rol de usuario:</label>
        <select id="rol" name="rol" required>
            <option value="0">Seleccione Rol...</option>
            <option value="1">Administrador</option>
            <option value="2">Maestro</option>
        </select>
    </div>

    <div class="switch-container">
        <div class="switch-box">
            <input type="checkbox" id="estado" name="estado" class="switch" onchange="toggleUserStatus()">
            <span class="switch-label">Usuario Inactivo</span>
        </div>
        <span id="userStatus"> Usuario Inactivo</span>
    </div>

    <div class="botones">
        <a href="#" class="modal_close">Close</a>
        <a href="#" class="modal_guardar">Guardar Cambios</a>
    </div>
</form>