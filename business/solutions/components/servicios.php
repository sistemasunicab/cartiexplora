<?php
    require('../../repositories/1cc2s4Sol.php');

    function posicionTituloImagen($imgHTML, $titulo, $posicionTitulo, $enlace = '')
    {
        if (strtolower($posicionTitulo) == 'abajo') {
            return
            '<div class="col-lg-5 col-md-5 col-sm-12 col-12 solutions-card">
                <div class="solutions-card-img d-flex justify-content-center align-items-center">
                    '. $imgHTML .'
                </div>
                <div class="solutions-card-desc">
                    <p class="font-roboto-black">'. $titulo .'</p>
                </div>
                <hr class="bg-orange m-0">
                <div class="d-lg-flex justify-content-lg-end">
                    <a href="'. $enlace .'" class="solutions-card-button tx-white bg-orange font-roboto-bolditalic d-lg-inline d-md-block d-sm-block d-block">Más Información</a>
                </div>
            </div>';
        }
        return '';
    }

    $html = '';

    // Verificar sección
    $res_sentecia = $mysqli1->query($sentencia . "3");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_servicios = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_servicios = $mysqli1->query($sql_seccion_servicios);

    while ($row_datos_seccion = $res_seccion_servicios->fetch_assoc()) {
        
        // Obtener imagenes
        $res_sentecia = $mysqli1->query($sentencia . "9");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_imagenes = $mysqli1->query($sql_imagenes);

        $html .= '<section class="container">'; 
        $html .=    '<div class="row my-4 p-lg-4 p-md-3 p-sm-2 p-2">'; 
       
        $numCards = 1;
        while ($row_imagenes = $res_imagenes->fetch_assoc()) {
           $html .= posicionTituloImagen('<img'.ImageAttributeBuilder::buildAttributes('tres', $row_imagenes['ruta'], 'card-icon').'>', $row_imagenes['titulo'], $row_imagenes['posicionTitulo'], $row_imagenes['enlace']);

            if(!($numCards++ % 2 === 0)){
                $html .=    '<div class="col-lg-2 col-md-2 col-sm-0 col-0"></div>';
            }
           
        }

        $html .=    '</div>'; 
        $html .= '</section>';
    }

    echo $html;
?>