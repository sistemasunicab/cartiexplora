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

    
    $res_sentecia = $mysqli1->query($sentencia . "83");//13
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);
    
 
    $html = '';

    while ($row_datos_seccion = $res_seccion->fetch_assoc()) {
        $html .= '<main class="container section-nuestros-estudiantes">';
        $html .=    '<div class="row titulo-mb-nuestros-estudiantes">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<h2 class="h2-nuestros-estudiantes font-roboto-light-title">'. $row_datos_seccion['titulo'] .'</h2>';
        $html .=        '</div>';
        $html .=    '</div>';


        $res_sentecia = $mysqli1->query($sentencia . "84");//27
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_imagenes = $mysqli1->query($sql_imagenes);
        
        // Variables de control
        $esPrimeraImagen = true;
        $imagenesEnFila = 0;
        $totalRecorridas = 0;

        $html .=    '<div class="galeria-nuestros-estudiantes">';
        $html .=        '<div class="row">';
        while ($filaImagen = $res_imagenes->fetch_assoc()) {
    
            $claseSeleccion = $esPrimeraImagen ? ' item-nuestros-estudiantes__seleccionado' : '';
            $atributosImagen = ImageAttributeBuilder::buildAttributes($nivel, $filaImagen['ruta'], $filaImagen['descripcion']);
        
            $html .= '<div class="col-lg-3 col-md-4 col-sm-4 col-4 row-margin-nuestros-estudiantes">';
            $html .=     '<a href="#zoom-imagen" class="item-nuestros-estudiantes' . $claseSeleccion . '">';
            $html .=        '<div>';
            $html .=            '<img' . $atributosImagen . ' class="img-fluid w-100" draggable="false">';
            $html .=        '</div>';
            $html .=     '</a>';
            $html .= '</div>';
        
            if ($esPrimeraImagen) {
                $imagenInicial = $atributosImagen;
                $esPrimeraImagen = false;
            }

        }
        
        $html .=            '<div class="d-lg-none col-md-4 col-sm-4 col-4"></div>';
        $html .=        '</div>'; // Cierra la fila
        $html .=    '</div>'; 
        $html .= '</main>';
        $html .= '<section class="section-nuestros-estudiantes fondo-nuestros-estudiantes" id="zoom-imagen">';
        $html .=    '<div class="container">';
        $html .=        '<div class="row">';
        $html .=            '<div class="col-lg-2 col-md-1 col-sm-1 col-1 "></div>';
        $html .=            '<div class="col-lg-8 col-md-10 col-sm-10 col-10 img-grande-nuestros-estudiantes">';
        $html .=                '<img id="imagen-grande-galeria" '. $imagenInicial .' class="img-fluid w-100" draggable="false">';
        $html .=            '</div>';
        $html .=            '<div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
    }

    echo $html;
?>