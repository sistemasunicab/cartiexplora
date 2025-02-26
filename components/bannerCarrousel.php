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

    $res_sentecia = $mysqli1->query($sentencia . "3");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);
    if ($res_seccion->num_rows == 0) return;

    $res_sentecia = $mysqli1->query($sentencia . "2");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_banner = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_banner = $mysqli1->query($sql_banner);
    $rows_imagenes = [];

    while ($row_imagen = $res_banner->fetch_assoc()) {
        $rows_imagenes[] = $row_imagen;
    }

    $html = '<section>';
    $html .= '<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">';

    // Genera un indicador de carrusel por imagen
    // El primer indicador debe tener la clase "active" el resto no
    for ($j = 0; $j < sizeof($rows_imagenes); $j++) {
        if ($j == 0) {
            $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
        } else {
            $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $j . '" aria-label="Slide ' . ($j + 1) . '"></button>';
        }
    }
    $html .= '</div>
        <div class="carousel-inner">';

    // Renderiza un item del carrusel con sus respectivos componenetes
    $firstImage = 0;

    for ($i = 0; $i < sizeof($rows_imagenes); $i++) {
        if ($rows_imagenes[$i]['linkImagen'] == '') $link_image = '';

        $link_image = $rows_imagenes[$i]['linkImagen'];
        $link_button = $rows_imagenes[$i]['linkBoton'];
        $text_button = $rows_imagenes[$i]['textoBoton'];
        $styles = ButtonStylesBannerBuilder::buildStyles($rows_imagenes[$i]['color'], $rows_imagenes[$i]['transparencia'], $rows_imagenes[$i]['porcentajeTop'], $rows_imagenes[$i]['porcentajeLeft']);
        $attributes = ImageAttributeBuilder::buildAttributes($nivel, $rows_imagenes[$i]['ruta']);

        // El primer item o div del carrusel debe tener la clase "active", el resto no.
        if ($firstImage  == 0) {
            $html .= '<div class="carousel-item active"><a href="' . $link_image . '"><img ' . $attributes . ' class="img-fluid w-100"></a><a href="' . $link_button . '" class="button-absolute" style="' . $styles . '">' . $text_button . '</a></div>' . "\n";
            $firstImage++;
        } else {
            $html .= '<div class="carousel-item"><a href="' . $link_image . '"><img ' . $attributes . ' class="img-fluid w-100"></a><a href="' . $link_button . '" class="button-absolute " style="' . $styles . '">' . $text_button . '</a></div>' . "\n";
        }
    }

    $html .= '
        </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>';

    echo $html;
?>