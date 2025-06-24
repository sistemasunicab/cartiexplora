<?php
$html_communication = '';

// 1) Verificar si la sección está visible (sentencia #58)
$rowsVisible = obtenerFilas($mysqli1, $sentencia, 58);

if (!empty($rowsVisible)) {
    foreach ($rowsVisible as $row_data_visible) {
        // 2) Obtener la imagen del ícono (sentencia #64)
        $rowsIcon = obtenerFilas($mysqli1, $sentencia, 64);
        $icon_path = '';
        if (!empty($rowsIcon)) {
            // Usamos solo la primera fila si hay varias (asumimos un solo ícono)
            $rutaIcono = $rowsIcon[0]['ruta'] ?? '';
            $icon_path = rutaPorNivel($rutaIcono);
        }

        // 3) Obtener los archivos de la tabla (sentencia #66)
        $rowsFiles = obtenerFilas($mysqli1, $sentencia, 66);

        $html_communication  = '<div class="col-lg-7 col-md-7 col-sm-9 col-9 mx-auto d-flex flex-column p-0">';
        $html_communication .= '  <div class="d-flex flex-column col-lg-10 col-md-10 col-sm-12 col-12 m-auto">';
        $html_communication .= '    <h2-calendario class="font-roboto-bold tx-blue m-auto mb-ws">'
                             . htmlspecialchars($row_data_visible['titulo'], ENT_QUOTES, 'UTF-8') .
                             '</h2-calendario>';
        $html_communication .= '<div class="d-flex flex-column gap-lg-5 gap-4">';
        if (!empty($rowsFiles)) {
            foreach ($rowsFiles as $row_data_files) {
                $nombreArchivo = htmlspecialchars($row_data_files['nombrArchivo'] ?? 'Documento sin título', ENT_QUOTES, 'UTF-8');
                $fechaArchivo  = htmlspecialchars($row_data_files['fechaSubida'] ?? 'Fecha no disponible', ENT_QUOTES, 'UTF-8');
                $rutaArchivo   = $row_data_files['ruta'] ?? '';
                $archivo_path  = rutaPorNivel($rutaArchivo);

                $html_communication .= '    <div class="row file-container d-flex align-items-center justify-content-between">';
                // Lado izquierdo: texto (nombre y fecha)
                $html_communication .= '      <div class="col-7 d-flex flex-column text-start">';
                $html_communication .= '        <p-calendario class="font-roboto-bold mb-0">' . $nombreArchivo . '</p-calendario>';
                $html_communication .= '        <p-calendario class="font-roboto-bold mb-0">' . $fechaArchivo . '</p-calendario>';
                $html_communication .= '      </div>';
                // Lado derecho: ícono + botón
                $html_communication .= '      <div class="col-5 d-flex flex-lg-row flex-column align-items-end">';
                $html_communication .= '        <img src="' . $icon_path . '" alt="PDF" class="fluid-img mx-auto col-lg-3 col-md-4 col-sm-5 col-4 my-auto mb-lg-auto mb-3 mb-lg-0 me-lg-3">';
                $html_communication .= '        <button class="my-auto mx-auto btn shadow h-auto tx-color-wh btn-calendary fw-semibold btn-route" '
                                      . 'style="width:100px;" data-ruta="' . $archivo_path . '">Ver</button>';
                $html_communication .= '      </div>';
                $html_communication .= '    </div>';
            }
        }
        $html_communication .= '</div>';
        $html_communication .= '  </div>';
        $html_communication .= '</div>';
    }
}
?>

<div id="comunicados" class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?= $html_communication ?>
    </div>
</div>
