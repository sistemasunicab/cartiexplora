<?php

/**
 * Component of the Unicab HomePage in charge of displaying the academic offer section.
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
$resSentecia = $mysqli1->query($sentencia . "4");

while ($record = $resSentecia->fetch_assoc()) {
    $sqlAcademicOffer = $record['campos'] . $record['tablas'] . $record['condiciones'];
}

$resAcademicOfferSection = $mysqli1->query($sqlAcademicOffer);

while ($record = $resAcademicOfferSection->fetch_assoc()) {

    if ($record['visible'] != 1) {
        return;
    }
    //? Gets the section title and renders it
    echo '<div class="row mt-10 mx-0"><h1 class="col text-center tx-color-bl fw-bold px-0">' . $record['titulo'] . '</h1></div>';
}

//? Search the images in section 2
$resSentecia = $mysqli1->query($sentencia . "2");

while ($record = $resSentecia->fetch_assoc()) {
    $sqlImages = $record['campos'] . $record['tablas'] . $record['condiciones'];
}

$resImages = $mysqli1->query($sqlImages);

?>

<section class="bg-light-gray mt-4 py-3">
    <div class="row justify-content-center gap-5 mx-0 academic-offer-img">
        <?php
        //? Render the images
        $html = '';
        while ($record = $resImages->fetch_assoc()) {
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $record['ruta'], $record['descripcion'], $record['rutaEncima']);
            $html .= '<img ' . $attributes . ' class="img-fluid col-2" />' . "\n";
        }
        echo $html;
        ?>
    </div>
</section>