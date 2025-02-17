<?php
$numero_de_sentencia_info = "39";
$res_sentencia_info = $mysqli1->query($sentencia . $numero_de_sentencia_info);
while ($row_sentencia_info = $res_sentencia_info->fetch_assoc()) {
    $condiciones_info = str_replace('||', '\'\'', $row_sentencia_info['condiciones']);
    $sql_datos_info = $row_sentencia_info['campos'] . $row_sentencia_info['tablas'] . $condiciones_info;
}

$res_datos_info = $mysqli1->query($sql_datos_info);

if ($res_datos_info->num_rows > 0) {
    $html_info = '';

    $html_info = '<div class="info">';
    $html_info .= '<div class="container-info">';

    $numero_de_sentencia_info = "34";
    $res_sentencia_info = $mysqli1->query($sentencia . $numero_de_sentencia_info);
    while ($row_sentencia_info = $res_sentencia_info->fetch_assoc()) {
        $condiciones_info = str_replace('||', '\'\'', $row_sentencia_info['condiciones']);
        $sql_datos_info = $row_sentencia_info['campos'] . $row_sentencia_info['tablas'] . $condiciones_info;
    }

    $res_datos_info = $mysqli1->query($sql_datos_info);
    while ($row_datos_info = $res_datos_info->fetch_assoc()) {
        $path = $row_datos_info['ruta'];
        $altern = $row_datos_info['textoAlterno'];
        $descripcion = $row_datos_info['descripcion'];
        $titulo = $row_datos_info['titulo'];
        $path_image = '';
        if ($nivel == "raiz") {
            $path_image = $path;
        } else if ($nivel == "uno") {
            $path_image = '../' . $path;
        } else if ($nivel == "dos") {
            $path_image = '../../' . $path;
        } else if ($nivel == "tres") {
            $path_image = '../../../' . $path;
        }

        $html_info .= '<div class="info-item">';
        $html_info .= '<img src="' . $path_image . '" alt="' . $altern . '">';
        $html_info .= '<div class="info-item-data">';
        $html_info .= '<h3>' . $titulo . '</h3>';
        $html_info .= '<p class="special-paragraph">' . $descripcion . '</p>';
        $html_info .= '</div>';
        $html_info .= '</div>';
    }


    echo $html_info;
}
?>