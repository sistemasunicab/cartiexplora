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
            $title .= '<div class="row align-items-center my-2">';
            $title .=     '<div class="col-lg-5 col-md-3 col-sm-4 col-4">';
            $title .=         '<h4 class="card-h4-principios px-4">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-2 col-md-2 col-sm-2 col-2">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-5 col-md-7 col-sm-6 col-6"></div>';
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
        $html .=               '<img class="img-fluid w-100 img-banner-principios" '. $atributosMovil .' alt="Banner principios que nos guian">';
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
        $numeroColumnas = 2;
        $cantidadFilaActual = 1;

        $html .= '<section class="container section-principios">';

        for ($i = 0; $i < $numeroCards; $i++) {
            if (strtolower($imagenes[$i]['titulo']) === strtolower($textos[$i]['identificacion'])) {
                // Si estamos en el primer elemento de una nueva fila, abrimos <div class="row">
                if ($cantidadFilaActual === 1) {
                    $html .= '<div class="row section-principios">';
                }
            
                $html .= '<div class="col-lg-6 col-md-12 col-sm-12 col-12 margin-card-principios">';
                $html .=     '<div class="card-principios">';
                $html .=         posicionTitulo(
                                        '<img' . ImageAttributeBuilder::buildAttributes(
                                                        $nivel,
                                                        $imagenes[$i]['ruta'],
                                                        $imagenes[$i]['descripcion']
                                                    ) . ' class="icon-principios img-fluid">',
                                        $imagenes[$i]['titulo'],
                                        $imagenes[$i]['posicionTitulo']
                                    );
                $html .=         '<div class="card-content-principios" id="' . $imagenes[$i]['titulo'] . '-' . $i . '">';
                $html .=             '<p>' . tratarTexto($textos[$i]['texto']) . '</p>';
                $html .=             '<div class="d-flex justify-content-between align-items-center" id="btn-principios-container">';
                $html .=                 '<hr class="principios-line">';
                $html .=                 '<a style="color: white" class="btn-principios" role="button" '
                             . 'onclick="leerMasPrincipios(\'' . $imagenes[$i]['titulo'] . '-' . $i . '\', this)">Leer más</a>';
                $html .=             '</div>';
                $html .=         '</div>';
                $html .=     '</div>';
                $html .= '</div>';
                                
                $cantidadFilaActual++;
                                
                
                if ($cantidadFilaActual === $numeroColumnas + 1) {
                    $html .= '</div>';
                    $cantidadFilaActual = 1;         // volvemos a empezar en la siguiente fila
                }
            }
        }

        // Si al terminar el bucle queda una fila incompleta (p. ej. sólo 1 card en una fila de 2 columnas), añadimos columnas vacías y cerramos la fila
        if ($cantidadFilaActual > 1 && $cantidadFilaActual <= $numeroColumnas) {
            // ponemos tantas columnas vacías como hagan falta para llegar a $numeroColumnas
            $columasRelleno = $numeroColumnas - ($cantidadFilaActual - 1);
            for ($j = 0; $j < $columasRelleno; $j++) {
                $html .= '<div class="col-lg-6"></div>';
            }
            $html .= '</div>';  // Cerramos la fila pendiente
        }

        $html .= '</section>';   
    }
    echo $html;