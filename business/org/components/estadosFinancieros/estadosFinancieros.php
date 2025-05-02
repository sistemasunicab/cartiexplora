<?php
$numero_de_estados_financieros = "78";
$res_estados_financieros = $mysqli1->query($sentencia . $numero_de_estados_financieros);
while ($row_estados_financieros = $res_estados_financieros->fetch_assoc()) {
    $condiciones_estados_financieros = str_replace('|', '\'', $row_estados_financieros['condiciones']);
    $sql_datos_estados_financieros = $row_estados_financieros['campos'] . $row_estados_financieros['tablas'] . $condiciones_estados_financieros;
}

$res_datos_estados_financieros = $mysqli1->query($sql_datos_estados_financieros);

$sentencia_formulario = "131";

$campos_formulario = [];
$res_sentecia = $mysqli1->query($sentencia . $sentencia_formulario);
while ($row_sentencia = $res_sentecia->fetch_assoc()) {
    $sql_formulario = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
}

$res_formulario = $mysqli1->query($sql_formulario);
while ($row_datos_form = $res_formulario->fetch_assoc()) {
    $campos_formulario[] = $row_datos_form;
};

while ($row_datos_estados_financieros = $res_datos_estados_financieros->fetch_assoc()) {
    $html_estados_financieros = '<div class="col-lg-9 col-md-9 col-sm-12 col-12 my-5 p-0 mx-auto d-flex flex-column">';
    $html_estados_financieros .= '<h3 class="mx-auto col-lg-12 col-md-12 col-sm-10 col-10 tx-blue font-roboto-light-title">' . $row_datos_estados_financieros['titulo'] . '</h3>';
    $html_estados_financieros .= '<div class="btn-financiero col-lg-3 col-md-3 col-sm-12 col-12 d-flex flex-row bg-blue p-0 m-0 my-3 mb-5 my-md-5">
                                <div class="bg-orange m-0 p-0 col-2" style="height:100%;"></div>
                                <p class="special-paragraph py-2 py-md-1 col-10 font-roboto-italic tx-white text-center my-1">Solicitar información</p></div> ';
    $html_estados_financieros .= '<form id="form_info" class="form-financial col-12 p-0 mx-auto d-flex flex-column">';

    for ($i = 0; $i < count($campos_formulario) - 1; $i++) {
        $estados_financieros_campos = $campos_formulario[$i];
        $type = "text";
        if ($estados_financieros_campos['texto'] == 'contraseña') {
            $type = "password";
        }

        $html_estados_financieros .= '
        <input
            onkeyup="validarCampo(this,\'' . $estados_financieros_campos['texto'] . '\', \''. $estados_financieros_campos['tipo'] .'\', 1, \'' . $campos_formulario[count($campos_formulario) - 1]['campo'] .'\')"
            ' . $estados_financieros_campos['obligatorio'] . '
            id="' . $estados_financieros_campos['campo'] . '"
            name="'. $estados_financieros_campos['texto'] . '"
            type="' . $type . '"
            class="text-center font-roboto-bolditalic col-lg-6 col-md-6 col-sm-10 col-10 mx-auto my-2"
            placeholder="' . $estados_financieros_campos['placeHolder'] . '"
        >';    
    }

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
    $html_estados_financieros .= '<button id="'.$campos_formulario[count($campos_formulario) - 1]['campo'].'" class="btn p-2 bg-orange col-lg-2 col-md-3 col-sm-4 col-4 mx-auto mt-3">';
    $html_estados_financieros .= '<div class="d-flex flex-row align-items-center justify-content-center">';
    $html_estados_financieros .= '<p class="special-paragraph font-roboto-medium tx-white m-0 mx-2">'.$campos_formulario[count($campos_formulario) - 1]['texto'].'</p>';
    $html_estados_financieros .= '<img src="' . $image_path . '" alt="Solicitar" width="30px">';
    $html_estados_financieros .= '</div>';
    $html_estados_financieros .= '</button>';
    $html_estados_financieros .= '</form>';

    $html_estados_financieros .= '<div id="alert" style="margin-left: .5rem;">
                                        <p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
                                        <input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0"></p>
                                    </div>';
    $html_estados_financieros .= '</div>';

}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_estados_financieros;
        ?>
    </div>
</div>