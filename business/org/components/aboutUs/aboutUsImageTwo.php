<?php
$filasNosotrosTitulo = obtenerFilas($mysqli1, $sentencia, 47);

if (!empty($filasNosotrosTitulo)) {

    $filasNosotrosImagenes = obtenerFilas($mysqli1, $sentencia, 42);

    foreach ($filasNosotrosImagenes as $row) {
        $atributosEscritorio        = ImageAttributeBuilder::buildAttributes($nivel, $row['ruta']);
        $atributosMovil             = ImageAttributeBuilder::buildAttributes($nivel, $row['rutaMovil']);
        $atributosTabletaVertical   = ImageAttributeBuilder::buildAttributes($nivel, $row['rutaTabletaVertical']);
        $atributosTabletaHorizontal = ImageAttributeBuilder::buildAttributes($nivel, $row['rutaTabletaHorizontal']);

        $imagenes = [
            ['atributos' => $atributosEscritorio,        'clases' => 'd-lg-inline d-md-none d-sm-none d-none img-fluid w-100'],
            ['atributos' => $atributosMovil,             'clases' => 'd-lg-none d-md-none d-sm-none d-inline img-fluid w-100'],
            ['atributos' => $atributosTabletaVertical,   'clases' => 'd-lg-none d-md-none d-sm-inline d-none img-fluid w-100'],
            ['atributos' => $atributosTabletaHorizontal, 'clases' => 'd-lg-none d-md-inline d-sm-none d-none img-fluid w-100'],
        ];

        $title = $row['titulo'];
        $html_nosotrosImgDos = '<div class="row col-12 mx-auto p-0 m-0">';
        $html_nosotrosImgDos .= '<div class="col-1 p-0 m-0"></div>';
        // Título en una fila completa centrada
        $html_nosotrosImgDos .= '
            <div class="col-9 tx-blue font-roboto-light-title mb-ws p-0 m-0">
                <h1-nosotros>' . $title . '</h1-nosotros>
            </div>';

        $html_nosotrosImgDos .= '<div class="col-2 p-0 m-0"></div>';
        $html_nosotrosImgDos .= '</div>';

        $html_nosotrosImgDos .= '<div class="row col-12 mx-auto p-0 m-0">';
        // Imágenes en una columna centrada
        $html_nosotrosImgDos .= '<div class="col-12 mx-auto p-0 d-flex flex-column align-items-center">';
        foreach ($imagenes as $img) {
            $html_nosotrosImgDos .= '<img ' . $img['atributos'] . ' class="' . $img['clases'] . '">';
        }
        $html_nosotrosImgDos .= '</div>';
        $html_nosotrosImgDos .= '</div>';
    }

    $html_nosotrosImgDos .= '</div>'; // Cierra row
}
?>

<div class="container-fluid my-ws mx-0 p-0">
    <?= $html_nosotrosImgDos?>
</div>
