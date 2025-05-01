<?php
$numero_de_sentencia_nosotros = "44";
$res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
    $condiciones_nosotros = str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
    $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
}

$res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

if ($res_datos_nosotros->num_rows > 0) {
    $html_nosotros = '<div class="my-5 w-100 p-0">';
    $html_nosotros .= '<div class="d-flex flex-column flex-xl-row justify-content-between mx-auto col-10">';

    while ($row_datos_nosotros = $res_datos_nosotros->fetch_assoc()) {
        $html_nosotros .= '<div class="m-auto col-12 col-xl-7">';
        $html_nosotros .= '<h2 class="text-center text-xl-start font-roboto-light-title tx-blue mb-10">' . $row_datos_nosotros['titulo'] . '</h2>';
        $html_nosotros .= '<p class="special-paragraph text-center text-xl-start font-roboto-regular my-auto col-11 tx-black mb-5">' . $row_datos_nosotros['texto'] . '</p>';
        $html_nosotros .= '</div>';
    }

    $numero_de_sentencia_nosotros = "39";
    $res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
    while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
        $condiciones_nosotros = str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
        $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
    }

    $res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

    while ($row_datos_nosotros = $res_datos_nosotros->fetch_assoc()) {
        $html_nosotros .= '<div class="mx-auto mt-auto col-10 col-xl-5">';
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
        $html_nosotros .= '<img src="' . $path_image . '" alt="' . $altern . '" style="width:100%;">';
        $html_nosotros .= '</div>';
    }

    $html_nosotros .= '</div>';
    $html_nosotros .= '</div>';

}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_nosotros;
        ?>
    </div>
</div>