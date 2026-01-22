$(function () {
    $(".select2").select2();
});

document.addEventListener("DOMContentLoaded", () => {
    galeriaEstudiantes();
});

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
/*const descargarArchivo = (nivel, path, nombreNuevoArchivo, destino) => {
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
};*/

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
    $(".presaberes-bienvenida").hide();
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
            //Esta es la ruta desde donde se llama ... cartiexplora/components/inscripciones.php
            //local
            //url: "../cartiexplora/ajax/formInscripcionesAbiertas.php",
            //produccion
            url: "ajax/formInscripcionesAbiertas.php",
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

    if (window.location.pathname.endsWith("pagos.php")) {
        mostrarSubmit(btnSubmit.id);
    }
    else if (window.location.pathname.endsWith("pagar_curso.php")) {
        mostrarSubmit(btnSubmit.id);
    }
    else if (window.location.pathname.endsWith("transformacionDigital.php")) {
        mostrarSubmit(btnSubmit.id);
    }
    
    //mostrarSubmit(btnSubmit.id);
    const formulario = btnSubmit.closest('form');
    if (!formulario.hasAttribute('data-form-instance')) {
        mostrarSubmit(btnSubmit.id);
    }
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
    if (controlSubmit == 1) {
        $(idSubmit).hide();
    }

    if ((value.trim() === "" || value.trim() === '') && campoObligatorio) {
        control = 1;
        marcarInputError(id);
        agregarCampoError(id);
        texto = "El campo " + descripcion + " se debe llenar";
    } else {
        marcarInputCorrecto(id);
        quitarCampoError(id);
    }

    armarReferenciaPago();

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
                    //$('#medioalert').addClass('select-alert');
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

                armarReferenciaPago();
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
    const modeloZoom = document.getElementById("modelo_zoom");

    if (modeloZoom) {
        const modeloImg = document.getElementById("modelo_imgzoom");
        const modeloContainer = document.getElementById("modelo-zoomContainer");
        modeloZoom.addEventListener("click", () => {
            modeloContainer.classList.toggle("d-none");
        });
        modeloContainer.addEventListener("click", () => {
            modeloContainer.classList.toggle("d-none");
        });
    }

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
    $('#blogImage').attr('src', response.imagen);
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
    let contenido=$(".ghf");
    contenido.slideUp(250);

    $(document).on("click", 'a[data-button-blog]', function(e) {
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

    $(document).on("click", '.blogsearch-result[data-blog-id]', function(e) {
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
                data: {verTodo: false, input: value},
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

    let clickedInsideResults = false;

    $('#search-results').on('mousedown', function() {
        clickedInsideResults = true;
    });

    $('#searchbar-blog').on('focus', function() {
        $("#search-results").removeClass("d-none");   
    });

    $('#searchbar-blog').on('blur', function() {
        setTimeout(function() {
            if (!clickedInsideResults) {
                $("#search-results").addClass("d-none");
            }
            clickedInsideResults = false;
        }, 100);
    });

    const textoBusqueda = $('#titulo-busqueda').text()
    $(document).on("click", '[data-see-more-blogs]', function(e) {
        e.preventDefault();

        $.ajax({
            url: "../../org/ajax/blogSearchEngine.php",
            type: "POST",
            data: {verTodo: true, input: $('#searchbar-blog').val()},
            success: function (response) {
                if (response.status === "success") {
                    document.getElementById('resultados-busqueda-blog').scrollIntoView({ behavior: 'smooth' });
                    $("#search-results").addClass("d-none"); 
                    $("#noticias-recientes").addClass("d-none"); 
                    $("#titulo-busquedaCategorias").addClass("d-none"); 
                    $("#resultados-busqueda-blog").removeClass("d-none"); 
                    $("#titulo-busqueda").removeClass("d-none"); 

                    $('#titulo-busqueda').text(textoBusqueda + $('#searchbar-blog').val())
                    $('#resultados').html(response.searchData)
                }   
            },
            error: function (response) {
                console.log(response);
            },
        });  
    });

    const textoCategorias = $('#titulo-busquedaCategorias').text()
    $(document).on("click", '[data-categoria-boton]', function(e) {
        e.preventDefault();
        const boton = $(this);
        const textoBoton = boton.text();

        $.ajax({
            url: "../../org/ajax/blogCategories.php",
            type: "POST",
            data: {categoria: this.dataset.categoria},
            success: function (response) {
                if (response.status === "success") {
                    document.getElementById('resultados-busqueda-blog').scrollIntoView({ behavior: 'smooth' });
                    $("#titulo-busqueda").addClass("d-none"); 
                    $("#noticias-recientes").addClass("d-none"); 
                    $("#resultados-busqueda-blog").removeClass("d-none"); 
                    $("#titulo-busquedaCategorias").removeClass("d-none"); 

                    $('#titulo-busquedaCategorias').text(textoCategorias + textoBoton)
                    $('#resultados').html(response.searchData)
                }   
            },
            error: function (response) {
                console.log(response);
            },
        });  
    });

    let cancelarSuscripcionVisible = false;
    $('#unsubscribe-newsletter').on("click", function(e) {
        e.preventDefault();
        cancelarSuscripcionVisible = !cancelarSuscripcionVisible

        if (cancelarSuscripcionVisible) {
            $('#newsletter-cancelarSuscripcion').show();
        } else {
            $('#newsletter-cancelarSuscripcion').hide();
        }
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

    $('#newsletterUnsubscribeForm').on("submit", function (e) {
        e.preventDefault();
        
        const data = {
            correo: $('#unsubscribeNewsletter').val(),
            suscripcion: false,
        };

        $('#unsubscribeNewsletterButton').hide();
        $.ajax({
            url: "/cartiexplora/ajax/newsletterManager.php",
            type: "POST",
            data: data,
            success: function (response) {
                if (response.status === "error") {
                    $('#unsubscribeNewsletterButton').show();

                    $("#unsubscribe-newsletter-response").data('responseType', 'error');
                    $("#unsubscribe-newsletter-response").attr('data-response-type', 'error');
                    $("#unsubscribe-newsletter-response").removeClass("d-none");
                    $("#unsubscribe-newsletter-response").text(response.message);

                    setTimeout(() => {
                        $("#unsubscribe-newsletter-response").addClass("d-none");
                    }, 5000)
                } else if (response.status === "success") {
                    $("#newsletterUnsubscribeForm")[0].reset();

                    $("#unsubscribe-newsletter-response").data('responseType', 'success')
                    $("#unsubscribe-newsletter-response").attr('data-response-type', 'success')
                    $("#unsubscribe-newsletter-response").removeClass("d-none")
                    $("#unsubscribe-newsletter-response").text(response.message);
                    
                    setTimeout(() => {
                        $("#unsubscribe-newsletter-response").addClass("d-none");
                        $("#newsletter-cancelarSuscripcion").hide();
                        cancelarSuscripcionVisible = false;
                    }, 5000)
                }   
            },
            error: function (r) {
                console.log(r);
                
                $('#unsubscribeNewsletterButton').show();

                $("#unsubscribe-newsletter-response").data('responseType', 'error');
                $("#unsubscribe-newsletter-response").attr('data-response-type', 'error');
                $("#unsubscribe-newsletter-response").removeClass("d-none");

                $("#unsubscribe-newsletter-response").text("Ha ocurrido un error, intentelo mas tarde.");

                setTimeout(() => {
                    $("#unsubscribe-newsletter-response").addClass("d-none");
                }, 5000)
            },
        });
    });
});

//** Formularios Class Home **//
class formularioIndividual {

    constructor (formulario) {
        this.formulario = formulario;
        this.botonSubmit = `#${JSON.parse(formulario.dataset.formConfiguracion).botonSubmit}`;
        this.camposError = [];
    }

    setupForm() {
        const campos = this.formulario.querySelectorAll('input:not([disabled]), select:not([disabled]), textarea:not([disabled])');
        
        console.log(this.botonSubmit);
        $(this.botonSubmit).hide();
        campos.forEach(campo => {
            if (['INPUT', 'TEXTAREA'].includes(campo.tagName)) {
                /// Verifica al ser inicializado para prevenir que se habilite el boton.
                if (campo.hasAttribute("required") && (campo.value == "" || campo.value == "NA")) {
                    this.marcarError(campo);
                    this.agregarError(campo);
                }
                else {
                    this.marcarCorrecto(campo);
                    this.quitarError(campo);
                }

                campo.addEventListener('keyup', () => {
                    const descripcion = campo.dataset.descripcion;
                    const reglaValidacion = campo.dataset.reglaValidacion;
                    const controlSubmit = parseInt(campo.dataset.controlSubmit);

                    this.validarCampo(
                        campo,
                        descripcion,
                        reglaValidacion,
                        controlSubmit
                    );
                });
            }
        });
    }

    marcarError = (campo) => {
        $(campo).addClass("error");
    };

    marcarCorrecto = (campo) => {
        $(campo).removeClass("error");
    };

    agregarError = (campo) => {
        if (!this.camposError.includes(campo)) {
            this.camposError.push(campo);
        }
    }

    quitarError = (campo) => {
        try {
            let indice = this.camposError.indexOf(campo);
            if (indice >= 0) {
                this.camposError.splice(indice, 1);
            }        
        }
        catch(e) {}
    }

    validarCampo(input, descripcion, reglaValidacion, controlSubmit) {
        let { value } = input;
        const campoObligatorio = input.getAttribute("required") === '' ? true : false;
        let control = 0;
        let texto = "";
        $(this.botonSubmit).hide();

        if ((value.trim() === "" || value.trim() === '') && campoObligatorio) {
            control = 1;
            this.marcarError(input);
            this.agregarError(input);
            texto = "El campo " + descripcion + " se debe llenar";
        } else {
            this.marcarCorrecto(input);
            this.quitarError(input);
        }

        if (control == 0) {
            if (reglaValidacion == "numero") {
                if (reglasvalidacion.numero.test(value)) {
                    this.marcarCorrecto(input);
                    this.quitarError(input);
                } else {
                    control = 1;
                    this.marcarError(input);
                    this.agregarError(input);
                    texto = "Ingrese sólamente números para " + descripcion;
                }
            } else if (reglaValidacion == "texto") {
                if (value.match(reglasvalidacion.texto)) {
                    control = 1;
                    this.marcarError(input);
                    this.agregarError(input);
                    texto = "Ha ingresado alguno de los siguientes caracteres no válidos para " + descripcion + ": ";
                    texto += "- _ \' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\";
                } else {
                    this.marcarCorrecto(input);
                    this.quitarError(input);
                }
            } else if (reglaValidacion == "texto1") {
                if (value.match(reglasvalidacion.texto1)) {
                    control = 1;
                    this.marcarError(input);
                    this.agregarError(input);
                    texto = "Ha ingresado alguno de los siguientes caracteres no válidos para " + descripcion + ": ";
                    texto += "_ \' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\";
                } else {
                    this.marcarCorrecto(input);
                    this.quitarError(input);
                }
            } else if (reglaValidacion == "correo") {
                if (reglasvalidacion.correo.test(value)) {
                    this.marcarCorrecto(input);
                    this.quitarError(input);
                } else {
                    control = 1;
                    this.marcarError(input);
                    this.agregarError(input);
                    texto = "No es un patrón de correo válido para " + descripcion;
                }
            } else if (reglaValidacion == "fecha") {
                if (reglasvalidacion.fecha.test(value)) {
                    this.marcarCorrecto(input);
                    this.quitarError(input);
                } else {
                    control = 1;
                    this.marcarError(input);
                    this.agregarError(input);
                    texto = "No es un patrón válido para " + descripcion;
                }
            } else if (reglaValidacion == "password") {
                console.log(value);
                if (reglasvalidacion.password.test(value)) {
                    this.marcarCorrecto(input);
                    this.quitarError(input);
                } else {
                    control = 1;
                    this.marcarError(input);
                    this.agregarError(input);
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
            this.submitCheck();
        }
    }

    submitCheck() {
        let controlSubmit = 0;
        
        this.camposError.forEach(campo => {
            this.marcarError(campo);
            controlSubmit = 1;
        });

        if(controlSubmit > 0) {
            $(this.botonSubmit).hide();
        } else {
            $(this.botonSubmit).show();
            $("#alert").hide();
        }
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // Obtiene todos los forms con data-attribute "form-instance"
    // Crea un nuevo objeto de ese formulario.

    document.querySelectorAll("[data-form-instance]").forEach((formulario) => {
        const form = new formularioIndividual(formulario);
        form.setupForm();
    });

});

//** Formularios Class Home Fin **//

/** Celebrando logros y experiencias Fin **/

/** Presaberes */
function val_documento_presaberes() {
    //alert("hola");
    $(".loader").fadeOut("slow");
    $("#btncomenzar").hide();

    let doc = $("#register_documento").val();
    $("#n_documento").val(doc);
    
    //Se valida si el estudiante ya presentó la evaluación de presaberes --- validaciion_pres_sm (sin matrícula)
    $.ajax({
        type:"POST",
        url: "../../org/ajax/validacion_pres.php",
        data:"documento=" + doc,
        success:function(r) {
            let res = JSON.parse(r);
            
            let r_est = res.estado;
            let grado = res.grado;
            let idgrado = res.idgra;
            let r_ctpreg = res.ct_preg;
            
            $("#idgra").val(idgrado);
            $("#lblct_preg").html(r_ctpreg);
            $("#ct_preg").val(r_ctpreg);
            
            if(res.ct_preg == "0") {
                //Se valida si el documento está en base de datos
                if(res.estado_doc == "NoBD") {
                    $("#msgdocumento").html("Este documento no está asociado a ningún grado para presentar la evaluación.");
                }
                else {
                    $("#msgdocumento").html("Para el grado " + grado + " no aplica esta evaluación de admisión.");
                }
                
                let contenido=$(".presaberes-bienvenida");
                contenido.slideUp(250);
                //let contenido1=$(".file-input");
                //contenido1.slideUp(250);
            }
            else if(res.origen == "Home School") {
                $("#msgdocumento").html("Este documento es de origen Home School. Debe ponerse en contacto con secretaría académica.");
                let contenido=$(".presaberes-bienvenida");
                contenido.slideUp(250);
                //let contenido1=$(".file-input");
                //contenido1.slideUp(250);
            }
            else {
                if(r_est == "SIN_PRESENTAR") {
                    //val_documento1();							
                    $("#msgdocumento").html("");
                    
                    if(idgrado == 11 || idgrado == 12 || idgrado == 17 || idgrado == 18) {
                        //$("#ct_preg_cf").show();
                        $("#ct_preg_sf").hide();
                    }
                    else {
                        //$("#ct_preg_cf").hide();
                        $("#ct_preg_sf").show(); 
                    }
                    
                    //let contenido2=$("#divcodigo");
                    //contenido2.slideUp(250);
                        
                    $("#msgdocumento").html("");
                        
                    let contenido=$(".presaberes-bienvenida");
                    contenido.slideDown(250);
                    //let contenido1=$(".file-input");
                    //contenido1.slideDown(250);
                    
                    $("#btncomenzar").show();
                }
                else {
                    $("#msgdocumento").html("Este documento ya presentó la evaluación de presaberes.");
                    
                    let contenido=$(".presaberes-bienvenida");
                    contenido.slideUp(250);
                    //let contenido1=$(".file-input");
                    //contenido1.slideUp(250);
                }
            }
            
        }
    });
}

function val_documento_presaberes_sm() {
    //alert("hola");
    $(".loader").fadeOut("slow");
    $("#btncomenzar").hide();

    let doc = $("#register_documento").val();
    $("#n_documento").val(doc);
    
    //Se valida si el estudiante ya presentó la evaluación de presaberes --- validaciion_pres_sm (sin matrícula)
    $.ajax({
        type:"POST",
        url: "../../org/ajax/validacion_pres_sm.php",
        data:"documento=" + doc,
        success:function(r) {
            let res = JSON.parse(r);
            
            let r_est = res.estado;
            let grado = res.grado;
            let idgrado = res.idgra;
            let r_ctpreg = res.ct_preg;
            
            $("#idgra").val(idgrado);
            $("#lblct_preg").html(r_ctpreg);
            $("#ct_preg").val(r_ctpreg);
            
            if(res.ct_preg == "0") {
                //Se valida si el documento está en base de datos
                if(res.estado_doc == "NoBD") {
                    $("#msgdocumento").html("Este documento no está asociado a ningún grado para presentar la evaluación.");
                }
                else {
                    $("#msgdocumento").html("Para el grado " + grado + " no aplica esta evaluación de admisión.");
                }
                
                let contenido=$(".presaberes-bienvenida");
                contenido.slideUp(250);
                //let contenido1=$(".file-input");
                //contenido1.slideUp(250);
            }
            else if(res.origen == "Home School") {
                $("#msgdocumento").html("Este documento es de origen Home School. Debe ponerse en contacto con secretaría académica.");
                let contenido=$(".presaberes-bienvenida");
                contenido.slideUp(250);
                //let contenido1=$(".file-input");
                //contenido1.slideUp(250);
            }
            else {
                if(r_est == "SIN_PRESENTAR") {
                    //val_documento1();							
                    $("#msgdocumento").html("");
                    
                    if(idgrado == 11 || idgrado == 12 || idgrado == 17 || idgrado == 18) {
                        //$("#ct_preg_cf").show();
                        $("#ct_preg_sf").hide();
                    }
                    else {
                        //$("#ct_preg_cf").hide();
                        $("#ct_preg_sf").show(); 
                    }
                    
                    //let contenido2=$("#divcodigo");
                    //contenido2.slideUp(250);
                        
                    $("#msgdocumento").html("");
                        
                    let contenido=$(".presaberes-bienvenida");
                    contenido.slideDown(250);
                    //let contenido1=$(".file-input");
                    //contenido1.slideDown(250);
                    
                    $("#btncomenzar").show();
                }
                else {
                    $("#msgdocumento").html("Este documento ya presentó la evaluación de presaberes.");
                    
                    let contenido=$(".presaberes-bienvenida");
                    contenido.slideUp(250);
                    //let contenido1=$(".file-input");
                    //contenido1.slideUp(250);
                }
            }
            
        }
    });
}

function primer_pregunta() {
    let contenido=$(".ghf");
    contenido.slideDown(250);
    let contenido1=$(".ghf1");
    contenido1.slideUp(250);
    
    $("#divencp").show();
    
    let listado = $("#txt_ids_preguntas").val();
    //alert(listado);
    let longitud = listado.length;
    //alert(longitud);
    let separa = listado.split("_");
    let idpreg = separa[0];
    //alert(idpreg);
    let separa1 = idpreg + "_";
    //alert(separa1);
    let longitud1 = separa1.length;
    let listado_final = listado.substring(longitud1,longitud);
    $("#txt_ids_preguntas").val(listado_final);
    $("#txt_idpreg").val(idpreg);
    
    //Se carga la pregunta
    $.ajax({
        type:"POST",
        url: "../../org/ajax/preguntas_est_getdat.php",
        data:"idpreg=" + idpreg,
        success:function(r) {
            let res = JSON.parse(r);
            //alert(res.id_tp);
            let long_img = res.imagen.length;
            let imagen = "registro" + res.imagen.substring(5,long_img);
            
            $("#txt_respuesta1").val(res.r1ok);
            $("#txt_respuesta2").val(res.r2ok);
            $("#txt_respuesta3").val(res.r3ok);
            $("#txt_retro").val(res.retro);
            
            let opciones = [res.r1ok, res.r1no, res.r2no, res.r3no];
            //La función Math.random() nos devuelve un número aleatorio entre 0 y 0.9999..., 
            //lo que conseguimos al restarle 0.5 es que nos genere números negativos y positivos 
            //para que la función sort() nos re-ordene el array de forma aleatoria colocando un elemento delante otro detrás.
            opciones.sort(function() { return Math.random() - 0.5 });
            
            let opciones2 = [res.r1ok, res.r2ok, res.r1no, res.r2no];
            opciones2.sort(function() { return Math.random() - 0.5 });
            
            let opciones3 = [res.r1ok, res.r2ok, res.r3ok, res.r1no];
            opciones3.sort(function() { return Math.random() - 0.5 });
            
            $("#txt_tp").val(res.id_tp);
            
            if(res.id_tp == 2) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + '</p><br>';
                html = html + '<p>Respuesta: <input type="text" id="txtrespuesta" /></p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
            else if(res.id_tp == 3) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + '</p><br>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r1" value="' + opciones[0] + '"> ' + opciones[0] + '</label></p>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r2" value="' + opciones[1] + '"> ' + opciones[1] + '</label></p>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r3" value="' + opciones[2] + '"> ' + opciones[2] + '</label></p>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r4" value="' + opciones[3] + '"> ' + opciones[3] + '</label></p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
            else if(res.id_tp == 4) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + ' (Seleccione dos)</p><br>';
                html = html + '<p><input type="checkbox" id="r1" value="' + opciones2[0] + '"> ' + opciones2[0] + '</p>';
                html = html + '<p><input type="checkbox" id="r2" value="' + opciones2[1] + '"> ' + opciones2[1] + '</p>';
                html = html + '<p><input type="checkbox" id="r3" value="' + opciones2[2] + '"> ' + opciones2[2] + '</p>';
                html = html + '<p><input type="checkbox" id="r4" value="' + opciones2[3] + '"> ' + opciones2[3] + '</p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
            else if(res.id_tp == 5) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + ' (Seleccione tres)</p><br>';
                html = html + '<p><input type="checkbox" id="r1" value="' + opciones3[0] + '"> ' + opciones3[0] + '</p>';
                html = html + '<p><input type="checkbox" id="r2" value="' + opciones3[1] + '"> ' + opciones3[1] + '</p>';
                html = html + '<p><input type="checkbox" id="r3" value="' + opciones3[2] + '"> ' + opciones3[2] + '</p>';
                html = html + '<p><input type="checkbox" id="r4" value="' + opciones3[3] + '"> ' + opciones3[3] + '</p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
        }
    });
    
    //Se valida si ya todas las preguntas se contestaron para activar la finalización
    let tot_conteo = parseInt($("#txtconteo").val());
    let tot_totpreg = parseInt($("#txttotalpreg").val());
    if(tot_conteo > tot_totpreg) {
        $("#btnsiguiente").hide();
        $("#btnfinalizar").show();
        
        tot_conteo--;
        $("#txtconteo").val(tot_conteo);
    }
}

function sig_pregunta() {
    //Se valida si el campo texto esta lleno para el tipo de pregunta 2
    let tp = $("#txt_tp").val();
    if(tp == "2") {
        if($("#txtrespuesta").val() == "") {
            alert("Se debe indicar la respuesta");
            return;
        }
        
        validar_texto('txtrespuesta');
        if($("#txt_control_respuesta").val() == "ERROR") {
            return;
        }
    }
    else if(tp == "3") {
        let respuesta = $('input:radio[name=respuesta]:checked').val();
        
        if(respuesta == undefined) {
            alert("Se debe seleccionar una opción");
            return;
        }
    }
    else if(tp == "4") {
        let sel = $('input[type=checkbox]:checked').map(function(_, el) {
            return $(el).val();
        }).get();
        if(sel == "") {
            alert("No ha seleccionado ningua opción");
            return;
        }
    }
    else if(tp == "5") {
        let sel = $('input[type=checkbox]:checked').map(function(_, el) {
            return $(el).val();
        }).get();
        if(sel == "") {
            alert("No ha seleccionado ningua opción");
            return;
        }
    }
    
    //Se actualiza la respuesta en la tabla tbl_respuestas *********************
    actualizar_respuesta(tp);
    //Fin actualización respuesta **********************************************    
    
    //Se cambia el consecutivo
    let conteo = parseInt($("#txtconteo").val());
    conteo++;
    //alert(conteo);
    $("#txtconteo").val(conteo);
    //Se valida si es la última pregunta
    if(conteo > parseInt($("#txttotalpreg").val())) {
        $("#btnsiguiente").hide();
        $("#btnfinalizar").show();
        
        let html = '';
        html = html + '<div id="divimagen" class="col-4 col-sm-4">';
        html = html + '</div>';
        html = html + '<div id="divtextopregunta" class="col-8 col-sm-8">';
        html = html + '</div>';
        
        $("#divpreguntas").empty();
        $("#divpreguntas").html(html);
        
        conteo--;
        $("#txtconteo").val(conteo);
    }
    
    let listado = $("#txt_ids_preguntas").val();
    //alert(listado);
    let longitud = listado.length;
    //alert(longitud);
    let separa = listado.split("_");
    let idpreg = separa[0];
    //alert(idpreg);
    let separa1 = idpreg + "_";
    //alert(separa1);
    let longitud1 = separa1.length;
    let listado_final = listado.substring(longitud1,longitud);
    $("#txt_ids_preguntas").val(listado_final);
    $("#txt_idpreg").val(idpreg);
    
    //Se carga la pregunta
    $.ajax({
        type:"POST",
        url: "../../org/ajax/preguntas_est_getdat.php",
        data:"idpreg=" + idpreg,
        success:function(r) {
            let res = JSON.parse(r);
            let long_img = res.imagen.length;
            let imagen = "registro" + res.imagen.substring(5,long_img);
            
            $("#txt_respuesta1").val(res.r1ok);
            $("#txt_respuesta2").val(res.r2ok);
            $("#txt_respuesta3").val(res.r3ok);
            $("#txt_retro").val(res.retro);
            
            let opciones = [res.r1ok, res.r1no, res.r2no, res.r3no];
            //La función Math.random() nos devuelve un número aleatorio entre 0 y 0.9999..., 
            //lo que conseguimos al restarle 0.5 es que nos genere números negativos y positivos 
            //para que la función sort() nos re-ordene el array de forma aleatoria colocando un elemento delante otro detrás.
            opciones.sort(function() { return Math.random() - 0.5 });
            
            let opciones2 = [res.r1ok, res.r2ok, res.r1no, res.r2no];
            opciones2.sort(function() { return Math.random() - 0.5 });
            
            let opciones3 = [res.r1ok, res.r2ok, res.r3ok, res.r1no];
            opciones3.sort(function() { return Math.random() - 0.5 });
            
            $("#txt_tp").val(res.id_tp);
            
            if(res.id_tp == 2) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + '</p><br>';
                html = html + '<p>Respuesta: <input type="text" id="txtrespuesta" /></p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
            else if(res.id_tp == 3) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + '</p><br>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r1" value="' + opciones[0] + '"> ' + opciones[0] + '</label></p>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r2" value="' + opciones[1] + '"> ' + opciones[1] + '</label></p>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r3" value="' + opciones[2] + '"> ' + opciones[2] + '</label></p>';
                html = html + '<p><label><input type="radio" name="respuesta" id="r4" value="' + opciones[3] + '"> ' + opciones[3] + '</label></p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
            else if(res.id_tp == 4) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + ' (Seleccione dos)</p><br>';
                html = html + '<p><input type="checkbox" id="r1" value="' + opciones2[0] + '"> ' + opciones2[0] + '</p>';
                html = html + '<p><input type="checkbox" id="r2" value="' + opciones2[1] + '"> ' + opciones2[1] + '</p>';
                html = html + '<p><input type="checkbox" id="r3" value="' + opciones2[2] + '"> ' + opciones2[2] + '</p>';
                html = html + '<p><input type="checkbox" id="r4" value="' + opciones2[3] + '"> ' + opciones2[3] + '</p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
            else if(res.id_tp == 5) {
                let html = '';
                let html_modal = '';
                html = html + '<div id="divimagen" class="col-4 col-sm-4" style="overflow: scroll;">';
                if(res.imagen != "NA") {
                    html = html + '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_img"><img class="imgpreg" src="https://unicab.org/' + imagen + '" width="250px"></a>';
                    html_modal = html_modal + '<img src="https://unicab.org/' + imagen + '" width="600px">';
                }
                html = html + '</div>';
                html = html + '<div id="divtextopregunta" class="col-8 col-sm-8" style="overflow: scroll;">';
                html = html + '<p>' + res.pregunta + ' (Seleccione tres)</p><br>';
                html = html + '<p><input type="checkbox" id="r1" value="' + opciones3[0] + '"> ' + opciones3[0] + '</p>';
                html = html + '<p><input type="checkbox" id="r2" value="' + opciones3[1] + '"> ' + opciones3[1] + '</p>';
                html = html + '<p><input type="checkbox" id="r3" value="' + opciones3[2] + '"> ' + opciones3[2] + '</p>';
                html = html + '<p><input type="checkbox" id="r4" value="' + opciones3[3] + '"> ' + opciones3[3] + '</p>';
                if(res.imagen != "NA") {
                    html = html + '</div><label>Clic en la imagen para agrandar</label>';
                }
                else {
                    html = html + '</div>';
                }
                
                $("#divpreguntas").empty();
                $("#divpreguntas").html(html);
                
                $("#divmodalimg").empty();
                $("#divmodalimg").html(html_modal);
            }
        }
    });
}

function actualizar_respuesta(tp) {
    //alert(tp);
    let idpreg = $("#txt_idpreg").val();
    let documento = $("#txt_documento").val();
    let respuesta1 = $("#txt_respuesta1").val(); //Esta es la respuesta ok de la pregunta cargada desde la base de datos
    let respuesta2 = $("#txt_respuesta2").val(); //Esta es la respuesta 2 ok de la pregunta cargada desde la base de datos
    let respuesta3 = $("#txt_respuesta3").val(); //Esta es la respuesta 3 ok de la pregunta cargada desde la base de datos
    let resultado = "";
        
    if(tp == "2") {
        let respuesta = $("#txtrespuesta").val();
        
        if(respuesta == respuesta1) {
            resultado = "OK";
        }
        else {
            resultado = "NO";
        }
        //alert(resultado);
        
        //Se actualiza la respuesta
        $.ajax({
            type:"POST",
            url: "../../org/ajax/respuestas_est_upddat.php",
            data:"idpreg=" + idpreg + "&documento=" + documento + "&respuesta=" + respuesta + "&resultado=" + resultado,
            success:function(r) {
                //nada
            }
        });
    }
    else if(tp == "3") {
        let respuesta = $('input:radio[name=respuesta]:checked').val();
        
        if(respuesta == respuesta1) {
            resultado = "OK";
        }
        else {
            resultado = "NO";
        }
        
        //Se actualiza la respuesta
        $.ajax({
            type:"POST",
            url: "../../org/ajax/respuestas_est_upddat.php",
            data:"idpreg=" + idpreg + "&documento=" + documento + "&respuesta=" + respuesta + "&resultado=" + resultado,
            success:function(r) {
                //nada
            }
        });
    }
    else if(tp == "4") {
        let sel = $('input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                }).get();
        //alert(sel);
        let respuesta_combinada = respuesta1 + "," + respuesta2;
        let respuesta_combinada1 = respuesta2 + "," + respuesta1;
        
        if(sel == respuesta_combinada) {
            resultado = "OK";
        }
        else if(sel == respuesta_combinada1) {
            resultado = "OK";
        }
        else {
            resultado = "NO";
        }
        
        //Se actualiza la respuesta
        $.ajax({
            type:"POST",
            url: "../../org/ajax/respuestas_est_upddat.php",
            data:"idpreg=" + idpreg + "&documento=" + documento + "&respuesta=" + sel + "&resultado=" + resultado,
            success:function(r) {
                //nada
            }
        });
    }
    else if(tp == "5") {
        let sel = $('input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                }).get();
        //alert(sel);
        let respuesta_combinada = respuesta1 + "," + respuesta2 + "," + respuesta3;
        let respuesta_combinada1 = respuesta1 + "," + respuesta3 + "," + respuesta2;
        let respuesta_combinada2 = respuesta2 + "," + respuesta1 + "," + respuesta3;
        let respuesta_combinada3 = respuesta2 + "," + respuesta3 + "," + respuesta1;
        let respuesta_combinada4 = respuesta3 + "," + respuesta2 + "," + respuesta1;
        let respuesta_combinada5 = respuesta3 + "," + respuesta1 + "," + respuesta2;
        
        if(sel == respuesta_combinada) {
            resultado = "OK";
        }
        else if(sel == respuesta_combinada1) {
            resultado = "OK";
        }
        else if(sel == respuesta_combinada2) {
            resultado = "OK";
        }
        else if(sel == respuesta_combinada3) {
            resultado = "OK";
        }
        else if(sel == respuesta_combinada4) {
            resultado = "OK";
        }
        else if(sel == respuesta_combinada5) {
            resultado = "OK";
        }
        else {
            resultado = "NO";
        }
        
        //Se actualiza la respuesta
        $.ajax({
            type:"POST",
            url: "../../org/ajax/respuestas_est_upddat.php",
            data:"idpreg=" + idpreg + "&documento=" + documento + "&respuesta=" + sel + "&resultado=" + resultado,
            success:function(r) {
                //nada
            }
        });
    }
    
    //conteos(documento);
    //sleep(5);
    //conteos(documento);
}

function validar_texto(id) {
    let control = 0;
    var id_obj = "#" + id;
    let ctr_obj = "#ctr_" + id;
    //var input_desc = document.getElementById("desc");
    let v_input = document.getElementById(id);
    //var v_val = /[-_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/;
    let v_val = /[-_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\=\+\|;:\(\)\{\}\[\]\\]{1,}/;
    let val = String($(id_obj).val()).match(v_val);
    if(val == null) {
        v_input.setCustomValidity("");
        $("#txt_control_respuesta").val("OK");
    }
    else {
        v_input.setCustomValidity("Ha ingresado caracteres inválidos");
        var texto = "Ha ingresado alguno de los siguientes caracteres no válidos para la respuesta: ";
        texto += "- _ \' \" < > ~ ^ * $ ! ¡ # % & ¿ ? /= + , ; : ( ) { } [ ] \\";
        $("#txt_control_respuesta").val("ERROR");
        alert(texto);
    }
}

function finalizar() {
    $("#btnfinalizar").hide();
    
    location.href = 'https://unicab.org/res_eval_pres_correo_1.php?n_documento=' + $("#txt_documento").val() + '&idgra=' + $("#txtidgra").val();    
}

function finalizar_sm() {
    $("#btnfinalizar").hide();
    
    location.href = 'https://unicab.org/res_eval_pres_correo_home_page.php?n_documento=' + $("#txt_documento").val() + '&idgra=' + $("#txtidgra").val();    
}

function conteos(doc) {
    //Se hacen los conteos
    $.ajax({
        type:"POST",
        //url:"conteos_resp_pres.php",
        url: "../../org/ajax/conteos_resp_pres.php",
        data:"documento=" + doc,
        success:function(r) {
            let res = JSON.parse(r);
            
            $("#txtok").val(res.ctok);
            $("#txtno").val(res.ctno);
            $("#txtna").val(res.ctna);
        }
    });
}
        
/** Presaberes */

/**  EPAYCO */
$(document).ready(function() {
    /*$("#selmediopago .custom-option").change(function() {
        const medio = document.querySelector("#selmediopago");
        console.log(medio);
        if(medio.dataset.value == "NA") {
            $("#txtref").val("");
            $("#txtvalorref").val("");

            $("#txtvalor").val("");
        }
    });*/

    $("#formPensamientoLogico").hide();

    $("#selmediopago").change(function() {
        const medio = document.querySelector("#selmediopago");
        const nombre = document.querySelector("#txtnom");
        //console.log(medio);
        if(medio.value == "NA") {
            $("#pdesc").html("Debe seleccionar un medio de pago").css("color", "red");
            $("#alert").show();
            $("#btnPagarCurso").hide();
        }
        else {
            $("#pdesc").html("");
            $("#alert").hide();
            validarCampo(nombre, 'Nombre de quien paga', 'texto', 1, 'btnPagarCurso');
        }
    });

    // Mostrar referencia o valor manual
    $("input[name=opvalor]").click(function () {
        // Limpieza inicial
        $("#btnpagar").hide();
        $("#nombre_responsable").val("");
        $("#identificacion_responsable").val("");
        $("#txtref").val("");
        $("#txtvalorref").val("");

        $("#txtnumdoc").val("");
        $("#txtanio").val("");
        $("#txtvalor").val("");
        $("#txtvalorrefman").val("");

        marcarCamposObligatorios();

        // Identificar radio btn
        let btnSelecccionado = $('input:radio[name=opvalor]:checked').val();    

        if (btnSelecccionado == 0) {
            $('#secreferencia').show();
            $('#secvalman').hide();
        }
        else if (btnSelecccionado == 1) {
            $('#secvalman').show();
            $('#secreferencia').hide();
        }

        mostrar_submit_epayco(btnSelecccionado);
    });

    // Se arma la referencia de pago
    $("#selconcepto .custom-option").click(function() {
        const concepto = document.querySelector("#selconcepto");
        
        if(concepto.dataset.value == "NA") {
            $("#txtref").val("");
            $("#txtvalorref").val("");
            //form-block-pagos
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

            //Se consulta el pago
            //qval();
        }

        mostrar_submit_epayco(1);
    });

    $("#txtref").on("input", function() {
        $("#txtvalorref").val("");
        $("#btnpagar").hide();
    });

    //mostrar_submit_epayco(btnSelecccionado);
    $("#btnPagarCurso").hide();

    //Referencia de payco que viene por url
    let ref_payco = getQueryParam('ref_payco');
    //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
    let urlapp = "https://secure.epayco.co/validation/v1/reference/" + ref_payco;

    $.get(urlapp, function(response) {

        if (response.success) {

            if (response.data.x_cod_response == 1) {
            //Codigo personalizado
            $("#respuesta").addClass("aceptada");
            }
            //Transaccion Rechazada
            if (response.data.x_cod_response == 2) {
            $("#respuesta").addClass("rechazada");
            }
            //Transaccion Pendiente
            if (response.data.x_cod_response == 3) {
            $("#respuesta").addClass("pendiente");
            }
            //Transaccion Fallida
            if (response.data.x_cod_response == 4) {

            }

            $('#fecha').html(response.data.x_transaction_date);
            $('#respuesta').html(response.data.x_response);
            $('#referencia').text(response.data.x_extra2);
            $('#motivo').text(response.data.x_response_reason_text);
            $('#recibo').text(response.data.x_transaction_id);
            $('#banco').text(response.data.x_bank_name);
            $('#autorizacion').text(response.data.x_approval_code);
            $('#factura').text(response.data.x_id_invoice);
            $('#nombrepagador').text(response.data.x_extra4);
            $('#nombrepagador1').text(response.data.x_extra4);
            $('#concepto').text(response.data.x_description);
            $('#ref_epayco').text(response.data.x_ref_payco);

            //$('#rutacontinuar').val(response.data.x_extra1 + response.data.x_ref_payco);
            $('#rutacontinuar').val('../../solutions/pages/transformacionDigital.php');
            //$('#rutacontinuar').val("https://unicab.solutions/diplomados/derecho_disciplinario/index.php?ref_pago=" + response.data.x_ref_payco);
            $('#documentopago').val(response.data.x_extra2);
            $('#ref_epayco1').val(response.data.x_ref_payco);
            $('#estado').val(response.data.x_response);
            $('#valor1').val(response.data.x_amount);
            $('#idevento').val(response.data.x_extra3);

            let cod_proyecto = "";
            if(response.data.x_bank_name == "GANA") {
                cod_proyecto = 242;
            }
            else if(response.data.x_bank_name == "EFECTY") {
                cod_proyecto = 111992;
            }
            else if(response.data.x_bank_name == "BALOTO") {
                cod_proyecto = 950715;
            }
            else if(response.data.x_bank_name == "PUNTO RED") {
                cod_proyecto = 110342;
            }
            else if(response.data.x_bank_name == "RED SERVI") {
                cod_proyecto = 761;
            }
            else if(response.data.x_bank_name == "SURED") {
                    cod_proyecto = 'MR0382';
                }
            else {
                cod_proyecto = "";
            }
            $('#cod_proyecto').text(cod_proyecto);
            $('#desc_res').text(response.data.x_response_reason_text);
            $('#valor').text(response.data.x_amount + ' ' + response.data.x_currency_code);
        } 
        else {
            //alert("Error consultando la información");
            console.log("Error consultando la información");
        }

        let nombrepagador = response.data.x_extra4;
        let nombre = nombrepagador.replace(" ", "_");
        insertar_pago(response.data.x_extra3, response.data.x_extra2, nombre, response.data.x_amount, response.data.x_response, response.data.x_ref_payco);
        //insertar_pago(4, "9397454", nombre, response.data.x_amount, response.data.x_response, response.data.x_ref_payco);

    });
});

let handler = ePayco.checkout.configure({
    key: '870fd53ee9274a76a62c34f434b09569',
    test: false
});

function callEpayco() {
    if (window.location.pathname.endsWith("pagos.php")) {
        //Se genera código de factura
        let codfact1 = "";
        let ale = 0;
        let sa1 = ["q","a","1","z","x","2","s","w","3","p","l","4","m","k","5","o","e","6",
                "d","c","7","i","j","8","n","r","9","f","v","0","u","h","b","t","g"];
        let medioValor = "";
        let valor = 0;
        let data={};
        
        let medio = document.querySelector("#selmediopago");
        medioValor = medio.dataset.value;
        
        for(let i = 1; i <=10; i++) {
            ale = parseInt(Math.random()*sa1.length);
            codfact1 = codfact1 + sa1[ale];
        }
        
        //Se arma la petición de pago
        let codigo = $("#txtref").val();
        console.log(codigo);
        let array = codigo.split("-");
        let doc_est = array[0];
        //var nombre = $("#txtnom").val();
        let nombre = $("#nombre_responsable").val();
        let identif = $("#identificacion_responsable").val();
        let codfact = $("#txtcodfact").val();
        let concepto = $("#txtconcepto").val();
        //Esto hace un replace de manera global, utilizando expresiones regulares
        let concepto1 = concepto.replace(/[ ]/gi,"_");
        
        let opvalor = $('input:radio[name=opvalor]:checked').val();
        if(opvalor == 0) {
            valor = $("#txtvalorref").val();
        }
        else if(opvalor == 1) {
            valor = $("#txtvalor").val();
            concepto = "Pago manual";
        }
        console.log(valor);
        
        //var factura = doc_est + "_" + codfact;
        let factura = doc_est + "_" + codfact1;
        
        //Se arma la referencia de pago
        if(medioValor == "E") {
            data={
                //Parametros compra (obligatorio)
                name: "Unicab Colegio Virtual",
                description: concepto,
                invoice: factura,
                currency: "cop",
                amount: valor,
                tax_base: "0",
                tax: "0",
                country: "co",
                lang: "es",
                
                //Onpage="false" - Standard="true"
                external: "false",
                key: "870fd53ee9274a76a62c34f434b09569",
                
                //Atributos opcionales
                extra1: codigo,
                extra2: "extra2",
                extra3: "extra3",
                confirmation: "https://unicab.org/resultado_pagos.php",
                response: "https://unicab.org/resultado_pagos.php",
                
                
                //Atributos cliente
                name_billing: nombre,
                //address_billing: "Carrera 19 numero 14 91",
                type_doc_billing: "cc",
                //mobilephone_billing: "3050000000",
                number_doc_billing: identif,
                
                //atributo deshabilitación metodo de pago
                methodsDisable: ["TDC", "PSE", "SP", "DP"]
                
            };
        }
        else if(medioValor == "P" || medioValor == "P6") {
            data={
                //Parametros compra (obligatorio)
                name: "Unicab Colegio Virtual",
                description: concepto,
                invoice: factura,
                currency: "cop",
                amount: valor,
                tax_base: "0",
                tax: "0",
                country: "co",
                lang: "es",
                
                //Onpage="false" - Standard="true"
                external: "false",
                key: "870fd53ee9274a76a62c34f434b09569",
                
                //Atributos opcionales
                extra1: codigo,
                extra2: "extra2",
                extra3: "extra3",
                confirmation: "https://unicab.org/resultado_pagos.php",
                response: "https://unicab.org/resultado_pagos.php",
                
                
                //Atributos cliente
                name_billing: nombre,
                //address_billing: "Carrera 19 numero 14 91",
                type_doc_billing: "cc",
                //mobilephone_billing: "3050000000",
                number_doc_billing: identif,
                
                //atributo deshabilitación metodo de pago
                methodsDisable: ["TDC", "SP", "CASH", "DP"]
                
            };
        }
        else if(medioValor == "TC") {
            data={
                //Parametros compra (obligatorio)
                name: "Unicab Colegio Virtual",
                description: concepto,
                invoice: factura,
                currency: "cop",
                amount: valor,
                tax_base: "0",
                tax: "0",
                country: "co",
                lang: "es",
                
                //Onpage="false" - Standard="true"
                external: "false",
                key: "870fd53ee9274a76a62c34f434b09569",
                
                //Atributos opcionales
                extra1: codigo,
                extra2: "extra2",
                extra3: "extra3",
                confirmation: "https://unicab.org/resultado_pagos.php",
                response: "https://unicab.org/resultado_pagos.php",
                
                
                //Atributos cliente
                name_billing: nombre,
                //address_billing: "Carrera 19 numero 14 91",
                type_doc_billing: "cc",
                //mobilephone_billing: "3050000000",
                number_doc_billing: identif,
                
                //atributo deshabilitación metodo de pago
                methodsDisable: ["PSE", "SP", "CASH", "DP"]
                
            };
        }
        console.log(data);

        handler.open(data);
    }
    else {
        //Se genera código de factura
        let codfact1 = "";
        let ale = 0;
        let sa1 = ["q","a","1","z","x","2","s","w","3","p","l","4","m","k","5","o","e","6",
                "d","c","7","i","j","8","n","r","9","f","v","0","u","h","b","t","g"];
        let medioValor = "";
        let valor = 0;
        let data={};
        
        let medio = document.querySelector("#selmediopago");
        medioValor = medio.value;
        
        for(let i = 1; i <=10; i++) {
            ale = parseInt(Math.random()*sa1.length);
            codfact1 = codfact1 + sa1[ale];
        }
        
        //Se arma la petición de pago
        let codigo = $("#txtref").val();
        console.log(codigo);
        //let array = codigo.split("-");
        //let doc_est = array[0];
        let nombre = $("#txtnom").val();
        let identif = $("#txtidentif").val();
        let idEvento = 0;
        idEvento = $("#idEvento").val();
        //let codfact = $("#txtcodfact").val();
        //let concepto = $("#txtconcepto").val();
        //Esto hace un replace de manera global, utilizando expresiones regulares
        //let concepto1 = concepto.replace(/[ ]/gi,"_");
        
        valor = $("#txtvalor").val();
        console.log(valor);
        let fecha = $("#txtano").val();
        let referencia = $("#txtref").val();
        
        //var factura = doc_est + "_" + codfact;
        let factura = identif + "_" + codfact1;
        
        //Se arma la referencia de pago
        if(medioValor == "E") {
            data={
                //Parametros compra (obligatorio)
                name: "Unicab Colegio Virtual",
                description: "Pago Curso Desarrollo Pensamiento Lógico",
                invoice: factura,
                currency: "cop",
                amount: valor,
                tax_base: "0",
                tax: "0",
                country: "co",
                lang: "es",
                
                //Onpage="false" - Standard="true"
                external: "false",
                key: "870fd53ee9274a76a62c34f434b09569",
                
                //Atributos opcionales
                extra1: codigo,
                extra2: identif,
                extra3: idEvento,
                extra4: nombre,
                confirmation: "https://unicab.solutions/nus/business/solutions/pages/resultado_pagos.php",
                response: "https://unicab.solutions/nus/business/solutions/pages/resultado_pagos.php",                
                
                //Atributos cliente
                name_billing: nombre,
                //address_billing: "Carrera 19 numero 14 91",
                type_doc_billing: "cc",
                //mobilephone_billing: "3050000000",
                number_doc_billing: identif,
                
                //atributo deshabilitación metodo de pago
                methodsDisable: ["TDC", "PSE", "SP", "DP"]
                
            };
        }
        else if(medioValor == "P" || medioValor == "P6") {
            data={
                //Parametros compra (obligatorio)
                name: "Unicab Colegio Virtual",
                description: "Pago Curso Desarrollo Pensamiento Lógico",
                invoice: factura,
                currency: "cop",
                amount: valor,
                tax_base: "0",
                tax: "0",
                country: "co",
                lang: "es",
                
                //Onpage="false" - Standard="true"
                external: "false",
                key: "870fd53ee9274a76a62c34f434b09569",
                
                //Atributos opcionales
                extra1: codigo,
                extra2: identif,
                extra3: idEvento,
                extra4: nombre,
                confirmation: "https://unicab.solutions/nus/business/solutions/pages/resultado_pagos.php",
                response: "https://unicab.solutions/nus/business/solutions/pages/resultado_pagos.php",
                
                
                //Atributos cliente
                name_billing: nombre,
                //address_billing: "Carrera 19 numero 14 91",
                type_doc_billing: "cc",
                //mobilephone_billing: "3050000000",
                number_doc_billing: identif,
                
                //atributo deshabilitación metodo de pago
                methodsDisable: ["TDC", "SP", "CASH", "DP"]
                
            };
        }
        else if(medioValor == "TC") {
            data={
                //Parametros compra (obligatorio)
                name: "Unicab Colegio Virtual",
                description: "Pago Curso Desarrollo Pensamiento Lógico",
                invoice: factura,
                currency: "cop",
                amount: valor,
                tax_base: "0",
                tax: "0",
                country: "co",
                lang: "es",
                
                //Onpage="false" - Standard="true"
                external: "false",
                key: "870fd53ee9274a76a62c34f434b09569",
                
                //Atributos opcionales
                extra1: codigo,
                extra2: identif,
                extra3: idEvento,
                extra4: nombre,
                confirmation: "https://unicab.solutions/nus/business/solutions/pages/resultado_pagos.php",
                response: "https://unicab.solutions/nus/business/solutions/pages/resultado_pagos.php",
                
                
                //Atributos cliente
                name_billing: nombre,
                //address_billing: "Carrera 19 numero 14 91",
                type_doc_billing: "cc",
                //mobilephone_billing: "3050000000",
                number_doc_billing: identif,
                
                //atributo deshabilitación metodo de pago
                methodsDisable: ["PSE", "SP", "CASH", "DP"]
                
            };
        }
        
        handler.open(data);

        //location.href = "../../solutions/pages/resultado_pagos.php";
    }
}

function qval() {
    let control = 0;
    let medioValor = "";
    let datos = "";

    if (window.location.pathname.endsWith("pagos.php")) {
        let medio = document.querySelector("#selmediopago");
        medioValor = medio.dataset.value;
        console.log("medio " + medioValor);

        //let numeroDocumento = $("#txtnumdoc").val();
        //let anio = $("#txtanio").val();
        //let btnSelecccionado = $("input:radio[name=opvalor]:checked").val();

        if(medioValor == "NA") {
            var texto = "Debe seleccionar un medio de pago.";
            $("#pdesc").html(texto).css("color","red");
        }
        else {
            $("#pdesc").html("");
            
            let codigo = $("#txtref").val();
            let array = codigo.split("-");
            let ndoc = array[0];
            let ano = array[1];
            let tipo_conc = array[2];
            
            $("#txtnumdoc").val(ndoc);
            $("#txtanio").val(ano);
            
            if(medioValor == "E") {
                datos = "ndoc=" + ndoc + "&a=" + ano + "&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PEB&tconc=" + tipo_conc;
            }
            else if(medioValor == "P") {
                datos = "ndoc=" + ndoc + "&a=" + ano + "&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PEB&tconc=" + tipo_conc;
            }
            else if(medioValor == "P6") {
                datos = "ndoc=" + ndoc + "&a=" + ano + "&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PSE&tconc=" + tipo_conc;
            }
            else if(medioValor == "TC") {
                datos = "ndoc=" + ndoc + "&a=" + ano + "&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=TC&tconc=" + tipo_conc;
            }
            
            $.ajax({
                type:"POST",
                url: "../../org/ajax/consulta_pago_getdat_f.php",
                data:datos,
                success:function(r) {
                    let valor = 0;
                    let concepto1 = "0";
                    
                    let res = JSON.parse(r);
                    let estado = res.estado;
                    
                    if(estado == 1) {
                        if(tipo_conc == "m") {
                            valor = res.valor;
                            concepto1 = "MATRICULA";
                        }
                        else if(tipo_conc == "pm1") {
                            valor = res.valor;
                            concepto1 = "PENSION M1";
                        }
                        else if(tipo_conc == "pm2") {
                            valor = res.valor;
                            concepto1 = "PENSION M2";
                        }
                        else if(tipo_conc == "pm3") {
                            valor = res.valor;
                            concepto1 = "PENSION M3";
                        }
                        else if(tipo_conc == "pm4") {
                            valor = res.valor;
                            concepto1 = "PENSION M4";
                        }
                        else if(tipo_conc == "pm5") {
                            valor = res.valor;
                            concepto1 = "PENSION M5";
                        }
                        else if(tipo_conc == "pm6") {
                            valor = res.valor;
                            concepto1 = "PENSION M6";
                        }
                        else if(tipo_conc == "pm7") {
                            valor = res.valor;
                            concepto1 = "PENSION M7";
                        }
                        else if(tipo_conc == "pm8") {
                            valor = res.valor;
                            concepto1 = "PENSION M8";
                        }
                        else if(tipo_conc == "pm9") {
                            valor = res.valor;
                            concepto1 = "PENSION M9";
                        }
                        else if(tipo_conc == "pm10") {
                            valor = res.valor;
                            concepto1 = "PENSION M10";
                        }
                        else if(tipo_conc == "ocp") {
                            valor = res.registros[0].ocp;
                            concepto1 = "OCP";
                        }
                        else if(tipo_conc == "p") {
                            valor = res.registros[0].poliza;
                            concepto1 = "POLIZA";
                        }
                        else if(tipo_conc == "dg") {
                            valor = res.registros[0].dg;
                            concepto1 = "DERECHOS GRADO PRESENCIAL";
                        }
                        else if(tipo_conc == "dgv") {
                            valor = res.registros[0].dgv;
                            concepto1 = "DERECHOS GRADO VIRTUAL";
                        }
                        else if(tipo_conc == "pp") {
                            valor = res.valor;
                            concepto1 = "PRIMER PAGO";
                        }
                        else if(tipo_conc == "mocp") {
                            valor = res.valor;
                            concepto1 = "MATRICULA Y OCP";
                        }
                        else if(tipo_conc == "icfes") {
                            if(res.id_grado_est == "12" || res.id_grado_est == "18") {
                                valor = res.valor;
                            }
                            else {
                                valor = 0;
                            }
                            concepto1 = "ICFES";
                        }
                        
                        let concepto = "PAGO " + concepto1 + " " + ano;
                        if(res.inc == "SI") {
                            let comision = parseFloat(res.incrementos[0].comision_epayco);
                            let fijo = parseInt(res.incrementos[0].val_fijo_epayco);
                            let iva = parseFloat(res.incrementos[0].iva_comision_epayco);
                            let comision1 = comision * valor;
                            let iva1 = iva * (comision1 + fijo);    
                            valor = Math.ceil(parseFloat(valor) + comision1 + fijo + iva1);
                        }
                        
                        $("#txtconcepto").val(concepto);
                        $("#txtvalorref").val(valor);
                        $("#txtvalor").val(valor);
                        $("#txtvalorrefman").val(codigo);
                        
                        $("#txtidgrado").val(res.id_grado_est);
                        
                        if(tipo_conc == "icfes") {
                            if(res.id_grado_est == "12" || res.id_grado_est == "18") {
                                //No hace nada
                            }
                            else {
                                let texto = "El pago de ICFES sólamente es para grado 11 y Ciclo VI.";
                                $("#pdesc").html(texto).css("color","red");
                            }                            
                        }
                    }
                    else {
                        $("#txtconcepto").val("");
                        $("#txtvalorref").val("");
                        $("#txtvalor").val("");
                        $("#txtvalorrefman").val("");
                    }
                }
            });
        }
        
        setTimeout("mostrar_submit_epayco(0)",1000);
    }

}

function mostrar_submit_epayco(btnSelecccionado) {
    let control = 0;
    let idObjeto = "#btnpagar";
    console.log(btnSelecccionado);
    console.log(camposError);
    let buscados = ["nombre_responsable", "identificacion_responsable", "selmediopago", "txtref", "txtvalorref"];
    let algunoPresente = buscados.some(campo => camposError.includes(campo));
    if (btnSelecccionado == 0 && algunoPresente) {
        control = 1;
    }
    else if (btnSelecccionado == 0 && !algunoPresente) {
        control = 0;
    }
    buscados = ["nombre_responsable", "identificacion_responsable", "selmediopago", "txtnumdoc", "txtanio", "txtvalor", "selconcepto", "txtvalorrefman"];
    algunoPresente = buscados.some(campo => camposError.includes(campo));
    if (btnSelecccionado == 1 && algunoPresente) {
        control = 1;
    }
    else if (btnSelecccionado == 1 && !algunoPresente) {
        control = 0;
    }
    
    /*camposError.forEach(campo => {
        if (btnSelecccionado == 0) {            
            if (campo == "txtnumdoc") {
                control = 0;
            }
            else if (campo == "txtanio") {
                control = 0;
            }
            else if (campo == "txtvalor") {
                control = 0;
            }
            else if (campo == "selconcepto") {
                control = 0;
            }
            else {
                control = 1;
            }
        }
        else {
            control = 1;
        }
        //marcarInputError(campo);        
    });*/
    console.log(control);

    if (control > 0) {
        $(idObjeto).hide();
    }
    else {
        $(idObjeto).show();
        $("#alert").hide();
    }
}

const armarReferenciaPago = () => {
    if (window.location.pathname.endsWith("pagos.php")) {
        const concepto = document.querySelector("#selconcepto");

        const numeroDocumento = $("#txtnumdoc").val();
        const anio = $("#txtanio").val();
        const referencia_pago_manual = numeroDocumento + "-" + anio + "-" + concepto.dataset.value;

        // input readonly informativo en valor manual
        $("#txtvalorrefman").val(referencia_pago_manual);
        // input readonly informativo en valor manual
        $("#txtvalorrefman").val(referencia_pago_manual);
        // Identificar radio btn
        const btnSelecccionado = $("input:radio[name=opvalor]:checked").val();

        if (btnSelecccionado == 1) {
            // input obligatorio en referencia de pago, cuando se ejecuta esta funcion este input esta esconido
            $("#txtref").val(referencia_pago_manual);
            marcarInputCorrecto("txtref");
            quitarCampoError("txtref");
        }

        if (camposError.length > 0) {
            $("#txtvalorrefman").val("");
        }
    }
};

function mostrarBotonPagarCursozz(idButton) {
    const medio = document.querySelector("#selmediopago");
    let control = 0;
    if(medio.value == "NA") {
        control = 1;
    }

    if (control == 0) {
       let txtnom = $("#txtnom").val();
       if (txtnom != "");
    }

    if (control == 0) {
        $("#btnPagarCurso").show();
    }
}

function getQueryParam(param) {
    location.search.substr(1)
    .split("&")
    .some(function(item) { // returns first occurence and stops
        return item.split("=")[0] == param && (param = item.split("=")[1])
    })
    return param
}

function insertar_pago(id_evento, documento, nombre, valor, estado, ref_epayco) {
    console.log("evento: " + id_evento + " doc: " + documento + "nombre: " + nombre + " valor: " + valor + " estado: " + estado + " ref_epayco: " + ref_epayco);
    $.ajax({
        type:"POST",
        //url:"../business/solutions/ajax/registrar_pago_putdat.php",
        url:"../ajax/registrar_pago_putdat.php",
        data:"idevento=" + id_evento + "&documento=" + documento + "&nombre=" + nombre + "&valor=" + valor + "&estado=" + estado + "&ref_epayco=" + ref_epayco,
        success:function(r) {
            //alert(r);
            let res = JSON.parse(r);
            let insert = res.insert;
            if (insert == "OK") {
                $("#btnvolver").show();
            }
            else {
                $("#btnvolver").hide();
            }
        }
    });
}

function volver() {
    //var rutavolver = "https://unicab.solutions/diplomados/derecho_disciplinario/index.php?ref_pago=" + $("#ref_epayco1").val();
    var rutavolver = $("#rutacontinuar").val();
    //var documento = "9397454";
    var documento = $("#documentopago").val();
    var ref_epayco = $("#ref_epayco1").val();
    var nombrepagador = $("#nombrepagador1").val();
    var nombre = nombrepagador.replace(" ", "_");
    
    location.href = rutavolver;
}

function validar_ref_epayco() {
    let ref_epayco = $("#val_ref_epayco").val().trim();
    if (ref_epayco == "") {
        alert("Ingrese el código de referencia epayco o pin de pago");
        return;
    }

    let url = "https://secure.payco.co/restpagos/transaction/response.json?ref_payco=" + ref_epayco + "&public_key=870fd53ee9274a76a62c34f434b09569";
    fetch(url)
    .then(response => response.json())
    .then(data => {
        //console.log(data);
        let estado = data.data.x_response;
        console.log(estado);
        //estado = "Aceptada"; 
        if (estado == "Aceptada") {
            $("#formPensamientoLogico").show();
            $("#ref_epayco").val(data.data.x_ref_payco);
        }
        else {
            $("#formPensamientoLogico").hide();
            alert("Esta transacción esta en estado " + estado);
        }
    })
}
/* EPAYCO */

/** Estados Financieros */
/*$("#form_info").on("submit", function (e) {
    e.preventDefault();

    let usuario = $("#correo_estados_financieros").val();
    let contraseña = $("#password_estados_financieros").val();
    
    const data = {
        usuario: usuario,
        contraseña: contraseña,
    };

    $.ajax({
        //url: "../../cartiexplora/ajax/formInscripcionesAbiertas.php",
        url: "../../cartiexplora/business/org/ajax/login_estados1.php",
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
});*/
/** Estados Financieros */