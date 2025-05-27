<?php
$html_base = '';

// 1) Obtenemos datos de calendario (sentencia #56)
$rowsCalendary = obtenerFilas($mysqli1, $sentencia, 56);

if (!empty($rowsCalendary)) {
    foreach ($rowsCalendary as $row_data_calendary) {
        $html_base = '<div class="p-0 col-9 mx-auto d-flex flex-column">';
        $html_base .= '<h2-calendario class="ms-0 ms-md-5 ms-lg-0 tx-blue font-roboto-light-title">'
                   . $row_data_calendary['titulo'] .
                   '</h2-calendario>';

        // 2) Obtenemos datos de la imagen asociada (sentencia #62)
        $rowsImage = obtenerFilas($mysqli1, $sentencia, 62);

        if (!empty($rowsImage)) {
            foreach ($rowsImage as $row_data_image) {
                $altText    = $row_data_image['textoAlterno'] ?? 'Imagen';
                $image_path = rutaPorNivel($row_data_image['ruta']);

                $html_base .= '<div class="d-flex flex-column flex-lg-row align-items-center text-center mx-auto mt-5">';
                $html_base .= '<img 
                                   src="' . $image_path . '" 
                                   alt="' . $altText . '" 
                                   class="mb-5 mb-lg-0 mx-auto mx-lg-0 me-lg-5 img-fluid" 
                                   style="width:140px;"
                               >';
                $html_base .= '<button 
                                   class="mx-auto ms-0 ms-lg-5 btn shadow h-auto tx-color-wh btn-calendary fw-semibold" 
                                   style="width:200px;"
                               >
                                   Ver
                               </button>';
                $html_base .= '</div>';
                $html_base .= '</div>';
            }
        }
    }
}
?>

<div class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?= $html_base ?>
    </div>
</div>
