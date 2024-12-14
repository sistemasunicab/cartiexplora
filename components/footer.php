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
    $condiciones_footer = str_replace('||', '\'\'', $row_sentencia_footer['condiciones']);
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

$hmtl_images = '<div class="images-footer">';

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

    $hmtl_images .= '<div class="image-footer">';
    $hmtl_images .= '<div class="img-container">';
    $hmtl_images .= '<img src="' . $ruta_imagen . '" alt="logo">';
    $hmtl_images .= '</div>';
    $hmtl_images .= '<p>' . $imagen['titulo'] . '</p>';
    $hmtl_images .= '</div>';
}

$hmtl_images .= '</div>';
?>

<?php
$numero_de_sentencia_footer = "27";
$res_sentencia_footer = $mysqli1->query($sentencia . $numero_de_sentencia_footer);
while ($row_sentencia_footer = $res_sentencia_footer->fetch_assoc()) {
    $condiciones_footer = str_replace('||', '\'\'', $row_sentencia_footer['condiciones']);
    $sql_datos_footer = $row_sentencia_footer['campos'] . $row_sentencia_footer['tablas'] . $condiciones_footer;
}
$res_datos_footer = $mysqli1->query($sql_datos_footer);

$numero_de_sentencia_footer1 = "28";
$res_sentencia_footer1 = $mysqli1->query($sentencia . $numero_de_sentencia_footer1);
while ($row_sentencia_footer1 = $res_sentencia_footer1->fetch_assoc()) {
    $condiciones_footer1 = str_replace('||', '\'\'', $row_sentencia_footer1['condiciones']);
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
        if ($row_datos_footer['descripcion'] === $link['title']){
            $link_media = $link['link'];
        }
    }
    $imagenes_footer[] = [
        'ruta' => $row_datos_footer['ruta'],
        'descripcion' => $row_datos_footer['descripcion'],
        'link' => $link_media
    ];
}

$hmtl_social_media = '<div id="basic5" class="social-media">';

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
    $hmtl_social_media .= '<a class="media" href="' . $imagen['link'] . '">';
    $hmtl_social_media .= '<img src="' . $ruta_imagen . '" alt="' .$imagen['descripcion']. '">';
    $hmtl_social_media .= '</a>';
}

$hmtl_social_media .= '</div>';

?>

<?php
$numero_de_sentencia_footer = "29";
$res_sentencia_footer = $mysqli1->query($sentencia . $numero_de_sentencia_footer);
while ($row_sentencia_footer = $res_sentencia_footer->fetch_assoc()) {
    $condiciones_footer = str_replace('||', '\'\'', $row_sentencia_footer['condiciones']);
    $sql_datos_footer = $row_sentencia_footer['campos'] . $row_sentencia_footer['tablas'] . $condiciones_footer;
}
$res_datos_footer = $mysqli1->query($sql_datos_footer);

$html_copyright = '<div class="second-footer">';
while ($row_datos_footer = $res_datos_footer->fetch_assoc()){
    $html_copyright .= '<p>'. $row_datos_footer['t1'] . '</p>';
}
$html_copyright .= '</div>';
?>

<footer>
    <div class="first-footer">
        <?php echo $hmtl_images; ?>
        <div class="contact-info">
            <div id="basic-info">
                <p id="basic1" class="">Llámanos o escríbenos</p>
                <p id="basic2" class=""><?php echo $tel ?></p>
                <p id="basic3" class=""><?php echo $correo ?></p>
            </div>
            <div id="info">
                <p id="basic4" class="">Encuéntranos</p>
                <?php echo $hmtl_social_media; ?>
                <p id="first-class"><?php echo $direccion ?></p>
                <p id="second-class"><?php echo $ubicacion ?></p>
            </div>

        </div>
    </div>
    <?php echo $html_copyright; ?>
</footer>