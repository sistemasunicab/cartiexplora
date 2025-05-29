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
    $html_estados_financieros = '<div class="col-lg-9 col-md-12 col-sm-12 col-12 p-0 mx-auto d-flex flex-column">';
    $html_estados_financieros .= '<h3-financieros class="mx-auto col-lg-12 col-md-10 col-sm-10 col-10 tx-blue font-roboto-light-title mb-5">' . $row_datos_estados_financieros['titulo'] . '</h3-financieros>';
    $html_estados_financieros .= '<div class="btn-financiero col-lg-3 col-md-12 col-sm-12 col-12 d-flex flex-row bg-blue p-0 m-0 mt-0 mb-5 mt-lg-5">
                                <div class="bg-orange m-0 p-0 col-2" style="height:100%;"></div>
                                <p-financieros class="py-3 ps-2 ps-lg-3 col-10 font-roboto-bolditalic tx-white my-0">Solicitar información</p-financieros></div>';
    $html_estados_financieros .= '<form id="form_info" class="form-financial col-12 p-0 mx-auto d-flex flex-column">';

    for ($i = 0; $i < count($campos_formulario) - 1; $i++) {
        $campo = $campos_formulario[$i];
        $type = ($campo['texto'] === 'contraseña') ? 'password' : 'text';

        $html_estados_financieros .= '
        <input
            onkeyup="validarCampo(this,\'' . $campo['texto'] . '\', \'' . $campo['tipo'] . '\', 1, \'' . $campos_formulario[count($campos_formulario) - 1]['campo'] . '\')"
            ' . $campo['obligatorio'] . '
            id="' . $campo['campo'] . '"
            name="' . $campo['texto'] . '"
            type="' . $type . '"
            class="text-center font-roboto-bolditalic col-lg-4 col-md-6 col-sm-10 col-10 mx-auto mt-2 mb-4"
            placeholder="' . $campo['placeHolder'] . '"
        >';
    }

    $campo_final = $campos_formulario[count($campos_formulario) - 1];

    $html_estados_financieros .= '<button id="' . $campo_final['campo'] . '" class="btn-submit-financial btn p-2 bg-orange col-lg-2 col-md-3 col-sm-4 col-4 mx-auto mt-3">';
    $html_estados_financieros .= '<div class="d-flex flex-row align-items-center justify-content-center py-1 py-lg-2">';
    $html_estados_financieros .= '<p-financieros class="font-roboto-medium tx-white m-0 mx-2">' . $campo_final['texto'] . '</p-financieros>';
    $html_estados_financieros .= '<img src="' . $image_path . '" alt="Solicitar" width="30px">';
    $html_estados_financieros .= '</div>';
    $html_estados_financieros .= '</button>';
    $html_estados_financieros .= '</form>';

    $html_estados_financieros .= '<div id="alert" style="margin-left: .5rem;">
        <p-financieros><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
        <input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0"></p-financieros>
    </div>';
    $html_estados_financieros .= '</div>';


}
?>
<div class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?php echo $html_estados_financieros; ?>
    </div>
</div>