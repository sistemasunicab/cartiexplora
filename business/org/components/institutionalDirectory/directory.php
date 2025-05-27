<?php

$numero_de_directorio = 55;
$filas_directorio = obtenerFilas($mysqli1, $sentencia, $numero_de_directorio);

foreach ($filas_directorio as $row_datos_directorio) {
    $html_directorio = '<div class="col-9 p-0 mx-auto d-flex flex-column">';
    $html_directorio .= '<div class="mb-5 container-fluid mx-0 p-0">';
    $html_directorio .= '<div class="col-lg-11 col-md-12 col-sm-12 col-12 p-0 mx-auto d-flex flex-column">';
    $html_directorio .= '<div class="row d-flex flex-row col-12 col-md-8 col-lg-6">';
    $html_directorio .= '<h3-directory class="tx-blue font-roboto-light-title col-12 mb-3">' . $row_datos_directorio['titulo'] . '</h3-directory>';
    $html_directorio .= '</div>';
    $html_directorio .= '<div class="row col-lg-8 col-md-12 col-sm-12 col-12 mx-auto d-flex flex-column">';
    $html_directorio .= '<h4-directory class="col-lg-9 col-md-12 col-sm-12 col-12 tx-orange font-roboto-light my-auto text-center mb-3 mb-lg-0 mt-3 mt-lg-5">Escríbenos o Llámanos</h4-directory>';

    // Imagen de búsqueda
    $img_buscar = obtenerFilas($mysqli1, $sentencia, 60);
    $image_path = count($img_buscar) ? rutaPorNivel($img_buscar[0]['ruta']) : '';   
    $alt = $img_buscar[0]['textoAlterno'] ?? 'Buscar';

    // Imagen de contacto
    $img_contacto = obtenerFilas($mysqli1, $sentencia, 135);
    $image_path_contacto = count($img_contacto) ? rutaPorNivel($img_contacto[0]['ruta']) : '';
    $alt_contacto = $img_contacto[0]['textoAlterno'] ?? 'Contacto';

    $html_directorio .= '<div class="d-flex flex-column flex-lg-row justify-content-between">';
    $html_directorio .= '<div class="position-relative h-auto m-auto d-inline-block col-lg-9 col-md-9 col-sm-12 col-12">';
    $html_directorio .= '<input type="text" class="search font-roboto-blackitalic form-control text-center py-3 py-lg-4 pe-lg-5 border-bold-blue border-2" placeholder="Buscar por nombre">';
    $html_directorio .= '<img src="' . $image_path . '" class="img-fluid d-lg-block d-none position-absolute end-0 top-50 translate-middle-y me-4" alt="' . $alt . '" width="40px">';
    $html_directorio .= '</div>';
    $html_directorio .= '<img src="' . $image_path_contacto . '" class="img-fluid col-lg-2 col-md-2 col-sm-3 col-4 mx-auto mt-lg-0 mt-3" alt="' . $alt_contacto . '">';
    $html_directorio .= '</div>';
    $html_directorio .= '</div>';   
    $html_directorio .= '</div>';
    $html_directorio .= '</div>';

    // Encabezados dinámicos con íconos
    $icons_data = obtenerFilas($mysqli1, $sentencia, 61);
    $icons = [];

    foreach ($icons_data as $icon) {
        $icons[] = [
            'path' => rutaPorNivel($icon['ruta']),
            'title' => $icon['titulo']
        ];
    }

    $html_directorio .= '<div class="row container-fluid mb-5 mx-0 p-0">';
    $html_directorio .= '<div class="table-responsive-lg">';
    $html_directorio .= '<table id="datos-empelados" class="table table-bordered text-center">';
    $html_directorio .= '<thead class="bg-bold-blue text-white"><tr>';
    foreach ($icons as $icon) {
        $html_directorio .= '<th>
            <div class="d-flex flex-row align-items-center justify-content-center">
                <img class="me-3 my-1" src="' . $icon['path'] . '" width="30px">
                <p-directory class="mb-auto fw-normal"> ' . $icon['title'] . ' </p-directory>
            </div>
        </th>';
    }
    $html_directorio .= '</tr></thead><tbody>';
    for ($i = 0; $i < 4; $i++) {
        $html_directorio .= '<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
    }
    $html_directorio .= '</tbody></table></div>';

    $html_directorio .= '</div>';
    // Imagen inferior con texto
    $img_horarios = obtenerFilas($mysqli1, $sentencia, 104);
    if (!empty($img_horarios)) {
        $img = $img_horarios[0];
        $ruta = rutaPorNivel($img['ruta']);
        $alt = $img['textoAlterno'] ?? 'Imagen';
        $titulo = $img['titulo'];

        $html_directorio .= '<div class="row container-fluid mx-0 p-0">';
        $html_directorio .= '<div id="horarios" class="col-10 p-0 mx-auto d-flex flex-lg-row flex-column justify-content-between">';
        $html_directorio .= '<div class="mb-4 mb-lg-0 mx-auto ms-lg-0 col-lg-6 col-md-6 col-sm-8 col-12 d-flex flex-column">';
        $html_directorio .= '<img src="' . $ruta . '" class="h-auto" alt="' . $alt . '">';
        $html_directorio .= '</div>';
        $html_directorio .= '<h4-directory class="col-lg-5 col-md-12 col-sm-12 col-12 font-roboto-black text-center text-lg-start my-auto"><b>' . $titulo . '</b></h4-directory>';
        $html_directorio .= '</div>';
        $html_directorio .= '</div>';
    }

    $html_directorio .= '</div>';
}
?>

<div class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?php echo $html_directorio; ?>
    </div>
</div>

