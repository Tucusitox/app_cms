// LISTA DESPLEGABLE PARA CADA SECCION DE LAS INTERFACEZ
const iconAbrir = document.querySelectorAll(".abrirLista");
const iconCerrar = document.querySelectorAll(".cerrarLista");
const lista = document.querySelectorAll(".opciones");
const cajaPadre = document.querySelectorAll(".cajaPadre");

iconAbrir.forEach((icon, index) => {
    icon.addEventListener("click", () => {
        lista[index].classList.remove("d-none");
        icon.classList.add("d-none");
        iconCerrar[index].classList.remove("d-none");
        cajaPadre[index].style.border = "2px solid green";
        cajaPadre[index].style.borderRadius = "10px";
    });
});

iconCerrar.forEach((icon, index) => {
    icon.addEventListener("click", () => {
        lista[index].classList.add("d-none");
        iconAbrir[index].classList.remove("d-none");
        icon.classList.add("d-none");
        cajaPadre[index].style.border = "none";
        cajaPadre[index].style.borderRadius = "0";
    });
});
