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

    $res_sentecia = $mysqli1->query($sentencia . "128");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res_seccion = $mysqli1->query($sql_seccion);
    $html = '';
    while ($row_seccion = $res_seccion->fetch_assoc()) {
        $imagenes = [];
        $res_imagenes = $mysqli1->query($sentencia . "129");
        while ($row_sentencia = $res_imagenes->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_imagenes = $mysqli1->query($sql_imagenes);
        while ($row_imagenes = $res_imagenes->fetch_assoc()) {
            $imagenes[] = $row_imagenes;
        }

        $titulo = array_shift($imagenes);
        $html .= '<section class="bg-bold-blue py-3 my-2rem">';
        $html .=    '<div class="container">';
        $html .=        '<div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">';
        $html .=            '<h2 class="tx-orange font-roboto-black text-center">' . $titulo['titulo'] . '</h2>';
        $html .=            '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $titulo['ruta'], $titulo['descripcion']) . ' class="img-fluid pagos-icono">';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';

        $html .= '<section class="container my-2rem">';
        $html .=    '<div class="row mb-2rem">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<h4 class="font-roboto-black text-center">' . $row_seccion['subTitulo'] . '</h4>';
        $html .=        '</div>';
        $html .=    '</div>';

        $iconoPDF = array_shift($imagenes);
        $res_circulares= $mysqli1->query($sentencia . "130");
        while ($row_sentencia = $res_circulares->fetch_assoc()) {
            $sql_circulares = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_circulares = $mysqli1->query($sql_circulares);
        while ($row_circulares = $res_circulares->fetch_assoc()) {
            $html .=    '<div class="row align-items-center justify-content-center my-2rem">';
            $html .=        '<div class="col-lg-5 col-md-5 col-sm-5 col-5 text-lg-center text-start my-2">';
            $html .=            '<p class="font-roboto-bolditalic">'. $row_circulares['titulo'] .'</p>';
            $html .=        '</div>';
            $html .=        '<div class="col-lg-5 col-md-5 col-sm-5 col-5 text-center my-2">';
            $html .=            '<div class="row align-items-center">';
            $html .=                '<div class="col-6">';
            $html .=                    '<a onclick="descargarArchivo(\'' . $nivel . '\', \''. $row_circulares['ruta'] .'\', \''.$row_circulares['nombreArchivo'] . '\', \'' . $row_circulares['destino'] .'\')" class="download-button mx-3">';
            $html .=                        '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $iconoPDF['ruta'], $iconoPDF['descripcion']) . ' class="img-fluid pdf-btn">';
            $html .=                    '</a>';
            $html .=                '</div>';
            $html .=                '<div class="col-6">';
            $html .=                    '<a href="'.$row_circulares['linkLeer'].'" class="btn py-3 px-4 rounded bg-orange tx-white font-roboto-bolditalic drop-shadow">' . $iconoPDF['titulo'] . '</a>';
            $html .=                '</div>';
            $html .=            '</div>';
            $html .=        '</div>';
            $html .=    '</div>';
        }


        $html .= '</section>';


        $gifAyuda = array_shift($imagenes);
        $html .= '<section class="container my-2rem">';
        $html .=    '<div class="row justify-content-lg-end justify-content-center">';
        $html .=        '<div class="col-lg-12 col-md-8 col-sm-8 col-8 text-lg-end text-center">';
        $html .=            '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $gifAyuda['ruta'], $gifAyuda['descripcion']) . ' class="img-fluid ayuda-gif">';
        $html .=            '<p class="font-roboto-bolditalic">' . $gifAyuda['titulo'] . '</p>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
    }

    echo $html;
