$(function () {
    $(".select2").select2();
});

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
                    $("#form-notificacion")
                        .text("Error al enviar el formulario. Inténtalo de nuevo")
                        .fadeIn()
                        .delay(3000)
                        .fadeOut();
                }
            },
            error: function (response) {
                $("#form-notificacion")
                    .text("Error al enviar el formulario. Inténtalo de nuevo")
                    .fadeIn()
                    .delay(3000)
                    .fadeOut();
            },
        });
    });
});

const reglasvalidacion  = {
    texto: /[-_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/,
    texto1: /[_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/,
    nombre: /^[a-zA-ñÑ\s]{1,100}$/,
    correo: /^[_-\w.]+@[a-z]+\.[a-z]{2,5}$/,
    asunto: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s]{1,200}$/,
    mensaje: /^[\wáéíóúÁÉÍÓÚñÑ.,!?¿¡()\-:\s]{1,2000}$/,
};

// Elemento donde se muestra el error
let notificacionFormInscripciones;

let erroresCampos = {}; // Objeto para almacenar los errores actuales por campo

function validar_campo(input) {
    if (!notificacionFormInscripciones) {
        notificacionFormInscripciones =
            document.querySelector("#form-notificacion");
    }

    let { name, value, type } = input;

    if (type === "checkbox") {
        if (input.checked) {
            input.classList.remove("error");
            input.classList.add("success");
            delete erroresCampos[name]; // Elimina el error si está corregido
        } else {
            input.classList.add("error");
            input.classList.remove("success");
            erroresCampos[name] = `El campo ${name} debe estar marcado.`;
        }
    } else if (reglasvalidacion[name].test(value) && value.trim() !== '') {
        input.classList.remove("error");
        input.classList.add("success");
        delete erroresCampos[name]; // Elimina el error si está corregido
    } else {
        input.classList.add("error");
        input.classList.remove("success");
        erroresCampos[name] = mensaje_personalizado(name, value);
    }

    actualizarNotificacionesErrores();
    mostrar_submit();
}

function actualizarNotificacionesErrores() {
    if (Object.keys(erroresCampos).length === 0) {
        // No hay errores
        notificacionFormInscripciones.classList.add("notificacion-hidden");
        notificacionFormInscripciones.innerText = "";
    } else {
        // Mostrar todos los errores
        notificacionFormInscripciones.classList.remove("notificacion-hidden");
        notificacionFormInscripciones.innerText = Object.values(erroresCampos).join('\n');
    }
}

const mensaje_personalizado = (campo, value) => {
    if (campo === "nombre") {
        if (value.length > 100) {
            return "El nombre debe contener solo letras y espacios, y no exceder 100 caracteres.";
        }
    } else if (campo === "correo") {
        if (value.length > 50) {
            return "El correo electrónico debe ser válido y tener un máximo de 50 caracteres (ejemplo: nombre@dominio.com).";
        }
    } else if (campo === "asunto") {
        if (value.length > 200) {
            return "El asunto debe contener solo letras, números y puntuación válida, con un máximo de 200 caracteres.";
        }
    } else if (campo === "mensaje") {
        if (value.length > 2000) {
            return "El mensaje puede contener letras, números y símbolos permitidos, con un máximo de 2000 caracteres.";
        }
    }
    return ("Ha ingresado alguno de los siguientes caracteres no válidos para " + campo + ": " + "- _ ' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\");
};

const mayus = (element) => {
    element.value = element.value.toUpperCase();
    validar_campo(element);
};

const mostrar_submit = () => {
    const elementosForm = document.querySelectorAll(".inscripciones-input");

    let todosValidos = true;
    elementosForm.forEach((input) => {
        if ((input.type != "submit" && !input.classList.contains("success")) || input.classList.contains("error")) {
            todosValidos = false;
        }
    });

    if (todosValidos) {
        $("#inscripciones_enviar").removeAttr("disabled");
    } else {
        $("#inscripciones_enviar").attr("disabled", "disabled");
    }
};

const reset_clases = () => {
    const elementosForm = document.querySelectorAll("input, textarea, select");
    elementosForm.forEach((elementoForm) =>
        elementoForm.classList.remove("success", "error")
    );
};
