<?php
// 1) VERIFICAR SI LA SECCIÓN ESTÁ VISIBLE (Sentencia #48)
$number_sentence_visible = "58";
$res_sentence_visible = $mysqli1->query($sentencia . $number_sentence_visible);

while ($row_sentence_visible = $res_sentence_visible->fetch_assoc()) {
    $conditions_visible = str_replace('|', '\'', $row_sentence_visible['condiciones']);
    $sql_data_visible = $row_sentence_visible['campos'] . $row_sentence_visible['tablas'] . $conditions_visible;
}
$res_data_visible = $mysqli1->query($sql_data_visible);

// SOLO MOSTRAR EL CONTENIDO SI LA SECCIÓN ESTÁ VISIBLE
while ($row_data_visible = $res_data_visible->fetch_assoc()) {

    // 2) OBTENER LA IMAGEN DEL ÍCONO (Sentencia #50)
    $number_sentence_icon = "64";
    $res_sentence_icon = $mysqli1->query($sentencia . $number_sentence_icon);

    while ($row_sentence_icon = $res_sentence_icon->fetch_assoc()) {
        $conditions_icon = str_replace('|', '\'', $row_sentence_icon['condiciones']);
        $sql_data_icon = $row_sentence_icon['campos'] . $row_sentence_icon['tablas'] . $conditions_icon;
    }

    $res_data_icon = $mysqli1->query($sql_data_icon);
    $icon_path = ''; // Ruta final del ícono

    while ($row_data_icon = $res_data_icon->fetch_assoc()) {
        $rutaIcono = $row_data_icon['ruta'] ?? '';
        // Determina la ruta según la variable $nivel
        if ($nivel == "raiz") {
            $icon_path = $rutaIcono;
        } else if ($nivel == "uno") {
            $icon_path = '../' . $rutaIcono;
        } else if ($nivel == "dos") {
            $icon_path = '../../' . $rutaIcono;
        } else if ($nivel == "tres") {
            $icon_path = '../../../' . $rutaIcono;
        }
    }

    // 3) OBTENER LOS ARCHIVOS DE LA TABLA (Sentencia #52)
    $number_sentence_files = "66";
    $res_sentence_files = $mysqli1->query($sentencia . $number_sentence_files);

    while ($row_sentence_files = $res_sentence_files->fetch_assoc()) {
        $conditions_files = str_replace('|', '\'', $row_sentence_files['condiciones']);
        $sql_data_files = $row_sentence_files['campos'] . $row_sentence_files['tablas'] . $conditions_files;
    }

    $res_data_files = $mysqli1->query($sql_data_files);

    // CONTENEDOR PRINCIPAL
    $html_communication = '<div class="col-lg-7 col-md-7 col-sm-9 col-9 mx-auto my-5 d-flex flex-column p-0">';
    $html_communication .= '    <div class="d-flex flex-column col-lg-10 col-md-10 col-sm-12 col-12 m-auto">';

    // TÍTULO DE LA SECCIÓN (POR EJEMPLO "COMUNICADOS")
    $html_communication .= '<h2 class="font-roboto-bold tx-blue m-auto">'. $row_data_visible['titulo']. '</h2>';

    // RECORRER CADA ARCHIVO DE LA TABLA
    while ($row_data_files = $res_data_files->fetch_assoc()) {
        // Información del archivo
        $nombreArchivo = htmlspecialchars($row_data_files['nombrArchivo'] ?? 'Documento sin título');
        $fechaArchivo = htmlspecialchars($row_data_files['fechaSubida'] ?? 'Fecha no disponible');
        $rutaArchivo = $row_data_files['ruta'] ?? '';

        // Ajustar la ruta según el nivel
        $archivo_path = '';
        if ($nivel === 'raiz') {
            $archivo_path = $rutaArchivo;
        } else if ($nivel === 'uno') {
            $archivo_path = '../' . $rutaArchivo;
        } else if ($nivel === 'dos') {
            $archivo_path = '../../' . $rutaArchivo;
        } else if ($nivel === 'tres') {
            $archivo_path = '../../../' . $rutaArchivo;
        }

        // Estructura: Ícono + Texto + Botón
        $html_communication .= '  <div class="file-container d-flex align-items-center justify-content-between my-10">';

        // Lado izquierdo: texto (nombre y fecha)
        $html_communication .= '    <div class="col-7 d-flex flex-column text-start">';
        $html_communication .= '      <p class="font-roboto-bold mb-0">' . $nombreArchivo . '</p>';
        $html_communication .= '      <p class="font-roboto-bold mb-0">' . $fechaArchivo . '</p>';
        $html_communication .= '    </div>';

        // Lado derecho: ícono + botón
        $html_communication .= '    <div class="col-5 d-flex flex-md-row flex-column align-items-end">';
        $html_communication .= '      <img src="' . $icon_path . '" alt="PDF" class="fluid-img mx-auto col-lg-4 col-md-4 col-sm-5 col-5 my-auto mb-md-auto mb-3 mb-md-0 me-md-3">';
        // Usar data-ruta para el botón (si usarás JavaScript para descargar)
        $html_communication .= '      <button class="my-auto mx-auto btn shadow h-auto tx-color-wh btn-calendary fw-semibold btn-route" '
            . 'style="width:100px;" data-ruta="' . $archivo_path . '">Ver</button>';
        $html_communication .= '    </div>';

        $html_communication .= '  </div>';
    }
    $html_communication .= '    </div>'; // cierra w-80 m-auto pt-5 pb-5
    $html_communication .= '</div>';     // cierra w-60 m-auto m-block-15 d-flex flex-column
}
?>

<div id="comunicados" class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_communication;
        ?>
    </div>
</div>