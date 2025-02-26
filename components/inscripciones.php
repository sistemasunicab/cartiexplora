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
                    '<div class="col-lg-7 d-flex align-items-center">' .
                        '<div>' .
                            '<div class="my-5">' .
                                '<h1 class="font-roboto-black">' . $row_datos_seccion['titulo'] . '</h1>' .
                                '<h1 class="font-roboto-light">' . $row_datos_seccion['subTitulo'] . '</h1>' .
                            '</div>' .
                            '<div class="my-5">' .
                                '<p class="m-0 font-roboto-bolditalic">' . $row_datos_seccion['texto'] . '</p>' .
                                '<p class="m-0 font-roboto-bolditalic">' . $parametros['telefono_admisiones'] . '</p>' .
                                '<p class="m-0 font-roboto-bolditalic">' . $parametros['correo_admisiones'] . '</p>' .
                            '</div>' .
                        '</div>' .
                    '</div>';

        $html .=
        '<div class="col-lg-5 form-container">' .
            '<div class="row">' .
                '<div class="col-lg-1"></div>' .
                '<div class="col-lg-1"></div>' .
                '<div class="col-lg-10">' .
                    '<form class="form-inscripciones row" id="myForm">' .
                        '<h3 class="mb-2 pt-3 fw-bold text-center inscripciones-form-titulo">'. $parametros['titulo_form_inscripciones'] .'</h3>' .
                        '<div class="col-lg-2"></div>' .
                        '<div class="col-lg-8">';
    
        $res_sentecia = $mysqli1->query($sentencia . "29");
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
        
            if ($tipo === 'submit') {
                $html .= '
                    <div class="row justify-content-center align-items-start my-5"> 
                        <input type="submit" id="inscripciones_enviar" class="inscripciones-btn w-100 form-text" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . ' value="' . $campo . '">
                    </div>';
            }else if ($tipo === 'checkbox') {
                $html .=
                    '<div class="row justify-content-center align-items-start my-4">' .
                        '<input class="col-lg-2 inscripciones-input" onclick="validar_campo(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>' .
                        '<p class="form-text col-lg-10">'. $parametros['checkbox_form_inscripciones'] .'</p>' .
                    '</div>';
            } else if ($tipo === 'textarea') {
                $html .=
                    '<div class="row gap-2 my-2">' .
                        '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : '')  . '</label>' .
                        '<textarea onkeyup="validar_campo(this)" name="' . $campo . '" id="inscripciones_' . $campo . '" rows="2" class="form-textarea inscripciones-input" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '></textarea>' .
                    '</div>';
            } else {
                $html .=
                    '<div class="row gap-2 my-2">' .
                        '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : "")  . '</label>' .
                        '<input onkeyup="validar_campo(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" class="form-input inscripciones-input" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>' .
                    '</div>';
            }
        }
    
        $html .=
            '</div>
                                    <div class="col-lg-2"></div>
                                </form>
                            </div>
                        </div>
                        <div class="notificacion-error notificacion-hidden" id="form-notificacion"></div>
                        <div class="notificacion-success notificacion-hidden" id="notificacion-success">¡Formulario enviado con éxito!</div>
                    </div>
                </div>
            </section>';
    }
    
    echo $html;
?>