<?php

$numero_de_sentencia_educacion="46";
$res_sentencia_educacion=$mysqli1->query($sentencia . $numero_de_sentencia_educacion);
while ($row_sentencia_educacion=$res_sentencia_educacion->fetch_assoc()) {
    $condiciones_educacion=str_replace('|', '\'', $row_sentencia_educacion['condiciones']);
    $sql_datos_educacion=$row_sentencia_educacion['campos'] . $row_sentencia_educacion['tablas'] . $condiciones_educacion;
}

$res_datos_educacion=$mysqli1->query($sql_datos_educacion);

if ($res_datos_educacion->num_rows > 0) {
    $html_educacion='<div class="space-between-about w-100 p-0 my-2rem">';
    $html_educacion .= '<div class="d-flex flex-column flex-md-row col-10 justify-content-between mx-auto">';

    while ($row_datos_educacion=$res_datos_educacion->fetch_assoc()) {
        $html_educacion .= '<div class="mx-auto mx-md-0 text-center text-md-start col-10 col-md-4 mt-0 mt-md-10 mb-3">';
        $html_educacion .= '<h2 class="tx-blue font-roboto-light-title">' . $row_datos_educacion['titulo'] . '</h2>';
        $html_educacion .= '<h3 class="tx-black font-roboto-bold">' . $row_datos_educacion['subTitulo'] . '</h3>';
        $html_educacion .= '</div>';
    }

    $numero_de_sentencia_educacion="41";
    $res_sentencia_educacion=$mysqli1->query($sentencia . $numero_de_sentencia_educacion);
    while ($row_sentencia_educacion=$res_sentencia_educacion->fetch_assoc()) {
        $condiciones_educacion=str_replace('|', '\'', $row_sentencia_educacion['condiciones']);
        $sql_datos_educacion=$row_sentencia_educacion['campos'] . $row_sentencia_educacion['tablas'] . $condiciones_educacion;
    }

    $res_datos_educacion=$mysqli1->query($sql_datos_educacion);

    $html_educacion .= '<div class="col-10 mx-auto me-md-0 d-md-flex flex-md-column col-md-7">';
    while ($row_datos_educacion=$res_datos_educacion->fetch_assoc()) {

        $path=$row_datos_educacion['ruta'];
        $altern=$row_datos_educacion['textoAlterno'];
        $descripcion=$row_datos_educacion['descripcion'];
        $titulo=$row_datos_educacion['titulo'];
        $path_image='';
        if ($nivel == "raiz") {
            $path_image=$path;
        } else if ($nivel == "uno") {
            $path_image='../' . $path;
        } else if ($nivel == "dos") {
            $path_image='../../' . $path;
        } else if ($nivel == "tres") {
            $path_image='../../../' . $path;
        }
        $html_educacion .= '<div class="font-roboto-regular d-flex flex-row gap-4">';
        $html_educacion .= '<img class="image-education" src="' . $path_image . '" alt="' . $altern . '">';
        $html_educacion .= '<div class="">';
        $html_educacion .= '<h3 class="font-roboto-black">' . $titulo . '</h3>';
        $html_educacion .= '<p class="special-paragraph my-3">' . $descripcion . '</p>';
        $html_educacion .= '</div>';
        $html_educacion .= '</div>';
    }
    $html_educacion .= '</div>';

    $html_educacion .= '</div>';
    $html_educacion .= '</div>';

}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_educacion;
        ?>
    </div>
</div>