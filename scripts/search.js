const searchInput = document.getElementById("busqueda");
const table = document.querySelector(".table_id");

searchInput.addEventListener("keyup", function () {
  const searchTerm = this.value.toLowerCase();

  const rows = table.querySelectorAll("tbody tr");
  rows.forEach(function (row) {
    const cells = row.querySelectorAll("td");
    let matchFound = false;

    cells.forEach(function (cell) {
      const cellText = cell.textContent.toLowerCase();
      if (cellText.includes(searchTerm)) {
        matchFound = true;
        return; // Salir del bucle cells si se encuentra una coincidencia
      }
    });

    row.style.display = matchFound ? "" : "none";
  });
});

// Cerrar sesión
function logout() {
  window.location.href = "/models/logout.php";
}

const logoutLink = document.querySelector(
  ".menuIcons a[href='/models/logout.php']"
);
if (logoutLink) {
  logoutLink.addEventListener("click", function (e) {
    e.preventDefault();
    logout();
  });
}

// Deshabilitar el botón de retroceso del navegador
history.pushState(null, null, location.href);
window.onpopstate = function () {
  history.go(1);
};
