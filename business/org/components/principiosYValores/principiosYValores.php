<?php

    function tratarTexto($texto){
        $textoInsertarCienCaracteres = '<span class="show"> ...</span><span class="hide">';
        $textoInsertarFinalCadena = '</span>';
        $posicion = 350;
        $nuevaCadena = substr_replace($texto, $textoInsertarCienCaracteres, $posicion, 0);
        return $nuevaCadena . $textoInsertarFinalCadena;
    }    

    function posicionTitulo($imgHTML, $titulo, $posicionTitulo)
    {
        $title = '';
        if (strtolower($posicionTitulo) == 'abajo') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=    '<div class="col-4 col-lg-4 my-4">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .=    '<div class="col-12 col-lg-12">';
            $title .=        '<h4 class="font-roboto-black text-center">' . $titulo . '</h4>';
            $title .=    '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'derecha') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-3 col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-8 col-lg-8">';
            $title .=         '<h4 class="font-roboto-black">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-8 col-lg-8">';
            $title .=         '<h4 class="font-roboto-black text-end">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-3 col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'arriba') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-12 col-lg-12 my-4">';
            $title .=         '<h4 class="font-roboto-black text-center">'. $titulo .'</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-4 col-lg-4">';
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

    $res_sentecia = $mysqli1->query($sentencia . "88");//15
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);

    //Obtener Imagenes
    $res_sentecia = $mysqli1->query($sentencia . "89");//31
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }

    $res1 = $mysqli1->query($sql_imagenes);
    while ($row = $res1->fetch_assoc()) {
        $imagenes[] = $row;
    }

    //Obtener textos
    $res_sentecia = $mysqli1->query($sentencia . "90");//37
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_textos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res2 = $mysqli1->query($sql_textos);

    while ($row = $res2->fetch_assoc()) {
        $textos[] = $row;
    }

    $html = '';
    while ($row_sentencia = $res_seccion->fetch_assoc()) {
        $imagenBanner = array_shift($imagenes);
        $html .= '<div class="container my-5">';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<img '. ImageAttributeBuilder::buildAttributes($nivel, $imagenBanner['ruta'], $imagenBanner['descripcion']) .'" class="img-fluid w-100">';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</div>';
        $html .= '<main class="container">';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<h2 class="tx-blue font-roboto-light-title tx-uppercase">' . $row_sentencia['titulo'] . '</h2>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p>' . $row_sentencia['texto'] . '</p>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</main>';

    
        $numeroCards = sizeof($imagenes);
        $html .= '<section class="container my-5">';
        $html .=    '<div class="row p-3 my-5">';
        for ($i = 0; $i < $numeroCards; $i++) {
            $html .=        '<div class="col-lg-5 col-md-12 col-sm-12 col-12 value my-5">';
            if (strtolower($imagenes[$i]['titulo']) === strtolower($textos[$i]['identificacion'])) {
                
                $html .=             posicionTitulo('<img' . ImageAttributeBuilder::buildAttributes($nivel, $imagenes[$i]['ruta'], $imagenes[$i]['descripcion']) . ' class="principios-icon img-fluid">', $imagenes[$i]['titulo'], $imagenes[$i]['posicionTitulo']);
                $html .=             '<div class="row">';
                $html .=                 '<div class="values-card col-lg-12 col-md-12 col-sm-12 col-12" id="'.$imagenes[$i]['titulo']. '-'. $i .'">';
                $html .=                     '<p class="special-paragraph text-lg-start">' . tratarTexto($textos[$i]['texto']) . '</p>';
                $html .=                     '<div class="d-flex justify-content-end">';
                $html .=                         '<a class="special-paragraph bg-orange tx-white p-3 rounded principios-button" role="button" onclick="leerMasPrincipios(\''.$imagenes[$i]['titulo']. '-'. $i .'\', this)">Leer más</a>';
                $html .=                     '</div>';
                $html .=                 '</div>';
                $html .=             '</div>';
                $html .=         '</div>';
                if($i % 2 === 0){
                    $html .=        '<div class="col-lg-2 d-lg-block d-none my-4"></div>';
                }
            }
        }
        $html .=     '</div>';
        $html .= '</section>';
    }
    echo $html;