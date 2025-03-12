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
        $html .= '<main class="container my-5">';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<h2 class="my-5 tx-blue lh-1 font-roboto-light-title">'. $row_datos_seccion['titulo'] .'</h2>';
        $html .=        '</div>';
        $html .=    '</div>';


        $res_sentecia = $mysqli1->query($sentencia . "84");//27
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_imagenes = $mysqli1->query($sql_imagenes);
        
        $primeraImagen = true;
        $html .=    '<div class="row galeria">';
        while ($row_imagenes = $res_imagenes->fetch_assoc()) {
            if($primeraImagen){
                $html .= '<div class="col-lg-3 my-3">';
                $html .=    '<a href="#zoom-imagen" class="item item-seleccionado">';
                $html .=        '<img'. ImageAttributeBuilder::buildAttributes($nivel, $row_imagenes['ruta'],$row_imagenes['descripcion']) .' class="img-fluid w-100" draggable="false">';
                $html .=    '</a>';
                $html .= '</div>';
                $imagenInicial = ImageAttributeBuilder::buildAttributes($nivel, $row_imagenes['ruta'],$row_imagenes['descripcion']);
                $primeraImagen = false;
            }else{
                $html .= '<div class="col-lg-3 my-3">';
                $html .=     '<a href="#zoom-imagen" class="item">';
                $html .=         '<img'. ImageAttributeBuilder::buildAttributes($nivel, $row_imagenes['ruta'],$row_imagenes['descripcion']) .' class="img-fluid w-100" draggable="false">';
                $html .=     '</a>';
                $html .= '</div>';
            }
        }

        $html .=    '</div>';
        $html .= '</main>';
        $html .= '<section class="bg-light-gray-o26 p-1" id="zoom-imagen">';
        $html .=    '<div class="container my-5">';
        $html .=        '<div class="row">';
        $html .=            '<div class="col-lg-2"></div>';
        $html .=            '<div class="col-lg-8">';
        $html .=                '<img id="imagen-grande-galeria" '. $imagenInicial .' class="img-fluid w-100" draggable="false">';
        $html .=            '</div>';
        $html .=            '<div class="col-lg-2"></div>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
    }

    echo $html;
?>