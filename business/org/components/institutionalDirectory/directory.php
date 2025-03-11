<?php
$numero_de_directorio = "55";//78
$res_directorio = $mysqli1->query($sentencia . $numero_de_directorio);
while ($row_directorio = $res_directorio->fetch_assoc()) {
    $condiciones_directorio = str_replace('|', '\'', $row_directorio['condiciones']);
    $sql_datos_directorio = $row_directorio['campos'] . $row_directorio['tablas'] . $condiciones_directorio;
}

$res_datos_directorio = $mysqli1->query($sql_datos_directorio);

while ($row_datos_directorio = $res_datos_directorio->fetch_assoc()) {
    $html_directorio = '<div class="col-9 my-5 p-0 mx-auto d-flex flex-column">';
    $html_directorio .= '<div class="col-11 my-5 p-0 mx-auto d-flex flex-column">';
    $html_directorio .= '<h3 class="tx-blue mb-5 font-roboto-light-title">' . $row_datos_directorio['titulo'] . '</h3>';
    $html_directorio .= '<h4 class="tx-orange font-roboto-light m-auto text-center mb-4">Escríbenos o Llámanos</h4>';

    $number_sentence_image = "60";//79
    $res_sentence_image = $mysqli1->query($sentencia . $number_sentence_image);

    while ($row_sentence_image = $res_sentence_image->fetch_assoc()) {
        $conditions_image = str_replace('|', '\'', $row_sentence_image['condiciones']);
        $sql_data_image = $row_sentence_image['campos'] . $row_sentence_image['tablas'] . $conditions_image;
    }

    $res_data_image = $mysqli1->query($sql_data_image);

    while ($row_data_image = $res_data_image->fetch_assoc()) {
        $ruta = htmlspecialchars($row_data_image['ruta']);
        $alt = htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen'); // Default alt text

        // Determine the correct path based on the $nivel variable
        $image_path = '';
        if ($nivel == "raiz") {
            $image_path = $ruta;
        } else if ($nivel == "uno") {
            $image_path = '../' . $ruta;
        } else if ($nivel == "dos") {
            $image_path = '../../' . $ruta;
        } else if ($nivel == "tres") {
            $image_path = '../../../' . $ruta;
        }
    }
    $html_directorio .= '<div class="position-relative d-inline-block col-8 mx-auto">';
    $html_directorio .= '<input type="text" class="form-control pe-5 border-bold-blue border-2 font-roboto-bold" style="height:80px;" placeholder="Buscar por nombre">';
    $html_directorio .= '<img src="' . $image_path . '" class="position-absolute end-0 top-50 translate-middle-y me-4" alt="Buscar" width="40px">';
    $html_directorio .= '</div>';
    $html_directorio .= '</div>';
    
    $number_sentence_table = "61";//80
    $res_sentence_table = $mysqli1->query($sentencia . $number_sentence_table);

    $icons = [];

    while ($row_sentence_table = $res_sentence_table->fetch_assoc()) {
        $conditions_table = str_replace('|', '\'', $row_sentence_table['condiciones']);
        $sql_data_table = $row_sentence_table['campos'] . $row_sentence_table['tablas'] . $conditions_table;
    }

    // Ejecutamos la consulta para obtener las imágenes de los encabezados
    $res_icons = $mysqli1->query($sql_data_table);

    while ($row_icon = $res_icons->fetch_assoc()) {
        // Determinar la ruta correcta de la imagen según el nivel
        $ruta = htmlspecialchars($row_icon['ruta']);
        $titulo = htmlspecialchars($row_icon['titulo']); // Nombre del encabezado

        if ($nivel == "raiz") {
            $image_path = $ruta;
        } else if ($nivel == "uno") {
            $image_path = '../' . $ruta;
        } else if ($nivel == "dos") {
            $image_path = '../../' . $ruta;
        } else if ($nivel == "tres") {
            $image_path = '../../../' . $ruta;
        }

        // Guardamos la información en un array asociativo
        $icons[] = ['path' => $image_path, 'title' => $titulo];
    }

    // Construcción de la tabla con los encabezados dinámicos
    $html_directorio .= '<table class="table table-bordered text-center">';
    $html_directorio .= '<thead class="bg-bold-blue text-white">';
    $html_directorio .= '<tr>';

    // Generar los encabezados dinámicamente con los íconos obtenidos
    foreach ($icons as $icon) {
        $html_directorio .= '<th><img src="' . $icon['path'] . '" width="30px"> ' . $icon['title'] . '</th>';
    }
    $html_directorio .= '</tr>';
    $html_directorio .= '</thead>';
    $html_directorio .= '<tbody>';
    $html_directorio .= '</tbody>'; // Dejamos el cuerpo vacío por ahora
    $html_directorio .= '</table>';


    
    $html_directorio .= '</div>';

}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_directorio;
        ?>
    </div>
</div>