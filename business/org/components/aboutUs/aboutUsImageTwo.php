<style>
  
</style>

<?php
$numero_de_sentencia_nosotros = "38";
$res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
    $condiciones_nosotros = str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
    $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
}

$res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

if (mysqli_num_rows($res_datos_nosotros) > 0) {
    $html_nosotrosImgDos = '<div class="my-10 w-100 p-0 d-flex justify-content-center align-items-center">';
    $html_nosotrosImgDos .= '<div>';

    $numero_de_sentencia_nosotros = "33";
    $res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
    while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
        $condiciones_nosotros = str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
        $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
    }

    $res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

    while ($row_datos_nosotros = $res_datos_nosotros->fetch_assoc()) {
        $path = $row_datos_nosotros['ruta'];
        $altern = $row_datos_nosotros['textoAlterno'];
        $title = $row_datos_nosotros['titulo'];
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
        $html_nosotrosImgDos .= '<h1 class="ml-5 col-10 mx-auto tx-blue font-roboto-light-title mb-5">' . $title. '</h1>';
        $html_nosotrosImgDos .= '<img class="w-100 h-auto d-block" src="' . $path_image . '" alt="' . $altern . '">';
    }

    $html_nosotrosImgDos .= '</div>';
    $html_nosotrosImgDos .= '</div>';
}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_nosotrosImgDos;
        ?>
    </div>
</div>