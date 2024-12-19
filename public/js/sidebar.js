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
        cajaPadre[index].style.background = "rgb(196, 189, 189)";
    });
});

iconCerrar.forEach((icon, index) => {
    icon.addEventListener("click", () => {
        lista[index].classList.add("d-none");
        iconAbrir[index].classList.remove("d-none");
        icon.classList.add("d-none");
        cajaPadre[index].style.background = "transparent";
    });
});
