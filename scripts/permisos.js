const openModals = [...document.querySelectorAll(".btnIcon")];
const modal = document.querySelector(".modal");
const closeModalx = document.querySelector(".modal_close_x");
const closeModal = document.querySelector(".modal_close");

openModals.forEach((openModal) => {
  openModal.addEventListener("click", (e) => {
    e.preventDefault();
    modal.classList.add("modal--show");
  });
});

closeModalx.addEventListener("click", (e) => {
  e.preventDefault();
  modal.classList.remove("modal--show");
});

closeModal.addEventListener("click", (e) => {
  e.preventDefault();
  modal.classList.remove("modal--show");
});

// ------------------------ Botón cambio de estado --------------------

function toggleUserStatus() {
  const switchElement = document.getElementById("estado");
  const switchLabel = document.querySelector(".switch-label");
  const userStatus = document.getElementById("userStatus");

  if (switchElement.checked) {
    switchLabel.textContent = "Usuario Activo";
    userStatus.textContent = "Usuario Activo";
  } else {
    switchLabel.textContent = "Usuario Inactivo";
    userStatus.textContent = "Usuario Inactivo";
  }
}

// ------------------------ Botón cambio de estado y envío de información --------------------

document.addEventListener("DOMContentLoaded", function () {
  const modalGuardarBtn = document.querySelector(".modal_guardar");
  modalGuardarBtn.addEventListener("click", guardarCambios);
});

function guardarCambios() {
  const userId = document.getElementById("userId").value;
  const email = document.getElementById("email").value;
  const rol = document.getElementById("rol").value;
  const estado = document.getElementById("estado").checked
    ? "Activo"
    : "Inactivo";

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../controllers/updatePermission.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
    }
  };
  xhr.send(
    "id=" + userId + "&email=" + email + "&rol=" + rol + "&estado=" + estado
  );
}
