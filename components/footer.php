<?php
//nivel de la carpeta desde donde se llama este componente (archivo index.php de la raíz)

if ($nivel == 'raiz') {
    $levelSelect = 'linkNivelRaiz';
    require('business/repositories/1cc2s4Home.php');
}
if ($nivel == 'uno') {
    $levelSelect = 'linkNivelUno';
    require('../business/repositories/1cc2s4Home.php');
}
if ($nivel == 'dos') {
    $levelSelect = 'linkNivelDos';
    require('../../business/repositories/1cc2s4Home.php');
}
if ($nivel == 'tres') {
    $levelSelect = 'linkNivelTres';
    require('../../../business/repositories/1cc2s4Home.php');
}

$res_sentencia = $mysqli1->query($sentencia . "13");
while ($row_sentencia = $res_sentencia->fetch_assoc()) {
    $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . str_replace('|', '\'', $row_sentencia['condiciones']);
}
$res_datos = $mysqli1->query($sql_datos);
while ($row_datos = $res_datos->fetch_assoc()) {
    $tel = $row_datos['t1'];
}

$res_sentencia = $mysqli1->query($sentencia . "14");
while ($row_sentencia = $res_sentencia->fetch_assoc()) {
    $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . str_replace('|', '\'', $row_sentencia['condiciones']);
}
$res_datos = $mysqli1->query($sql_datos);
while ($row_datos = $res_datos->fetch_assoc()) {
    $correo = $row_datos['t1'];
}

$res_sentencia = $mysqli1->query($sentencia . "15");
while ($row_sentencia = $res_sentencia->fetch_assoc()) {
    $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . str_replace('|', '\'', $row_sentencia['condiciones']);
}
$res_datos = $mysqli1->query($sql_datos);
while ($row_datos = $res_datos->fetch_assoc()) {
    $direccion = $row_datos['t1'];
}

$res_sentencia = $mysqli1->query($sentencia . "16");
while ($row_sentencia = $res_sentencia->fetch_assoc()) {
    $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . str_replace('|', '\'', $row_sentencia['condiciones']);
}
$res_datos = $mysqli1->query($sql_datos);
while ($row_datos = $res_datos->fetch_assoc()) {
    $ubicacion = $row_datos['t1'];
}
?>


<?php
$numero_de_sentencia_footer = "25";
$res_sentencia_footer = $mysqli1->query($sentencia . $numero_de_sentencia_footer);

while ($row_sentencia_footer = $res_sentencia_footer->fetch_assoc()) {
    $condiciones_footer = str_replace('|', '\'', $row_sentencia_footer['condiciones']);
    $sql_datos_footer = $row_sentencia_footer['campos'] . $row_sentencia_footer['tablas'] . $condiciones_footer;
}
$res_datos_footer = $mysqli1->query($sql_datos_footer);

$imagenes_footer = [];
while ($row_datos_footer = $res_datos_footer->fetch_assoc()) {
    $imagenes_footer[] = [
        'ruta' => $row_datos_footer['ruta'],
        'titulo' => $row_datos_footer['titulo']
    ];
}

$hmtl_images = '<div class="col-md-7 d-flex flex-wrap h-auto justify-content-center gap-5 mx-auto pt-5">';

foreach ($imagenes_footer as $imagen) {
    $ruta_imagen = '';
    if ($nivel == "raiz") {
        $ruta_imagen = $imagen['ruta'];
    } else if ($nivel == "uno") {
        $ruta_imagen = '../' . $imagen['ruta'];
    } else if ($nivel == "dos") {
        $ruta_imagen = '../../' . $imagen['ruta'];
    } else if ($nivel == "tres") {
        $ruta_imagen = '../../../' . $imagen['ruta'];
    }

    $hmtl_images .= '<div class="image-footer d-flex flex-column align-items-center text-center" style="width:200px;">';
    $hmtl_images .= '<div class="d-flex justify-content-center align-items-center" style="height: 125px;">';
    $hmtl_images .= '<img src="' . $ruta_imagen . '" alt="logo">';
    $hmtl_images .= '</div>';
    $hmtl_images .= '<p class="special-paragraph font-roboto-medium m-0 pt-1 lh-sm tx-orange">' . $imagen['titulo'] . '</p>';
    $hmtl_images .= '</div>';
}

$hmtl_images .= '</div>';
?>

<?php
$numero_de_sentencia_footer = "27";
$res_sentencia_footer = $mysqli1->query($sentencia . $numero_de_sentencia_footer);
while ($row_sentencia_footer = $res_sentencia_footer->fetch_assoc()) {
    $condiciones_footer = str_replace('|', '\'', $row_sentencia_footer['condiciones']);
    $sql_datos_footer = $row_sentencia_footer['campos'] . $row_sentencia_footer['tablas'] . $condiciones_footer;
}
$res_datos_footer = $mysqli1->query($sql_datos_footer);

$numero_de_sentencia_footer1 = "28";
$res_sentencia_footer1 = $mysqli1->query($sentencia . $numero_de_sentencia_footer1);
while ($row_sentencia_footer1 = $res_sentencia_footer1->fetch_assoc()) {
    $condiciones_footer1 = str_replace('|', '\'', $row_sentencia_footer1['condiciones']);
    $sql_datos_footer1 = $row_sentencia_footer1['campos'] . $row_sentencia_footer1['tablas'] . $condiciones_footer1;
}
$res_datos_footer1 = $mysqli1->query($sql_datos_footer1);

$links = [];

while ($row_link = $res_datos_footer1->fetch_assoc()) {
    $links[] = [
        'title' => $row_link['parametro'],
        'link' => $row_link['t1']
    ];
}
$imagenes_footer = [];
while ($row_datos_footer = $res_datos_footer->fetch_assoc()) {
    $link_media = '';
    foreach ($links as $link) {
        if ($row_datos_footer['titulo'] === $link['title']) {
            $link_media = $link['link'];
        }
    }
    $imagenes_footer[] = [
        'ruta' => $row_datos_footer['ruta'],
        'title' => $row_datos_footer['titulo'],
        'link' => $link_media
    ];
}

$hmtl_social_media = '<div class="mx-auto my-2">';

foreach ($imagenes_footer as $imagen) {
    $ruta_imagen = '';
    if ($nivel == "raiz") {
        $ruta_imagen = $imagen['ruta'];
    } else if ($nivel == "uno") {
        $ruta_imagen = '../' . $imagen['ruta'];
    } else if ($nivel == "dos") {
        $ruta_imagen = '../../' . $imagen['ruta'];
    } else if ($nivel == "tres") {
        $ruta_imagen = '../../../' . $imagen['ruta'];
    }
    $hmtl_social_media .= '<a class="mt-2 mb-3 mx-3" href="' . $imagen['link'] . '">';
    $hmtl_social_media .= '<img style="height:25px" src="' . $ruta_imagen . '" alt="' . $imagen['title'] . '">';
    $hmtl_social_media .= '</a>';
}

$hmtl_social_media .= '</div>';

?>

<?php
$numero_de_sentencia_footer = "40";
$res_sentencia_footer = $mysqli1->query($sentencia . $numero_de_sentencia_footer);
while ($row_sentencia_footer = $res_sentencia_footer->fetch_assoc()) {
    $condiciones_footer = str_replace('|', '\'', $row_sentencia_footer['condiciones']);
    $sql_datos_footer = $row_sentencia_footer['campos'] . $row_sentencia_footer['tablas'] . $condiciones_footer;
}
$res_datos_footer = $mysqli1->query($sql_datos_footer);

$imagenes_footer = [];
while ($row_datos_footer = $res_datos_footer->fetch_assoc()) {
    $imagenes_footer[] = [
        'ruta' => $row_datos_footer['ruta'],
        'titulo' => $row_datos_footer['titulo']
    ];
}
$entities = '<div class="col-10 d-flex flex-column flex-md-row align-items-center align-items-md-end m-auto my-4 justify-content-between">';
$entities .= '<div class="text-center mb-3 mb-md-0">';
$entities .= '<p class="special-paragraph m-auto font-roboto-light tx-white  py-1"><b>Entidades que nos vigilan:</b></p>';
$entities .= '</div>';

foreach ($imagenes_footer as $imagen) {
    $ruta_imagen = '';
    if ($nivel == "raiz") {
        $ruta_imagen = $imagen['ruta'];
    } else if ($nivel == "uno") {
        $ruta_imagen = '../' . $imagen['ruta'];
    } else if ($nivel == "dos") {
        $ruta_imagen = '../../' . $imagen['ruta'];
    } else if ($nivel == "tres") {
        $ruta_imagen = '../../../' . $imagen['ruta'];
    }

    $entities .= '<div class="text-center mb-3 mb-md-0">'; // Margen solo en pantallas pequeñas
    $entities .= '<div>';
    $entities .= '<img src="' . $ruta_imagen . '" alt="logo" class="img-fluid" style="width: 70px; height: auto;">';
    $entities .= '</div>';
    $entities .= '<p class="special-paragraph m-0 m-auto font-roboto-light tx-white  py-1">' . $imagen['titulo'] . '</p>';
    $entities .= '</div>';
}

$entities .= '</div>';


$numero_de_sentencia_footer = "29";
$res_sentencia_footer = $mysqli1->query($sentencia . $numero_de_sentencia_footer);
while ($row_sentencia_footer = $res_sentencia_footer->fetch_assoc()) {
    $condiciones_footer = str_replace('|', '\'', $row_sentencia_footer['condiciones']);
    $sql_datos_footer = $row_sentencia_footer['campos'] . $row_sentencia_footer['tablas'] . $condiciones_footer;
}
$res_datos_footer = $mysqli1->query($sql_datos_footer);

$html_copyright = $entities;
while ($row_datos_footer = $res_datos_footer->fetch_assoc()) {
    $html_copyright .= '<p class="special-paragraph text-center m-auto font-roboto-light tx-white py-1">' . $row_datos_footer['t1'] . '</p>';

}
?>

<div class="container-fluid p-0 m-0">
    <div class="row w-100 p-0 m-0">
        <footer class="w-100 p-0 m-0 bg-bold-blue">
            <div class="first-footer col-11 m-auto d-flex flex-column flex-md-row tx-white justify-content-end pb-5">
                <?php echo $hmtl_images; ?>
                <div class="d-flex flex-column pt-4 mx-auto m-auto col-xl-5">
                    <div class="d-flex flex-column w-auto mb-3 mx-auto mx-xl-0 ms-xl-auto">
                        <p class="lh-sm font-roboto-thinitalic my-0 mx-auto mx-xl-0 tx-white opacity-75">Llámanos o
                            escríbenos</p>
                        <h4 class="lh-sm font-roboto-bolditalic my-0 mx-auto mx-xl-0 tx-white"><?php echo $tel ?></h4>
                        <h4 class="lh-sm font-roboto-bolditalic my-0 mx-auto mx-xl-0 tx-white"><?php echo $correo ?>
                        </h4>
                    </div>
                    <div id="info" class="d-flex flex-column w-auto mx-xl-0 ms-xl-auto">
                        <p class="special-paragraph font-roboto-bolditalic my-0 mx-auto">Encuéntranos</p>
                        <?php echo $hmtl_social_media; ?>
                        <p class="font-roboto-light mx-auto mt-4 mb-0 tx-white text-nowrap overflow-visible"><?php echo $direccion ?></p>
                        <p class="font-roboto-light mx-auto my-0 pb-3 tx-white text-nowrap overflow-visible"><?php echo $ubicacion ?></p>
                    </div>

                </div>
            </div>
            <div class="second-footer d-flex flex-column bg-orange w-100">
                <?php
                echo $html_copyright;
                ?>
            </div>

        </footer>
    </div>
</div>