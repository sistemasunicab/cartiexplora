$(function () {
    $(".select2").select2();
});

document.addEventListener("DOMContentLoaded", () => {
    galeriaEstudiantes();
});

/* Script Galeria Nuestros Estudiantes */
const galeriaEstudiantes = () => {
    const items = document.querySelectorAll(".galeria div .item");

    items.forEach((item) => {
        item.addEventListener("click", () => {
            // Elimina la clase seleccionada de la imagen actualmente seleccionada
            document
                .querySelector(".item-seleccionado")
                .classList.remove("item-seleccionado");

            const itemImg = item.querySelector("img");
            const imgGrande = document.querySelector("#imagen-grande-galeria");

            imgGrande.src = itemImg.src;
            imgGrande.alt = itemImg.alt;

            item.classList.add("item-seleccionado");
        });
    });
};

/**
 * Función responsable de la descarga de archivos
 *
 * @param {String} nivel El nivel en el árbol de directorios desde el que se accederá al archivo.
 * @param {String} path ruta donde se encuentra el archivo a descargar
 * @param {String} nombreArchivo  nombre nuevo que se va a asignar a este archivo
 * @param {String} destino  target de la etiqueta <a></a>
 *
 * */
const descargarArchivo = (nivel, path, nombreNuevoArchivo, destino) => {
    const instanciaADescargar = document.createElement("a");
    if (nivel == "raiz") {
        instanciaADescargar.href = path;
    } else if (nivel == "uno") {
        instanciaADescargar.href = `../${path}`;
    } else if (nivel == "dos") {
        instanciaADescargar.href = `../../${path}`;
    } else if (nivel == "tres") {
        instanciaADescargar.href = `../../../${path}`;
    }
    instanciaADescargar.target = destino;
    instanciaADescargar.download = nombreNuevoArchivo;
    document.body.appendChild(instanciaADescargar);
    instanciaADescargar.click();
    document.body.removeChild(instanciaADescargar);
};

const leerMasPrincipios = (id, boton) => {
    let tresPuntos = document.querySelector(`#${id} .show`);
    let textoOculto = document.querySelector(`#${id} .hide`);

    //Oculta o Muestra tres puntos ...
    tresPuntos.classList.toggle("show");
    tresPuntos.classList.toggle("hide");

    //Oculta o muestra el texto escondido
    textoOculto.classList.toggle("hide");
    textoOculto.classList.toggle("show");

    boton.innerText =
        boton.innerText === "Leer más" ? "Leer menos" : "Leer más";
};

// Inscripciones Academicas

const mostrarInscripcionesMovil = () => {
    document.body.classList.toggle('overflow-hidden');
    const formInscripciones = document.querySelector("#form-container");
    formInscripciones.classList.toggle("inscripciones-movil");
    formInscripciones.classList.toggle("d-none");
};

// Despues de enviado el formulario hace el reset de clases css aplicadas
const reset_clases = () => {
    const elementosForm = document.querySelectorAll("input, textarea, select");
    elementosForm.forEach((elementoForm) =>
        elementoForm.classList.remove("success", "error")
    );
};

$(document).ready(function () {
    $("#myForm").on("submit", function (e) {
        e.preventDefault();

        let nombre = $("#inscripciones_nombre").val();
        let email = $("#inscripciones_correo").val();
        let asunto = $("#inscripciones_asunto").val();
        let mensaje = $("#inscripciones_mensaje").val();
        let subscribe = $("#inscripciones_checkbox").is(":checked");

        const data = {
            nombre: nombre,
            email: email,
            asunto: asunto,
            mensaje: mensaje,
            subscribe: subscribe,
        };

        $.ajax({
            url: "../../cartiexplora/ajax/formInscripcionesAbiertas.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    $("#myForm")[0].reset();
                    $("#inscripciones_enviar").attr("disabled", "disabled");
                    $("#notificacion-success").fadeIn().delay(3000).fadeOut();
                    reset_clases();
                } else {
                    $("#form-notificacion-resultado-envio")
                        .text(
                            "Error al enviar el formulario. Inténtalo de nuevo"
                        )
                        .fadeIn()
                        .delay(3000)
                        .fadeOut().css('display', '');
                }
            },
            error: function (response) {
                $("#form-notificacion-resultado-envio")
                    .text("Error al enviar el formulario. Inténtalo de nuevo")
                    .fadeIn()
                    .delay(3000)
                    .fadeOut();
            },
        });
    });
});

const reglasvalidacion = {
    texto: /[-_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/,
    correo: /^[_-\w.]+@[a-z]+\.[a-z\.]{2,7}$/,
    numero: /^[0-9]{1,}$/,
    fecha: /^[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/,
};


// Elemento donde se muestra el error
let notificacionFormInscripciones;

// Variable encargada de almacenar el error actual
let error = '';

const actualizarNotificacionesErrores = (error) => {
    // Verifica que el elemento no sea undefined
    if (!notificacionFormInscripciones) {
        notificacionFormInscripciones = document.querySelector("#form-notificacion-error");
    }

    if (error === '') {
        // No hay errores
        notificacionFormInscripciones.classList.add("notificacion-hidden");
        notificacionFormInscripciones.innerText = "";
    } else {
        // Mostrar todos los errores
        notificacionFormInscripciones.classList.remove("notificacion-hidden");
        notificacionFormInscripciones.innerText = error;
    }
}

const mostrar_submit = () => {
    const elementosForm = document.querySelectorAll(".inscripciones-input");

    let todosValidos = true;
    elementosForm.forEach((input) => {
        const campoObligatorio = input.getAttribute("required") === '' ? true : false;

        if (campoObligatorio && input.value === ''){
            marcarInputError(input);
        }

        if ((input.type != "submit" && !input.classList.contains("success")) ||input.classList.contains("error")) {
            todosValidos = false;
        }
    });

    if (todosValidos && error === '') {
        $("#inscripciones_enviar").removeAttr("disabled");
    } else {
        $("#inscripciones_enviar").attr("disabled", "disabled");
    }
};

const marcarInputError = (input) => {
    input.classList.add("error");
    input.classList.remove("success");
};

const marcarInputCorrecto = (input) => {
    input.classList.remove("error");
    input.classList.add("success");
};

const validar_texto = (input) => {

    let { name, value } = input;
    const campoObligatorio = input.getAttribute("required") === '' ? true : false;
    
    if ((value.trim() === "" || value.trim() === '') && campoObligatorio) {
        marcarInputError(input);
        error = `El campo ${name} es obligatorio`;
    } else if (value.match(reglasvalidacion.texto)) {
        marcarInputError(input);
        error = `Ha ingresado alguno de los siguientes caracteres no válidos para ${name}: - _ ' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\`;
    } else {
        marcarInputCorrecto(input);
        error = '';
    }
    
    actualizarNotificacionesErrores(error);
    mostrar_submit();
};

const validar_numero = (input) => {
    let { name, value } = input;
    const campoObligatorio = input.getAttribute("required") === '' ? true : false;

    if ((value.trim() === "" || value.trim() === '') && campoObligatorio) {
        marcarInputError(input);
        error = `El campo ${name} es obligatorio.`;
    } else if (reglasvalidacion.numero.test(value)) {
        marcarInputCorrecto(input);
        error = '';
    } else {
        error = `Ingrese sólamente números mayores a 0 para ${name}`;
        marcarInputError(input);
    }
    
    actualizarNotificacionesErrores(error);
    mostrar_submit();
}

const validar_correo = (input) => {
    let { name, value } = input;
    const campoObligatorio = input.getAttribute("required") === '' ? true : false;

    if ((value.trim() === "" || value.trim() === '') && campoObligatorio) {
        marcarInputError(input);
        error = `El campo ${name} es obligatorio.`;
    } else if (reglasvalidacion.correo.test(value)) {
        marcarInputCorrecto(input);
        error = '';
    } else {
        error = `No es un patrón válido para ${name}`;
        marcarInputError(input);
    }
    
    actualizarNotificacionesErrores(error);
    mostrar_submit();
};

const validar_fecha = (input) => {
    
    let { name, value: fecha } = input;
    const campoObligatorio = input.getAttribute("required") === '' ? true : false;

    if ((fecha.trim() === "" || fecha.trim() === '') && campoObligatorio) {
        marcarInputError(input);
        error = `El campo ${name} es obligatorio.`;

    } else if (reglasvalidacion.fecha.test(fecha)) {
        
        const partesFecha = fecha.split("-");
        const anio = partesFecha[0];
        const mes  = partesFecha[1];
        const dia  = partesFecha[2];
        let contieneErrores = false;

        if(anio < 1850 || anio > 2050) {
            contieneErrores = true;
            marcarInputError(input);
            error = `No es un patrón válido para ${name}`;
        }

        if(mes < 1 || mes > 12) {
            contieneErrores = true;
            marcarInputError(input);
            error = `No es un patrón válido para ${name}`;
        } else {
            
            if(mes == 2) {
                if(dia < 1 || dia > 29) {
                    contieneErrores = true;
                    marcarInputError(input);
                    error = `No es un patrón válido para ${name}`;
                } 
            } else if(mes == 4 || mes == 6 || mes == 9 || mes == 11) {
                if(dia < 1 || dia > 30) {
                    contieneErrores = true;
                    marcarInputError(input);
                    error = `No es un patrón válido para ${name}`;
                } 
            } else {
                if(dia < 1 || dia > 31) {
                    contieneErrores = true;
                    marcarInputError(input);
                    error = `No es un patrón válido para ${name}`;
                } 
            }
        }
        
        if(!contieneErrores){
            marcarInputCorrecto(input);
            error = '';
        }
    } else {
        error = `No es un patrón válido para ${name}`;
        marcarInputError(input);
    }
    
    actualizarNotificacionesErrores(error);
    mostrar_submit();
}