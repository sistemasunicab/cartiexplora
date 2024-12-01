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
$res_sentecia = $mysqli1->query($sentencia . "4");

while ($row_sentencia = $res_sentecia->fetch_assoc()) {
    $sql_academic_offer = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
}

$res_academic_offer = $mysqli1->query($sql_academic_offer);

while ($row_data = $res_academic_offer->fetch_assoc()) {

    if ($row_data['visible'] != 1) {
        return;
    }
    //? Gets the section title and renders it
    echo '<div class="row mt-10 mx-0"><h1 class="col text-center tx-color-bl fw-bold px-0">' . $row_data['titulo'] . '</h1></div>';
}

//? Search the images in section 2
$res_sentecia = $mysqli1->query($sentencia . "2");

while ($row_sentencia = $res_sentecia->fetch_assoc()) {
    $sql_images = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
}

$res_images = $mysqli1->query($sql_images);

?>

<section class="bg-light-gray mt-4 py-3">
    <div class="row justify-content-center gap-5 mx-0 academic-offer-img">
        <?php
        //? Render the images
        $html = '';
        while ($row_images = $res_images->fetch_assoc()) {
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $row_images['ruta'], $row_images['descripcion'], $row_images['rutaEncima']);
            $html .= '<a href="" class="col-2"><img ' . $attributes . ' class="img-fluid" /></a>' . "\n";
        }
        echo $html;
        ?>
    </div>
</section>