<?php
$numero_de_sentencia_educacion = "37";
$res_sentencia_educacion = $mysqli1->query($sentencia . $numero_de_sentencia_educacion);
while ($row_sentencia_educacion = $res_sentencia_educacion->fetch_assoc()) {
    $condiciones_educacion = str_replace('||', '\'\'', $row_sentencia_educacion['condiciones']);
    $sql_datos_educacion = $row_sentencia_educacion['campos'] . $row_sentencia_educacion['tablas'] . $condiciones_educacion;
}

$res_datos_educacion = $mysqli1->query($sql_datos_educacion);

if ($res_datos_educacion->num_rows > 0) {
    $html_educacion = '<div class="educacion">';
    $html_educacion .= '<div class="container-educacion">';

    while ($row_datos_educacion = $res_datos_educacion->fetch_assoc()) {
        $html_educacion .= '<div class="titles">';
        $html_educacion .= '<h2>' . $row_datos_educacion['titulo'] . '</h2>';
        $html_educacion .= '<h3>' . $row_datos_educacion['subTitulo'] . '</h3>';
        $html_educacion .= '</div>';
    }

    $numero_de_sentencia_educacion = "32";
    $res_sentencia_educacion = $mysqli1->query($sentencia . $numero_de_sentencia_educacion);
    while ($row_sentencia_educacion = $res_sentencia_educacion->fetch_assoc()) {
        $condiciones_educacion = str_replace('||', '\'\'', $row_sentencia_educacion['condiciones']);
        $sql_datos_educacion = $row_sentencia_educacion['campos'] . $row_sentencia_educacion['tablas'] . $condiciones_educacion;
    }

    $res_datos_educacion = $mysqli1->query($sql_datos_educacion);

    $html_educacion .= '<div class="educacion-data">';
    while ($row_datos_educacion = $res_datos_educacion->fetch_assoc()) {
        
        $path = $row_datos_educacion['ruta'];
        $altern = $row_datos_educacion['textoAlterno'];
        $descripcion = $row_datos_educacion['descripcion'];
        $titulo = $row_datos_educacion['titulo'];
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
        $html_educacion .= '<div class="educacion-item">';
        $html_educacion .= '<img src="' . $path_image . '" alt="' . $altern . '">';
        $html_educacion .= '<div class="educacion-item-data">';
        $html_educacion .= '<h3>' . $titulo . '</h3>';
        $html_educacion .= '<p class="special-paragraph">' . $descripcion . '</p>';
        $html_educacion .= '</div>';
        $html_educacion .= '</div>';
    }
    $html_educacion .= '</div>';

    $html_educacion .= '</div>';
    $html_educacion .= '</div>';

    echo $html_educacion;
}
?>