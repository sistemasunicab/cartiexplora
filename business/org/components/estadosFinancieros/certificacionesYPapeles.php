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
    $html_certificaciones = '<div class="col-lg-9 col-md-9 col-sm-12 col-12 my-5 p-0 mx-auto d-flex flex-column">';
    $html_certificaciones .= '<h3 class="col-lg-7 col-md-7 col-sm-10 col-10 mx-auto mx-md-0 tx-blue font-roboto-light-title">' . $row_datos_certificaciones['titulo'] . '</h3>';
    // Primera fila
    $html_certificaciones .= '<form id="form_servicios" class="my-5 form-financial d-flex flex-column">';

    // Primera fila
    $html_certificaciones .= '<div class="my-2 d-flex flex-column flex-md-row justify-content-between">';

    $html_certificaciones .= '
    <input
        onkeyup="validarCampo(this,\'nombre\', \'texto\', 1, \'submit-certificaciones-papeles\')"
        required
        id="nombre_certificaciones"
        name="nombre"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="Nombre Completo"
        autocomplete="name"
    >';

    $html_certificaciones .= '
    <input
        onkeyup="validarCampo(this,\'identificacion\', \'numero\', 1, \'submit-certificaciones-papeles\')"
        required
        id="identificacion_certificaciones"
        name="identificacion"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="Número de identificación"
        autocomplete="off"
    >';

    $html_certificaciones .= '
    <div class="select-wrapper col-lg-3 col-md-3 col-sm-6 col-6 mx-auto my-2">
        <select 
            onkeyup="validarSelect(this,\'tipo\', \'submit-certificaciones-papeles\', \'\' )"
            id="tipo_certificaciones" 
            name="tipo_id_certificaciones" 
            class="col-12 display-options little-paragraph font-roboto-italic tx-white">
            <option value="" disabled selected>Tipo</option>
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
        onkeyup="validarCampo(this,\'correo\', \'correo\', 1, \'submit-certificaciones-papeles\')"
        required
        id="correo_certificaciones"
        name="correo"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="Correo electrónico"
        autocomplete="email"
    >';

    $html_certificaciones .= '
    <input
        onkeyup="validarCampo(this,\'telefono\', \'numero\', 1, \'submit-certificaciones-papeles\')"
        required
        id="telefono_certificaciones"
        name="telefono"
        type="text"
        class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2"
        placeholder="Número de teléfono"
        autocomplete="tel"
        pattern="[0-9]+"
        inputmode="tel"
    >';

    // Dropdown "Grado"
    $html_certificaciones .= '
    <div class="select-wrapper col-lg-3 col-md-3 col-sm-6 col-6 mx-auto my-2">
        <select
            onkeyup   ="validarSelect(this, \'grado\', \'submit-certificaciones-papeles\', \'\' )"
            id="grado_certificaciones"
            name="grado_id_certificaciones"
            class="col-12 display-options little-paragraph font-roboto-italic tx-white"
        >
            <option value="" disabled selected>Grado</option>
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
    <div class="col-lg-4 col-md-4 col-sm-10 col-10 my-5">
        <div class="col-12 select-wrapper">
            <select
                onkeyup   ="validarSelect(this, \'relación\', \'submit-certificaciones-papeles\', \'relacion_certificaciones_otro\')"
                id="relacion_certificaciones_select"
                name="relacion_id_certificaciones"
                class="col-12 p-2 display-options little-paragraph font-roboto-italic tx-white"
            >
                <option value="" disabled selected>Relación con la institución</option>
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
    <div class="col-lg-4 col-md-4 col-sm-10 col-10 my-2">
        <div class="col-12 select-wrapper">
            <select
                onkeyup   ="validarSelect(this, \'certificación\', \'submit-certificaciones-papeles\', \'tipo_certificaciones_otro\')"
                id="tipo_certificaciones_select"
                name="certificacion_id"
                class="col-12 p-2 display-options little-paragraph font-roboto-italic tx-white"
            >
                <option value="" disabled selected>Tipo de certificación</option>
    ';

        // --- Carga dinámica de opciones ---
        $numero_opciones_dropdown = "82";
        $res_opciones_dropdown      = $mysqli1->query($sentencia . $numero_opciones_dropdown);
        $sql_opciones_dropdown      = '';

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
                if ((int)$row['visible'] !== 1) continue;
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

        $html_certificaciones .= '<div id="display-calendar" class="my-5 my-md-0 col-lg-2 col-md-2 col-sm-8 col-8 d-flex flex-column align-items-center text-center mx-auto position-relative">';
        $html_certificaciones .= '<p class="text-up-absolute">' . $row_data_image["titulo"] . '</p>';
        $html_certificaciones .= '<img src="' . $image_path . '" alt="' . $alt . '" class="img-fluid" style="width:80px;">';
        // Add the "Ver" button with margin-left, box shadow, circular border, and auto height
        $html_certificaciones .= '</div>';

    }
    $html_certificaciones .= '
    <textarea
        onkeyup="validarCampo(this,\'proposito\', \'texto\', 1, \'submit-certificaciones-papeles\')"
        id="proposito_certificaciones"
        required
        name="proposito"
        class="text-area-input col-lg-4 col-md-4 col-sm-10 col-10 mx-auto mx-md-0"
        placeholder="Propósito del documento"
        rows="4"
        autocomplete="off"
    ></textarea>
    </div>
    ';

    $html_certificaciones .= '
    <div class="my-4 my-md-3 mx-auto mx-md-0 form-check d-flex align-items-center gap-2">
        <input
            required
            class="form-check-input"
            type="checkbox"
            id="tratamiento_certificaciones"
            name="tratamiento"
        >
        <label
            class="form-check-label d-flex align-items-center font-roboto-regular special-paragraph m-0"
            for="tratamiento_certificaciones"
        >
            Acepto tratamiento de datos.
        </label>
    </div>
    ';

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
    $html_certificaciones .= '<button id="submit-certificaciones-papeles" class="btn p-2 bg-orange col-lg-2 col-md-3 col-sm-4 col-4 mx-auto mt-3">';
    $html_certificaciones .= '<div class="d-flex flex-row align-items-center justify-content-center">';
    $html_certificaciones .= '<p class="special-paragraph font-roboto-medium tx-white m-0 mx-2">Solicitar</p>';
    $html_certificaciones .= '<img src="' . $image_path . '" alt="' . $alt . '" class="img-fluid" style="width:30px;">';
    $html_certificaciones .= '</div>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '</div>'; // Cierre contenedor principal

    $html_certificaciones .= '</div>';

    $html_certificaciones .= '</div>';
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="container-fluid m-0 p-0" id="certificaciones">
    <div class="row m-0 p-0">
        <?php
        echo $html_certificaciones;
        ?>
    </div>
</div>