<?php

    function tratarTexto($texto){
        $textoInsertarCienCaracteres = '<span class="show-principios"> ...</span><span class="hide-principios">';
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
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-4">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
            $title .=        '<h4 class="card-h4-principios text-center">' . $titulo . '</h4>';
            $title .=    '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'derecha') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-4 col-md-2 col-sm-4 col-4">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-8 col-md-10 col-sm-8 col-8">';
            $title .=         '<h4 class="card-h4-principios">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-8 col-md-10 col-sm-8 col-8">';
            $title .=         '<h4 class="card-h4-principios text-end">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-4 col-md-2 col-sm-4 col-4">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'arriba') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-4">';
            $title .=         '<h4 class="card-h4-principios text-center">'. $titulo .'</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-12 col-md-12 col-sm-12 col-12 col-lg-4">';
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
        $atributosEscritorio = ImageAttributeBuilder::buildsrcset($nivel, $imagenBanner['ruta']);
        $atributosTabletaVertical = ImageAttributeBuilder::buildsrcset($nivel, $imagenBanner['rutaTabletaVertical']);
        $atributosTabletaHorizontal = ImageAttributeBuilder::buildsrcset($nivel, $imagenBanner['rutaTabletaHorizontal']);
        $atributosMovil = ImageAttributeBuilder::buildAttributes($nivel, $imagenBanner['rutaMovil']);
        //TODO: Faltan: Imagenes de escritorio, tablet y movil. a espera del equipo creativo.

        $html .= '<div class="container banner-principios">';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<picture>';
        $html .=               '<source '. $atributosEscritorio.' media="(min-width: 992px)">';
        $html .=               '<source  '.$atributosTabletaHorizontal.' media="(min-width: 768px)">';
        $html .=               '<source '.$atributosTabletaVertical.' media="(min-width: 576px)">';
        $html .=               '<img '. $atributosMovil .' alt="Banner principios que nos guian" class="img-fluid w-100">';
        $html .=            '</picture>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</div>';
        $html .= '<main class="container section-principios">';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<h2 class="font-roboto-light-title h2-principios">' . $row_sentencia['titulo'] . '</h2>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p class="p-principios">' . $row_sentencia['texto'] . '</p>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</main>';

    
        $numeroCards = sizeof($imagenes);


        $html .= '<section class="container section-principios">';
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<div class="grid-principios">';
        for ($i = 0; $i < $numeroCards; $i++) {
            if (strtolower($imagenes[$i]['titulo']) === strtolower($textos[$i]['identificacion'])) {
                $html .=         '<div class="card-principios">';
                $html .=             posicionTitulo('<img' . ImageAttributeBuilder::buildAttributes($nivel, $imagenes[$i]['ruta'], $imagenes[$i]['descripcion']) . ' class="icon-principios img-fluid">', $imagenes[$i]['titulo'], $imagenes[$i]['posicionTitulo']);

                $html .=             '<div class="card-content-principios" id="'.$imagenes[$i]['titulo']. '-'. $i .'">';
                $html .=                '<p>' . tratarTexto($textos[$i]['texto']) . '</p>';
                $html .=                '<div class="d-flex justify-content-between align-items-center" id="btn-principios-container">';
                $html .=                    '<hr class="principios-line">';
                $html .=                    '<a style="color: white" class="btn-principios" role="button" onclick="leerMasPrincipios(\''.$imagenes[$i]['titulo']. '-'. $i .'\', this)">Leer más</a>';
                $html .=                '</div>';
                $html .=             '</div>';
                $html .=         '</div>';
            }
        }
        $html .=            '</div>';
        $html .=        '</div>';
        $html .=     '</div>';
        $html .= '</section>';
    }
    echo $html;