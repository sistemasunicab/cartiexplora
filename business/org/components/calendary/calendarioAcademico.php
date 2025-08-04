<?php
    // Inicializamos las variables de cada fila
    $html_row_one   = '';
    $html_row_two   = '';
    $html_base      = '';

    //Se obtiene el enlace del calendario
    $exe_calendario = $mysqli1->query($sentencia . "163");
    while ($row_calendario = $exe_calendario->fetch_assoc()) {
        $sql_calendario = $row_calendario['campos'] . $row_calendario['tablas'] . $row_calendario['condiciones'];
    }

    $res_calendario = $mysqli1->query($sql_calendario);
    while ($row_pdf = $res_calendario->fetch_assoc()) {
        $link_calendario = $row_pdf['link'];
    }

    // 1) Obtenemos datos de calendario (sentencia #56)
    $rowsCalendary = obtenerFilas($mysqli1, $sentencia, 56);

    if (!empty($rowsCalendary)) {
        foreach ($rowsCalendary as $row_data_calendary) {
            // Fila uno: título
            $html_row_one  = '<div class="row p-0 m-0">';
            $html_row_one .= '<div class="col-lg-1 col-md-2 col-1 p-0 m-0"></div>';
            $html_row_one .= '<div class="p-0 col-lg-10 col-md-7 col-7">';
            $html_row_one .= '<h2-calendario class="tx-blue font-roboto-light-title">'
                            . $row_data_calendary['titulo'] .
                              '</h2-calendario>';
            $html_row_one .= '</div>';
            $html_row_one .= '<div class="col-lg-1 col-md-3 col-4 p-0 m-0"></div>';
            $html_row_one .= '</div>';            

            // 2) Obtenemos datos de la imagen asociada (sentencia #62)
            $rowsImage = obtenerFilas($mysqli1, $sentencia, 62);

            if (!empty($rowsImage)) {
                foreach ($rowsImage as $row_data_image) {
                    $altText    = $row_data_image['textoAlterno'] ?? 'Imagen';
                    $image_path = rutaPorNivel($row_data_image['ruta']);

                    // Fila dos: imagen + botón
                    $html_row_two  = '<div class="row m-0 p-0">';
                    $html_row_two .= '<div class="col-lg-4 col-1 p-0 m-0"></div>';
                    $html_row_two .= '<div class="col-lg-4 col-10 p-0 m-0">';
                    $html_row_two .= '<div class="d-flex flex-column flex-lg-row align-items-center text-center mx-auto mt-5">';
                    $html_row_two .= '<img '
                                    . 'src="' . $image_path . '" '
                                    . 'alt="' . $altText . '" '
                                    . 'class="mb-5 mb-lg-0 mx-auto mx-lg-0 me-lg-5 img-fluid" '
                                    . 'style="width:140px;"'
                                    . '>';
                    $html_row_two .= '<a href="'.$link_calendario.'" target="_blank" '
                                    . 'class="mx-lg-0 mx-auto btn shadow h-auto tx-color-wh btn-calendary fw-semibold" '
                                    . 'style="width:200px;"'
                                    . '>'
                                    . 'Ver'
                                    . '</a>';
                    $html_row_two .= '</div>';
                    $html_row_two .= '</div>';
                    $html_row_two .= '<div class="col-lg-4 col-1 p-0 m-0"></div>';
                    $html_row_two .= '</div>';
                }
            }

            // Concatenamos las dos filas para esta iteración
            $html_base .= $html_row_one . $html_row_two;
        }
    }
?>

<div class="container-fluid my-ws mx-0 p-0">
    <?php echo $html_base; ?>
</div>
