<?php
// 1) Comprobamos si hay filas para la sección “Sobre Nosotros” (sentencia 45)
$rowsCheck = obtenerFilas($mysqli1, $sentencia, 45);

$html_nosotrosImgUno = '';
if (!empty($rowsCheck)) {
    $html_nosotrosImgUno .= '
        <div class="bg-light-gray-o26 space-between-about p-0 d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-12 p-0 d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-center my-ws my-lg-0">';
            
    // 2) Obtenemos las imágenes (sentencia 40)
    $rowsImages = obtenerFilas($mysqli1, $sentencia, 40);

    // Definimos una única clase base que se aplica a cada <img>
    $baseClass = 'img-fluid p-2 p-md-3 p-lg-0';

    // 3) Recorremos cada fila y construimos el <img>
    foreach ($rowsImages as $rowImg) {
        $path_image = rutaPorNivel($rowImg['ruta']);
        $altText    = $rowImg['textoAlterno'];

        $html_nosotrosImgUno .= '
                <div class="d-flex flex-column p-lg-0 col-lg-4 col-md-6 col-sm-6 col-6 mx-auto">
                    <img 
                        class="' . $baseClass . '" 
                        src="'   . $path_image  . '" 
                        alt="'   . $altText    . '"
                    >
                </div>';
    }

    $html_nosotrosImgUno .= '
            </div>
        </div>';
}
?>

<div class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?= $html_nosotrosImgUno ?>
    </div>
</div>
