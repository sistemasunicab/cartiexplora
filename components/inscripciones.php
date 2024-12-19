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

    $res_sentencia = $mysqli1->query($sentencia . "13");
    while ($row_sentencia = $res_sentencia->fetch_assoc()) {
        $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    $res_datos = $mysqli1->query($sql_datos);
    while ($row_datos = $res_datos->fetch_assoc()) {
        $telefono_admisiones = $row_datos['t1'];
    }

    $res_sentencia = $mysqli1->query($sentencia . "14");
    while ($row_sentencia = $res_sentencia->fetch_assoc()) {
        $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    $res_datos = $mysqli1->query($sql_datos);
    while ($row_datos = $res_datos->fetch_assoc()) {
        $correo_admisiones = $row_datos['t1'];
    }

    $res_sentecia = $mysqli1->query($sentencia . "6");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_inscripciones = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_inscripciones = $mysqli1->query($sql_seccion_inscripciones);

    $html = '';

    while ($row_datos_seccion = $res_seccion_inscripciones->fetch_assoc()) {

        $html .=
            '<section class="container inscripciones-seccion">' .
                '<div class="row">' .
                    '<div class="col-md-7 d-flex align-items-center">' .
                        '<div>' .
                            '<div class="my-5">' .
                                '<h2 class="fw-bold titulo-2">' . $row_datos_seccion['titulo'] . '</h2>' .
                                '<h3 class="titulo-2">' . $row_datos_seccion['subTitulo'] . '</h3>' .
                            '</div>' .
                            '<div class="my-5">' .
                                '<p class="m-0 fw-bold inscripciones-info">' . $row_datos_seccion['texto'] . '</p>' .
                                '<p class="m-0 fw-bold inscripciones-info">' . $telefono_admisiones . '</p>' .
                                '<p class="m-0 fw-bold inscripciones-info">' . $correo_admisiones . '</p>' .
                            '</div>' .
                        '</div>' .
                    '</div>';
    }


    if ($html != '') {

        $html .= 
                    '<div class="col-md-5">' .
                        '<div class="p-2">' .
                        '<div class="row">' .
                            '<div class="col-md-1"></div>' .
                            '<div class="col-md-10">' .
                                '<form class="form-inscripciones" id="myForm">' .
                                    '<h3 class="mb-2 pt-3 fw-bold text-center inscripciones-form-titulo">Saber más</h3>' .
                                    '<fieldset class="px-5 pb-4">';

        $res_sentecia = $mysqli1->query($sentencia . "27");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_formulario = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }

        $res_formulario = $mysqli1->query($sql_formulario);
        while ($row_datos_form = $res_formulario->fetch_assoc()) {

            $campo = $row_datos_form['campo'];
            $tipo = $row_datos_form['tipo'];

            $obligatorio = 'required';
            $soloLectura = 'readonly';
            $deshabilitado = 'disabled';

            if ($row_datos_form['obligatorio'] != 1) {
                $obligatorio = '';
            }
            if ($row_datos_form['soloLectura'] != 1) {
                $soloLectura = '';
            }
            if ($row_datos_form['habilitado'] != 0) {
                $deshabilitado = '';
            }

            if ($tipo === 'checkbox') {
                $html .= 
                    '<div class="d-flex align-items-start gap-2 my-4">' .
                        '<input onclick="validar_campo(this)" type="' . $tipo. '" id="inscripciones_' . $campo . '" name="' . $campo . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>' .
                        '<p class="form-text">Estoy de acuerdo en que estos datos se almacenen y procesen con el fin de establecer el contacto. Soy consiente de que puedo revocar mi consentimiento en cualquier momento. *
                        <br>
                        * indica los campos obligatorios.
                        </p>'.
                    '</div>';
            } else if ($tipo === 'textarea') {
                    $html .= 
                        '<div class="d-flex flex-column gap-2 my-2">' .
                            '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : '')  . '</label>' .
                            '<textarea onkeyup="validar_campo(this)" name="'. $campo .'" id="inscripciones_' . $campo . '" rows="2" class="form-textarea" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '></textarea>' .
                        '</div>';
            } else {
                    $html .= 
                        '<div class="d-flex flex-column gap-2 my-2">' .
                            '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : "")  . '</label>' .
                            '<input onkeyup="validar_campo(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="'. $campo .'" class="form-input" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>' .
                        '</div>';
            }
            
        }

        $html .= 
                                            '<input type="submit" id="inscripciones_enviar" class="inscripciones-btn w-100 form-text" disabled value="Envía tu mensaje">' .
                                        '</fieldset>' .
                                    '</form>' .
                                '</div>' .
                                '<div class="col-md-1"></div>' .
                            '</div>' . 
                            '<div class="notificacion-error notificacion-hidden" id="form-notificacion"></div>' .
                            '<div class="notificacion-success notificacion-hidden" id="notificacion-success">¡Formulario enviado con éxito!</div>' .
                            '</div>' .
                    '</div>' .
                '</div>' .
            '</section>';
    }

    echo $html;