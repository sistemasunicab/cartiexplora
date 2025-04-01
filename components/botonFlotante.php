<?php

if ($nivel == "raiz") {
    require('business/repositories/1cc2s4Home.php');
} else if ($nivel == "uno") {
    require('../business/repositories/1cc2s4Home.php');
} else if ($nivel == "dos") {
    require('../../business/repositories/1cc2s4Home.php');
} else if ($nivel == "tres") {
    require('../../../business/repositories/1cc2s4Home.php');
}

$res_sentecia = $mysqli1->query($sentencia . "109");
while ($row_sentencia = $res_sentecia->fetch_assoc()) {
    $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
}
$res_seccion = $mysqli1->query($sql_seccion);

$html = '';
while ($row_datos_seccion = $res_seccion->fetch_assoc()) {

    $html .= '<section class="button-section bg-orange home-button-fixed d-md-flex flex-md-column px-md-1 p-2 d-flex">';

    $res_sentecia = $mysqli1->query($sentencia . "110");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_iconos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_iconos = $mysqli1->query($sql_iconos);

    while ($row_icono = $res_iconos->fetch_assoc()) {
        $html .= '<a href="'. $row_icono['enlace'] .'" class="button-move px-md-3 h-100 w-100" role="button">';
        $html .=    '<div class="py-md-4">';
        $html .=        '<img '.ImageAttributeBuilder::buildAttributes($nivel, $row_icono['ruta'], $row_icono['descripcion']).' class="button-fixed-icon img-fluid">';
        $html .=        '<span class="button-fixed-text bg-orange p-2 special-paragraph text-black">'. $row_icono['titulo'] .'</span>';
        $html .=    '</div>';
        $html .= '</a>';
    }

    $html .= '</section>';
}

echo $html;
?>
    
    