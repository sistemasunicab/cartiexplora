<?php

/**
 * Component of the Unicab HomePage in charge of displaying the image carousel.
 * 
 * @author Cristian Ortiz
 */

if ($nivel == "raiz") {
    require('business/repositories/1cc2s4Home.php');
} else if ($nivel == "uno") {
    require('../business/repositories/1cc2s4Home.php');
} else if ($nivel == "dos") {
    require('../../business/repositories/1cc2s4Home.php');
} else if ($nivel == "tres") {
    require('../../../business/repositories/1cc2s4Home.php');
}

//? Verify that the section is visible
$res_sentecia = $mysqli1->query($sentencia . "5");

while ($row_sentencia = $res_sentecia->fetch_assoc()) {
    $sql_banner = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
}

$res_banner = $mysqli1->query($sql_banner);

while ($row_data = $res_banner->fetch_assoc()) {
    if ($row_data['visible'] != 1) {
        return;
    }
}

//? Search the banner images
$res_sentecia = $mysqli1->query($sentencia . "6");

while ($row_sentencia = $res_sentecia->fetch_assoc()) {
    $sql_images = $row_sentencia['campos'] . $row_sentencia['tablas'];
}

$res_images = $mysqli1->query($sql_images);
$rows_images = [];

while ($row_image = $res_images->fetch_assoc()) {
    $rows_images[] = $row_image;
}

?>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        //? Generate one carousel indicator per image
        $html = '';
        $image_number = 0;

        for($i = 0; $i < sizeof($rows_images); $i++){
            if($rows_images[$i]['visible'] != 1) continue;
            $image_number++;
        }
        
        //? The first indicator generated must have the class active, the rest must not.
        for ($j = 0; $j < $image_number; $j++) {
            if ($j == 0) {
                $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
            } else {
                $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $j . '" aria-label="Slide ' . ($j + 1) . '"></button>';
            }
        }
        echo $html;
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        //? Renders a carousel item with its components
        $firstImage = 0;
        $html = '';
        for ($i = 0; $i < sizeof($rows_images); $i++) {
            if ($rows_images[$i]['visible'] != 1) continue;
            if ($rows_images[$i]['linkImagen'] == '') $link_image = '';
            
            $link_image = $rows_images[$i]['linkImagen'];
            $link_button = $rows_images[$i]['linkBoton'];
            $text_button = $rows_images[$i]['textoBoton'];
            $styles = ButtonStylesBannerBuilder::buildStyles($rows_images[$i]['color'], $rows_images[$i]['transparencia'], $rows_images[$i]['porcentajeTop'], $rows_images[$i]['porcentajeLeft']);
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $rows_images[$i]['ruta']);
            

            //? The first item in the carousel must have the active class, the rest must not.
            if ($firstImage  == 0) {
                $html .= '<div class="carousel-item active"><a href="' . $link_image . '"><img ' . $attributes . ' class="img-fluid"></a><a href="' . $link_button . '" class="button-absolute" style="' . $styles . '">' . $text_button . '</a></div>' . "\n";
                $firstImage++;
            } else {
                $html .= '<div class="carousel-item"><a href="' . $link_image . '"><img ' . $attributes . ' class="img-fluid"></a><a href="' . $link_button . '" class="button-absolute " style="' . $styles . '">' . $text_button . '</a></div>' . "\n";
            }
        }
        echo $html;
        ?>
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


<!-- 
<br>
<br>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href=""><img src="../cartiexplora/assets/img/banner.png" class="img-fluid"></a>
            <a href="#" class="button-absolute"
                style=" 
            background: rgba(0, 0, 0, 0.7);
            top: 82%;
            left: 50%;
            color: var(--white);
            ">Prueba de Boton</a>
        </div>
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
-->