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

        $html .= '<section class="my-5">';
        $html .=    '<div class="container my-2">';
        $html .=       '<div class="row">';
        $html .=           '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=               '<h2 class="text-center font-roboto-black tx-blue" id="ofertaAcademica">' . $row_datos_seccion['titulo'] . '</h2>';
        $html .=           '</div>';
        $html .=       '</div>';
        $html .=    '</div>';
        
        // Busqueda de las imagenes de la oferta academica
        $res_sentecia = $mysqli1->query($sentencia . "17");
        
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_images = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        
        $res_images = $mysqli1->query($sql_images);
        
        $html .=    '<div class="bg-light-gray-o26">';
        $html .=        '<div class="container py-5">';
        $html .=            '<div class="row justify-content-lg-between justify-content-center ">';
        
        // Renderiza las imágenes
        $ultimaImagen = 1; 
        while ($row_images = $res_images->fetch_assoc()) {
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $row_images['ruta'], $row_images['descripcion'], $row_images['rutaEncima']);

            $html .=            '<div class="my-lg-0 my-3 col-lg-3 col-md-6 col-sm-6 col-6">';
            $html .=                '<a href="'.$row_images['enlace'].'" class="academic-offer-img">';
            $html .=                    '<img ' . $attributes . ' class="img-fluid w-100" >';
            $html .=                '</a>';
            $html .=            '</div>';
            if($ultimaImagen !== $res_images->num_rows){
                $html .=        '<div class=" d-lg-block d-md-none d-sm-none d-none col-lg-1"></div>';
            }
            $ultimaImagen++;
        }
        $html .=            '</div>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
    }  

    echo $html;
?>