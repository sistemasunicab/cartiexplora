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
    $html_certificaciones .= '<div class="my-5 form-financial d-flex flex-column">';

    // Primera fila
    $html_certificaciones .= '<div class="my-2 d-flex flex-column flex-md-row justify-content-between">';
    $html_certificaciones .= '<input type="text" class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2" placeholder="Nombre Completo">';
    $html_certificaciones .= '<input type="text" class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2" placeholder="Número de identificación">';

    // Dropdown "Tipo"
    $html_certificaciones .= '<div class="btn-group col-lg-3 col-md-3 col-sm-6 col-6 mx-auto my-2">';
    $html_certificaciones .= '<button class="dropdown-toggle col-3 display-options btn p-0 d-flex flex-row" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 m-auto font-roboto-italic tx-white">Tipo</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100" aria-labelledby="dropdownTipo">';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Estudiante</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Docente</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Administrativo</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Otro</a></li>';
    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '</div>'; // Cierre btn-group

    $html_certificaciones .= '</div>'; // Cierre fila

    // Segunda fila
    $html_certificaciones .= '<div class="my-2 d-flex flex-column flex-md-row justify-content-between">';
    $html_certificaciones .= '<input type="email" class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2" placeholder="Correo electrónico">';
    $html_certificaciones .= '<input type="text" class="col-lg-4 col-md-4 col-sm-10 col-10 mx-auto ms-md-0 font-roboto-bolditalic my-2" placeholder="Número de teléfono">';

    // Dropdown "Grado"
    $html_certificaciones .= '<div class="btn-group col-lg-3 col-md-3 col-sm-6 col-6 mx-auto my-2">';
    $html_certificaciones .= '<button class="dropdown-toggle col-3 display-options btn p-0 d-flex flex-row" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 m-auto font-roboto-italic tx-white">Grado</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100" aria-labelledby="dropdownGrado">';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Primaria</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Secundaria</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Universitario</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Otro</a></li>';
    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '</div>'; // Cierre btn-group

    $html_certificaciones .= '</div>'; // Cierre fila

    // Dropdown "Relación con la institución"
    $html_certificaciones .= '<div class="btn_displayed my-5 btn-group col-lg-4 col-md-4 col-sm-10 col-10 mx-auto mx-md-0 d-flex flex-column">';
    $html_certificaciones .= '<button class="dropdown-toggle col-12 display-options btn p-0 d-flex flex-row dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 text-break m-auto font-roboto-italic tx-white dropdown-text">Relación con la institución</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100">';

    $numero_opciones_dropdown = "81";
    $res_opciones_dropdown = $mysqli1->query($sentencia . $numero_opciones_dropdown);

    while ($row_opciones = $res_opciones_dropdown->fetch_assoc()) {
        $condiciones_opciones = str_replace('|', '\'', $row_opciones['condiciones']);
        $sql_opciones_dropdown = $row_opciones['campos'] . $row_opciones['tablas'] . $condiciones_opciones;
    }

    $res_datos_opciones = $mysqli1->query($sql_opciones_dropdown);
    while ($row_datos_opciones = $res_datos_opciones->fetch_assoc()) {
        if ($row_datos_opciones['visible'] != 1)
            continue;

        $valor = htmlspecialchars($row_datos_opciones['valor'], ENT_QUOTES, 'UTF-8');
        $html_certificaciones .= '<li><a class="dropdown-item dropdown-option" data-value="' . $valor . '">' . $valor . '</a></li>';
    }
    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '<input type="text" class="form-control mt-2 other-input" placeholder="Especificar" style="display: none;">';
    $html_certificaciones .= '</div>';


    $html_certificaciones .= '<div class="btn-financiero col-lg-3 col-md-3 col-sm-12 col-12 d-flex flex-row bg-blue p-0 m-0 my-2">
                                <div class="bg-orange m-0 p-0 col-2" style="height:100%;"></div>
                                <p class="special-paragraph py-2 py-md-1 col-10 font-roboto-italic tx-white text-center my-1">Detalles de la Solicitud: </p></div> ';

    $html_certificaciones .= '<div class="mt-5 d-flex flex-column flex-md-row col-12 position-relative">';
    
    $html_certificaciones .= '<div class="btn_displayed my-2 btn-group col-lg-4 col-md-4 col-sm-10 col-10 mx-auto mx-md-0 d-flex flex-column">';
    $html_certificaciones .= '<button class="dropdown-toggle col-12 display-options btn p-0 d-flex flex-row dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 m-auto font-roboto-italic tx-white dropdown-text">Tipo de certificación</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100">';

    $numero_opciones_dropdown = "82";
    $res_opciones_dropdown = $mysqli1->query($sentencia . $numero_opciones_dropdown);

    while ($row_opciones = $res_opciones_dropdown->fetch_assoc()) {
        $condiciones_opciones = str_replace('|', '\'', $row_opciones['condiciones']);
        $sql_opciones_dropdown = $row_opciones['campos'] . $row_opciones['tablas'] . $condiciones_opciones;
    }

    $res_datos_opciones = $mysqli1->query($sql_opciones_dropdown);
    while ($row_datos_opciones = $res_datos_opciones->fetch_assoc()) {
        if ($row_datos_opciones['visible'] != 1)
            continue;

        $valor = htmlspecialchars($row_datos_opciones['valor'], ENT_QUOTES, 'UTF-8');
        $html_certificaciones .= '<li><a class="dropdown-item dropdown-option" href="#" data-value="' . $valor . '">' . $valor . '</a></li>';
    }

    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '<input type="text" class="form-control mt-2 other-input" placeholder="Especificar" style="display: none;">';

    $html_certificaciones .= '</div>';


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
        $html_certificaciones .= '<img src="' . $image_path . '" alt="' . $alt . '" class="img-fluid" style="width:80px;">';
        // Add the "Ver" button with margin-left, box shadow, circular border, and auto height
        $html_certificaciones .= '</div>';

    }
    $html_certificaciones .= '<textarea class="text-area-input col-lg-4 col-md-4 col-sm-10 col-10 mx-auto mx-md-0" placeholder="Propósito del documento" rows="4"></textarea>';
    $html_certificaciones .= '</div>';

    $html_certificaciones .= '<div class="my-4 my-md-3 mx-auto mx-md-0 form-check d-flex align-items-center gap-2">';
    $html_certificaciones .= '<input class="form-check-input" type="checkbox" id="dataConsent">';
    $html_certificaciones .= '<label class="form-check-label d-flex align-items-center font-roboto-regular special-paragraph m-0" for="dataConsent">Acepto tratamiento de datos.</label>';
    $html_certificaciones .= '</div>';

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
    $html_certificaciones .= '<button class="btn p-2 bg-orange col-lg-2 col-md-3 col-sm-4 col-4 mx-auto d-flex flex-row align-items-center justify-content-center mt-3">';
    $html_certificaciones .= '<p class="special-paragraph font-roboto-medium tx-white m-0 mx-2">Solicitar</p>';
    $html_certificaciones .= '<img src="' . $image_path . '" alt="' . $alt . '" class="img-fluid" style="width:30px;">';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '</div>'; // Cierre contenedor principal

    $html_certificaciones .= '</div>';

    $html_certificaciones .= '</div>';
}
?>

<div class="container-fluid m-0 p-0" id="certificaciones">
    <div class="row m-0 p-0">
        <?php
        echo $html_certificaciones;
        ?>
    </div>
</div>