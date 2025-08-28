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

    $res_sentecia = $mysqli1->query($sentencia . "85");//14
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);

    //Obtener icono de descargar pdf
    $res_sentecia = $mysqli1->query($sentencia . "86");//29
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_icono = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_icono = $mysqli1->query($sql_icono);

    while ($row_sentencia = $res_icono->fetch_assoc()) {
        $iconoPdf = '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $row_sentencia['ruta'], $row_sentencia['descripcion']) . ' class="img-fluid pdf-btn">'; 
    }

    $html = '';
    // Obtiene la sección y la muestra
    while ($row_sentencia = $res_seccion->fetch_assoc()) {
        
        $html .= '<main class="container section-publicaciones">';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-6 col-sm-12 col-12">';
        $html .=            '<h2 class="font-roboto-light-title h2-publicaciones">' . $row_sentencia['titulo'] . '</h2>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-0 col-md-6 col-sm-0 col-0"></div>';
        $html .=    '</div>';
        
        
        $res_sentecia = $mysqli1->query($sentencia . "87");//34
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_publicaciones = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        
        $res_publicaciones = $mysqli1->query($sql_publicaciones);
        while ($row_publicacion = $res_publicaciones->fetch_assoc()) {
            $date = new DateTime($row_publicacion['fechaSubida']);
            
            $html .= '<div class="row margin-publicaciones">';
            $html .=    '<div class="col-lg-5 col-md-12 col-sm-12 col-12">';
            $html .=        '<h4 class="h4-publicaciones">'. $row_publicacion['titulo'] .'</h4>';
            $html .=        '<div class="row justify-content-evenly align-items-center">';
            $html .=            '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
            $html .=                '<a class="d-block w-100 h-100" href="'.$row_publicacion['ruta'].'" target="_blank">';
            $html .=                    '<img '.ImageAttributeBuilder::buildAttributes($nivel, $row_publicacion['rutaImagen'], $row_publicacion['descripcionImagen']).' class="img-fluid img-publicaciones">';
            $html .=                '</a>';
            $html .=            '</div>';
            $html .=        '</div>';
            $html .=    '</div>';
            $html .=    '<div class="col-lg-7 col-md-12 col-sm-12 col-12">';
            $html .=        '<span class="fecha-publicaciones">Publicación: '.$date->format('m/Y'). '</span>';
            $html .=        '<p class="p-publicaciones">'. $row_publicacion['texto'] . '</p>';
            $html .=        '<div class="row align-items-center btn-my-publicaciones">';
            $html .=            '<div class="col-lg-3 col-md-3 col-sm-4 col-4 text-center">';
            $html .=                '<a href="'.$row_publicacion['ruta'].'" class="d-inline-block download-button">';
            $html .=                    $iconoPdf;
            $html .=                '</a>';
            $html .=                '<label>'.$row_publicacion['isbn'].'</label>';
            $html .=            '</div>';
            $html .=            '<div class="col-lg-1 d-lg-block d-md-none col-sm-1 col-1 "></div>';
            $html .=            '<div class="col-lg-4 col-md-9 col-sm-4 col-4">';

            $href = "";

            /*if ($nivel == "raiz") {
                $href .= $row_publicacion['linkLeer'];
            } else if ($nivel == "uno") {
                $href .= '../'. $row_publicacion['linkLeer'];
            } else if ($nivel == "dos") {
                $href .= '../../'. $row_publicacion['linkLeer'];
            } else if ($nivel == "tres") {
                $href .= '../../../'. $row_publicacion['linkLeer'];
            }*/

            $html .=                '<a href="'.$row_publicacion['ruta'].'" target="_blank" class="btn-publicaciones">Leer</a>';
            $html .=            '</div>';
            $html .=            '<div class="col-lg-4 d-lg-block d-md-none col-sm-5 col-4"></div>';
            $html .=        '</div>';
            $html .=    '</div>';
            $html .= '</div>';
        }
        $html .= '</main>';
    }

    echo $html;
?>
