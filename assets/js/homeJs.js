$(function () {
    $(".select2").select2();
});

document.addEventListener("DOMContentLoaded", () => {
    galeriaEstudiantes();
    // actualizarPorcentajesBotonBanner();
});

// const actualizarPorcentajesBotonBanner = () => {
//     const botones = document.querySelectorAll(
//         ".carousel-item .button-carousel"
//     );

//     botones.forEach((boton) => {
//         // Almacena los valores originales solo una vez, si no están ya guardados
//         if (!boton.dataset.originalTop) {
//             boton.dataset.originalTop = boton.style.top;
//         }
//         if (!boton.dataset.originalLeft) {
//             boton.dataset.originalLeft = boton.style.left;
//         }

//         boton.style.top = boton.dataset.originalTop;
//         boton.style.left = boton.dataset.originalLeft;
//         boton.style.transform = `translateX(-${boton.dataset.originalLeft})`;
//     });
// };

// Escuchamos el evento resize para ejecutar la verificación cada vez que cambie el ancho de la ventana
// window.addEventListener('resize', actualizarPorcentajesBotonBanner);

/* Script Galeria Nuestros Estudiantes */
const galeriaEstudiantes = () => {
    const items = document.querySelectorAll(".galeria-nuestros-estudiantes div .item-nuestros-estudiantes");

    items.forEach((item) => {
        item.addEventListener("click", () => {
            document.querySelector(".item-nuestros-estudiantes__seleccionado")
                .classList.remove("item-nuestros-estudiantes__seleccionado");

            const itemImg = item.querySelector("img");
            const imgGrande = document.querySelector("#imagen-grande-galeria");

            imgGrande.src = itemImg.src;
            imgGrande.alt = itemImg.alt;

            item.classList.add("item-nuestros-estudiantes__seleccionado");
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
    let tresPuntos = document.querySelector(`#${id} .show-principios`);
    let textoOculto = document.querySelector(`#${id} .hide-principios`);

    //Oculta o Muestra tres puntos ...
    tresPuntos.classList.toggle("show-principios");
    tresPuntos.classList.toggle("hide-principios");

    //Oculta o muestra el texto escondido
    textoOculto.classList.toggle("hide-principios");
    textoOculto.classList.toggle("show-principios");

    boton.innerText =
        boton.innerText === "Leer más" ? "Leer menos" : "Leer más";
};

$(document).ready(function () {
    $("#blog_likeBtn").on("click", function (e) {
        e.preventDefault();

        const urlParams = new URLSearchParams(window.location.search);

        const data = {
            id: parseInt(urlParams.get("blogId")) || parseInt($('#blog_post').data('blogId')),
            liked: 1
        };

        $.ajax({
            url: "../../org/ajax/blogLikes.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    $("#blog_dislikeBtn").toggleClass("d-none");
                    $("#blog_likeBtn").toggleClass("d-none");
                    console.log(response)
                }
            },
            error: function (response) {
                console.log(response)
            },
        });
    });

    $("#blog_dislikeBtn").on("click", function (e) {
        e.preventDefault();

        const urlParams = new URLSearchParams(window.location.search);

        const data = {
            id: parseInt(urlParams.get("blogId")) || parseInt($('#blog_post').data('blogId')),
            liked: 0
        };

        $.ajax({
            url: "../../org/ajax/blogLikes.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    $("#blog_dislikeBtn").toggleClass("d-none");
                    $("#blog_likeBtn").toggleClass("d-none");
                    console.log(response)
                }
            },
            error: function (response) {
                console.log(response)
            },
        });
    });

    $("#search").keyup(function () {
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#datos-empelados tbody tr"), function () {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
});

$(document).ready(function () {
    $(".datos").hide();
    marcarCamposObligatorios();
    $("#alert").hide();
    $("#divcargando").css({ display: 'none' });
    let btnSubmit = document.querySelector('button[type="submit"]');
    let idSubmit = "#" + btnSubmit.id;

    $("#formulario").on("submit", function (e) {
        e.preventDefault();

        let nombre = $("#nombre").val();
        let email = $("#correo").val();
        let asunto = $("#asunto").val();
        let mensaje = $("#mensaje").val();
        let subscribe = $("#checkbox").is(":checked");

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
                    $("#formulario")[0].reset();
                    $("#notificacionSuccess").fadeIn().delay(3000).fadeOut();
                } else {
                    $("#notificacionError")
                        .text(
                            "Error al enviar el formulario. Inténtalo de nuevo"
                        )
                        .fadeIn()
                        .delay(3000)
                        .fadeOut();
                }
            },
            error: function (response) {
                $("#notificacionError")
                    .text("Error al enviar el formulario. Inténtalo de nuevo")
                    .fadeIn()
                    .delay(3000)
                    .fadeOut();
            },
        });
    });

    $("#register_grado").change(function () {
        let gra = $("#register_grado").val();

        if (gra == "NA") {
            //$(idSubmit).hide();
            let texto = "Debe seleccionar un grado para la matrícula";
            $("#pdesc").html(texto).css("color", "red");
            $("#alert").show();
            marcarInputError(this.id);
            agregarCampoError(this.id);
        }
        else {
            //$("#btnEnviar").show();
            $("#pdesc").html("");
            $("#alert").hide();
            marcarInputCorrecto(this.id);
            quitarCampoError(this.id);
        }
        mostrarSubmit(btnSubmit.id);
    });

    $("#register_tipo_documento").change(function () {
        let td = $("#register_tipo_documento").val();
        let td_txt = $("#register_tipo_documento option:selected").text();
        $("#td_text").val(td_txt);

        if (td == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un tipo de documento para la matrícula";
            $("#pdesc").html(texto).css("color", "red");
            $("#alert").show();
            marcarInputError(this.id);
            agregarCampoError(this.id);
        }
        else {
            //$("#btnEnviar").show();
            $("#pdesc").html("");
            $("#alert").hide();
            marcarInputCorrecto(this.id);
            quitarCampoError(this.id);
        }
        mostrarSubmit(btnSubmit.id);
    });

    $("#register_medio").change(function () {
        let medio = $("#register_medio").val();

        if (medio == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un medio de llegada";
            $("#pdesc").html(texto).css("color", "red");
            $("#alert").show();
            marcarInputError(this.id);
            agregarCampoError(this.id);
        }
        else {
            //$("#btnEnviar").show();
            $("#pdesc").html("");
            $("#alert").hide();
            marcarInputCorrecto(this.id);
            quitarCampoError(this.id);
        }
        mostrarSubmit(btnSubmit.id);
    });

    $("#register_genero").change(function () {
        let gen = $("#register_genero").val();

        if (gen == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un género para la matrícula";
            $("#pdesc").html(texto).css("color", "red");
            $("#alert").show();
            marcarInputError(this.id);
            agregarCampoError(this.id);
        }
        else {
            //$("#btnEnviar").show();
            $("#pdesc").html("");
            $("#alert").hide();
            marcarInputCorrecto(this.id);
            quitarCampoError(this.id);
        }
        mostrarSubmit(btnSubmit.id);
    });

    $("#parentesco_acudiente_1").change(function () {
        let parentesco = $("#parentesco_acudiente_1").val();

        if (parentesco == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un parentesco para el acudiente";
            $("#pdesc").html(texto).css("color", "red");
            $("#alert").show();
            marcarInputError(this.id);
            agregarCampoError(this.id);
        }
        else {
            //$("#btnEnviar").show();
            $("#pdesc").html("");
            $("#alert").hide();
            marcarInputCorrecto(this.id);
            quitarCampoError(this.id);
        }
        mostrarSubmit(btnSubmit.id);
    });

    $("#comentariosCampos").on("submit", function (e) {
        e.preventDefault();

        const urlParams = new URLSearchParams(window.location.search);
        let blogId =  parseInt(urlParams.get("blogId")) || parseInt($('#blog_post').data('blogId'));

        let email = $("#correo").val();
        let comentario = $("#comentario").val();

        const data = {
            id: blogId,
            email: email,
            comentario: comentario,
        };

        $.ajax({
            url: "../../org/ajax/comentarios.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    $("#comentariosCampos")[0].reset();

                    const comment = $("#comentario-plantilla .comment-block").clone();
                    comment.addClass('order-first');
                    comment.find('.logros-comentario').text(data.comentario);
                    comment.find('.logros-correo').text(data.email);
                    
                    const date = new Date();
                    const d = String(date.getDate()).padStart(2, '0');
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const y = String(date.getFullYear()).slice(-2);
                    comment.find('.fecha').text(`${y}-${m}-${d}`);

                    $('#comentarios').append('<div class="col-lg-2 col-md-2 order-first"></div>')
                    $('#comentarios').append(comment);
                    $('#comentarios').append('<div class="col-lg-2 col-md-2 order-first"></div>')
                }   
            },
            error: function (response) {
                console.log(response)
            },
        });
    });

    $("#selmediopago .custom-option").change(function() {
        const medio = document.querySelector("#selmediopago");

        if(medio.dataset.value == "NA") {
            $("#txtref").val("");
            $("#txtvalorref").val("");

            $("#txtvalor").val("");
        }
    });

    // Mostrar referencia o valor manual
    $("input[name=opvalor]").click(function () {
        // Limpieza inicial
        $("#txtref").val("");
        $("#txtvalorref").val("");

        $("#txtnumdoc").val("");
        $("#txtanio").val("");
        $("#txtvalor").val("");
        $("#txtvalorrefman").val("");

        marcarCamposObligatorios();

        // Identificar radio btn
        const btnSelecccionado = $('input:radio[name=opvalor]:checked').val();

        if (btnSelecccionado == 0) {
            $('#secreferencia').show();
            $('#secvalman').hide();
        }

        if (btnSelecccionado == 1) {
            $('#secvalman').show();
            $('#secreferencia').hide();
        }

        mostrarSubmit(btnSubmit.id);
    });

    // Se arma la referencia de pago
    $("#selconcepto .custom-option").click(function() {
        const concepto = document.querySelector("#selconcepto");
       
        if(concepto.dataset.value == "NA") {
            $("#txtref").val("");
            $("#txtvalorref").val("");
            form-block-pagos
            $("#txtvalorrefman").val("");
        }
        else {

            const numeroDocumento = $("#txtnumdoc").val();
            const anio = $("#txtanio").val();
            const referencia_pago_manual = numeroDocumento + "-" + anio + "-" + concepto.dataset.value;
            
            // input readonly informativo en valor manual
            $("#txtvalorrefman").val(referencia_pago_manual);

            // input obligatorio en referencia de pago, cuando se ejecuta esta funcion este input esta esconido
            $("#txtref").val(referencia_pago_manual);
            marcarInputCorrecto('txtref');
            quitarCampoError('txtref');
        }

        mostrarSubmit(btnSubmit.id);
    });

    /* Newsletter */
    $('#newsletterForm').on("submit", function (e) {
        e.preventDefault();
        const data = {
            correo: $('#correoNewsletter').val(),
            suscripcion: true,
        };

        $('#registerNewsletter').hide();
        $.ajax({
            url: "/cartiexplora/ajax/newsletterManager.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "error") {
                    $('#registerNewsletter').show();

                    $("#newsletter-response").data('responseType', 'error');
                    $("#newsletter-response").attr('data-response-type', 'error');
                    $("#newsletter-response").removeClass("d-none");
                    $("#newsletter-response").text(response.message);

                    setTimeout(() => {
                        $("#newsletter-response").addClass("d-none");
                    }, 5000)
                } else if (response.status === "success") {
                    $("#newsletterForm")[0].reset();

                    $("#newsletter-response").data('responseType', 'success')
                    $("#newsletter-response").attr('data-response-type', 'success')
                    $("#newsletter-response").removeClass("d-none")
                    $("#newsletter-response").text(response.message);
                    
                    setTimeout(() => {
                        $("#newsletter-response").addClass("d-none");
                    }, 5000)
                }   
            },
            error: function (r) {
                console.log(r);
                
                $('#registerNewsletter').show();

                $("#newsletter-response").data('responseType', 'error');
                $("#newsletter-response").attr('data-response-type', 'error');
                $("#newsletter-response").removeClass("d-none");

                $("#newsletter-response").text("Ha ocurrido un error, intentelo mas tarde.");

                setTimeout(() => {
                    $("#newsletter-response").addClass("d-none");
                }, 5000)
            },
        });
    });
    
    mostrarSubmit(btnSubmit.id);
});

const reglasvalidacion = {
    texto: /[-_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/,
    texto1: /[_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/,
    correo: /^[_-\w.]+@[a-z]+\.[a-z\.]{2,7}$/,
    numero: /^[0-9]{1,}$/,
    fecha: /^[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/,
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/,
};

let camposError = [];

// Elemento donde se muestra el error
//let notificacionFormInscripciones;

/*const actualizarNotificacionesErrores = () => {
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
}*/

const marcarCamposObligatorios = () => {
    const elementosForm = document.querySelectorAll(".campoFormulario");

    elementosForm.forEach((elemento) => {
        //if (elemento.tagName === "INPUT") {}
        if (elemento.hasAttribute("required") && (elemento.value == "" || elemento.value == "NA" || elemento.dataset.value == "NA")) {
            marcarInputError(elemento.id);
            agregarCampoError(elemento.id);
        }
        else {
            marcarInputCorrecto(elemento.id);
            quitarCampoError(elemento.id);
        }
    });
};

const mostrar_submit = () => {
    const elementosForm = document.querySelectorAll(".inscripciones-input");

    let todosValidos = true;
    elementosForm.forEach((input) => {
        const campoObligatorio = input.getAttribute("required") === '' ? true : false;

        if (campoObligatorio && input.value === '') {
            marcarInputError(input);
        }

        if ((input.type != "submit" && !input.classList.contains("success")) || input.classList.contains("error")) {
            todosValidos = false;
        }
    });

    if (todosValidos && error === '') {
        $("#inscripciones_enviar").removeAttr("disabled");
    } else {
        $("#inscripciones_enviar").attr("disabled", "disabled");
    }
};

const mostrarSubmit = (botonSubmit) => {
    let control = 0;
    let idObjeto = "#" + botonSubmit;

    camposError.forEach(campo => {
        marcarInputError(campo);
        control = 1;
    });

    if (control > 0) {
        $(idObjeto).hide();
    }
    else {
        try {
            let email1 = document.getElementById("register_correoA");
            let email2 = document.getElementById("register_correoA1");

            if (email1 && email2) {
                if ($("#register_correoA").val() == $("#register_correoA1").val()) {
                    $(idObjeto).show();
                    $("#alert").hide();
                }
                else {
                    var texto = "El email y la confirmación del email del acudiente deben ser iguales";
                    $("#pdesc").html(texto).css("color", "red");
                    $(idObjeto).hide();
                    $("#alert").show();
                }
            }
            else {
                $(idObjeto).show();
                $("#alert").hide();
            }
        } catch (error) {

        }
    }
};

const marcarInputError = (id) => {
    //input.classList.add("error");
    //input.classList.remove("success");
    let idObjeto = "#" + id;
    $(idObjeto).addClass("error");
};

const marcarInputCorrecto = (id) => {
    //input.classList.remove("error");
    //input.classList.add("success");
    let idObjeto = "#" + id;
    $(idObjeto).removeClass("error");
};

/**
 * Función responsable de validar el ingreso de datos en formularios
 *
 * @param {object} input campo del formulario.
 * @param {String} descripcion descripción personalizada del campo del formulario que se mostrará en caso de error
 * @param {String} reglaValidacion  propiedad del objeto reglasValidacion con la cual se va a evaluar el ingreso de datos
 * @param {Int} controlSubmit  parámetro que indica si se lanza o no la función mostrarSubmit: 0 no se lanza, 1 si se lanza
 * @param {String} botonSubmit  nombre del botón submit del formulario
 *
 * */
const validarCampo = (input, descripcion, reglaValidacion, controlSubmit, botonSubmit) => {
    let { id, name, value } = input;
    const campoObligatorio = input.getAttribute("required") === '' ? true : false;
    let control = 0;
    let texto = "";
    let idSubmit = "#" + botonSubmit;
    $(idSubmit).hide();

    if ((value.trim() === "" || value.trim() === '') && campoObligatorio) {
        control = 1;
        marcarInputError(id);
        agregarCampoError(id);
        texto = "El campo " + descripcion + " se debe llenar";
    } else {
        marcarInputCorrecto(id);
        quitarCampoError(id);
    }

    if (control == 0) {
        if (reglaValidacion == "numero") {
            if (reglasvalidacion.numero.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "Ingrese sólamente números para " + descripcion;
            }
        } else if (reglaValidacion == "texto") {
            if (value.match(reglasvalidacion.texto)) {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "Ha ingresado alguno de los siguientes caracteres no válidos para " + descripcion + ": ";
                texto += "- _ \' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\";
            } else {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            }
        } else if (reglaValidacion == "texto1") {
            if (value.match(reglasvalidacion.texto1)) {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "Ha ingresado alguno de los siguientes caracteres no válidos para " + descripcion + ": ";
                texto += "_ \' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\";
            } else {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            }
        } else if (reglaValidacion == "correo") {
            if (reglasvalidacion.correo.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "No es un patrón de correo válido para " + descripcion;
            }
        } else if (reglaValidacion == "fecha") {
            if (reglasvalidacion.fecha.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "No es un patrón válido para " + descripcion;
            }
        } else if (reglaValidacion == "password") {
            if (reglasvalidacion.password.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número.";
            }
        }
    }

    if (texto != "") {
        $("#pdesc").html(texto).css("color", "red");
        $("#alert").show();
    } else {
        $("#pdesc").html("");
        $("#alert").hide();
    }

    if (controlSubmit == 1 && control == 0) {
        mostrarSubmit(botonSubmit);
    }
};

const agregarCampoError = (id) => {
    if (!camposError.includes(id)) {
        camposError.push(id);
    }
}

const quitarCampoError = (id) => {
    try {
        let indice = camposError.indexOf(id);
        if (indice >= 0) {
            camposError.splice(indice, 1);
        }
    }
    catch (e) { }
}

const valDocumentoEntrevista = (botonSubmit) => {
    $("#divcargando").css({ display: 'block' });

    $(".datos").hide();
    $("#msgdocumento").html("");
    $("#estnuevo").val("NO");
    $("#btnEnviar").hide();
    $("#register_documentoe_f").val("");
    $("#alert").hide();

    //Se limpian lo cuadros de texto
    $("#register_nombres").val("");
    $("#register_apellidos").val("");
    $("#register_grado").val("NA");
    $('#register_grado').change();
    $("#register_tipo_documento").val("NA");
    $('#register_tipo_documento').change();
    $("#register_telefono").val("");
    $("#register_medio").val("NA");
    $('#register_medio').change();
    $("#activiadad_extra").val("");
    $("#register_genero").val("NA");
    $("#register_genero").change();

    $("#register_nombreA").val("");
    $("#register_documentoA").val("");
    $("#register_direccionA").val("");
    $("#register_celularA").val("");
    $("#register_correoA").val("");
    $("#register_correoA1").val("");
    $("#parentesco_acudiente_1").val("NA");
    $('#parentesco_acudiente_1').change();
    $("#register_ciudada").val("");

    let doc = $("#register_documentoe").val();
    let cifra = doc.substring(0, 1);
    //alert(cifra);
    if (doc == "0" || cifra == "0") {
        $("#msgdocumento").html("El documento no puede ser 0, o no puede empezar por 0");
    }
    else if (doc == "") {
        $("#msgdocumento").html("Ingrese el número de documento del estudiante");
    }
    else {
        $.ajax({
            type: "POST",
            url: "../../org/ajax/registro_matricula_0.php",
            data: "documento=" + doc,
            success: function (r) {
                let res = JSON.parse(r);
                let control_matricula = 0;
                let r_est = res.estado;

                $("#register_estado").val(r_est);

                //Se valida si ya tiene un proceso de pre matrícula abierto
                if (res.procesoAbierto == "SI") {
                    control_matricula = 1;
                    $("#pdesc").html("");
                    if (res.programoEntrevista == "SI") {
                        $("#msgdocumento").html("Este documento ya tiene un proceso de entrevista abierto. Verificar el email " + res.emailA + " para revisar la información que se envío de la entrevista.");
                    }
                    else {
                        $("#msgdocumento").html("Este documento ya tiene un proceso de entrevista abierto. Verificar el email " + res.emailA + " para revisar la información que se le enviará de la entrevista.");
                    }
                }

                if (control_matricula == 0) {
                    $("#pdesc").html("");
                    if (r_est == "activo") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;

                        $("#msgdocumento").html("Este documento se encuentra activo en el grado " + r_grado + ". El proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if (r_est == "solicitud" || r_est == "pre_solicitud") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;

                        $("#msgdocumento").html("Este documento ya tiene una solicitud de matrícula en el grado " + r_grado + ". El proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if (r_est == "reprobado") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;

                        $("#msgdocumento").html("Estudiante antiguo, el proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if (r_est == "aprobado") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;

                        $("#msgdocumento").html("Estudiante antiguo, el proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if (r_est == "retirado") {
                        $("#msgdocumento").html("Este documento se encuentra Retirado. Comunícate con Secretaría Académica.");
                    }
                    else if (r_est == "nuevo") {
                        $("#estnuevo").val("SI");
                        $("#register_documentoe_f").val(doc);
                        $(".datos").show();
                        $(".btnContinuar").hide();
                        $("#btnEnviar").hide();
                        $("#divcargando").css({ display: 'none' });
                        //mostrar_submit(botonSubmit);
                        $("#pdesc").html("");

                        //Se cargan los datos si existen
                        if (res.control_antiguos == "2") {
                            $("#register_nombres").val(res.nombres);
                            $("#register_apellidos").val(res.apellidos);
                            //$("#register_grado").val(0);
                            //$('#register_grado').change();
                            $("#register_tipo_documento").val(res.id_tdoc);
                            $('#register_tipo_documento').change();
                            $("#register_telefono").val(res.tel);
                            //$("#register_medio").val(0);
                            //$('#register_medio').change();
                            $("#activiadad_extra").val(res.actividad_extra);
                            $("#register_genero").val(res.genero);
                            $("#register_genero").change();

                            $("#register_nombreA").val(res.acudiente);
                            $("#register_documentoA").val(res.documento_responsable);
                            $("#register_direccionA").val(res.direccion);
                            $("#register_celularA").val(res.telA);
                            $("#register_correoA").val(res.emailA);
                            $("#register_correoA1").val(res.emailA);
                            $("#parentesco_acudiente_1").val(res.parentesco_acudiente_1);
                            $('#parentesco_acudiente_1').change();
                            $("#register_ciudada").val(res.ciudadA);

                            mostrarSubmit(botonSubmit);
                        }

                    }
                    else if (r_est == "inactivo") {
                        $("#msgdocumento").html("Este documento se encuentra inactivo en este momento. Comunícate con Secretaría Académica.");
                    }
                    else {
                        $("#msgdocumento").html("No se pudo procesar la solicitud de matrícula para éste documento. Comunícate con Secretaría Académica.");
                    }
                }

                $("#divcargando").css({ display: 'none' });
            }
        });
    }

}

const limpiar = () => {
    $(".datos").hide();
    $("#msgdocumento").html("");
    $("#estnuevo").val("NO");
    $(".btnContinuar").show();
    $("#btnEnviar").hide();
    $("#register_documentoe_f").val("");

    //Se limpian lo cuadros de texto
    $("#register_nombres").val("");
    $("#register_apellidos").val("");
    $("#register_grado").val(0);
    $('#register_grado').change();
    $("#register_tipo_documento").val(0);
    $('#register_tipo_documento').change();
    $("#register_telefono").val("");
    $("#register_medio").val(0);
    $('#register_medio').change();
    $("#activiadad_extra").val("");
    $("#register_genero").val(0);
    $("#register_genero").change();

    $("#register_nombreA").val("");
    $("#register_documentoA").val("");
    $("#register_direccionA").val("");
    $("#register_celularA").val("");
    $("#register_correoA").val("");
    $("#register_correoA1").val("");
    $("#parentesco_acudiente_1").val("NA");
    $('#parentesco_acudiente_1').change();
    $("#register_ciudada").val("");

    $("#pdesc").html("");
    $("#alert").hide();
}

function cambiarImagenBlog(objeto, ruta) {
    const imagen = objeto.querySelector('img')
    if (imagen) {
        imagen.src = ruta;
    }
}

function restaurarImagenBlog(objeto, ruta) {
    const imagen = objeto.querySelector('img')
    if (imagen) {
        imagen.src = ruta;
    }
}

/*Calendario*/
if (window.location.pathname.endsWith("calendario.php")) {
    document.addEventListener("DOMContentLoaded", function () {
        // Selecciona todos los contenedores de countdown
        const countdowns = document.querySelectorAll(".countdown-container");

        if (countdowns.length === 0) {
            // Ningún evento, ya mostramos el mensaje en PHP
            return;
        }

        countdowns.forEach(function (container) {
            const targetDate = new Date(container.dataset.fecha).getTime();
            const dayEl = container.querySelector(".countdown-day");
            const hourEl = container.querySelector(".countdown-hour");
            const minEl = container.querySelector(".countdown-min");
            const secEl = container.querySelector(".countdown-sec");

            const interval = setInterval(function () {
                const now = Date.now();
                const distance = targetDate - now;

                if (distance <= 0) {
                    clearInterval(interval);
                    container.innerHTML = '<p class="tx-white">El evento ya ha pasado.</p>';
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                dayEl.textContent = days;
                hourEl.textContent = hours;
                minEl.textContent = minutes;
                secEl.textContent = seconds;
            }, 1000);
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Selecciona todos los botones con la clase .btn-route
        const botonesVer = document.querySelectorAll('.btn-route');

        botonesVer.forEach((boton) => {
            boton.addEventListener('click', function () {
                const rutaArchivo = this.getAttribute('data-ruta');
                // Crear un enlace invisible y forzar la descarga
                const link = document.createElement('a');
                link.href = rutaArchivo;
                link.setAttribute('download', rutaArchivo.split('/').pop()); // Obtiene el nombre del archivo
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    });
}
/*Fin Calendario*/

/* Estados Financieros */

if (window.location.pathname.endsWith("estadosFinancieros.php")) {
    document.addEventListener("DOMContentLoaded", function () {
        const form_info = $("#form_info");
        const form_servicios = $("#form_servicios");

        const reset_form_info = () => {
            const inputs_info = form_info.find("input, textarea");
            for (let i = 0; i < inputs_info.length; i++) {
                const elemento = inputs_info[i];
                marcarInputCorrecto(elemento.id);
                quitarCampoError(elemento.id);
            }
        }

        const reset_form_servicios = () => {
            const inputs_servicios = form_servicios.find("input, textarea");
            for (let i = 0; i < inputs_servicios.length; i++) {
                const elemento = inputs_servicios[i];
                marcarInputCorrecto(elemento.id);
                quitarCampoError(elemento.id);
            }
            const selects = form_servicios.find(".custom-select");
            for (let i = 0; i < selects.length; i++) {
                const wrapper = selects[i];
                marcarInputCorrecto(wrapper.id);
                quitarCampoError(wrapper.id);
            }
        }


        form_info.on("click", function (e) {
            const id = "submit-estados-financieros";
            const send_info = $("#" + id);
            reset_form_servicios();
            camposError = [];
            send_info.hide();
            const inputs_info = form_info.find("input, textarea");

            for (let i = inputs_info.length - 1; i >= 0; i--) {
                const elemento = inputs_info[i];
                elemento.dispatchEvent(new KeyboardEvent('keyup', { bubbles: true }));
            }
            mostrarSubmit(id);

        });

        form_servicios.on("click", function (e) {
            const id = "submit-certificaciones-papeles";
            const send_servicios = $("#" + id);
            reset_form_info();
            camposError = [];
            send_servicios.hide();
            const inputs_servicios = form_servicios.find("input, textarea");

            for (let i = inputs_servicios.length - 1; i >= 0; i--) {
                const elemento = inputs_servicios[i];
                elemento.dispatchEvent(new KeyboardEvent('keyup', { bubbles: true }));
            }

            mostrarSubmit(id);

            const selects = form_servicios.find(".custom-select");
            for (let i = 0; i < selects.length; i++) {
                const wrapper = selects[i];
                const descripcion = wrapper.getAttribute("data-texto");
                const idBoton = wrapper.getAttribute("data-btn_submit");
                validarSelectPersonalizado(wrapper, descripcion, idBoton);

            }
        });


        form_info.on("submit", function (e) {
            e.preventDefault();

        });

        form_servicios.on("submit", function (e) {
            e.preventDefault();
        });

        const currentYear = new Date().getFullYear();
        const startYear = 2010;
        const endYear = 2030;

        document.querySelectorAll(".year-trigger").forEach((imgEl) => {
            const container = imgEl.closest("div");
            const select = container.querySelector(".year-select");

            // Rellenar el select solo si está vacío
            if (select.options.length === 0) {
                for (let year = startYear; year <= endYear; year++) {
                    const option = document.createElement("option");
                    option.value = year;
                    option.textContent = year;

                    if (year === currentYear) {
                        option.selected = true;
                    }

                    select.appendChild(option);
                }

                new Choices(select, {
                    searchEnabled: false,
                    itemSelectText: '',
                    shouldSort: false,
                });
            }

            // Mostrar el selector al hacer clic en la imagen
            imgEl.addEventListener("click", () => {
                select.classList.remove("d-none");
                select.focus();
            });
        });
    });
}
/* Fin Estados Financieros */

function verInfografia(imagen) {
    html_modal = '<img src="' + imagen + '" width="600px">';
    //alert(html_modal);

    $("#divmodalimg").empty();
    $("#divmodalimg").html(html_modal);

    $('#modal_img').modal('toggle');
    $('#modal_img').modal('show');
}


function validarSelectPersonalizado(elemento, descripcion, botonSubmit) {
    const id = elemento.id;
    const value = elemento.getAttribute('data-value');
    const idSubmit = "#" + botonSubmit;
    $(idSubmit).hide();

    if (value == "NA") {
        marcarInputError(id);
        agregarCampoError(id);
        $("#pdesc")
            .html(`${descripcion}`)
            .css("color", "red");
        $("#alert").show();
    } else {
        marcarInputCorrecto(id);
        quitarCampoError(id);
        $("#pdesc").html("");
        $("#alert").hide();
        mostrarSubmit(botonSubmit);
    }
}

document.addEventListener('DOMContentLoaded', function () {

    let btnSubmit = document.querySelector('button[type="submit"]');
    if (!btnSubmit) {
        console.error("btn submit no encontrado");
    }

    document.querySelectorAll('.custom-select').forEach(function (wrapper) {
        const triggerDiv = wrapper.querySelector('.display-options');
        const optionsContainer = wrapper.querySelector('.custom-options');
        const optionsList = wrapper.querySelectorAll('.custom-option');
        const selectedSpan = wrapper.querySelector('.selected-value');

        if (selectedSpan.dataset.value == "NA") {
            wrapper.classList.add('error');
        }

        triggerDiv.addEventListener('click', function (e) {
            //e.stopPropagation();
            document.querySelectorAll('.custom-select.open').forEach(function (other) {
                if (other !== wrapper) other.classList.remove('open');
            });
            wrapper.classList.toggle('open');
        });

        optionsList.forEach(function (optionEl) {
            optionEl.addEventListener('click', function (e) {
                e.stopPropagation();
                wrapper.dataset.value = optionEl.dataset.value;
                selectedSpan.textContent = optionEl.textContent;

                wrapper.classList.remove('open');

                if (wrapper.dataset.value == "NA") {

                    let texto = wrapper.dataset.texto;
                    $('#medioalert').addClass('select-alert');
                    $("#pdesc").html(texto).css("color", "red");
                    $("#alert").show();
                    marcarInputError(wrapper.id);
                    agregarCampoError(wrapper.id);

                }
                else {
                    $("#pdesc").html("");
                    $("#alert").hide();
                    marcarInputCorrecto(wrapper.id);
                    quitarCampoError(wrapper.id);
                }

                mostrarSubmit(wrapper.dataset.btnSubmit);

            });
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.custom-select')) {
            document.querySelectorAll('.custom-select.open').forEach(function (opened) {
                opened.classList.remove('open');
            });
        }
    });
});

/**  Zona de enlaces Inicio **/

// Variables
let originalOrder = null;
let linksStarted = false;
let listenersAttached = false;
let autoplay = null;

// Funciones
function loadCarousel() {
    //-- Variables --//
    const slider = document.getElementById('linksCarousel');
    const moveCount = 1;

    //-- Checkings --//
    if (slider == null) { return; }

    // Checks if the size changed, and if it is more than 992 breakpoint, returns to normal.
    if (window.innerWidth > 991 && linksStarted === true) {
        console.log('Zona de enlaces: Carousel Desactivado.');
        clearInterval(autoplay);
        linksStarted = false;

        originalOrder.forEach(function (link) {
            link.style.transition = 'none';
            link.style.transform = 'none';
            slider.appendChild(link);
        });
    }

    // Basic check for window / device checking.
    if (window.innerWidth >= 992 || linksStarted === true) { return; }

    //-- Funciones --//
    function Next() {
        Array.from(slider.children).forEach(function (link) {
            link.style.transition = 'transform .35s ease';
            link.style.transform = `translateX(-${link.offsetWidth}px)`;
        });

        setTimeout(function () {
            Array.from(slider.children).forEach(function (link) {
                link.style.transition = 'none';
                link.style.transform = `translateX(0px)`;
            });
            void slider.offsetWidth;

            for (let i = 0; i < moveCount; i++) {
                const first = slider.children[0];
                slider.appendChild(first);
            }
        }, 350);
    }

    function Previous() {
        for (let i = 0; i < moveCount; i++) {
            const last = slider.children[slider.children.length - 1];
            slider.insertBefore(last, slider.firstChild);
        }
        void slider.offsetWidth;

        Array.from(slider.children).forEach(function (link) {
            link.style.transition = 'none';
            link.style.transform = `translateX(-${link.offsetWidth}px)`;
        });

        Array.from(slider.children).forEach(function (link) {
            link.style.transition = 'transform .35s ease';
            link.style.transform = `translateX(0px)`;
        });
    }

    function Reset() {
        clearInterval(autoplay);
        autoplay = setInterval(Next, 3000);
    }

    //-- Codigo --//
    console.log('Zona de enlaces: Carousel Iniciado');

    linksStarted = true;
    originalOrder = Array.from(slider.children);
    autoplay = setInterval(Next, 3000);

    if (!listenersAttached) {
        document.querySelector('#linksCarousel_next').addEventListener('click', function () {
            Next();
            Reset();
        });

        document.querySelector('#linksCarousel_previous').addEventListener('click', function () {
            Previous();
            Reset();
        });

        listenersAttached = true;
    }
}

// Listeners
document.addEventListener('DOMContentLoaded', loadCarousel);
window.addEventListener('resize', loadCarousel)

/** Zona de enlaces Fin **/

/** Ecosistema Inicio **/

function displayEcosistema(id, btn) {
    let tresPuntos = document.querySelector(`#${id} [data-tipo="dots"]`);
    let textoOculto = document.querySelector(`#${id} [data-tipo="text"]`);
    let textoCompleto = document.querySelector(`#${id}`);

    if (btn.dataset.textoExpandido === 'false') {
        btn.dataset.textoExpandido = 'true';
        btn.innerText = "Leer menos";

        tresPuntos.classList.toggle("d-none");
        textoOculto.classList.toggle("d-none");
        textoCompleto.classList.toggle("historia-ecosistema-efecto");
    } else if (btn.dataset.textoExpandido === 'true') {
        btn.dataset.textoExpandido = 'false';
        btn.innerText = "Leer más";

        tresPuntos.classList.toggle("d-none");
        textoOculto.classList.toggle("d-none");
        textoCompleto.classList.toggle("historia-ecosistema-efecto");
    }
}

/** Ecosistema Fin **/

/** Modelo Pedagogico Inicio **/

document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".nuestroModelo-item");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    }, { threshold: 0.5 });

    elements.forEach(el => observer.observe(el));
});

/** Modelo Pedagogico Fin **/

/** Celebrando logros y experiencias Inicio **/

const updateBlog = function(response) {
    console.log("Success blog update");
    document.getElementById('blog_post').scrollIntoView({ behavior: 'smooth' });
    window.history.replaceState(null, '', window.location.pathname);

    $("#blog_dislikeBtn").addClass("d-none");
    $("#blog_likeBtn").removeClass("d-none");

    $('#comentarios').children().each(function() {
        $(this).remove();
    });

    $('#blog_post').data('blogId', response.id);
    $('#blog_post').attr('data-blog-id', response.id);

    const partes = response.fecha.split("-");
    const fecha = new Date(partes[0], partes[1] - 1, partes[2]); // Año, mes (0-indexado), día

    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
    const formatoFecha = fecha.toLocaleDateString('es-ES', opciones);
    $('#blogDate').text(formatoFecha);

    $('#blogTitle').text(response.titulo);
    $('#blogPublisher').text("Por: "+response.autor);
    $('#blogImage').attr('src', '../../../'+response.imagen);
    $('#content').html(response.descripcion);

    response.comentarios.reverse().forEach(function(comentario) {
        const comment = $("#comentario-plantilla .comment-block").clone();
        comment.find('.logros-comentario').text(comentario.comentario);
        comment.find('.logros-correo').text(comentario.correo);

        const fechaOriginal = comentario.fecha;
        const fecha = new Date(fechaOriginal);
        const fechaFormateada = fecha.toISOString().slice(2, 10); // "yy-mm-dd"
        comment.find('.logros-fecha').text(fechaFormateada);

        $('#comentarios').append('<div class="col-lg-2 col-md-2"></div>')
        $('#comentarios').append(comment);
        $('#comentarios').append('<div class="col-lg-2 col-md-2"></div>')
    });
} 

$(document).ready(function() {
    $("a[data-button-blog]").on("click", function(e) {
        e.preventDefault();

        const data = { 
            id: $(this).data('blogId') 
        };
    
        $.ajax({
            url: "../../org/ajax/blogSetManager.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    updateBlog(response);
                }   
            },
            error: function (response) {
                console.log(response);
            },
        });  
    });

    $(document).on("click", '.blogsearch-result', function(e) {
        e.preventDefault();
        console.log('doing thing');

        const data = { 
            id: $(this).data('blogId') 
        };
    
        $.ajax({
            url: "../../org/ajax/blogSetManager.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "success") {
                    
                    updateBlog(response);
                    $('#searchbar-blog').val('');
                    $("#search-results .search-engine").empty();
                }   
            },
            error: function (response) {
                console.log(response);
            },
        });  
    });

    $('#searchbar-blog').on('input', function() {
        var value = $(this).val();

        if (value != "") {
            $.ajax({
                url: "../../org/ajax/blogSearchEngine.php",
                type: "POST",
                data: {input: value},
                success: function (response) {
                    if (response.status === "success") {
                        $("#search-results").removeClass("d-none"); 
                        console.log("search completed");

                        $('#search-results .search-engine').html(response.searchData)
                    }   
                },  
                error: function (response) {
                    $("#search-results").addClass("d-none");    
                    console.log(response);
                },
            });  
        } else {
            $("#search-results .search-engine").empty();
        }
    });
});

const mostrarSubmitNewsletter = (botonSubmit, nombreFormulario) => {
    let control = 0;
    let controlPrueba = 0;
    let idObjeto = "#" + botonSubmit;
    
    camposError.forEach(campo => {
        marcarInputError(campo);
        control = 1;
    }); 

    if (nombreFormulario == 'newsletterForm') {
        let campoCorreoNewsletter = camposError.includes('correoNewsletter');
        
        if (campoCorreoNewsletter) {
            return;
        } else {
            control = 0;
        }
    }

    if(control > 0) {
        $(idObjeto).hide();
    }
    else {
        try {
            let email1 = document.getElementById("register_correoA");
            let email2 = document.getElementById("register_correoA1");
            
            if (email1 && email2) {
                if($("#register_correoA").val() == $("#register_correoA1").val()) {
                    $(idObjeto).show();
                    $("#alert").hide();
                }
                else {
                    var texto = "El email y la confirmación del email del acudiente deben ser iguales";
                    $("#pdesc").html(texto).css("color","red");
                    $(idObjeto).hide();
                    $("#alert").show();
                }
            }
            else {
                $(idObjeto).show();
                $("#alert").hide();
            }
        } catch (error) {
            
        }
    }
};

const validarCampoNewsletter = (input, descripcion, reglaValidacion, controlSubmit, botonSubmit, nombreFormulario) => {
    let { id, name, value } = input;
    const campoObligatorio = input.getAttribute("required") === '' ? true : false;
    let control = 0;
    let texto = "";
    let idSubmit = "#" + botonSubmit;
    $(idSubmit).hide();

    if ((value.trim() === "" || value.trim() === '') && campoObligatorio) {
        control = 1;
        marcarInputError(id);
        agregarCampoError(id);
        texto = "El campo " + descripcion + " se debe llenar";
    } else {
        marcarInputCorrecto(id);
        quitarCampoError(id);
    }

    if (control == 0) {
        if (reglaValidacion == "numero") {
            if (reglasvalidacion.numero.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "Ingrese sólamente números para " + descripcion;
            }
        } else if (reglaValidacion == "texto") {
            if (value.match(reglasvalidacion.texto)) {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "Ha ingresado alguno de los siguientes caracteres no válidos para " + descripcion + ": ";
                texto += "- _ \' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\";
            } else {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            }
        } else if (reglaValidacion == "texto1") {
            if (value.match(reglasvalidacion.texto1)) {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "Ha ingresado alguno de los siguientes caracteres no válidos para " + descripcion + ": ";
                texto += "_ \' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\";
            } else {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            }
        } else if (reglaValidacion == "correo") {
            if (reglasvalidacion.correo.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "No es un patrón de correo válido para " + descripcion;
            }
        } else if (reglaValidacion == "fecha") {
            if (reglasvalidacion.fecha.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "No es un patrón válido para " + descripcion;
            }
        } else if (reglaValidacion == "password") {
            console.log(value);
            if (reglasvalidacion.password.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                control = 1;
                marcarInputError(id);
                agregarCampoError(id);
                texto = "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número.";
            }
        }
    }

    if (texto != "") {
        $("#pdesc").html(texto).css("color","red");
        $("#alert").show();
    } else {
        $("#pdesc").html("");
        $("#alert").hide();
    }
    
    if (controlSubmit == 1 && control == 0) {
        mostrarSubmitNewsletter(botonSubmit, nombreFormulario);
    }    
};

/** Celebrando logros y experiencias Fin **/