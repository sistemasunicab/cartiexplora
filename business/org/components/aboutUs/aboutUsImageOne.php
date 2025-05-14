<?php

$numero_de_sentencia_nosotros="45";
$res_sentencia_nosotros=$mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
while ($row_sentencia_nosotros=$res_sentencia_nosotros->fetch_assoc()) {
    $condiciones_nosotros=str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
    $sql_datos_nosotros=$row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
}

$res_datos_nosotros=$mysqli1->query($sql_datos_nosotros);

if (mysqli_num_rows($res_datos_nosotros) > 0) {
    $html_nosotrosImgUno='<div class="my-2rem space-between-about w-100 p-0 d-flex justify-content-center align-items-center">';
    $html_nosotrosImgUno .= '<div class="d-flex flex-wrap w-100 justify-content-between align-items-center">';

    $numero_de_sentencia_nosotros="40";
    $res_sentencia_nosotros=$mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
    while ($row_sentencia_nosotros=$res_sentencia_nosotros->fetch_assoc()) {
        $condiciones_nosotros=str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
        $sql_datos_nosotros=$row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
    }

    $res_datos_nosotros=$mysqli1->query($sql_datos_nosotros);

    $class_images=[
        'col-lg-4 col-md-4 col-sm-6 col-12 img-fluid mx-auto mb-3',
        'col-lg-4 col-md-4 col-sm-6 col-12 img-fluid mx-auto mb-3',
        'col-lg-4 col-md-4 col-sm-6 col-12 img-fluid mx-auto mb-3'
    ];

    $i=0;
    while ($row_datos_nosotros=$res_datos_nosotros->fetch_assoc()) {
        $path=$row_datos_nosotros['ruta'];
        $altern=$row_datos_nosotros['textoAlterno'];
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

        $class=$class_images[$i % count($class_images)];
        $html_nosotrosImgUno .= '<img class="' . $class . '" src="' . $path_image . '" alt="' . $altern . '">';
        $i++;
    }


    $html_nosotrosImgUno .= '</div>';
    $html_nosotrosImgUno .= '</div>';

}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_nosotrosImgUno;
        ?>
    </div>
</div>