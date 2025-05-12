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
        
        $html .= '<main class="container my-2rem">';
        $html .=    '<div class="row mb-2rem">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<h2 class="tx-blue font-roboto-light-title tx-uppercase">' . $row_sentencia['titulo'] . '</h2>';
        $html .=        '</div>';
        $html .=    '</div>';
        
        
        $res_sentecia = $mysqli1->query($sentencia . "87");//34
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_publicaciones = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        
        $res_publicaciones = $mysqli1->query($sql_publicaciones);
        while ($row_publicacion = $res_publicaciones->fetch_assoc()) {
            $date = new DateTime($row_publicacion['fechaSubida']);
            
            $html .= '<div class="row mb-2rem">';
            $html .=    '<div class="col-lg-5 col-md-12 col-sm-12 col-12">';
            $html .=        '<h4 class="font-roboto-black mb-3">'. $row_publicacion['titulo'] .'</h4>';
            $html .=        '<div class="row justify-content-evenly align-items-center my-4">';
            $html .=            '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
            $html .=                '<img '.ImageAttributeBuilder::buildAttributes($nivel, $row_publicacion['rutaImagen'], $row_publicacion['descripcionImagen']).' class="img-fluid w-75">';
            $html .=            '</div>';
            $html .=        '</div>';
            $html .=    '</div>';
            $html .=    '<div class="col-lg-7 col-md-12 col-sm-12 col-12">';
            $html .=        '<p class="special-paragraph tx-orange">Publicación: '.$date->format('m/Y'). '</p>';
            $html .=        '<p>'. $row_publicacion['texto'] . '</p>';
            $html .=        '<div class="row align-items-center my-2rem">';
            $html .=            '<div class="col-lg-2 col-md-2 col-sm-4 col-4">';
            $html .=                '<a onclick="descargarArchivo(\'' . $nivel . '\', \''. $row_publicacion['ruta'] .'\', \''.$row_publicacion['nombreArchivo'] . '\', \'' . $row_publicacion['destino'] .'\')" class="d-inline-block download-button">';
            $html .=                    $iconoPdf;
            $html .=                '</a>';
            $html .=            '</div>';
            $html .=            '<div class="col-lg-1 d-lg-block d-none"></div>';
            $html .=            '<div class="col-lg-4 col-md-6 col-sm-6 col-6">';
            $html .=                '<a href="'. $row_publicacion['linkLeer'] .'" class="d-inline-block publications-button bg-orange tx-white">Leer</a>';
            $html .=            '</div>';
            $html .=            '<div class="col-lg-5 d-lg-block d-none"></div>';
            $html .=        '</div>';
            $html .=    '</div>';
            $html .= '</div>';
        }
        $html .= '</main>';
    }

    echo $html;
?>
