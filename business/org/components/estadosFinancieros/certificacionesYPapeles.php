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
    $html_certificaciones .= '
    <div class="col-lg-9 col-md-12 col-sm-12 col-12 p-0 mx-auto d-flex flex-column">
        <h3-financieros class="col-lg-8 col-md-10 col-sm-10 col-10 mx-auto mx-lg-0 tx-blue font-roboto-light-title my-0">'
            . $titulo .
        '</h3-financieros>
        <form id="form_servicios" class="my-5 form-financial d-flex flex-column">

            <!-- Primera fila: Nombre, Identificación, Tipo ID -->
            <div class="my-2 d-flex flex-column flex-lg-row justify-content-between">';

    // Input: Nombre
    $campo = $nombre_certifications;
    $type = ($campo['texto'] === 'contraseña') ? 'password' : 'text';
    $html_certificaciones .= '
                <input
                    onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                    ' . $campo['obligatorio'] . '
                    id="' . $campo['campo'] . '"
                    name="' . $campo['campo'] . '"
                    type="' . $type . '"
                    class="col-lg-4 col-md-6 col-sm-9 col-9 mx-auto ms-lg-0 font-roboto-bolditalic my-2"
                    placeholder="' . $campo['placeHolder'] . '"
                    autocomplete="name"
                >';

    // Input: Identificación
    $campo = $identificacion_certifications;
    $html_certificaciones .= '
                <input
                    onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                    ' . $campo['obligatorio'] . '
                    id="' . $campo['campo'] . '"
                    name="' . $campo['campo'] . '"
                    type="text"
                    class="col-lg-4 col-md-6 col-sm-9 col-9 mx-auto ms-lg-0 font-roboto-bolditalic my-2"
                    placeholder="' . $campo['placeHolder'] . '"
                    autocomplete="off"
                >';

    // Dropdown: Tipo ID (opciones fijas)
    $campo = $tipo_id_certifications;
    $html_certificaciones .= '
                <div class="select-wrapper col-lg-3 col-md-4 col-sm-4 col-4 mx-auto my-2">
                    <select
                        onkeyup="validarSelect(this,\'' . $campo['texto'] . '\', \'' . $boton_certifications['campo'] . '\', \'\')"
                        id="' . $campo['campo'] . '"
                        name="' . $campo['campo'] . '"
                        class="col-12 p-2 display-options little-financieros font-roboto-italic tx-white"
                    >
                        <option value="" disabled selected>' . $campo['placeHolder'] . '</option>
                        <option value="Estudiante">Estudiante</option>
                        <option value="Docente">Docente</option>
                        <option value="Administrativo">Administrativo</option>
                        <option value="Otro">Otro</option>
                    </select>
                    <div class="select-arrow col-3">▼</div>
                </div>';
    $html_certificaciones .= '
            </div> <!-- / Primera fila -->

            <!-- Segunda fila: Correo, Teléfono, Grado -->
            <div class="my-2 d-flex flex-column flex-lg-row justify-content-between">';

    // Input: Correo
    $campo = $correo_certifications;
    $html_certificaciones .= '
                <input
                    onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                    ' . $campo['obligatorio'] . '
                    id="' . $campo['campo'] . '"
                    name="' . $campo['campo'] . '"
                    type="text"
                    class="col-lg-4 col-md-6 col-sm-9 col-9 mx-auto ms-lg-0 font-roboto-bolditalic my-2"
                    placeholder="' . $campo['placeHolder'] . '"
                    autocomplete="email"
                >';

    // Input: Teléfono
    $campo = $telefono_certifications;
    $html_certificaciones .= '
                <input
                    onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                    ' . $campo['obligatorio'] . '
                    id="' . $campo['campo'] . '"
                    name="' . $campo['campo'] . '"
                    type="text"
                    class="col-lg-4 col-md-6 col-sm-9 col-9 mx-auto ms-lg-0 font-roboto-bolditalic my-2"
                    placeholder="' . $campo['placeHolder'] . '"
                    autocomplete="tel"
                >';

    // Dropdown: Grado
    $campo = $grado_id_certifications;
    $html_certificaciones .= '
                <div class="select-wrapper col-lg-3 col-md-4 col-sm-4 col-4 mx-auto my-2">
                    <select
                        onkeyup="validarSelect(this,\'' . $campo['texto'] . '\', \'' . $boton_certifications['campo'] . '\', \'\')"
                        id="' . $campo['campo'] . '"
                        name="' . $campo['campo'] . '"
                        class="col-12 p-2 display-options little-financieros font-roboto-italic tx-white"
                    >
                        <option value="" disabled selected>' . $campo['placeHolder'] . '</option>
                        <option value="Primaria">Primaria</option>
                        <option value="Secundaria">Secundaria</option>
                        <option value="Universitario">Universitario</option>
                        <option value="Otro">Otro</option>
                    </select>
                    <div class="select-arrow col-3">▼</div>
                </div>';

    $html_certificaciones .= '
            </div> <!-- / Segunda fila -->

            <!-- Tercera fila: Relación con la institución -->
            <div class="col-lg-4 col-md-6 col-sm-9 col-9 mx-lg-0 mx-auto my-5">
                <div class="col-12 select-wrapper">
                    <select
                        onkeyup="validarSelect(this,\'' . $relacion_id_certifications['texto'] . '\', \'' . $boton_certifications['campo'] . '\', \'relacion_cert_otro\')"
                        id="' . $relacion_id_certifications['campo'] . '"
                        name="' . $relacion_id_certifications['campo'] . '"
                        class="col-12 p-2 display-options little-financieros font-roboto-italic tx-white"
                    >
                        <option value="" disabled selected>' . $relacion_id_certifications['placeHolder'] . '</option>';

    // Opciones dinámicas para “Relación con la institución” (sentencia 81)
    $opcionesRelacion = obtenerFilas($mysqli1, $sentencia, 81);
    foreach ($opcionesRelacion as $opt) {
        if ((int)$opt['visible'] !== 1) {
            continue;
        }
        $valor = $opt['valor'];
        $html_certificaciones .= '<option value="' . $valor . '">' . $valor . '</option>';
    }

    $html_certificaciones .= '
                    </select>
                    <div class="select-arrow col-3">▼</div>
                </div>
                <!-- Input “Otro” oculto -->
                <input
                    onkeyup="validarCampo(this, \'relacion_cert_otro\', \'texto\', 1, \'' . htmlspecialchars($boton_certifications['campo'], ENT_QUOTES, 'UTF-8') . '\')"
                    id="relacion_cert_otro"
                    name="relacion_otro"
                    type="text"
                    class="col-12 mt-2 other-input"
                    placeholder="Especificar"
                    style="display: none;"
                    autocomplete="off"
                >
            </div>
            <!-- / Relación con la institución -->

            <div class="btn-financiero col-lg-3 col-md-12 col-sm-12 col-12 d-flex flex-row bg-blue p-0 m-0 my-2">
                <div class="bg-orange m-0 p-0 col-2" style="height:100%;"></div>
                <p-financieros class="py-3 ps-2 ps-lg-3 col-10 font-roboto-bolditalic tx-white my-1">
                    Detalles de la Solicitud
                </p-financieros>
            </div>

            <div class="mt-5 d-flex flex-column flex-lg-row col-12 position-relative">

                <!-- Cuarta fila: Tipo de certificación -->
                <div class="col-lg-4 col-md-6 col-sm-9 col-9 mx-lg-0 mx-auto my-2">
                    <div class="col-12 select-wrapper">
                        <select
                            onkeyup="validarSelect(this,\'' . $tipo_certifications['texto'] . '\', \'' . $boton_certifications['campo'] . '\', \'tipo_cert_otro\')"
                            id="' . $tipo_certifications['campo'] . '"
                            name="' . $tipo_certifications['campo'] . '"
                            class="col-12 p-2 display-options little-financieros font-roboto-italic tx-white"
                        >
                            <option value="" disabled selected>' . $tipo_certifications['placeHolder'] . '</option>';

    // Opciones dinámicas para “Tipo de certificación” (sentencia 82)
    $opcionesTipo = obtenerFilas($mysqli1, $sentencia, 82);
    foreach ($opcionesTipo as $opt) {
        if ((int)$opt['visible'] !== 1) {
            continue;
        }
        $valor = $opt['valor'];
        $html_certificaciones .= '<option value="' . $valor . '">' . $valor . '</option>';
    }

    $html_certificaciones .= '
                        </select>
                        <div class="select-arrow col-3">▼</div>
                    </div>
                    <!-- Input “Otro” oculto -->
                    <input
                        onkeyup="validarCampo(this, \'tipo_cert_otro\', \'texto\', 1, \'' . $boton_certifications['campo'] . '\')"
                        id="tipo_cert_otro"
                        name="cert_otro"
                        type="text"
                        class="col-12 mt-2 other-input"
                        placeholder="Especificar"
                        style="display: none;"
                        autocomplete="off"
                    >
                </div>';
            
    // Imagen de años (sentencia 80)
    $anosData = obtenerFilas($mysqli1, $sentencia, 80);
    $row_ano = $anosData[0] ?? [];
    if (!empty($row_ano)) {
        $ruta_ano = rutaPorNivel($row_ano['ruta']);
        $alt_ano = $row_ano['textoAlterno'] ?? 'Año';
        $titulo_ano = $row_ano['titulo'];

        $html_certificaciones .= '
                <div class="my-5 my-lg-0 col-lg-2 col-md-8 col-sm-8 col-8 d-flex flex-column align-items-center text-center mx-auto position-relative">
                    <p-financieros class="text-up-absolute font-roboto-bolditalic">' . $titulo_ano . '</p-financieros>
                    <img src="' . $ruta_ano . '" alt="' . $alt_ano . '" class="img-fluid year-trigger" style="width:80px; cursor:pointer;">
                    <select id="certificaciones_date" required class="year-select mt-2 d-none"></select>
                </div>';
    }

    // Proposito (texto)
    $campo = $proposito_certifications;
    $html_certificaciones .= '
            <textarea
                onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $boton_certifications['campo'] . '\')"
                id="' . $campo['campo'] . '"
                ' . $campo['obligatorio'] . '
                name="' . $campo['campo'] . '"
                class="text-area-input col-lg-4 col-md-4 col-sm-10 col-10 mx-auto mx-lg-0 font-roboto-bolditalic"
                placeholder="' . $campo['placeHolder'] . '"
                rows="4"
                autocomplete="off"
            ></textarea>
        </div>';

    // Check “Tratamiento”
    $campo = $tratamiento_certifications;
    $html_certificaciones .= '
        <div class="my-4 my-lg-3 mx-auto mx-lg-0 form-check d-flex align-items-center gap-2">
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
    $html_certificaciones .= '
        <button id="' . $idBoton . '" class="btn-submit-financial btn p-2 bg-orange col-lg-2 col-md-3 col-sm-4 col-4 mx-auto mt-3">
            <div class="d-flex flex-row align-items-center justify-content-center py-1 py-lg-2">
                <p-financieros class="font-roboto-medium tx-white m-0 mx-2">' . $textoBoton . '</p-financieros>
                <img src="' . $rutaBtn . '" alt="' . $altBtn . '" class="img-fluid" style="width:30px;">
            </div>
        </button>
    </form>
</div>';
} // end foreach

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<div class="container-fluid my-ws mx-0 p-0" id="certificaciones">
    <div class="row m-0 p-0">
        <?= $html_certificaciones ?>
    </div>
</div>
