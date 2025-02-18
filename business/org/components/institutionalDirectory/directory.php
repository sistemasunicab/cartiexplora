<?php
$numero_de_sentencia_nosotros = "36";
$res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
    $condiciones_nosotros = str_replace('||', '\'\'', $row_sentencia_nosotros['condiciones']);
    $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
}

$res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

if (mysqli_num_rows($res_datos_nosotros) > 0) {
    $html_nosotrosImgUno = '<div class="nosotrosImagenesUno">';
    $html_nosotrosImgUno .= '<div class="container-nosotrosImgUno">';

    $numero_de_sentencia_nosotros = "31";
    $res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
    while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
        $condiciones_nosotros = str_replace('||', '\'\'', $row_sentencia_nosotros['condiciones']);
        $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
    }

    $res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

    while ($row_datos_nosotros = $res_datos_nosotros->fetch_assoc()) {
        $path = $row_datos_nosotros['ruta'];
        $altern = $row_datos_nosotros['textoAlterno'];
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
        $html_nosotrosImgUno .= '<img src="' . $path_image . '" alt="' . $altern . '">';
    }

    $html_nosotrosImgUno .= '</div>';
    $html_nosotrosImgUno .= '</div>';

    echo $html_nosotrosImgUno;
}
?>