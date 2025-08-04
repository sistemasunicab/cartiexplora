<?php
$numero_de_estados_financieros = 78;
$sentencia_formulario = 136;
$number_sentence_image = 103;

// Obtener datos de estados financieros
$datos_estados_financieros = obtenerFilas($mysqli1, $sentencia, $numero_de_estados_financieros);

// Obtener campos del formulario
$campos_formulario = obtenerFilas($mysqli1, $sentencia, $sentencia_formulario);

// Obtener imagen del botón
$imagenes = obtenerFilas($mysqli1, $sentencia, $number_sentence_image);
$imagen_boton = $imagenes[0] ?? null;
$image_path = '';
if ($imagen_boton) {
    $ruta = $imagen_boton['ruta'];
    $image_path = rutaPorNivel($ruta);
    $alt = $imagen_boton['textoAlterno'] ?? 'Imagen';
}

// Construcción del HTML
foreach ($datos_estados_financieros as $row_datos_estados_financieros) {
    $html_row_one = '<div class="row p-0 m-0">';
    $html_row_one .= '<div class="col-lg-1 col-md-1 col-sm-1 col-1 p-0"></div>';
    $html_row_one .= '<div class="col-lg-10 col-md-7 col-sm-7 col-7 p-0">';
    $html_row_one .= '<h3-financieros class="tx-blue font-roboto-light-title">' . $row_datos_estados_financieros['titulo'] . '</h3-financieros>';
    $html_row_one .= '</div>';
    $html_row_one .= '<div class="col-lg-1 col-md-4 col-sm-4 col-4 p-0"></div>';
    $html_row_one .= '</div>';

    $html_row_two = '<div class="row p-0 mx-0 my-5">';
    $html_row_two .= '<div class="col-lg-1 col-md-0 col-sm-0 col-0 p-0"></div>';
    $html_row_two .= '<div class="btn-financiero d-flex flex-row col-lg-3 col-md-12 col-sm-12 col-12 p-0">';
    $html_row_two .= '<div class="col-2 p-0 m-0 bg-orange"></div>';
    $html_row_two .= '<p class="p-3 font-roboto-bolditalic tx-white m-0 p-0">Solicitar información</p>';
    $html_row_two .= '</div>';
    $html_row_two .= '<div class="col-lg-8 col-md-0 col-sm-0 col-0 p-0"></div>';
    $html_row_two .= '</div>';

    $html_row_three = '<div class="row p-0 m-0">';
    $html_row_three .= '<form id="form_info" class="form-financial p-0" action="../ajax/login_estados1.php" method="POST">';
    $campo_final = $campos_formulario[count($campos_formulario) - 1];
    for ($i = 0; $i < count($campos_formulario) - 1; $i++) {
        $campo = $campos_formulario[$i];
        $type = ($campo['texto'] === 'contraseña') ? 'password' : 'text';
        $is_last_field = $i < count($campos_formulario) - 1;
        $html_row_three .= '<div class="row mx-0 ' . ($is_last_field ? "mb-4" : "") . '">';
        $html_row_three .= '<div class="col-lg-4 col-md-3 col-sm-1 col-1 p-0"></div>';
        $html_row_three .= '<div class="col-lg-4 col-md-6 col-sm-10 col-10 p-0 font-roboto-bolditalic">';
        $html_row_three .= '
        <input
            onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $campo_final['campo'] . '\')"
            ' . $campo['obligatorio'] . '
            id="' . $campo['campo'] . '"
            name="' . $campo['texto'] . '"
            type="' . $type . '"
            class="form-control text-center"
            placeholder="' . $campo['placeHolder'] . '"
            autocomplete="off"
        >';
        $html_row_three .= '</div>';
        $html_row_three .= '<div class="col-lg-4 col-md-3 col-sm-1 col-1 p-0"></div>';
        $html_row_three .= '</div>';
    }

    $html_row_three .= '<div class="row p-0 m-0">';
    $html_row_three .= '<div class="col-lg-5 col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_three .= '<div class="col-lg-2 col-md-2 col-sm-4 col-4 p-0 d-flex">';
    $html_row_three .= '<button id="' . $campo_final['campo'] . '" type="submit" class="form-control btn-submit-financial btn mx-auto px-lg-4 px-md-3 px-sm-3 px-3">';
    $html_row_three .= '<p class="font-roboto-medium tx-white m-0 p-0">' . $campo_final['texto'] . '</p>';
    $html_row_three .= '<img src="' . $image_path . '" alt="Solicitar" width="30px">';
    $html_row_three .= '</button>';
    $html_row_three .= '</div>';
    $html_row_three .= '<div class="col-lg-5 col-md-5 col-sm-4 col-4 p-0"></div>';
    $html_row_three .= '</div>';
    $html_row_three .= '</form>';
    $html_row_three .= '</div>';

    $html_estados_financieros = $html_row_one;
    $html_estados_financieros .= $html_row_two;
    $html_estados_financieros .= $html_row_three;
    
    $html_estados_financieros .= '<div id="alert" style="margin-left: .5rem;">
        <p-financieros><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
        <input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0"></p-financieros>
    </div>';
}
?>
<div class="container-fluid my-ws mx-0 p-0">
    <?php echo $html_estados_financieros; ?>
</div>