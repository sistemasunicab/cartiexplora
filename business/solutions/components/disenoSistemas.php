<?php

    require('../../repositories/1cc2s4Sol.php');  

    $html = '';

    // Obtener la imagen
    $res_sentecia = $mysqli1->query($sentencia . "10");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia_imagenes = $mysqli1->query($sql_imagenes);

    while($row_imagenes = $res_sentencia_imagenes->fetch_assoc()){
        $imagenes[] = $row_imagenes;
    }


    // Verificar si la seccion es visible y obtener texto
    $res_sentecia = $mysqli1->query($sentencia . "4");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_disenio = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_disenio = $mysqli1->query($sql_seccion_disenio);

    while($row_datos_seccion = $res_seccion_disenio->fetch_assoc()){

        $html .=    '<div class="w-100">';
        $html .=       '<img'. ImageAttributeBuilder::buildAttributes($nivel, $imagenes[0]['ruta'],'imagen-principal') .'class="img-fluid w-100 banner-shadow">';
        $html .=    '</div>';
        $html .= '<main class="container">';
        $html .=    '<div class="row my-5 align-items-center">';
        $html .=        '<div class="col-lg-2 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">';
        $html .=            '<img class="solutions-icon" '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[1]['ruta'], 'icono') .'>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-10 col-md-12 col-sm-12 col-12">';
        $html .=            '<h1 class="tx-blue titulo-servicio font-roboto-light-title">'. $imagenes[1]['titulo'] .'</h1>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>';
        $html .=        '<div class="col-lg-10 col-md-11 col-sm-11 col-11">';
        $html .=            $row_datos_seccion['texto'];
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</main>';

    }

    echo $html;
?>