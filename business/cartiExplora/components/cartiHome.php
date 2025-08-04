<?php
    function posicionTitulo($imgHTML, $titulo, $posicionTitulo, $color = '')
    {
        $title = '';
        if (strtolower($posicionTitulo) == 'abajo') {
            $title .= '<div class="row align-items-center justify-content-start mb-3">';
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
            $title .=        '<p class="font-roboto-black text-start '.$color.'">' . $titulo . '</p>';
            $title .=    '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'derecha') {
            $title .= '<div class="row align-items-center justify-content-start mb-3">';
            $title .=     '<div class="col-lg-3 col-md-1 col-sm-3 col-3 text-center">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-8 col-md-11 col-sm-8 col-8">';
            $title .=         '<p class="font-roboto-black '.$color.'">' . $titulo . '</p>';
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            $title .= '<div class="row align-items-center justify-content-start mb-3">';
            $title .=     '<div class="col-lg-8 col-md-11 col-sm-8 col-8">';
            $title .=         '<p class="font-roboto-black text-end '.$color.'">' . $titulo . '</p>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-3 col-md-1 col-sm-3 col-3 text-center">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'arriba') {
            $title .= '<div class="row align-items-center justify-content-start mb-3">';
            $title .=     '<div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">';
            $title .=         '<p class="font-roboto-black text-start '.$color.'">'. $titulo .'</p>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-3 col-md-3 col-sm-3 col-3">';
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

    //Obtener Imagenes
    $res_sentecia = $mysqli1->query($sentencia . "93");//33
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res1 = $mysqli1->query($sql_imagenes);
    while ($row = $res1->fetch_assoc()) {
        $imagenes[] = $row;
    }

    //Obtener textos
    $res_sentecia = $mysqli1->query($sentencia . "91");//40
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_textos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res2 = $mysqli1->query($sql_textos);

    while ($row = $res2->fetch_assoc()) {
        $textos[] = $row;
    }

    $res_sentecia = $mysqli1->query($sentencia . "92");//16
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);

    $html = '';
    while ($row_sentencia = $res_seccion->fetch_assoc()) {

        $imagen_banner = array_shift($imagenes);

        $html .= '<section class="mb-2rem">';
        $html .=        '<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagen_banner['ruta'], $imagen_banner['descripcion']).' class="img-fluid w-100 carti-image">';
        $html .= '</section>';

        $html .= '<main class="container" id="divMision">';
        $html .=    '<div class="row my-2rem">';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<h2 class="text-center tx-blue font-roboto-light-title">'. $row_sentencia['titulo'] .'</h2>';
        $html .=        '</div>';
        $html .=    '</div>';

        $imagen_explorador = array_shift($imagenes);
        $numeroCards = sizeof($textos);

        $html .=    '<div class="row mb-2rem">';
        for ($i = 0; $i < 3; $i++) {
            //Muestra las primeras cards del home con diferente estructura
            $html .=    '<div class="col-lg-6 value mb-2rem">';
            $html .=        posicionTitulo('<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[$i]['ruta'], $imagenes[$i]['descripcion']).' class="carti-mision-icons img-fluid w-100">', 
            $imagenes[$i]['titulo'],  $imagenes[$i]['posicionTitulo'], 'tx-orange');
            $html .=        '<div class="row" id="divPrincipios">';
            $html .=            '<div class="col-lg-12">';
            $html .=                '<p class="special-paragraph">';
            $html .=                    $textos[$i]['texto'];
            $html .=                '</p>';
            $html .=            '</div>';
            $html .=         '</div>';
            $html .=    '</div>';
            
            if($i === 2){
                $html .=    '<div class="col-lg-6 value mb-2rem">';
                $html .=       '<img '. ImageAttributeBuilder::buildAttributes($nivel, $imagen_explorador['ruta'], $imagen_explorador['descripcion']) .' class="img-fluid w-100 carti-image">';
                $html .=    '</div>';    
            }
        }
        $html .=    '</div>';

        $html .=    '<div class="row my-2rem">';
        for ($i = 3; $i < $numeroCards; $i++) {
            $html .=    '<div class="col-lg-4 value mb-2rem">';
            $html .=        posicionTitulo('<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[$i]['ruta'], $imagenes[$i]['descripcion']).' class="carti-icons img-fluid w-100">', 
            $imagenes[$i]['titulo'],  $imagenes[$i]['posicionTitulo']);
            $html .=        '<div class="row">';
            $html .=            '<div class="col-lg-12">';
            $html .=                '<p class="special-paragraph">';
            $html .=                    $textos[$i]['texto'];
            $html .=                '</p>';
            $html .=            '</div>';
            $html .=         '</div>';
            $html .=    '</div>';
        }

        $html .=    '</div>';
        $html .= '</main><br><br>';

        }

    echo $html;

