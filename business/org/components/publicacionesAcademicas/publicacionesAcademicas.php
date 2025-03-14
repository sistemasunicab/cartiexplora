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
        $iconoPdf = '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $row_sentencia['ruta'], $row_sentencia['descripcion']) . ' class="img-fluid w-100">'; 
    }

    $html = '';
    // Obtiene la sección y la muestra
    while ($row_sentencia = $res_seccion->fetch_assoc()) {
        
        $html .= '<main class="container my-5">';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-12">';
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
            
            $html .= '<div class="row my-5">';
            $html .=    '<div class="col-lg-5">';
            $html .=        '<h4 class="font-roboto-black mb-5">'. $row_publicacion['titulo'] .'</h4>';
            $html .=        '<img '.ImageAttributeBuilder::buildAttributes($nivel, $row_publicacion['rutaImagen'], $row_publicacion['descripcionImagen']).' class="img-fluid w-75">';
            $html .=    '</div>';
            $html .=    '<div class="col-lg-7">';
            $html .=        '<p class="special-paragraph">Publicación: '.$date->format('m/Y'). '</p>';
            $html .=        '<p>'. $row_publicacion['texto'] . '</p>';
            $html .=        '<div class="row align-items-center my-5">';
            $html .=            '<div class="col-lg-2">';
            $html .=                '<a onclick="descargarArchivo(\'' . $nivel . '\', \''. $row_publicacion['ruta'] .'\', \''.$row_publicacion['nombreArchivo'] . '\', \'' . $row_publicacion['destino'] .'\')" class="download-button">';
            $html .=                    $iconoPdf;
            $html .=                '</a>';
            $html .=            '</div>';
            $html .=            '<div class="col-lg-1"></div>';
            $html .=            '<div class="col-lg-4">';
            $html .=                '<a href="'. $row_publicacion['linkLeer'] .'" class="publications-button bg-orange tx-white">Leer</a>';
            $html .=            '</div>';
            $html .=            '<div class="col-lg-5"></div>';
            $html .=        '</div>';
            $html .=    '</div>';
            $html .= '</div>';
        }
        $html .= '</main>';
    }

    echo $html;
?>
