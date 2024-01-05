const openModals = [...document.querySelectorAll(".btnInfo")];
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

// ----------------------- For Deleting ------------------------------

function confirmDeleting() {
  return confirm("¿Estás realmente seguro de eliminar este maestro?");
}
