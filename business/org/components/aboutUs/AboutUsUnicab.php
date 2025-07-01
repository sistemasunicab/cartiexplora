<?php
// Usamos obtenerFilas para cargar los datos de la sección “Sobre Nosotros”
$rowsTexto    = obtenerFilas($mysqli1, $sentencia, 44);
$rowsImagenes = obtenerFilas($mysqli1, $sentencia, 39);

$html_nosotros = '';

if (!empty($rowsTexto)) {

    
    // 1) Columnas de texto (sentencia 44)
    foreach ($rowsTexto as $row) {
        $titulo = $row['titulo'];
        $texto  = $row['texto'];
        $html_row_one = '<div class="row col-12 mx-auto p-0 m-0">';
        $html_row_one .= '<div class="col-lg-1 col-1 p-0"></div>';
        $html_row_one .= '<div class="col-lg-7 col-9 p-0">';
        $html_row_one .= '  <h2-nosotros class="font-roboto-light-title tx-blue text-start">'
                            . $titulo .
                            '</h2-nosotros>';
        $html_row_one .= '</div>';
        $html_row_one .= '<div class="col-lg-4 col-2 p-0"></div>';
        $html_row_one .= '</div>';
            
        $html_row_two = '<div class="row col-12 p-0 m-0">';
        $html_row_two .= '<div class="col-lg-1 col-1 p-0"></div>';
        $html_row_two .= '<div class="col-lg-6 col-10 p-0 mt-ws mb-lg-0 mb-5">';
        $html_row_two .= '<div class="col-lg-11 col-12 p-0">';
        $html_row_two .=    '<p-nosotros class="font-roboto-regular tx-black">'
                                . $texto .
                            '</p-nosotros>';
        $html_row_two .= '</div>';
        $html_row_two .= '</div>';
        $html_row_two .= '<div class="d-lg-none col-1 p-0"></div>';
    }
    // 2) Columna de imágenes (sentencia 39)
    if (!empty($rowsImagenes)) {
        foreach ($rowsImagenes as $rowImg) {
            $html_row_two .= '<div class="d-lg-none col-1 p-0"></div>';
            $html_row_two .= '<div class="col-lg-4 col-10 p-0 d-flex flex-column justify-content-end ">';

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
                $html_row_two .= '<img ' . $img['atributos'] . ' class="' . $img['clases'] . '">';
            }
            $html_row_two .= '</div>';
        }
    }
    $html_row_two .= '<div class="col-lg-1 col-1 p-0"></div>';
    $html_row_two .= '</div>';

    $html_nosotros .= $html_row_one;
    $html_nosotros .= $html_row_two;
}
?>

<div class="container-fluid my-ws mx-0 p-0">
    <?= $html_nosotros ?>
</div>
