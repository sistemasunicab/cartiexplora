$(function () {
    $(".select2").select2();
});

document.addEventListener("DOMContentLoaded", () => {
    galeriaEstudiantes();
    actualizarPorcentajesBotonBanner();
});

const actualizarPorcentajesBotonBanner = () => {
    const botones = document.querySelectorAll(
        ".carousel-item .button-carousel"
    );
    const anchoActual = window.innerWidth;
    botones.forEach((boton) => {
        // Almacena los valores originales solo una vez, si no están ya guardados
        if (!boton.dataset.originalTop) {
            boton.dataset.originalTop = boton.style.top;
        }
        if (!boton.dataset.originalLeft) {
            boton.dataset.originalLeft = boton.style.left;
        }
        if (anchoActual < 768) {
            boton.style.top = "50%";
            boton.style.left = "50%";
            boton.style.transform = "translate(-50%, -50%)";
        } else if (anchoActual >= 768) {
            boton.style.top = boton.dataset.originalTop;
            boton.style.left = boton.dataset.originalLeft;
            boton.style.transform = "";
        }
    });
};

// Escuchamos el evento resize para ejecutar la verificación cada vez que cambie el ancho de la ventana
window.addEventListener('resize', actualizarPorcentajesBotonBanner);

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
    $(".datos").hide();
    marcarCamposObligatorios();
    $("#alert").hide();
    $("#divcargando").css({display:'none'});
    let btnSubmit = document.querySelector('button[type="submit"]');
    let idSubmit = "#" + btnSubmit.id;

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
                        .text(
                            "Error al enviar el formulario. Inténtalo de nuevo"
                        )
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

    $("#register_grado").change(function() {
        let gra = $("#register_grado").val();
        
        if(gra == "NA") {
            //$(idSubmit).hide();
            let texto = "Debe seleccionar un grado para la matrícula";
            $("#pdesc").html(texto).css("color","red");
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
    
    $("#register_tipo_documento").change(function() {
        let td = $("#register_tipo_documento").val();
        let td_txt = $("#register_tipo_documento option:selected").text();
        $("#td_text").val(td_txt);
        
        if(td == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un tipo de documento para la matrícula";
            $("#pdesc").html(texto).css("color","red");
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
    
    $("#register_medio").change(function() {
        let medio = $("#register_medio").val();
        
        if(medio == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un medio de llegada";
            $("#pdesc").html(texto).css("color","red");
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
    
    $("#register_genero").change(function() {
        let gen = $("#register_genero").val();
        
        if(gen == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un género para la matrícula";
            $("#pdesc").html(texto).css("color","red");
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
    
    $("#parentesco_acudiente_1").change(function() {
        let parentesco = $("#parentesco_acudiente_1").val();
        
        if(parentesco == "NA") {
            //$("#btnEnviar").hide();
            let texto = "Debe seleccionar un parentesco para el acudiente";
            $("#pdesc").html(texto).css("color","red");
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
    
    mostrarSubmit(btnSubmit.id);
});

const reglasvalidacion = {
    texto: /[-_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/,
    texto1: /[_'"\<\>\~\^\*\$\!\¡\#\%\&\¿\?\/\=\+\|,;:\(\)\{\}\[\]\\]{1,}/,
    correo: /^[_-\w.]+@[a-z]+\.[a-z\.]{2,7}$/,
    numero: /^[0-9]{1,}$/,
    fecha: /^[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/,
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
        if (elemento.hasAttribute("required") && (elemento.value == "" || elemento.value == "NA")) {
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

const mostrarSubmit = (botonSubmit) => {
    let control = 0;
    let control1 = 1;
    let idObjeto = "#" + botonSubmit;
    marcarCamposObligatorios();

    camposError.forEach(campo => {
        marcarInputError(campo);
        control = 1;
    }); 

    if(control > 0) {
        $(idObjeto).hide();
    }
    else {
        if(control1 == 0) {
            if($("#register_correoA").val() == $("#register_correoA1").val()) {
                $(idObjeto).show();
            }
            else {
                var texto = "El email y la confirmación del email del acudiente deben ser iguales";
                $("#pdesc").html(texto).css("color","red");
                $(idObjeto).hide();
            }
        } else {
            $(idObjeto).show();
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

/*const validar_texto = (input) => {
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
}*/

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
                marcarInputError(id);
                agregarCampoError(id);
                texto = "Ingrese sólamente números para " + descripcion;
            }
        } else if (reglaValidacion == "texto") {
            if (value.match(reglasvalidacion.texto)) {
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
                marcarInputError(id);
                agregarCampoError(id);
                texto = "No es un patrón de correo válido para " + descripcion;
            }
        } else if (reglaValidacion == "fecha") {
            if (reglasvalidacion.fecha.test(value)) {
                marcarInputCorrecto(id);
                quitarCampoError(id);
            } else {
                marcarInputError(id);
                agregarCampoError(id);
                texto = "No es un patrón válido para " + descripcion;
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
    
    //actualizarNotificacionesErrores(error);
    if (controlSubmit == 1) {
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
    catch(e) {}
}

const valDocumentoEntrevista = (botonSubmit) => {
    $("#divcargando").css({display:'block'});
    
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
    let cifra = doc.substring(0,1);
    //alert(cifra);
    if (doc == "0" || cifra == "0") {
        $("#msgdocumento").html("El documento no puede ser 0, o no puede empezar por 0");
    }
    else if (doc == "") {
        $("#msgdocumento").html("Ingrese el número de documento del estudiante");
    }
    else {
        $.ajax({
            type:"POST",
            url:"../../org/ajax/registro_matricula_0.php",
            data:"documento=" + doc,
            success:function(r) {
                let res = JSON.parse(r);
                console.log(res.estado);
                let control_matricula = 0;
                let r_est = res.estado;
                
                $("#register_estado").val(r_est);
                
                //Se valida si ya tiene un proceso de pre matrícula abierto
                if(res.procesoAbierto == "SI") {
                    control_matricula = 1;
                    $("#pdesc").html("");
                    if(res.programoEntrevista == "SI") {
                        $("#msgdocumento").html("Este documento ya tiene un proceso de entrevista abierto. Verificar el email " + res.emailA + " para revisar la información que se envío de la entrevista.");
                    }
                    else {
                        $("#msgdocumento").html("Este documento ya tiene un proceso de entrevista abierto. Verificar el email " + res.emailA + " para revisar la información que se le enviará de la entrevista.");
                    }							
                }
                
                if(control_matricula == 0) {
                    $("#pdesc").html("");
                    if(r_est == "activo") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;
                        
                        $("#msgdocumento").html("Este documento se encuentra activo en el grado " + r_grado + ". El proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if(r_est == "solicitud" || r_est == "pre_solicitud") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;
                        
                        $("#msgdocumento").html("Este documento ya tiene una solicitud de matrícula en el grado " + r_grado + ". El proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if(r_est == "reprobado") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;
                        
                        $("#msgdocumento").html("Estudiante antiguo, el proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if(r_est == "aprobado") {
                        let r_grado = res.grados[0].gra;
                        let r_idgrado = res.grados[0].id_gra;
                        
                        $("#msgdocumento").html("Estudiante antiguo, el proceso de entrevista es solo para estudiantes nuevos.");
                    }
                    else if(r_est == "retirado") {
                        $("#msgdocumento").html("Este documento se encuentra Retirado. Comunícate con Secretaría Académica.");
                    }
                    else if(r_est == "nuevo") {
                        $("#estnuevo").val("SI");
                        $("#register_documentoe_f").val(doc);
                        $(".datos").show();
                        $(".btnContinuar").hide();
                        $("#btnEnviar").hide();
                        $("#divcargando").css({display:'none'});
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
                    else if(r_est == "inactivo") {
                        $("#msgdocumento").html("Este documento se encuentra inactivo en este momento. Comunícate con Secretaría Académica.");
                    }
                    else {
                        $("#msgdocumento").html("No se pudo procesar la solicitud de matrícula para éste documento. Comunícate con Secretaría Académica.");
                    }
                }
                
                $("#divcargando").css({display:'none'});
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
