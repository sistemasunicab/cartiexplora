<?php
$numero_de_sentencia_nosotros="47";
$res_sentencia_nosotros=$mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
while ($row_sentencia_nosotros=$res_sentencia_nosotros->fetch_assoc()) {
    $condiciones_nosotros=str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
    $sql_datos_nosotros=$row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
}

$res_datos_nosotros=$mysqli1->query($sql_datos_nosotros);

if (mysqli_num_rows($res_datos_nosotros) > 0) {
    $html_nosotrosImgDos='<div class="my-2rem space-between-about w-100 p-0 d-flex justify-content-center align-items-center">';
    $html_nosotrosImgDos .= '<div>';

    $numero_de_sentencia_nosotros="42";
    $res_sentencia_nosotros=$mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
    while ($row_sentencia_nosotros=$res_sentencia_nosotros->fetch_assoc()) {
        $condiciones_nosotros=str_replace('|', '\'', $row_sentencia_nosotros['condiciones']);
        $sql_datos_nosotros=$row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
    }

    $res_datos_nosotros=$mysqli1->query($sql_datos_nosotros);

    while ($row_datos_nosotros=$res_datos_nosotros->fetch_assoc()) {
        $atributosEscritorio=ImageAttributeBuilder::buildAttributes($nivel, $row_datos_nosotros['ruta']);
        $atributosMovil=ImageAttributeBuilder::buildAttributes($nivel, $row_datos_nosotros['rutaMovil']);
        $atributosTabletaVertical=ImageAttributeBuilder::buildAttributes($nivel, $row_datos_nosotros['rutaTabletaVertical']);
        $atributosTabletaHorizontal=ImageAttributeBuilder::buildAttributes($nivel, $row_datos_nosotros['rutaTabletaHorizontal']);

        $imagenes=[
            [
                'atributos' => $atributosEscritorio,
                'clases'    => 'd-lg-inline d-md-none d-sm-none d-none img-fluid w-100'
            ],
            [
                'atributos' => $atributosMovil,
                'clases'    => 'd-lg-none d-md-none d-sm-none d-inline img-fluid w-100'
            ],
            [
                'atributos' => $atributosTabletaVertical,
                'clases'    => 'd-lg-none d-md-none d-sm-inline d-none img-fluid w-100'
            ],
            [
                'atributos' => $atributosTabletaHorizontal,
                'clases'    => 'd-lg-none d-md-inline d-sm-none d-none img-fluid w-100'
            ]
        ];
        $title=$row_datos_nosotros['titulo'];
        $html_nosotrosImgDos .= '<h1 class="ml-5 col-10 mx-auto tx-blue font-roboto-light-title mb-3">' . $title. '</h1>';
        foreach ($imagenes as $img) {
            $html_nosotrosImgDos .= '<img ' . $img['atributos'] . ' class="' . $img['clases'] .'">';
        }

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