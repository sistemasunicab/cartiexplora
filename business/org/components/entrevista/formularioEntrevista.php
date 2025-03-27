<?php
    function posicionTitulo($imgHTML, $titulo, $posicionTitulo, $color = '')
    {
        $title = '';
        if (strtolower($posicionTitulo) == 'abajo') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=    '<div class="col-lg-3 my-4">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .=    '<div class="col-lg-12">';
            $title .=        '<h4 class="font-roboto-black text-start '.$color.'">' . $titulo . '</h4>';
            $title .=    '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'derecha') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-8">';
            $title .=         '<h4 class="font-roboto-black'.$color.'">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=     '<div class="col-lg-8">';
            $title .=         '<h4 class="font-roboto-black text-end '.$color.'">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'arriba') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=     '<div class="col-lg-12 my-4">';
            $title .=         '<h4 class="font-roboto-black text-start '.$color.'">'. $titulo .'</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        }
        return $title;
    }

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    //Obtener Imagenes
    $res_sentecia = $mysqli1->query($sentencia . "106");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res1 = $mysqli1->query($sql_imagenes);
    while ($row = $res1->fetch_assoc()) {
        $imagenes[] = $row;
    }

    //Obtener textos
    $res_sentecia = $mysqli1->query($sentencia . "108");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_textos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res2 = $mysqli1->query($sql_textos);

    while ($row = $res2->fetch_assoc()) {
        $textos[] = $row;
    }

    $res_sentecia = $mysqli1->query($sentencia . "105");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);

    $html = '';
    while ($row_sentencia = $res_seccion->fetch_assoc()) {
        $imagen_banner = array_shift($imagenes);
        $html .= '<section class="row mb-5">';
        $html .=    '<div class="col-lg-12">';
        $html .=        '<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagen_banner['ruta'], $imagen_banner['descripcion']).' class="img-fluid w-100">';
        $html .=    '</div>';
        $html .= '</section>';

        /*$html .= '<main class="container" id="divMision">';
        $html .=    '<div class="row my-2">';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<h2 class="text-center tx-blue font-roboto-light-title">'. $row_sentencia['titulo'] .'</h2>';
        $html .=        '</div>';
        $html .=    '</div>';*/

        //$imagen_explorador = array_shift($imagenes);
        //$numeroCards = sizeof($textos);

        /*$html .=    '<div class="row">';
        for ($i = 0; $i < 3; $i++) {
            //Muestra las primeras cards del home con diferente estructura
            $html .=    '<div class="col-lg-6 p-4 value">';
            $html .=        posicionTitulo('<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[$i]['ruta'], $imagenes[$i]['descripcion']).' class="carti-icons object-fit-cover">', 
            $imagenes[$i]['titulo'],  $imagenes[$i]['posicionTitulo'], 'tx-orange');
            $html .=        '<div class="row" id="divPrincipios">';
            $html .=            '<div class="col-lg-12 my-3">';
            $html .=                '<p class="special-paragraph">';
            $html .=                    $textos[$i]['texto'];
            $html .=                '</p>';
            $html .=            '</div>';
            $html .=         '</div>';
            $html .=    '</div>';
            
            if($i === 2){
                $html .=    '<div class="col-lg-6 value">';
                $html .=       '<img '. ImageAttributeBuilder::buildAttributes($nivel, $imagen_explorador['ruta'], $imagen_explorador['descripcion']) .' class="img-fluid w-100">';
                $html .=    '</div>';    
            }
        }
        $html .=    '</div>';
        $html .=    '<div class="row my-3">';
        for ($i = 3; $i < $numeroCards; $i++) {
            $html .=    '<div class="col-lg-4 p-4 value">';
            $html .=        posicionTitulo('<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[$i]['ruta'], $imagenes[$i]['descripcion']).' class="carti-icons object-fit-cover">', 
            $imagenes[$i]['titulo'],  $imagenes[$i]['posicionTitulo']);
            $html .=        '<div class="row">';
            $html .=            '<div class="col-lg-12">';
            $html .=                '<p class="special-paragraph">';
            $html .=                    $textos[$i]['texto'];
            $html .=                '</p>';
            $html .=            '</div>';
            $html .=         '</div>';
            $html .=    '</div>';
        }

        $html .=    '</div>';*/
        $html .= '</main>';
    }

    $html .= '<div class="container datosEstudiante">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-2 amarillo">
                            <h5>'.$textos[0]['identificacion'].'</h5>
                        </div>
                        <div class="col-md-1 col-1 azuloscuro">
                            <h5>'.$textos[0]['identificacion'].'</h5>
                        </div>
                        <div class="col-md-9 col-9 azuloscuro">
                            <h5>'.$textos[0]['texto'].'</h5>
                        </div>
                    </div>
                    <br>
                </div>		
            </div><br>';

    /*$html .= '<section class="container inscripciones-seccion">';
    $html .=    '<div class="row">';
    $html .=        '<div class="col-lg-7 d-flex align-items-center">';
    $html .=            '<div>';
    $html .=                '<div class="my-5">';
    $html .=                    '<h1 class="font-roboto-black">' . $row_datos_seccion['titulo'] . '</h1>';
    $html .=                    '<h1 class="font-roboto-light">' . $row_datos_seccion['subTitulo'] . '</h1>';
    $html .=                '</div>';
    $html .=                '<div class="my-5">';
    $html .=                    '<p class="m-0 font-roboto-bolditalic">' . $row_datos_seccion['texto'] . '</p>';
    $html .=                    '<p class="m-0 font-roboto-bolditalic">' . $parametros['telefono_admisiones'] . '</p>';
    $html .=                    '<p class="m-0 font-roboto-bolditalic">' . $parametros['correo_admisiones'] . '</p>';
    $html .=                '</div>';
    $html .=            '</div>';
    $html .=        '</div>';
    $html .=        '<div class="col-lg-5 form-container">';
    $html .=            '<div class="row d-none d-sm-none d-lg-flex">';
    $html .=                '<div class="col-lg-1 p-0"></div>';
    $html .=                '<div class="col-lg-10">';
    $html .=                    '<form class="form-inscripciones row" id="myForm">';
    $html .=                        '<h3 class="mb-2 pt-3 fw-bold text-center inscripciones-form-titulo">' . $parametros['titulo_form_inscripciones'] . '</h3>';
    $html .=                        '<div class="col-lg-2"></div>';
    $html .=                        '<div class="col-lg-8">';*/

    /*$res_sentecia = $mysqli1->query($sentencia . "107");
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

        switch ($tipo) {
            case 'text':
                $html .= '<div class="row gap-2 my-2">';
                $html .=    '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : "")  . '</label>';
                $html .=    '<input onkeyup="validar_texto(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" class="form-input ' . (($obligatorio) ? "inscripciones-input" : "") . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>';
                $html .= '</div>';
                break;

            case 'button':
            case 'submit':
            case 'reset':
                $html .= '<div class="row justify-content-center align-items-start my-5">';
                $html .=     '<input type="'. $tipo .'" id="inscripciones_enviar" class="inscripciones-btn w-100 form-text" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . ' value="' . $campo . '">';
                $html .= '</div>';
                break;

            case 'checkbox':
                $html .= '<div class="row justify-content-center align-items-start my-4">';
                $html .=     '<input class="col-lg-2" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>';
                $html .=     '<p class="form-text col-lg-10">' . $parametros['checkbox_form_inscripciones'] . '</p>';
                $html .= '</div>';
                break;

            case 'textarea':
                $html .= '<div class="row gap-2 my-2">';
                $html .=    '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : '')  . '</label>';
                $html .=    '<textarea onkeyup="validar_texto(this)" name="' . $campo . '" id="inscripciones_' . $campo . '" rows="2" class="form-textarea ' . (($obligatorio) ? "inscripciones-input" : "") . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '></textarea>';
                $html .= '</div>';
                break;

            case 'number':
                $html .= '<div class="row gap-2 my-2">';
                $html .=     '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : "")  . '</label>';
                $html .=     '<input min="1" onchange="validar_numero(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" class="form-input ' . (($obligatorio) ? "inscripciones-input" : "") . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>';
                $html .= '</div>';
                break;

            case 'email':
                $html .= '<div class="row gap-2 my-2">';
                $html .=    '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : "")  . '</label>';
                $html .=    '<input onkeyup="validar_correo(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" class="form-input ' . (($obligatorio) ? "inscripciones-input" : "") . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>';
                $html .= '</div>';
                break;

            case 'date':
                $html .= '<div class="row gap-2 my-2">';
                $html .=    '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : "")  . '</label>';
                $html .=    '<input onchange="validar_fecha(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" class="form-input ' . (($obligatorio) ? "inscripciones-input" : "") . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>';
                $html .= '</div>';
                break;

            default:
                $html .= '<div class="row gap-2 my-2">';
                $html .=    '<label for="' . $campo . '" class="form-label">' . $campo . (($obligatorio) ? " *" : "")  . '</label>';
                $html .=    '<input onkeyup="validar_texto(this)" type="' . $tipo . '" id="inscripciones_' . $campo . '" name="' . $campo . '" class="form-input ' . (($obligatorio) ? "inscripciones-input" : "") . '" ' . $obligatorio . ' ' . $soloLectura . ' ' . $deshabilitado . '>';
                $html .= '</div>';
                break;
        }
    }

    $html .=                        '</div>';
    $html .=                        '<div class="col-lg-2"></div>';
    $html .=                    '</form>';
    $html .=                '</div>';
    $html .=                '<div class="col-lg-1"></div>';
    $html .=            '</div>';
    $html .=            '<div class="notificacion-error notificacion-hidden" id="form-notificacion"></div>';
    $html .=            '<div class="notificacion-success notificacion-hidden" id="notificacion-success">¡Formulario enviado con éxito!</div>';
    $html .=        '</div>';
    $html .=    '</div>';
    $html .= '</section>';*/

    $campos_formulario = [];
    $res_sentecia = $mysqli1->query($sentencia . "107");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_formulario = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res_formulario = $mysqli1->query($sql_formulario);
    while ($row_datos_form = $res_formulario->fetch_assoc()) {
        $campos_formulario[] = $row_datos_form;
        /*$campo = $row_datos_form['campo'];
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
        }*/
    }

    //<img src="assets/img/admisiones/ico1_admisiones_2025_1.jpg" id="imgh1" class="icono img-fluid"/>
    $icono_documento = array_shift($imagenes);
    $icono_datos = array_shift($imagenes);
    $imagen_continua_proceso = array_shift($imagenes);
    $gif_loading = array_shift($imagenes);
    $documento_estudiante = array_shift($campos_formulario);
    $html .= '<div class="container datosEstudiante">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-5"></div>
                        <div class="col-md-2 col-2">
                            <center>
                                <img '.ImageAttributeBuilder::buildAttributes($nivel, $icono_documento['ruta'], $icono_documento['descripcion']).' class="icono img-fluid">
                            </center>
                        </div>
                        <div class="col-md-5 col-5"></div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4 col-4"></div>
                        <div class="col-md-4 col-4">
                            <center>
                                <div class="form-group">
                                    <label for="'.$documento_estudiante['campo'].'" class="form-label1">'.$documento_estudiante['texto'].'</label>
                                    <input type="'.$documento_estudiante['tipo'].'" class="form-control campoFormulario" id="'.$documento_estudiante['campo'].'" name="'.$documento_estudiante['campo'].'" placeholder="Escribe el número de documento del estudiante" onkeyup="validarCampo(this, \'Número documento estudiante\', \'numero\', 0, \'\');" onBlur="limpiar();" required>
                                    <input type="hidden" style="width: 20px" id="ctr_'.$documento_estudiante['campo'].'" value="1"/>
                                </div>
                            </center>
                        </div>
                        <div class="col-md-4 col-4"></div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-2 col-2"></div>
                        <div class="col-md-8 col-8">
                            <h6 id="msgdocumento" style="color: blue;"></h6>
                        </div>				
                        <div class="col-md-2 col-2"></div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4 col-4"></div>
                        <div class="col-md-4 col-4">
                            <div class="form-group">
                                <center>
                                    <button type="button" class="btnContinuar" onclick="valDocumentoEntrevista(\'btnEnviar\');">
                                        <img '.ImageAttributeBuilder::buildAttributes($nivel, $imagen_continua_proceso['ruta'], $imagen_continua_proceso['descripcion']).' class="img-fluid">
                                    </button>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-4 col-4"></div>
                    </div><br>
                    <div id="divcargando" class="loader">
                        <center><p><img '.ImageAttributeBuilder::buildAttributes($nivel, $gif_loading['ruta'], $gif_loading['descripcion']).' class="img-fluid"></p></center>
                    </div>
                </div>		
            </div><br>';

    $html .= '<div class="alert alert-danger" role="alert" id="alert" style="margin-left: 5rem;">
                <p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
                <input type="text" class="alert" style="width: 20px; border: none; background: transparent;" id="txtvacio" value="0"></p>
            </div>';

    $html .= '<div id="whatsapp">
                <a href="https://wa.me/573008156531/?text=Hola. Necesito asesoría del proceso de admisiones." target="_blank">
                    <svg width="80" height="80" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                    <g class="layer">
                    <title>¿Necesitas asesoría?</title>
                    <circle cx="40" cy="40" fill="#fff" id="svg_1" r="38" stroke="#000000" stroke-width="0"/>
                    <path d="m57.81072,21.975c-4.48928,-4.5 -10.46786,-6.975 -16.82142,-6.975c-13.11429,0 -23.78571,10.67143 -23.78571,23.78571c0,4.18928 1.09286,8.28215 3.17143,11.89286l-3.375,12.32142l12.61072,-3.31072c3.47143,1.89642 7.38215,2.89286 11.36786,2.89286l0.01072,0c13.10358,0 24.01072,-10.67143 24.01072,-23.78571c0,-6.35357 -2.7,-12.32142 -7.18928,-16.82142l-0.00001,-0.00001l-0.00001,0l-0.00002,0.00001zm-16.82142,36.6c-3.55714,0 -7.03928,-0.95357 -10.07143,-2.75357l-0.71785,-0.42857l-7.47858,1.96072l1.99286,-7.29642l-0.47143,-0.75c-1.98215,-3.15 -3.02142,-6.78215 -3.02142,-10.52142c0,-10.89642 8.87143,-19.76786 19.77858,-19.76786c5.28215,0 10.24286,2.05714 13.97143,5.79642c3.72857,3.73928 6.02142,8.7 6.01072,13.98215c0,10.90714 -9.09642,19.77858 -19.99286,19.77858l0,-0.00002l-0.00001,0l-0.00001,-0.00001zm10.84286,-14.80714c-0.58928,-0.3 -3.51429,-1.73572 -4.06072,-1.92857c-0.54643,-0.20358 -0.94286,-0.3 -1.33928,0.3c-0.39642,0.6 -1.53214,1.92857 -1.88571,2.33572c-0.34286,0.39642 -0.69642,0.45 -1.28571,0.15c-3.49286,-1.74643 -5.78571,-3.11785 -8.08928,-7.07143c-0.61072,-1.05 0.61072,-0.975 1.74643,-3.24643c0.19286,-0.39642 0.09642,-0.73928 -0.05357,-1.03928c-0.15,-0.3 -1.33928,-3.225 -1.83214,-4.41429c-0.48215,-1.15714 -0.975,-0.99642 -1.33928,-1.01785c-0.34286,-0.02142 -0.73928,-0.02142 -1.13572,-0.02142c-0.39642,0 -1.03928,0.15 -1.58571,0.73928c-0.54643,0.6 -2.07858,2.03572 -2.07858,4.96072c0,2.925 2.13214,5.75357 2.42142,6.15c0.3,0.39642 4.18928,6.39642 10.15714,8.97858c3.77143,1.62857 5.25,1.76786 7.13572,1.48928c1.14643,-0.17143 3.51429,-1.43572 4.00714,-2.82857c0.49286,-1.39286 0.49286,-2.58215 0.34286,-2.82857c-0.13928,-0.26786 -0.53572,-0.41785 -1.125,-0.70714l-0.00001,-0.00001l0.00002,-0.00001l-0.00002,-0.00001z" fill="currentColor" id="svg_2"/>
                    </g>
                    </svg>
                </a>
            </div>';

    echo $html;

