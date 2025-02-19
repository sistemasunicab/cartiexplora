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

    $res_sentecia = $mysqli1->query($sentencia . "4");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // Obtiene el titulo de la sección y lo renderiza
        $html .= '<div class="row mt-10 mx-0"><h1 class="col titulo-1 text-center px-0">' . $row_datos_seccion['titulo'] . '</h1></div>';
    }

    if ($html != '') {
        // Busqueda de las imagenes de la oferta academica
        $res_sentecia = $mysqli1->query($sentencia . "17");

        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_images = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }

        $res_images = $mysqli1->query($sql_images);

        $html .= '<section class="bg-light-gray mt-4 py-3">
            <div class="row justify-content-center gap-5 mx-0 academic-offer-img">';

        // Renderiza las imágenes 
        while ($row_images = $res_images->fetch_assoc()) {
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $row_images['ruta'], $row_images['descripcion'], $row_images['rutaEncima']);
            $html .= '<a href="" class="col-2"><img ' . $attributes . ' class="img-fluid" /></a>' . "\n";
        }
        
        $html .= '</div></section>';
    }
    echo $html;
?>