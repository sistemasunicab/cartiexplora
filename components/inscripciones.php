<?php
    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }
    
    $res_sentencia = $mysqli1->query($sentencia . "31");
    while ($row_sentencia = $res_sentencia->fetch_assoc()) {
        $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res_parametros = $mysqli1->query($sql_datos);
    $parametros = [];
    while ($row_datos = $res_parametros->fetch_assoc()) {
        $parametros[$row_datos['parametro']] = $row_datos['t1'];
    }


    $campos_formulario = [];
    $res_sentecia = $mysqli1->query($sentencia . "29");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_formulario = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res_formulario = $mysqli1->query($sql_formulario);
    while ($row_datos_form = $res_formulario->fetch_assoc()) {
        $campos_formulario[] = $row_datos_form;
    }

    $res_sentecia = $mysqli1->query($sentencia . "6");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_inscripciones = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_inscripciones = $mysqli1->query($sql_seccion_inscripciones);
    
    $html = '';

    while ($row_datos_seccion = $res_seccion_inscripciones->fetch_assoc()) {

        $html .= '<section class="container section-inscripciones" id="inscripcionesAbiertas">';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-7 col-md-12 col-sm-12 col-12 d-lg-flex align-items-lg-center justify-content-lg-start">';
        $html .=            '<div class="row">';
        $html .=                '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=                    '<h1 class="h1-inscripciones">' . $row_datos_seccion['titulo'] . '</h1>';
        $html .=                    '<h1 class="h1-inscripciones-subtitulo">' . $row_datos_seccion['subTitulo'] . '</h1>';
        $html .=                '</div>';
        $html .=                '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=                    '<p class="parametros-inscripciones">' . $row_datos_seccion['texto'] . '</p>';
        $html .=                    '<p class="parametros-inscripciones">' . $parametros['telefono_admisiones'] . '</p>';
        $html .=                    '<p class="parametros-inscripciones">' . $parametros['correo_admisiones'] . '</p>';
        $html .=                '</div>';
        $html .=            '</div>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-5 col-md-12 col-sm-12 col-12 form-inscripciones-container">';
        $html .=            '<div class="row">';
        $html .=                '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
        $html .=                '<div class="col-lg-10 col-md-10 col-sm-10 col-10">';
        $html .=                    '<form class="form-inscripciones row" id="formulario" name="formulario">';
        $html .=                        '<h3 class="h3-inscripciones">' . $parametros['titulo_form_inscripciones'] . '</h3>';
        $html .=                        '<div class="col-lg-2 col-md-2 col-sm-2 col-2"></div>';
        $html .=                        '<div class="col-lg-8 col-md-8 col-sm-8 col-8">';


        // Datos Formulario
        $inscripciones_nombre = array_shift($campos_formulario);
        $inscripciones_correo = array_shift($campos_formulario);
        $inscripciones_asunto = array_shift($campos_formulario);
        $inscripciones_mensaje = array_shift($campos_formulario);
        $inscripciones_checkbox = array_shift($campos_formulario);
        $inscripciones_enviar = array_shift($campos_formulario);
        
        $html .=                            '<div class="row gap-2 my-2">';
        $html .=                               '<label for="' . $inscripciones_nombre['campo'] . '" class="form-label-inscripciones text-capitalize">' . $inscripciones_nombre['texto'] .' *</label>';
        $html .=                               '<input onkeyup="validarCampo(this,\''. $inscripciones_nombre['texto'] .'\', \'texto\', 1, \'enviaMensaje\')" type="' . $inscripciones_nombre['tipo'] . '" id="' . $inscripciones_nombre['campo'] . '" name="' . $inscripciones_nombre['campo'] . '" class="campoFormulario input-inscripciones" ' . $inscripciones_nombre['obligatorio'] . ' ' . $inscripciones_nombre['soloLectura'] . ' ' . $inscripciones_nombre['habilitado'] . '>';
        $html .=                            '</div>';

        $html .=                            '<div class="row gap-2 my-2">';
        $html .=                               '<label for="' . $inscripciones_correo['campo'] . '" class="form-label-inscripciones text-capitalize">' . $inscripciones_correo['texto'] .' *</label>';
        $html .=                               '<input onkeyup="validarCampo(this,\''. $inscripciones_correo['texto'] .'\', \'correo\', 1, \'enviaMensaje\')" type="' . $inscripciones_correo['tipo'] . '" id="' . $inscripciones_correo['campo'] . '" name="' . $inscripciones_correo['campo'] . '" class="campoFormulario input-inscripciones" ' . $inscripciones_correo['obligatorio'] . ' ' . $inscripciones_correo['soloLectura'] . ' ' . $inscripciones_correo['habilitado'] . '>';
        $html .=                            '</div>';

        $html .=                            '<div class="row gap-2 my-2">';
        $html .=                               '<label for="' . $inscripciones_asunto['campo'] . '" class="form-label-inscripciones text-capitalize">' . $inscripciones_asunto['texto'] .' *</label>';
        $html .=                               '<input onkeyup="validarCampo(this,\''. $inscripciones_asunto['texto'] .'\', \'texto\', 1, \'enviaMensaje\')" type="' . $inscripciones_asunto['tipo'] . '" id="' . $inscripciones_asunto['campo'] . '" name="' . $inscripciones_asunto['campo'] . '" class="campoFormulario input-inscripciones" ' . $inscripciones_asunto['obligatorio'] . ' ' . $inscripciones_asunto['soloLectura'] . ' ' . $inscripciones_asunto['habilitado'] . '>';
        $html .=                            '</div>';

        $html .=                            '<div class="row gap-2 my-2">';
        $html .=                               '<label for="' . $inscripciones_mensaje['campo'] . '" class="form-label-inscripciones text-capitalize">' . $inscripciones_mensaje['texto'] .' *</label>';
        $html .=                               '<textarea rows="2" onkeyup="validarCampo(this,\''. $inscripciones_mensaje['texto'] .'\', \'texto\', 1, \'enviaMensaje\')" id="' . $inscripciones_mensaje['campo'] . '" name="' . $inscripciones_mensaje['campo'] . '" class="campoFormulario input-inscripciones" ' . $inscripciones_mensaje['obligatorio'] . ' ' . $inscripciones_mensaje['soloLectura'] . ' ' . $inscripciones_mensaje['habilitado'] . '></textarea>';
        $html .=                            '</div>';

        $html .=                            '<div class="row justify-content-center align-items-start my-4">';
        $html .=                                '<input class="col-lg-2 col-2" type="' . $inscripciones_checkbox['tipo'] . '" id="' . $inscripciones_checkbox['campo'] . '" name="' . $inscripciones_checkbox['campo'] . '" ' . $inscripciones_checkbox['obligatorio'] . ' ' . $inscripciones_checkbox['soloLectura'] . ' ' . $inscripciones_checkbox['habilitado'] . '>';
        $html .=                                '<p class="form-inscripciones-checkbox-tx col-lg-10 col-10">' . $parametros['checkbox_form_inscripciones'] . '</p>';
        $html .=                            '</div>';

        $html .=                            '<div class="row justify-content-center align-items-start my-5">';
        $html .=                                '<button type="submit" id="enviaMensaje" class="inscripciones-btn w-100"  >' . $inscripciones_enviar['texto'] . '</button>';
        $html .=                            '</div>';

        $html .=                        '</div>';
        $html .=                        '<div class="col-lg-2 col-md-2 col-sm-2 col-2"></div>';
        $html .=                    '</form>';
        $html .=                '</div>';
        $html .=                '<div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>';
        $html .=            '</div>';
        $html .=            '<div id="alert" style="margin-left: .5rem;">
                                <p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
                                <input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0"></p>
                            </div>';
        $html .=            '<div class="notificacion-error notificacion-hidden" id="notificacionError"></div>';
        $html .=            '<div class="notificacion-success alert alert-success notificacion-hidden" id="notificacionSuccess">¡Formulario enviado con éxito!</div>';
        $html .=        '</div>';
        $html .=    '</div>';

        $html .=    '<br><br><div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-sm-3 col-6 d-lg-flex align-items-lg-center justify-content-lg-start">';
        $html .=            '<iframe width="315" height="560" src="https://www.youtube.com/embed/IfRW2fxItjU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-sm-3 col-6 d-lg-flex align-items-lg-center justify-content-lg-start">';
        $html .=            '<iframe width="315" height="560" src="https://www.youtube.com/embed/SCWCUMKt5Ks" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-sm-3 col-6 d-lg-flex align-items-lg-center justify-content-lg-start">';
        $html .=            '<iframe width="315" height="560" src="https://www.youtube.com/embed/2Y02ckW2fQY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-sm-3 col-6 d-lg-flex align-items-lg-center justify-content-lg-start">';
        $html .=            '<iframe width="315" height="560" src="https://www.youtube.com/embed/WXoxjLOUx7U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $html .=        '</div>';
        $html .=    '</div>';

        $html .= '</section>';
    }
                    
    
    
    echo $html;
?>