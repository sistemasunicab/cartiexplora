<?php
$numero_de_sentencia_info = "48";
$res_sentencia_info = $mysqli1->query($sentencia . $numero_de_sentencia_info);
while ($row_sentencia_info = $res_sentencia_info->fetch_assoc()) {
    $condiciones_info = str_replace('|', '\'', $row_sentencia_info['condiciones']);
    $sql_datos_info = $row_sentencia_info['campos'] . $row_sentencia_info['tablas'] . $condiciones_info;
}

$res_datos_info = $mysqli1->query($sql_datos_info);

if ($res_datos_info->num_rows > 0) {
    $html_info = '';

    $html_info = '<div class="space-between-about w-100 p-0 my-5">';
    $html_info .= '<div class="d-flex flex-column flex-md-row justify-content-between col-10 mx-auto">';

    $numero_de_sentencia_info = "43";
    $res_sentencia_info = $mysqli1->query($sentencia . $numero_de_sentencia_info);
    while ($row_sentencia_info = $res_sentencia_info->fetch_assoc()) {
        $condiciones_info = str_replace('|', '\'', $row_sentencia_info['condiciones']);
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

        $html_info .= '<div class="col-10 col-md-3 mx-auto mx-md-0 font-roboto-regular d-flex flex-column">';
        $html_info .= '<img class="h-auto ps-3" style="width:60px;" src="' . $path_image . '" alt="' . $altern . '">';
        $html_info .= '<div class="mb-3">';
        $html_info .= '<h3 class="tx-orange font-roboto-light-title ps-3">' . $titulo . '</h3>';
        $html_info .= '<p class="about-line-left special-paragraph font-roboto-regular px-2 ps-3 position-relative">' . $descripcion . '</p>';
        $html_info .= '</div>';
        $html_info .= '</div>';
    }
    
}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_info;
        ?>
    </div>
</div>