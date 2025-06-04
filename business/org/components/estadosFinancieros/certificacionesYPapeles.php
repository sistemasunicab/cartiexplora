<?php
// 1) Obtener todas las filas de “certificaciones” (sentencia 79)
$filasCertificaciones = obtenerFilas($mysqli1, $sentencia, 79);

$html_certificaciones = '';

foreach ($filasCertificaciones as $rowCert) {
    // Solo procesar si “visible” es 1
    if ((int)$rowCert['visible'] !== 1) {
        continue;
    }

    // 2) Cargar campos del formulario (sentencia 137)
    $camposForm = obtenerFilas($mysqli1, $sentencia, 137);
    
    // Extraer cada campo en variables
    $nombre_certifications             = array_shift($camposForm);
    $identificacion_certifications     = array_shift($camposForm);
    $tipo_id_certifications            = array_shift($camposForm);
    $correo_certifications             = array_shift($camposForm);
    $telefono_certifications           = array_shift($camposForm);
    $grado_id_certifications           = array_shift($camposForm);
    $relacion_id_certifications        = array_shift($camposForm);
    $tipo_certifications               = array_shift($camposForm);
    $fecha_certifications              = array_shift($camposForm);
    $proposito_certifications          = array_shift($camposForm);
    $tratamiento_certifications        = array_shift($camposForm);
    $boton_certifications              = array_shift($camposForm);

    // 3) Título de la sección
    $titulo = $rowCert['titulo'];

    /* Row one */

    $html_row_one = '<div class="col-12 row p-0 m-0 mb-5 ">';
    $html_row_one .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_one .= '<div class="col-lg-7 col-md-7 col-sm-7 col-7 p-0">';
    $html_row_one .= '<h3-financieros class="tx-blue font-roboto-light-title">' . $titulo . '</h3-financieros>';
    $html_row_one .= '</div>';
    $html_row_one .= '<div class="col-lg-2 col-md-4 col-sm-4 col-4 p-0"></div>';
    $html_row_one .= '</div>';


    /* Row two */

    $html_row_two = '<div class="row p-0 m-0 my-lg-5 my-4">';
    $html_row_two .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';

    $html_row_two .= '<div class="row col-lg-10 col-md-12 col-sm-12 col-12 p-0 m-0">';
    $html_row_two .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';
    // Input: Nombre
    $campo = $nombre_certifications;
    $html_row_two .= '<div class="col-lg-5 col-md-6 col-sm-10 col-10 p-0 m-0">';
    $html_row_two .= '
                <div class="col-lg-11 col-12 p-0 m-0 mb-lg-0 mb-4">
                    <input
                        onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                        ' . $campo['obligatorio'] . '
                        id="' . $campo['campo'] . '"
                        name="' . $campo['campo'] . '"
                        type="' . $campo['tipo'] . '"
                        class="form-control text-center font-roboto-bolditalic"
                        placeholder="' . $campo['placeHolder'] . '"
                        autocomplete="name"
                    >
                </div>';
    $html_row_two .= '</div>';
    $html_row_two .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';

    // Input: Identificación
    $campo = $identificacion_certifications;
    $html_row_two .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';
    $html_row_two .= '<div class="col-lg-5 col-md-6 col-sm-10 col-10 p-0 m-0">';
    $html_row_two .= '
                <div class="col-lg-11 col-12 p-0 m-0 mb-lg-0 mb-4">
                    <input
                        onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                        ' . $campo['obligatorio'] . '
                        id="' . $campo['campo'] . '"
                        name="' . $campo['campo'] . '"
                        type="text"
                        class="form-control text-center font-roboto-bolditalic"
                        placeholder="' . $campo['placeHolder'] . '"
                        autocomplete="off"
                    >
                </div>';
    $html_row_two .= '</div>';
    $html_row_two .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';
    // Dropdown: Tipo ID (opciones fijas)
    $campo = $tipo_id_certifications;
    $html_row_two .= '<div class="d-lg-none col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_two .= '<div class="col-lg-2 col-md-2 col-sm-4 col-4 p-0 m-0">';
    $html_row_two .= '
                    <div 
                        id="' . $campo['campo'] . '"
                        data-value="NA"
                        data-texto="Debes seleccionar un valor en ' . $campo['texto'] . '"
                        data-btn_submit="' . $boton_certifications['campo'] . '" 
                        class="select-wrapper custom-select col-12 h-100">
                        <div class="col-12 display-options font-roboto-italic tx-white" data-placeholder="' . $campo['placeHolder'] . '">
                            <span class="selected-value">' . $campo['placeHolder'] . '</span>
                            <i class="select-arrow">▼</i>
                        </div>
                        <div class="custom-options">
                        <div class="custom-option" data-value="NA">'. $campo['placeHolder'] . '</div>
                        <div class="custom-option" data-value="Estudiante">Estudiante</div>
                        <div class="custom-option" data-value="Docente">Docente</div>
                        <div class="custom-option" data-value="Administrativo">Administrativo</div>
                        </div>
                    </div>';

    $html_row_two .= '</div>';
    $html_row_two .= '<div class="d-lg-none col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_two .= '</div>';
    $html_row_two .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_two .= '</div>';

    /* Row three */

    $html_row_three = '<div class="row p-0 m-0 my-lg-5 my-4">';
    $html_row_three .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_three .= '<div class="row col-lg-10 col-md-12 col-sm-12 col-12 p-0 m-0">';
    // Input: Correo
    $campo = $correo_certifications;
    $html_row_three .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';
    $html_row_three .= '<div class="col-lg-5 col-md-6 col-sm-10 col-10 p-0 m-0">';
    $html_row_three .= '
                <div class="col-lg-11 col-12 p-0 m-0 mb-lg-0 mb-4">
                    <input
                        onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                        ' . $campo['obligatorio'] . '
                        id="' . $campo['campo'] . '"
                        name="' . $campo['campo'] . '"
                        type="text"
                        class="form-control text-center font-roboto-bolditalic"
                        placeholder="' . $campo['placeHolder'] . '"
                        autocomplete="email"
                    >
                </div>';
    $html_row_three .= '</div>';
    $html_row_three .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';
    // Input: Teléfono
    $campo = $telefono_certifications;
    $html_row_three .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';
    $html_row_three .= '<div class="col-lg-5 col-md-6 col-sm-10 col-10 p-0 m-0">';
    $html_row_three .= '    
                <div class="col-lg-11 col-12 p-0 m-0 mb-lg-0 mb-4">
                    <input
                        onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                        ' . $campo['obligatorio'] . '
                        id="' . $campo['campo'] . '"
                        name="' . $campo['campo'] . '"
                        type="text"
                        class="form-control text-center font-roboto-bolditalic"
                        placeholder="' . $campo['placeHolder'] . '"
                        autocomplete="tel"
                    >
                </div>';
    $html_row_three .= '</div>';
    $html_row_three .= '<div class="d-lg-none col-md-3 col-sm-1 col-1 p-0"></div>';
    // Dropdown: Grado
    $campo = $grado_id_certifications;
    $html_row_three .= '<div class="d-lg-none col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_three .= '<div class="col-lg-2 col-md-2 col-sm-4 col-4 p-0 m-0">';
    $html_row_three .= '
    <div 
        id="' . $campo['campo'] . '"
        data-value="NA"
        data-texto="Debes seleccionar un valor en ' . $campo['texto'] . '"
        data-btn_submit="' . $boton_certifications['campo'] . '" 
        class="select-wrapper custom-select col-12 h-100"
    >
        <div 
            class="col-12 display-options font-roboto-italic tx-white" 
            data-placeholder="' . $campo['placeHolder'] . '"
            tabindex="0"
        >
            <span class="selected-value">' . $campo['placeHolder'] . '</span>
            <i class="select-arrow">▼</i>
        </div>
        <div class="custom-options">
            <div class="custom-option" data-value="NA">' . $campo['placeHolder'] . '</div>
            <div class="custom-option" data-value="Primaria">Primaria</div>
            <div class="custom-option" data-value="Secundaria">Secundaria</div>
            <div class="custom-option" data-value="Universitario">Universitario</div>
        </div>
    </div>';

    $html_row_three .= '</div>';
    $html_row_three .= '<div class="d-lg-none col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_three .= '</div>';
    $html_row_three .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_three .= '</div>';

    /* Row four */

    $html_row_four = '<div class="row p-0 m-0 my-5">';
    $html_row_four .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_four .= '<div class="row col-lg-10 col-md-12 col-sm-12 col-12 p-0 m-0">';
    $html_row_four .= '<div class="d-lg-none col-md-2 col-sm-1 col-1 p-0 m-0">';
    $html_row_four .= '</div>';
    $html_row_four .= '<div class="col-lg-5 col-md-8 col-sm-10 col-10 p-0 m-0">';
    $html_row_four .= '
    <div 
        id="' . $relacion_id_certifications['campo'] . '"
        data-value="NA"
        data-texto="Debes seleccionar un valor en ' . $relacion_id_certifications['texto'] . '"
        data-btn_submit="' . $boton_certifications['campo'] . '" 
        class="col-lg-11 col-12 select-wrapper custom-select h-100"
    >
        <div 
            class="col-12 p-2 display-options little-financieros font-roboto-italic tx-white" 
            data-placeholder="' . $relacion_id_certifications['placeHolder'] . '"
            tabindex="0"
        >
            <span class="selected-value">' . $relacion_id_certifications['placeHolder'] . '</span>
            <i class="select-arrow">▼</i>
        </div>
        <div class="custom-options">
            <div class="custom-option" data-value="NA">' . $relacion_id_certifications['placeHolder'] . '</div>';

    // Opciones dinámicas para “Relación con la institución” (sentencia 81)
    $opcionesRelacion = obtenerFilas($mysqli1, $sentencia, 81);
    foreach ($opcionesRelacion as $opt) {
        if ((int) $opt['visible'] !== 1) {
            continue;
        }
        $valor = $opt['valor'];
        $html_row_four .= '
            <div class="custom-option" data-value="' . $valor . '">' . $valor . '</div>';
    }

    $html_row_four .= '
        </div>
    </div>';

    $html_row_four .= '</div>';
    $html_row_four .= '<div class="col-lg-2 col-md-2 col-sm-1 col-1 p-0 m-0">';
    $html_row_four .= '</div>';
    $html_row_four .= '</div>';
    $html_row_four .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_four .= '</div>';

    /* Row five */

    $html_row_five = '<div class="row p-0 m-0 my-lg-5 my-5">';
    $html_row_five .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_five .= '<div class="btn-financiero d-flex flex-row col-lg-3 col-md-12 col-sm-12 col-12 p-0">';
    $html_row_five .= '<div class="bg-orange m-0 p-0 col-2"></div>';
    $html_row_five .= '<p class="py-3 ps-2 ps-lg-3 col-10 font-roboto-bolditalic tx-white m-0">
                            Detalles de la Solicitud
                        </p>';
    $html_row_five .= '</div>';
    $html_row_five .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_five .= '</div>';

    /* Row six */

    $html_row_six = '<div class="row p-0 m-0 my-lg-5 my-4">';
    $html_row_six .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_six .= '<div class="row col-lg-10 col-md-12 col-sm-12 col-12 p-0 m-0">';
    $html_row_six .= '<div class="d-lg-none col-md-2 col-sm-1 col-1 p-0 m-0"></div>';
    $html_row_six .= '<div class="col-lg-5 col-md-8 col-sm-10 col-10 p-0 m-0 mb-lg-0 mb-5">';
    $html_row_six .= '
    <div 
        id="' . $tipo_certifications['campo'] . '"
        data-value="NA"
        data-texto="Debes seleccionar un valor en ' . $tipo_certifications['texto'] . '"
        data-btn_submit="' . $boton_certifications['campo'] . '"
        class="col-lg-11 col-12 select-wrapper custom-select"
    >
        <div 
            class="col-12 p-2 display-options little-financieros font-roboto-italic tx-white" 
            data-placeholder="' . $tipo_certifications['placeHolder'] . '"
            tabindex="0"
        >
            <span class="selected-value">' . $tipo_certifications['placeHolder'] . '</span>
            <i class="select-arrow">▼</i>
        </div>
        <div class="custom-options">
            <div class="custom-option" data-value="NA">' . $tipo_certifications['placeHolder'] . '</div>';

    // Opciones dinámicas para “Tipo de certificación” (sentencia 82)
    $opcionesTipo = obtenerFilas($mysqli1, $sentencia, 82);
    foreach ($opcionesTipo as $opt) {
        if ((int) $opt['visible'] !== 1) {
            continue;
        }
        $valor = $opt['valor'];
        $html_row_six .= '
            <div class="custom-option" data-value="' . $valor . '">' . $valor . '</div>';
    }

    $html_row_six .= '
        </div>
    </div>';

    $html_row_six .= '</div>';
    $html_row_six .= '<div class="d-lg-none col-md-2 col-sm-1 col-1 p-0 m-0"></div>';
    $html_row_six .= '<div class="d-lg-none col-md-4 col-sm-3 col-3 p-0 m-0"></div>';
    $html_row_six .= '<div class="col-lg-2 col-md-4 col-sm-6 col-6 p-0 m-0 mb-lg-0 mb-4 d-flex flex-column align-items-center justify-content-center position-relative">';
        // Imagen de años (sentencia 80)
        $anosData = obtenerFilas($mysqli1, $sentencia, 80);
        $row_ano = $anosData[0] ?? [];
        if (!empty($row_ano)) {
            $ruta_ano = rutaPorNivel($row_ano['ruta']);
            $alt_ano = $row_ano['textoAlterno'] ?? 'Año';
            $titulo_ano = $row_ano['titulo'];
    
            $html_row_six .= '
                        <p-financieros class="text-center text-up-absolute font-roboto-bolditalic">' . $titulo_ano . '</p-financieros>
                        <img src="' . $ruta_ano . '" alt="' . $alt_ano . '" class="img-fluid year-trigger mt-lg-0 mt-5" style="width:80px; cursor:pointer;">
                        <select id="certificaciones_date" required class="year-select mt-2 d-none"></select>';
        }
    
    $html_row_six .= '</div>';
    $html_row_six .= '<div class="d-lg-none col-md-4 col-sm-3 col-3 p-0 m-0"></div>';
    $html_row_six .= '<div class="d-lg-none col-md-2 col-sm-1 col-1 p-0 m-0"></div>';
    $html_row_six .= '<div class="col-lg-5 col-md-8 col-sm-10 col-10 p-0 m-0 mb-lg-0 mb-4">';
    $campo = $proposito_certifications;
    $html_row_six .= '
                <div class="row p-0 m-0">
                    <div class="col-lg-1 col-0 p-0 m-0"></div>
                    <div class="col-lg-11 col-12 p-0 m-0">
                        <textarea
                            onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                            id="' . $campo['campo'] . '"
                            ' . $campo['obligatorio'] . '
                            name="' . $campo['campo'] . '"
                            class="form-control text-area-input font-roboto-bolditalic"
                            placeholder="' . $campo['placeHolder'] . '"
                            rows="4"
                            autocomplete="off"
                        ></textarea>
                    </div>
                </div>';
    $html_row_six .= '</div>';
    $html_row_six .= '<div class="d-lg-none col-md-2 col-sm-1 col-1 p-0 m-0"></div>';
    $html_row_six .= '</div>';
    $html_row_six .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_six .= '</div>';

    /* Row seven */

    $html_row_seven = '<div class="row p-0 m-0 my-lg-5 my-4">';
    $html_row_seven .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_seven .= '<div class="row col-lg-10 col-md-10 col-sm-10 col-10 p-0 m-0">';
    $html_row_seven .= '<div class="d-lg-none col-md-2 col-sm-1 col-1 p-0 m-0"></div>';
    $html_row_seven .= '<div class="col-lg-5 col-md-8 col-sm-10 col-10 p-0 m-0 d-lg-block d-flex align-items-center justify-content-center">';
    // Check “Tratamiento”
    $campo = $tratamiento_certifications;
    $html_row_seven .= '
        <div class="form-check d-flex align-items-center gap-2">
            <input
                ' . $campo['obligatorio'] . '
                class="form-check-input"
                type="checkbox"
                id="' . $campo['campo'] . '"
                name="' . $campo['campo'] . '"
            >
            <label
                class="form-check-label d-flex align-items-center font-roboto-regular m-0"
                for="' . $campo['campo'] . '"
            >
                ' . $campo['placeHolder'] . '
            </label>
        </div>';
    $html_row_seven .= '</div>';
    $html_row_seven .= '<div class="col-lg-7 col-md-2 col-sm-1 col-1 p-0 m-0">';
    $html_row_seven .= '</div>';
    $html_row_seven .= '</div>';
    $html_row_seven .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_seven .= '</div>';

    $imagen_data = obtenerFilas($mysqli1, $sentencia, 103);
    // Botón final (imagen de “Solicitud” - sentencia 103)
    $row_imgBtn = $imagen_data[0] ?? [];
    if (!empty($row_imgBtn)) {
        $rutaBtn = rutaPorNivel($row_imgBtn['ruta']);
        $altBtn = $row_imgBtn['textoAlterno'] ?? 'Imagen';
    } else {
        $rutaBtn = '';
        $altBtn = '';
    }
    $idBoton = $boton_certifications['campo'];
    $textoBoton = $boton_certifications['texto'];

    /* Row eight */

    $html_row_eight = '<div class="row p-0 m-0 mt-lg-5 mt-4">';
    $html_row_eight .= '<div class="col-lg-5 col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_eight .= '<div class="col-lg-2 col-md-2 col-sm-4 col-4 p-0 d-flex">';
    $html_row_eight .= '<button id="' . $idBoton . '" class="form-control btn-submit-financial btn mx-auto">';
    $html_row_eight .= '<p class="font-roboto-medium tx-white m-0 p-0">' . $textoBoton . '</p>';
    $html_row_eight .= '<img src="' . $rutaBtn . '" alt="' . $altBtn . '" class="img-fluid" style="width:30px;">';
    $html_row_eight .= '</button>';
    $html_row_eight .= '</div>';
    $html_row_eight .= '<div class="col-lg-5 col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_eight .= '</div>';
    

    $html_certificaciones = $html_row_one;
    $html_certificaciones .= '<form id="form_servicios" class="form-financial p-0">';
    $html_certificaciones .= $html_row_two;
    $html_certificaciones .= $html_row_three;
    $html_certificaciones .= $html_row_four;
    $html_certificaciones .= $html_row_five;
    $html_certificaciones .= $html_row_six;
    $html_certificaciones .= $html_row_seven;
    $html_certificaciones .= $html_row_eight;
    $html_certificaciones .= '</form>';

} 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<div class="container-fluid my-ws mx-0 p-0" id="certificaciones">
    <?= $html_certificaciones ?>
</div>
