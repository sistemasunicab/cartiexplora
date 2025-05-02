<?php
$numero_de_certificaciones = "79";//74
$res_certificaciones = $mysqli1->query($sentencia . $numero_de_certificaciones);
while ($row_certificaciones = $res_certificaciones->fetch_assoc()) {
    $condiciones_certificaciones = str_replace('|', '\'', $row_certificaciones['condiciones']);
    $sql_datos_certificaciones = $row_certificaciones['campos'] . $row_certificaciones['tablas'] . $condiciones_certificaciones;
}

$res_datos_certificaciones = $mysqli1->query($sql_datos_certificaciones);

while ($row_datos_certificaciones = $res_datos_certificaciones->fetch_assoc()) {
    if ($row_datos_certificaciones['visible'] != 1)
        continue;

    $sentencia_formulario = "132";
    $campos_formulario = [];

    $res_sentecia = $mysqli1->query($sentencia . $sentencia_formulario);
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_formulario = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res_formulario = $mysqli1->query($sql_formulario);

    while ($row_datos_form = $res_formulario->fetch_assoc()) {
        $campos_formulario[] = $row_datos_form;
    }
    
    $nombre_certificaciones = array_shift($campos_formulario);
    $identificacion_certificaciones = array_shift($campos_formulario);
    $tipo_id_certificaciones = array_shift($campos_formulario);
    $correo_certificaciones = array_shift($campos_formulario);
    $telefono_certificaciones = array_shift($campos_formulario);
    $grado_id_certificaciones = array_shift($campos_formulario);
    $relacion_id_certificaciones = array_shift($campos_formulario);
    $tipo_certificaciones = array_shift($campos_formulario);
    $fecha_certificaciones = array_shift($campos_formulario);
    $proposito_certificaciones = array_shift($campos_formulario);
    $tratamiento_certificaciones = array_shift($campos_formulario);
    $botton_certificaciones = array_shift($campos_formulario);

    $html_certificaciones = '<div class="col-lg-9 col-md-9 col-sm-12 col-12 my-5 p-0 mx-auto d-flex flex-column">';
    $html_certificaciones .= '<h3 class="col-lg-7 col-md-7 col-sm-10 col-10 mx-auto mx-md-0 tx-blue font-roboto-light-title">' . $row_datos_certificaciones['titulo'] . '</h3>';
    // Primera fila
    $html_certificaciones .= '<form id="form_servicios" class="my-5 form-financial d-flex flex-column">';

    // Primera fila
    $html_certificaciones .= '<div class="my-2 d-flex flex-column flex-md-row justify-content-between">';

    $html_certificaciones .= '
    <input
        onkeyup="validarCampo(this,\''.$nombre_certificaciones['texto'].'\', \''.$nombre_certificaciones['tipo'].'\', 1, \''.$botton_certificaciones['campo'].'\')"
        '.$nombre_certificaciones['obligatorio'].'
        id="'.$nombre_certificaciones['campo'].'"
        name="'.$nombre_certificaciones['campo'].'"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="'.$nombre_certificaciones['placeHolder'].'"
        autocomplete="name"
    >';

    $html_certificaciones .= '
    <input
        onkeyup="validarCampo(this,\''.$identificacion_certificaciones['texto'].'\', \''.$identificacion_certificaciones['tipo'].'\', 1, \''.$botton_certificaciones['campo'].'\')"
        '.$identificacion_certificaciones['obligatorio'].'
        id="'.$identificacion_certificaciones['campo'].'"
        name="'.$identificacion_certificaciones['campo'].'"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="'.$identificacion_certificaciones['placeHolder'].'"
        autocomplete="off"
    >';

    $html_certificaciones .= '
    <div class="select-wrapper col-lg-3 col-md-3 col-sm-6 col-6 mx-auto my-2">
            
        <select 
            onkeyup="validarSelect(this,\''.$tipo_id_certificaciones['texto'].'\', \''.$botton_certificaciones['campo'].'\', \'\')"
            id="'.$tipo_id_certificaciones['campo'].'" 
            name="'.$tipo_id_certificaciones['campo'].'" 
            class="col-12 p-2 display-options little-paragraph font-roboto-italic tx-white">
            <option value="" disabled selected>'.$tipo_id_certificaciones['placeHolder'].'</option>
            <option value="Estudiante">Estudiante</option>
            <option value="Docente">Docente</option>
            <option value="Administrativo">Administrativo</option>
            <option value="Otro">Otro</option>
        </select>
        <div class="select-arrow col-3">▼</div>
    </div>
    ';
    $html_certificaciones .= '</div>'; // Cierre fila

    // Segunda fila
    $html_certificaciones .= '<div class="my-2 d-flex flex-column flex-md-row justify-content-between">';
    $html_certificaciones .= '
    <input
        onkeyup="validarCampo(this,\''.$correo_certificaciones['texto'].'\', \''.$correo_certificaciones['tipo'].'\', 1, \''.$botton_certificaciones['campo'].'\')"
        '.$correo_certificaciones['obligatorio'].'
        id="'.$correo_certificaciones['campo'].'"
        name="'.$correo_certificaciones['campo'].'"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="'.$correo_certificaciones['placeHolder'].'"
        autocomplete="email"
    >';

    $html_certificaciones .= '
    <input
        onkeyup="validarCampo(this,\''.$telefono_certificaciones['texto'].'\', \''.$telefono_certificaciones['tipo'].'\', 1, \''.$botton_certificaciones['campo'].'\')"
        '.$telefono_certificaciones['obligatorio'].'
        id="'.$telefono_certificaciones['campo'].'"
        name="'.$telefono_certificaciones['campo'].'"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="'.$telefono_certificaciones['placeHolder'].'"
        autocomplete="tel"
    >';

    // Dropdown "Grado"
    $html_certificaciones .= '
    <div class="select-wrapper col-lg-3 col-md-3 col-sm-6 col-6 mx-auto my-2">
        <select
            onkeyup="validarSelect(this, \''.$grado_id_certificaciones['texto'].'\', \''.$botton_certificaciones['campo'].'\', \'\')"
            id="'.$grado_id_certificaciones['campo'].'"
            name="'.$grado_id_certificaciones['campo'].'"
            class="col-12 p-2 display-options little-paragraph font-roboto-italic tx-white"
        >
            <option value="" disabled selected>'.$grado_id_certificaciones['placeHolder'].'</option>
            <option value="Primaria">Primaria</option>
            <option value="Secundaria">Secundaria</option>
            <option value="Universitario">Universitario</option>
            <option value="Otro">Otro</option>
        </select>
        <div class="select-arrow col-3">▼</div>
    </div>
    ';

    $html_certificaciones .= '</div>'; // Cierre fila

    // Dropdown "Relación con la institución"
    $html_certificaciones .= '
    <div class="col-lg-4 col-md-4 col-sm-10 col-10 mx-md-0 mx-auto my-5">
        <div class="col-12 select-wrapper">
            <select
                onkeyup="validarSelect(this, \''.$relacion_id_certificaciones['texto'].'\', \''.$botton_certificaciones['campo'].'\', \'relacion_certificaciones_otro\')"
                id="'.$relacion_id_certificaciones['campo'].'"
                name="'.$relacion_id_certificaciones['campo'].'"
                class="col-12 p-2 display-options little-paragraph font-roboto-italic tx-white"
            >
                <option value="" disabled selected>'.$relacion_id_certificaciones['placeHolder'].'</option>
    ';

    // --- Carga dinámica de opciones ---
    $numero_opciones_dropdown = "81";
    $res_opciones_dropdown = $mysqli1->query($sentencia . $numero_opciones_dropdown);
    $sql_opciones_dropdown = '';

    while ($row_opciones = $res_opciones_dropdown->fetch_assoc()) {
        $condiciones_opciones = str_replace('|', '\'', $row_opciones['condiciones']);
        $sql_opciones_dropdown = $row_opciones['campos']
            . $row_opciones['tablas']
            . $condiciones_opciones;
    }

    if (!empty($sql_opciones_dropdown)) {
        $res_datos_opciones = $mysqli1->query($sql_opciones_dropdown);
        while ($row = $res_datos_opciones->fetch_assoc()) {
            if ((int) $row['visible'] !== 1)
                continue;
            $valor = htmlspecialchars($row['valor'], ENT_QUOTES, 'UTF-8');
            $html_certificaciones .= '<option value="' . $valor . '">' . $valor . '</option>';
        }
    }

    $html_certificaciones .= '
            </select>
            <div class="select-arrow col-3">▼</div>
        </div>

        <!-- Input oculto que aparece si se elige “Otro” -->
        <input
            onkeyup="validarCampo(this, \'relación\', \'texto\', 1, \'submit-certificaciones-papeles\')"
            id="relacion_certificaciones_otro"
            name="relacion_otro"
            type="text"
            class="col-12 mt-2 other-input"
            placeholder="Especificar"
            style="display: none;"
            autocomplete="off"
        >
    </div>
    ';

    // Close dropdown "Relación con la institución"


    $html_certificaciones .= '<div class="btn-financiero col-lg-3 col-md-3 col-sm-12 col-12 d-flex flex-row bg-blue p-0 m-0 my-2">
                                <div class="bg-orange m-0 p-0 col-2" style="height:100%;"></div>
                                <p class="special-paragraph py-2 py-md-1 col-10 font-roboto-italic tx-white text-center my-1">Detalles de la Solicitud: </p></div> ';

    $html_certificaciones .= '<div class="mt-5 d-flex flex-column flex-md-row col-12 position-relative">';

    // Dropdown "Tipo de certificación"
    $html_certificaciones .= '
    <div class="col-lg-4 col-md-4 col-sm-10 col-10 mx-md-0 mx-auto my-2">
        <div class="col-12 select-wrapper">
            <select
                onkeyup="validarSelect(this, \''.$tipo_certificaciones['texto'].'\', \''.$botton_certificaciones['campo'].'\', \'tipo_certificaciones_otro\')"
                id="'.$tipo_certificaciones['campo'].'"
                name="'.$tipo_certificaciones['campo'].'"
                class="col-12 p-2 display-options little-paragraph font-roboto-italic tx-white"
            >
                <option value="" disabled selected>'.$tipo_certificaciones['placeHolder'].'</option>
    ';

    // --- Carga dinámica de opciones ---
    $numero_opciones_dropdown = "82";
    $res_opciones_dropdown = $mysqli1->query($sentencia . $numero_opciones_dropdown);
    $sql_opciones_dropdown = '';

    while ($row_opciones = $res_opciones_dropdown->fetch_assoc()) {
        $condiciones_opciones = str_replace('|', '\'', $row_opciones['condiciones']);
        $sql_opciones_dropdown =
            $row_opciones['campos'] .
            $row_opciones['tablas'] .
            $condiciones_opciones;
    }

    if (!empty($sql_opciones_dropdown)) {
        $res_datos_opciones = $mysqli1->query($sql_opciones_dropdown);
        while ($row = $res_datos_opciones->fetch_assoc()) {
            if ((int) $row['visible'] !== 1)
                continue;
            $valor = htmlspecialchars($row['valor'], ENT_QUOTES, 'UTF-8');
            $html_certificaciones .=
                '<option value="' . $valor . '">' . $valor . '</option>';
        }
    }

    $html_certificaciones .= '
            </select>
            <div class="select-arrow col-3">▼</div>
        </div>

        <!-- Input oculto que aparece si se elige “Otro” -->
        <input
            onkeyup="validarCampo(this, \'certificación\', \'texto\', 1, \'submit-certificaciones-papeles\')"
            id="tipo_certificaciones_otro"
            name="certificacion_otro"
            type="text"
            class="col-12 mt-2 other-input"
            placeholder="Especificar"
            style="display: none;"
            autocomplete="off"
        >
    </div>
    ';


    // Close dropdown "Tipo de certificacion"

    $number_sentence_image = "80";//75
    $res_sentence_image = $mysqli1->query($sentencia . $number_sentence_image);

    while ($row_sentence_image = $res_sentence_image->fetch_assoc()) {
        $conditions_image = str_replace('|', '\'', $row_sentence_image['condiciones']);
        $sql_data_image = $row_sentence_image['campos'] . $row_sentence_image['tablas'] . $conditions_image;
    }

    $res_data_image = $mysqli1->query($sql_data_image);

    while ($row_data_image = $res_data_image->fetch_assoc()) {
        $ruta = htmlspecialchars($row_data_image['ruta']);
        $alt = htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen'); // Default alt text

        // Determine the correct path based on the $nivel variable
        $image_path = '';
        if ($nivel == "raiz") {
            $image_path = $ruta;
        } else if ($nivel == "uno") {
            $image_path = '../' . $ruta;
        } else if ($nivel == "dos") {
            $image_path = '../../' . $ruta;
        } else if ($nivel == "tres") {
            $image_path = '../../../' . $ruta;
        }

        $html_certificaciones .= '<div class="my-5 my-md-0 col-lg-2 col-md-2 col-sm-8 col-8 d-flex flex-column align-items-center text-center mx-auto position-relative">';
        $html_certificaciones .= '<p class="text-up-absolute">' . $row_data_image["titulo"] . '</p>';
        $html_certificaciones .= '<img src="' . $image_path . '" alt="' . $alt . '" class="img-fluid year-trigger" style="width:80px; cursor:pointer;">';
        $html_certificaciones .= '<select id="certificaciones_date" required class="year-select mt-2 d-none"></select>';
        $html_certificaciones .= '</div>';

    }
    $html_certificaciones .= '
    <textarea
        onkeyup="validarCampo(this, \''.$proposito_certificaciones['texto'].'\', \''.$proposito_certificaciones['tipo'].'\', 1, \''.$botton_certificaciones['campo'].'\')"
        id="'.$proposito_certificaciones['campo'].'"
        '.$proposito_certificaciones['obligatorio'].'
        name="'.$proposito_certificaciones['campo'].'"
        class="text-area-input col-lg-4 col-md-4 col-sm-10 col-10 mx-auto mx-md-0"
        placeholder="'.$proposito_certificaciones['placeHolder'].'"
        rows="4"
        autocomplete="off"
    ></textarea>
    </div>
    ';

    $html_certificaciones .= '
    <div class="my-4 my-md-3 mx-auto mx-md-0 form-check d-flex align-items-center gap-2">
        <input
            '.$tratamiento_certificaciones['obligatorio'].'
            class="form-check-input"
            type="checkbox"
            id="'.$tratamiento_certificaciones['campo'].'"
            name="'.$tratamiento_certificaciones['campo'].'"
        >
        <label
            class="form-check-label d-flex align-items-center font-roboto-regular special-paragraph m-0"
            for="'.$tratamiento_certificaciones['campo'].'"
        >
            '.$tratamiento_certificaciones['texto'].'
        </label>
    </div>';

    $number_sentence_image = "103";
    $res_sentence_image = $mysqli1->query($sentencia . $number_sentence_image);

    while ($row_sentence_image = $res_sentence_image->fetch_assoc()) {
        $conditions_image = str_replace('|', '\'', $row_sentence_image['condiciones']);
        $sql_data_image = $row_sentence_image['campos'] . $row_sentence_image['tablas'] . $conditions_image;
    }


    $res_data_image = $mysqli1->query($sql_data_image);

    while ($row_data_image = $res_data_image->fetch_assoc()) {
        $ruta = htmlspecialchars($row_data_image['ruta']);
        $alt = htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen');
        // Determine the correct path based on the $nivel variable
        $image_path = '';
        if ($nivel == "raiz") {
            $image_path = $ruta;
        } else if ($nivel == "uno") {
            $image_path = '../' . $ruta;
        } else if ($nivel == "dos") {
            $image_path = '../../' . $ruta;
        } else if ($nivel == "tres") {
            $image_path = '../../../' . $ruta;
        }
    }
    $html_certificaciones .= '<button id="'.$botton_certificaciones['campo'].'" class="btn p-2 bg-orange col-lg-2 col-md-3 col-sm-4 col-4 mx-auto mt-3">';
    $html_certificaciones .= '<div class="d-flex flex-row align-items-center justify-content-center">';
    $html_certificaciones .= '<p class="special-paragraph font-roboto-medium tx-white m-0 mx-2">'.$botton_certificaciones['texto'].'</p>';
    $html_certificaciones .= '<img src="' . $image_path . '" alt="' . $alt . '" class="img-fluid" style="width:30px;">';
    $html_certificaciones .= '</div>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '</div>'; // Cierre contenedor principal

    $html_certificaciones .= '</form>';

    $html_certificaciones .= '</div>';
}
?>

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />


<div class="container-fluid m-0 p-0" id="certificaciones">
    <div class="row m-0 p-0">
        <?php
        echo $html_certificaciones;
        ?>
    </div>
</div>