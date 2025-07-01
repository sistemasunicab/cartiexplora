<?php
$filasInfoCheck = obtenerFilas($mysqli1, $sentencia, 48);

if (!empty($filasInfoCheck)) {
    $html_info = '<div class="row m-0 p-0">';
    $html_info .= '<div class="d-flex flex-column flex-lg-row justify-content-between col-10 mx-auto">';

    $filasInfoContenido = obtenerFilas($mysqli1, $sentencia, 43);

    foreach ($filasInfoContenido as $row) {
        $ruta       = $row['ruta'];
        $altern     = $row['textoAlterno'];
        $descripcion = $row['descripcion'];
        $titulo     = $row['titulo'];

        $path_image = rutaPorNivel($ruta);

        $html_info .= '<div class="col-10 col-lg-3 mx-auto mx-lg-0 font-roboto-regular d-flex flex-column">';
        $html_info .= '<img class="col-2 image-info-about-us" src="' . $path_image . '" alt="' . $altern . '">';
        $html_info .= '<div class="mb-3 col-12">';
        $html_info .= '<div class="d-flex flex-column">';
        $html_info .= '<h3-nosotros class="tx-orange font-roboto-light-title ps-3">' . $titulo . '</h3-nosotros>';
        $html_info .= '<p-nosotros-1 class="about-line-left font-roboto-regular pt-3 px-2 ps-3 position-relative">' . $descripcion . '</p-nosotros>';
        $html_info .= '</div>';
        $html_info .= '</div>';
        $html_info .= '</div>';
    }

    $html_info .= '</div>';
    $html_info .= '</div>';
}
?>

<div class="container-fluid my-ws mx-0 p-0">
    <?php
    echo $html_info ?? '';
    ?>
</div>
