<?php
// Usamos obtenerFilas para cargar los datos de la sección “Sobre Nosotros”
$rowsTexto    = obtenerFilas($mysqli1, $sentencia, 44);
$rowsImagenes = obtenerFilas($mysqli1, $sentencia, 39);

$html_nosotros = '';

if (!empty($rowsTexto)) {
    // Contenedor tipo row
    $html_nosotros .= '<div class="row col-12 mx-auto p-0 m-0">';

    // 1) Columnas de texto (sentencia 44)
    foreach ($rowsTexto as $row) {
        $titulo = $row['titulo'];
        $texto  = $row['texto'];

        $html_nosotros .= '
            <div class="col-0 col-lg-1 p-0"></div>
            <div class="col-10 col-lg-6 d-flex flex-column p-0 mx-auto mx-lg-0">
                <h2-nosotros class="col-lg-11 col-12 font-roboto-light-title tx-blue text-start">'
                    . $titulo .
                '</h2-nosotros>
                <p-nosotros class="col-lg-10 col-12 font-roboto-regular tx-black mt-ws b-5 text-start">'
                    . $texto .
                '</p-nosotros>
            </div>';
    }
    // 2) Columna de imágenes (sentencia 39)
    if (!empty($rowsImagenes)) {
        foreach ($rowsImagenes as $rowImg) {
            $html_nosotros .= '<div class="col-10 col-lg-4 mt-ws mt-lg-0 mx-auto mx-lg-0 p-0 d-flex flex-column justify-content-end ">';

            // Construimos atributos para cada versión de imagen
            $attrEscritorio        = ImageAttributeBuilder::buildAttributes($nivel, $rowImg['ruta']);
            $attrMovil             = ImageAttributeBuilder::buildAttributes($nivel, $rowImg['rutaMovil']);
            $attrTabletaVertical   = ImageAttributeBuilder::buildAttributes($nivel, $rowImg['rutaTabletaVertical']);
            $attrTabletaHorizontal = ImageAttributeBuilder::buildAttributes($nivel, $rowImg['rutaTabletaHorizontal']);

            $imagenes = [
                ['atributos' => $attrEscritorio,        'clases' => 'd-lg-inline d-none img-fluid w-100 mx-auto'],
                ['atributos' => $attrMovil,             'clases' => 'd-inline d-sm-none d-md-none d-lg-none img-fluid w-100 mx-auto'],
                ['atributos' => $attrTabletaVertical,   'clases' => 'd-sm-inline d-none d-md-none d-lg-none img-fluid w-100 mx-auto'],
                ['atributos' => $attrTabletaHorizontal, 'clases' => 'd-md-inline d-none d-lg-none img-fluid w-100 mx-auto'],
            ];

            foreach ($imagenes as $img) {
                $html_nosotros .= '<img ' . $img['atributos'] . ' class="' . $img['clases'] . '">';
            }
            $html_nosotros .= '</div>';
        }
        $html_nosotros .= '<div class="col-0 col-lg-1 p-0"></div>';
    }

    $html_nosotros .= '</div>';
}
?>

<div class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?= $html_nosotros ?>
    </div>
</div>
