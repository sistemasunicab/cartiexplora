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

$html_footer = '<div class="images-footer">';

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

    $html_footer .= '<div class="image-footer">';
    $html_footer .= '<div class="img-container">';
    $html_footer .= '<img src="' . $ruta_imagen . '" alt="logo">';
    $html_footer .= '</div>';
    $html_footer .= '<p>' . $imagen['titulo'] . '</p>';
    $html_footer .= '</div>';
}

$html_footer .= '</div>';
?>

<footer>
    <div class="first-footer">
        <?php echo $html_footer; ?>
        <div class="contact-info">
            <div id="basic-info">
                <p id="basic1" class="">Llámanos o escríbenos</p>
                <p id="basic2" class=""><?php echo $tel ?></p>
                <p id="basic3" class=""><?php echo $correo ?></p>
            </div>
            <div id="info">
                <p id="basic4" class="">Encuéntranos</p>
                <div id="basic5" class="social-media">
                    <img src="assets/img/facebook.png" alt="facebook" height="20"
                        class="d-inline-block align-text-center">
                    <img src="assets/img/x.png" alt="twitter" height="20" class="d-inline-block align-text-center">
                    <img src="assets/img/instagram.png" alt="instagram" height="20"
                        class="d-inline-block align-text-center">
                    <img src="assets/img/youtube.png" alt="youtube" height="20"
                        class="d-inline-block align-text-center">
                </div>
                <p id="first-class"><?php echo $direccion ?></p>
                <p id="second-class"><?php echo $ubicacion ?></p>
            </div>

        </div>
    </div>
    <div class="second-footer">
        <p>Términos y Condiciones / Política de privacidad / Cookies</p>
        <p>Copyright © 2025 - Equipo Creativo Unicab Virtual. Reservados todos los derechos</p>
    </div>
</footer>