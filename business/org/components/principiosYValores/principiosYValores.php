<?php

    function posicionTitulo($imgHTML, $titulo, $posicionTitulo)
    {
        $title = '';
        if (strtolower($posicionTitulo) == 'abajo') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=    '<div class="col-lg-4 my-4">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .=    '<div class="col-lg-12">';
            $title .=        '<h4 class="font-roboto-black text-center">' . $titulo . '</h4>';
            $title .=    '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'derecha') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-8">';
            $title .=         '<h4 class="font-roboto-black">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-8">';
            $title .=         '<h4 class="font-roboto-black text-end">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'arriba') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-12 my-4">';
            $title .=         '<h4 class="font-roboto-black text-center">Compromiso</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-4">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        }
        return $title;
    }

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "15");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);

    $html = '';
    while ($row_sentencia = $res_seccion->fetch_assoc()) {
        $html .= '<main class="container">';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<p>Falta banner seccion</p>';
        $html .=            '<img src="" alt="Imagen?">';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<h2 class="tx-blue font-roboto-light-title tx-uppercase">' . $row_sentencia['titulo'] . '</h2>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<p>' . $row_sentencia['texto'] . '</p>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</main>';

        //Obtener Imagenes
        $res_sentecia = $mysqli1->query($sentencia . "31");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }

        $res1 = $mysqli1->query($sql_imagenes);
        while ($row = $res1->fetch_assoc()) {
            $imagenes[] = $row;
        }

        //Obtener textos
        $res_sentecia = $mysqli1->query($sentencia . "37");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_textos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res2 = $mysqli1->query($sql_textos);

        while ($row = $res2->fetch_assoc()) {
            $textos[] = $row;
        }

        $numeroCards = sizeof($imagenes);

        $html .= '<section class="container my-5">';
        $html .=    '<div class="row my-5">';
        for ($i = 0; $i < $numeroCards; $i++) {
            $html .=        '<div class="col-lg-5 value my-5">';
            $html .=             posicionTitulo('<img' . ImageAttributeBuilder::buildAttributes($nivel, $imagenes[$i]['ruta'], $imagenes[$i]['descripcion']) . ' class="img-fluid w-100">', $imagenes[$i]['titulo'], $imagenes[$i]['posicionTitulo']);
            $html .=             '<div class="row">';
            $html .=                 '<div class="values-card">';
            $html .=                     '<p class="special-paragraph text-lg-start">' . $textos[$i]['texto'] . '</p>';
            $html .=                 '</div>';
            $html .=             '</div>';
            $html .=         '</div>';
            if($i % 2 === 0){
                $html .=        '<div class="col-lg-2 my-4"></div>';
            }
        }
        $html .=     '</div>';
        $html .= '</section>';
    }
    echo $html;