// VARIABLES A USAR
let inactivityTime = 0;
let bolean = false;

// TEMPORIZADOR PARA MOSTRAR ALERTA POR SESION CADUCADA
function timerIncrement() {
    inactivityTime += 1;

    // SI EL TIEMPO DE INACTIVIDAD ES MAYOR A N CANTIDAD DE TIEMPO
    if (inactivityTime > 900) { //-> 15 MINUTOS
        const modal = document.getElementById('modalPorInactividad');
        modal.classList.remove("d-none");
        bolean = true;
    }
};

// LLAMANDO A LA FUNCION DE INCREMENTO CADA SEGUNDO
setInterval(timerIncrement, 1000);

// RESETEAR EL CONTADOR
function resetTimer() {
    inactivityTime = 0;
};

// PETICION CON AXIOS PARA REFRESCAR LA SESION DEL MIDELWER EN LA APP
const endPoint = 'http://127.0.0.1:8000/actualizarSesion'
const peticion = async () => {
    const response = await axios.post(endPoint);
    if (response) {
        console.log(response.data)
    }
};

function invocandcion() {
    if (bolean == false) {
        resetTimer();
        peticion();
    }
}

// ESCUCHAR EVENTOS DE INTERACCION CON EL USUARIO
document.onkeydown = invocandcion; // Al presionar una tecla
document.onclick = invocandcion; // Al hacer clik en la pantalla
// document.onscroll = invocandcion; // Al hacer scroll en la pantalla
