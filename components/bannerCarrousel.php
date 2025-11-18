<?php

    function añadirNivelARuta($nivel, $ruta) {
         if ($nivel == "raiz") {
            $nuevaRuta = ' src="' . $ruta . '"';
            return $nuevaRuta;
        } else if ($nivel == "uno") {
            $nuevaRuta = ' src="../' . $ruta . '"';
            return $nuevaRuta;
        } else if ($nivel == "dos") {
            $nuevaRuta = ' src="../../' . $ruta . '"';
            return $nuevaRuta;
        } else if ($nivel == "tres") {
            $nuevaRuta = ' src="../../../' . $ruta .'"';
            return $nuevaRuta;
        }
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

    $res_sentecia = $mysqli1->query($sentencia . "3");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);
    if ($res_seccion->num_rows == 0) return;

    $res_sentecia = $mysqli1->query($sentencia . "2");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_banner = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'] . $row_sentencia['ordenamientos'];
    }
    $res_banner = $mysqli1->query($sql_banner);
    $rows_items = [];

    while ($row_imagen = $res_banner->fetch_assoc()) {
        $rows_items[] = $row_imagen;
    }


    $html = '<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                 <div class="carousel-indicators home-indicators">';

    // Genera un indicador de carrusel por imagen
    // El primer indicador debe tener la clase "active" el resto no
    for ($j = 0; $j < sizeof($rows_items); $j++) {
        if ($j == 0) {
            $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
        } else {
            $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $j . '" aria-label="Slide ' . ($j + 1) . '"></button>';
        }
    }
    $html .=    '</div>
            <div class="carousel-inner" data-bs-pause="hover">';

    $primerItemCarrusel = true;

    for ($i = 0; $i < sizeof($rows_items); $i++) {
        if ($rows_items[$i]['linkImagen'] == '') $link_image = '';

        // Valor por defecto
        $interval = '2000';

        $link_image = $rows_items[$i]['linkImagen'];
        $link_button = $rows_items[$i]['linkBoton'];
        $target = $rows_items[$i]['target'];
        $text_button = $rows_items[$i]['textoBoton'];
        $text = $rows_items[$i]['texto'];
        $top_text = $rows_items[$i]['porcentajeTopTexto'];
        $left_text = $rows_items[$i]['porcentajeLeftTexto'];
        $interval = $rows_items[$i]['milisegundosSlide'];
        $button_styles = ButtonStylesBannerBuilder::buildStyles($rows_items[$i]['color'], $rows_items[$i]['transparencia'], $rows_items[$i]['porcentajeTop'], $rows_items[$i]['porcentajeLeft']);
        $buttonVideo_styles = 'position: absolute; background: rgba(254, 145, 0, 1); top: 70%; left: 50%; transform: translateX(-50%);';

        $elemento = '';
        if ($rows_items[$i]['tipo'] === 'video'){
            $rutaEscritorio = añadirNivelARuta($nivel, $rows_items[$i]['ruta']);
            $rutaTabletaHorizontal = añadirNivelARuta($nivel, $rows_items[$i]['rutaTabletaHorizontal']);
            $rutaMovil = añadirNivelARuta($nivel, $rows_items[$i]['rutaMovil']);

            $elemento .=    '<div class="d-flex align-items-center justify-content-center w-100 h-100">';
            $elemento .=        '<video class="video-mobile" autoplay muted loop playsinline>';
            $elemento .=           '<source '.$rutaMovil.' type="video/mp4">';
            $elemento .=        '</video>';
            $elemento .=        '<video class="video-tablet" autoplay muted loop playsinline>';
            $elemento .=           '<source '.$rutaTabletaHorizontal.' type="video/mp4">';
            $elemento .=        '</video>';
            $elemento .=        '<video class="video-desktop" autoplay muted loop playsinline>';
            $elemento .=           '<source '. $rutaEscritorio .' type="video/mp4">';
            $elemento .=        '</video>';
            $elemento .=    '</div>';

        } else if($rows_items[$i]['tipo'] === 'imagen'){

            $atributosEscritorio = ImageAttributeBuilder::buildsrcset($nivel, $rows_items[$i]['ruta']);
            $atributosTabletaVertical = ImageAttributeBuilder::buildsrcset($nivel, $rows_items[$i]['rutaTabletaVertical']);
            $atributosTabletaHorizontal = ImageAttributeBuilder::buildsrcset($nivel, $rows_items[$i]['rutaTabletaHorizontal']);
            $atributosMovil = ImageAttributeBuilder::buildAttributes($nivel, $rows_items[$i]['rutaMovil']);

            $elemento .=    '<div class="d-flex align-items-center justify-content-center w-100 h-100">';
            $elemento .=        '<picture>';
            $elemento .=           '<source '. $atributosEscritorio.' media="(min-width: 992px)">';
            $elemento .=           '<source  '.$atributosTabletaHorizontal.' media="(min-width: 768px)">';
            $elemento .=           '<source '.$atributosTabletaVertical.' media="(min-width: 576px)">';
            $elemento .=           '<img '. $atributosMovil .' alt="Imagen carrusel" class="img-banner">';
            $elemento .=        '</picture>';
            $elemento .=    '</div>';
        }

        // El primer item o div del carrusel debe tener la clase "active", el resto no.
        if ($primerItemCarrusel) {
            $html .= '<div class="carousel-item banner-home-item active" data-bs-interval="'.$interval.'">';
            $html .=        $elemento;  

            if ($text) {
                $html .=    '<p class="texto-banner" style=" top: ' . $top_text . '%; left: ' . $left_text . '%; transform: translateX(-'.$left_text.'%)" >' . $text . '</p>';
            }

            if ($text_button){
                if ($rows_items[$i]['tipo'] === 'video'){
                    $html .=    '<a id="buttonVideo" href="' . $link_button . '" class="button-carousel button-absolute" style="' . $button_styles . '" role="button" target="_blank">' . $text_button . '</a>';
                }
                else {
                    $html .=    '<a href="' . $link_button . '" class="button-carousel button-absolute" style="' . $button_styles . '" role="button" target="'.$target.'">' . $text_button . '</a>';
                }                
            }

            $html .= '</div>';
            $primerItemCarrusel = false;
        } else {
            $html .= '<div class="carousel-item banner-home-item" data-bs-interval="'.$interval.'">';
            $html .=        $elemento;

            if ($text) {
                $html .=    '<p class="texto-banner" style=" top: ' . $top_text . '%; left: ' . $left_text . '%; transform: translateX(-'.$left_text.'%)" >' . $text . '</p>';
            }

            if ($text_button){
                if ($rows_items[$i]['tipo'] === 'video'){
                    $html .=    '<a id="buttonVideo" href="' . $link_button . '" class="button-carousel button-absolute" style="' . $button_styles . '" role="button" target="_blank">' . $text_button . '</a>';
                }
                else {
                    $html .=    '<a href="' . $link_button . '" class="button-carousel button-absolute" style="' . $button_styles . '" role="button" target="'.$target.'">' . $text_button . '</a>';
                }                
            }

            $html .= '</div>';
        }
    }
    
    $html .=        '</div>';
    $html .=        '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">';
    $html .=            '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
    $html .=            '<span class="visually-hidden">Previous</span>';
    $html .=        '</button>';
    $html .=        '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">';
    $html .=            '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
    $html .=            '<span class="visually-hidden">Next</span>';
    $html .=        '</button>';
    $html .=    '</div>';

    echo $html;
?>