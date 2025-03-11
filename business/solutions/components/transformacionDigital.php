<?php

    require('../../repositories/1cc2s4Sol.php');  

    $html = '';

    // Obtener la imagen
    $res_sentecia = $mysqli1->query($sentencia . "12");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagen_hero = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia_imagen = $mysqli1->query($sql_imagen_hero);

    while($row_imagen = $res_sentencia_imagen->fetch_assoc()){
        $imagen = $row_imagen['ruta'];
    }

    // Obtener el icono y titulo 
    $res_sentecia = $mysqli1->query($sentencia . "16");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_consulta = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia = $mysqli1->query($sql_consulta);

    while($row_imagen = $res_sentencia->fetch_assoc()){
        $icono = $row_imagen['ruta'];
        $titulo = $row_imagen['titulo'];
    }


    // Verificar si la seccion es visible y obtener texto
    $res_sentecia = $mysqli1->query($sentencia . "6");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_disenio = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_disenio = $mysqli1->query($sql_seccion_disenio);

    while($row_datos_seccion = $res_seccion_disenio->fetch_assoc()){

        $html .= '<section class="row mb-5">';
        $html .=    '<div class="col-lg-12">';
        $html .=       '<img'. ImageAttributeBuilder::buildAttributes($nivel, $imagen,'imagen-principal') .'class="img-fluid w-100 banner-shadow">';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<main class="container">';
        $html .=    '<div class="row my-5 align-items-center">';
        $html .=        '<div class="col-lg-2 d-flex justify-content-center align-items-center">';
        $html .=            '<img class="solutions-icon" '.ImageAttributeBuilder::buildAttributes($nivel, $icono, 'icono') .'>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-10">';
        $html .=            '<h1 class="tx-blue titulo-servicio font-roboto-light-title">'. $titulo .'</h1>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-2"></div>';
        $html .=        '<div class="col-lg-10">';
        $html .=            $row_datos_seccion['texto'];
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</main>';

    }

    echo $html;
?>