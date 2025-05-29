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

        $html .= '<section class="section-oferta">';
        $html .=    '<div class="container">';
        $html .=       '<div class="row">';
        $html .=           '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=               '<h2 class="h2-oferta h2-mb" id="ofertaAcademica">' . $row_datos_seccion['titulo'] . '</h2>';
        $html .=           '</div>';
        $html .=       '</div>';
        $html .=    '</div>';
        
        // Busqueda de las imagenes de la oferta academica
        $res_sentecia = $mysqli1->query($sentencia . "17");
        
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_images = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        
        $res_images = $mysqli1->query($sql_images);
        
        $html .=    '<div class="fondo-oferta">';
        $html .=        '<div class="container padding-oferta">';
        $html .=            '<div class="row">';
        
        // Renderiza las imágenes
        $posicionImagen = 0; 
        while ($row_images = $res_images->fetch_assoc()) {
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $row_images['ruta'], $row_images['descripcion'], $row_images['rutaEncima']);
            if($posicionImagen === 0) {
                $html .=            '<div class="col-lg-4 col-md-4 col-sm-6 col-6 img-left-oferta text-center">';
                $html .=                '<a href="'.$row_images['enlace'].'" class="img-oferta">';
                $html .=                    '<img ' . $attributes . ' class="img-fluid w-100" >';
                $html .=                '</a>';
                $html .=            '</div>';
                $posicionImagen++;
            }else if($posicionImagen === 1) {
                $html .=            '<div class="col-lg-4 col-md-4 col-sm-6 col-6 img-center-oferta text-center">';
                $html .=                '<a href="'.$row_images['enlace'].'" class="img-oferta">';
                $html .=                    '<img ' . $attributes . ' class="img-fluid w-100" >';
                $html .=                '</a>';
                $html .=            '</div>';
                $posicionImagen++;
            }else {
                $html .=            '<div class="col-lg-4 col-md-4 col-sm-12 col-12 img-right-oferta text-center">';
                $html .=                '<a href="'.$row_images['enlace'].'" class="img-oferta">';
                $html .=                    '<img ' . $attributes . ' class="img-fluid w-100" >';
                $html .=                '</a>';
                $html .=            '</div>';
                $posicionImagen = 0;
            }

        }
        $html .=            '</div>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
    }  

    echo $html;
?>