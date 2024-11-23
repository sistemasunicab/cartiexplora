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
$resSentecia = $mysqli1->query($sentencia . "5");

while ($record = $resSentecia->fetch_assoc()) {
    $sqlBannerSection = $record['campos'] . $record['tablas'] . $record['condiciones'];
}

$resBannerSection = $mysqli1->query($sqlBannerSection);

while ($record = $resBannerSection->fetch_assoc()) {
    if ($record['visible'] != 1) {
        return;
    }
}

//? Search the images in section 1
$resSentecia = $mysqli1->query($sentencia . "3");

while ($record = $resSentecia->fetch_assoc()) {
    $sqlImages = $record['campos'] . $record['tablas'] . $record['condiciones'];
}

$resImages = $mysqli1->query($sqlImages);
?>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        //? Generate one carousel indicator per image
        //? The first indicator generated must have the class active, the rest must not.
        $html = '';
        $imageNumber = $resImages->num_rows;
        for ($i = 0; $i < $imageNumber; $i++) {
            if ($i == 0) {
                $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
            } else {
                $html .= '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $i . '" aria-label="Slide ' . ($i + 1) . '"></button>';
            }
        }
        echo $html;
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        //? Renders a carousel item with its image tag
        //? The first item in the carousel must have the active class, the rest must not.
        $i = 0;
        $html = '';
        while ($record = $resImages->fetch_assoc()) {
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $record['ruta'], $record['descripcion']);
            if ($i == 0) {
                $html .= '<div class="carousel-item active"><img' . $attributes . 'class="img-fluid"></div>' . "\n";
                $i++;
            } else {
                $html .= '<div class="carousel-item"><img' . $attributes . 'class="img-fluid"/></div>' . "\n";
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