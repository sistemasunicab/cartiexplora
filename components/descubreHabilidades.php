<?php

function posicionTituloImagen($imgHTML, $titulo, $posicionTitulo)
{
    if (strtolower($posicionTitulo) == 'abajo') {
        return
            '<div class="img-container col-6 col-sm-4 col-lg-2 d-flex flex-column align-items-center gap-4 p-0 my-3">' . "\n"
            . $imgHTML . "\n"
            . '<p>' . $titulo . '</p>' . "\n"
            . '</div>' . "\n";
    } else if (strtolower($posicionTitulo) == 'derecha') {
        return
            '<div class="img-container col-6 col-sm-4 col-lg-2 d-flex align-items-center gap-4 p-0 mx-3">' . "\n"
            . $imgHTML . "\n"
            . '<p>' . $titulo . '</p>' . "\n"
            . '</div>' . "\n";
    } else if (strtolower($posicionTitulo) == 'izquierda') {
        return
            '<div class="img-container col-6 col-sm-4 col-lg-2 d-flex flex-row-reverse align-items-center gap-4 p-0 mx-3">' . "\n"
            . $imgHTML . "\n"
            . '<p>' . $titulo . '</p>' . "\n"
            . '</div>' . "\n";
    } else if (strtolower($posicionTitulo) == 'arriba') {
        return
            '<div class="img-container col-6 col-sm-4 col-lg-2 d-flex flex-column-reverse align-items-center gap-2 p-0 my-3">' . "\n"
            . $imgHTML . "\n"
            . '<p>' . $titulo . '</p>' . "\n"
            . '</div>' . "\n";
    }
    return '';
}

if ($nivel == "raiz") {
    require('business/repositories/1cc2s4Home.php');
} else if ($nivel == "uno") {
    require('../business/repositories/1cc2s4Home.php');
} else if ($nivel == "dos") {
    require('../../business/repositories/1cc2s4Home.php');
} else if ($nivel == "tres") {
    require('../../../business/repositories/1cc2s4Home.php');
}

$res_sentecia = $mysqli1->query($sentencia . "5");
while ($row_sentencia = $res_sentecia->fetch_assoc()) {
    $sql_seccion_habilidades = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
}
$res_seccion_habilidades = $mysqli1->query($sql_seccion_habilidades);

$html = '';

while ($row_datos_seccion = $res_seccion_habilidades->fetch_assoc()) {
    // Obtiene el titulo de la sección y lo renderiza
    $html .= '<section class="container">' . '<div class="row mt-10 mx-0">' .
        '<h2 class="col text-center titulo-1 px-0">' . "\n" . $row_datos_seccion['titulo'] . '</h2>' . "\n";

    //Obtener subtitulo
    $subtitulo = explode(" ", $row_datos_seccion['subTitulo']);
    $html .= '<h3 class="text-center titulo-2">' . '<span class="fw-bold">' . $subtitulo[0] . '</span> ' . $subtitulo[1] . '</h3>' . "\n";
    //texto de esta sección 
    $html .= '<p class="text-center texto-base">' . $row_datos_seccion['texto'] . '</p>' . "\n" .
        '</div>' . "\n";
}

if ($html !== '') {

    $res_sentecia = $mysqli1->query($sentencia . "18");

    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res_imagenes = $mysqli1->query($sql_imagenes);

    $html .= '<div class="row px-5 mt-10 contenedor-imagenes">' . "\n";

    while ($row_imagenes = $res_imagenes->fetch_assoc()) {
        $attributes = ImageAttributeBuilder::buildAttributes($nivel, $row_imagenes['ruta'], $row_imagenes['descripcion'], $row_imagenes['rutaEncima']);
        $html .= posicionTituloImagen('<img class="habilidades-img" ' . $attributes . '>', $row_imagenes['titulo'], $row_imagenes['posicionTitulo']);
    }

    $html .= '</div>' . "\n"
        . '</section>' . "\n";
}
echo $html;