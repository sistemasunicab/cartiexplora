<?php
/**
 * footer.php
 * 
 * Versión refactorizada y organizada del footer. 
 * Asume que $nivel y $mysqli1 ya están disponibles.
 */

// -----------------------------
// 1) DEFINICIONES GENERALES
// -----------------------------

// 1.1) Mapeo de niveles a rutas de inclusión/recurso
$nivelMap = [
    'raiz' => [
        'repo_prefix' => '',
        'link_class'  => 'linkNivelRaiz',
    ],
    'uno' => [
        'repo_prefix' => '../',
        'link_class'  => 'linkNivelUno',
    ],
    'dos' => [
        'repo_prefix' => '../../',
        'link_class'  => 'linkNivelDos',
    ],
    'tres' => [
        'repo_prefix' => '../../../',
        'link_class'  => 'linkNivelTres',
    ],
];

// Verificar que $nivel tenga un valor válido; en caso contrario, asignar “raiz”
if (!isset($nivel) || !array_key_exists($nivel, $nivelMap)) {
    $nivel = 'raiz';
}
$repoPrefix  = $nivelMap[$nivel]['repo_prefix'];
$levelSelect = $nivelMap[$nivel]['link_class'];

// 1.2) Incluir el repositorio correspondiente (business/repositories/1cc2s4Home.php)
require_once "{$repoPrefix}business/repositories/1cc2s4Home.php";

// 2) Funciones auxiliares
require_once __DIR__ . '/auxiliares.php'; 

// -----------------------------
// 3) OBTENER DATOS DE CONTACTO
// -----------------------------

$tel       = obtenerValorSimple($mysqli1, $sentencia, 13) ?: '';
$correo    = obtenerValorSimple($mysqli1, $sentencia, 14) ?: '';
$direccion = obtenerValorSimple($mysqli1, $sentencia, 15) ?: '';
$ubicacion = obtenerValorSimple($mysqli1, $sentencia, 16) ?: '';


// -----------------------------
// 4) IMÁGENES DEL FOOTER (sección principal)
// -----------------------------

// 4.1) Cargar datos de imágenes (sentencia 34)
$imagenesDatos = obtenerFilas($mysqli1, $sentencia, 34);

// 4.2) Construir array de imágenes (solo ruta y título)
$imagenesFooter = [];
foreach ($imagenesDatos as $fila) {
    $imagenesFooter[] = [
        'ruta'   => $fila['ruta'],
        'titulo' => $fila['titulo'],
        'enlace' => $fila['enlace'],
    ];
}

// 4.3) Tamaños de altura predefinidos (pueden ajustarse si cambian de número)
$imagesHeights = [119.2, 111.2, 68];
$hmtl_images = '<div class="row col-lg-7 col-md-9 d-flex flex-wrap h-auto gap-5 justify-content-center pt-5">';
foreach ($imagenesFooter as $idx => $imagen) {
    $rutaImg     = rutaPorNivel($imagen['ruta']);
    $altura      = $imagesHeights[$idx] ?? 100; // fallback genérico
    $tituloClean = $imagen['titulo'];
    $target      = $imagen['enlace'] ?? '';

    $hmtl_images .= '
        <div class="col-sm-3 col-4 image-footer d-flex flex-column align-items-center text-center">
            <a href="' . $target . '">
            <div class="d-flex justify-content-center align-items-center" style="height: 160px;">
                <img class="zoom-hover img-fluid my-auto" 
                     style="height: ' . $altura . 'px;" 
                     src="' . $rutaImg . '" 
                     alt="' . $tituloClean . '"
                     target="' . $target . '">
            </div>
            </a>
            <p2-footer class="font-roboto-medium m-0 pt-1 lh-sm tx-orange">'
                . $tituloClean .
            '</p2-footer>
        </div>';
}
$hmtl_images .= '</div>';


// -----------------------------
// 5) REDES SOCIALES
// -----------------------------

// 5.1) Obtener lista de enlaces (sentencia 37: links con parámetros)
$linksDatos   = obtenerFilas($mysqli1, $sentencia, 37);
$linksMap     = [];
foreach ($linksDatos as $filaLink) {
    // cada $filaLink tiene 'parametro' y 't1' (el link real)
    $linksMap[$filaLink['parametro']] = $filaLink['t1'];
}

// 5.2) Obtener imágenes redes sociales + títulos (sentencia 36)
$smImagenesDatos = obtenerFilas($mysqli1, $sentencia, 36);

// 5.3) Combinar datos: ruta, título y link
$smFooter = [];
foreach ($smImagenesDatos as $filaSM) {
    $titulo = $filaSM['titulo'];
    $ruta   = $filaSM['ruta'];
    $link   = $linksMap[$titulo] ?? '#';
    $smFooter[] = [
        'ruta'  => $ruta,
        'title' => $titulo,
        'link'  => $link,
    ];
}

// 5.4) Construir HTML de redes sociales
$hmtl_social_media = '<div class="mx-auto my-2">';
foreach ($smFooter as $imagen) {
    $rutaImg     = rutaPorNivel($imagen['ruta']);
    $tituloClean = $imagen['title'];
    $linkClean   = $imagen['link'];
    $height      = $tituloClean == 'youtube' ? 20 : 25;

    $hmtl_social_media .= '
        <a class="mt-2 mb-3 mx-2 mx-lg-2 mx-xl-3" href="' . $linkClean . '" target="_blank">
            <img class="social-media-icon zoom-hover" style="height:' . $height . 'px" 
                 src="' . $rutaImg . '" 
                 alt="' . $tituloClean . '">
        </a>';
}
$hmtl_social_media .= '</div>';


// -----------------------------
// 6) ALIADOS
// -----------------------------

// 6.1) Obtener datos de aliados (sentencia 138)
$aliadosDatos = obtenerFilas($mysqli1, $sentencia, 138);

// 6.2) Construir HTML de aliados
$hmtl_aliados = '';
foreach ($aliadosDatos as $aliado) {
    $titulo    = $aliado['titulo'];
    $ruta      = $aliado['ruta'];
    $rutaImg   = rutaPorNivel($ruta);

    $hmtl_aliados .= '
        <div class="row col-12 col-lg-7 col-md-7 d-flex flex-column flex-lg-row flex-md-row">
            <p3-footer class="col-12 col-lg-3 col-md-3 font-roboto-black tx-white my-4 my-lg-auto mx-auto mx-lg-0 text-center text-lg-start">'
                . $titulo .
            '</p3-footer>
            <img class="col-12 col-lg-7 col-md-7 my-auto mx-auto mx-lg-0" 
                 src="' . $rutaImg . '" 
                 alt="' . $titulo . '" 
                 style="width:200px;height:auto;">
        </div>';
}


// -----------------------------
// 7) ENTIDADES QUE NOS VIGILAN
// -----------------------------

// 7.1) Obtener datos de entidades (sentencia 49)
$entidadesDatos = obtenerFilas($mysqli1, $sentencia, 49);

// 7.2) Construir HTML de entidades
$entities = '
    <div class="col-10 col-md-11 d-flex flex-column flex-lg-row flex-md-row align-items-center align-items-lg-end align-items-md-end m-auto my-4 justify-content-between">
        <div class="text-center mb-3 mb-lg-0">
            <p4-footer class="entidades-tx m-auto font-roboto-light tx-white py-1">
                <b>Entidades que nos vigilan:</b>
            </p4-footer>
        </div>';

$imagesHeightsEnt = [55, 46, 19]; // Alturas predefinidas
$countEnt         = 0;

foreach ($entidadesDatos as $filaEnt) {
    $tituloEnt = $filaEnt['titulo'];
    $rutaEnt   = $filaEnt['ruta'];
    $rutaImg   = rutaPorNivel($rutaEnt);
    $alturaEnt = $imagesHeightsEnt[$countEnt] ?? 50;

    $entities .= '
        <div class="text-center mb-3 mb-lg-0 mb-md-0">
            <div>
                <img src="' . $rutaImg . '" 
                     alt="' . $tituloEnt . '" 
                     class="img-fluid" 
                     style="height:' . $alturaEnt . 'px;width:auto;">
            </div>
            <p4-footer class="entidades-tx m-0 m-auto font-roboto-light tx-white py-1">'
                . $tituloEnt .
            '</p4-footer>
        </div>';
    $countEnt++;
}

$entities .= '</div>';


// -----------------------------
// 8) COPYRIGHT / TEXTO FINAL
// -----------------------------

// 8.1) Obtener texto de copyright (sentencia 38)
$copyrightDatos = obtenerFilas($mysqli1, $sentencia, 38);

// 8.2) Construir HTML final
$html_copyright = $entities;
foreach ($copyrightDatos as $filaCopy) {
    $textoCopy = $filaCopy['t1'];
    $html_copyright .= '
        <p4-footer class="terminos-condiciones-footer text-center m-auto font-roboto-light tx-white">'
            . $textoCopy .
        '</p4-footer>';
}


// -----------------------------
// 9) SALIDA FINAL (HTML)
// -----------------------------
?>

<div class="container-fluid p-0 m-0">
    <div class="row w-100 p-0 m-0">
        <footer class="w-100 p-0 m-0 bg-bold-blue">
            <!-- PRIMER FOOTER: IMÁGENES + CONTACTO + REDES + ALIADOS -->
            <div class="first-footer mt-5 col-11 m-auto d-flex flex-column tx-white justify-content-end pb-5">
                <div class="d-flex flex-column flex-lg-row flex-md-row justify-content-md-center align-items-md-center">
                    <!-- 9.1) IMÁGENES PRINCIPALES -->
                    <?php echo $hmtl_images; ?>

                    <!-- 9.2) CONTACTO + REDES + UBICACIÓN -->
                    <div class="row col-12 col-lg-5 col-md-3 d-flex flex-column pt-4 w-auto mx-auto">
                        <div class="d-flex flex-column mb-3 mx-auto">
                            <p-footer class="lh-sm .llamanos-escribenos font-roboto-bold text-center text-md-start text-lg-center my-0 mx-auto mx-md-0 mx-lg-auto tx-white">
                                Llámanos o escríbenos
                            </p-footer>
                            <h5-footer class="numero-telefono lh-sm font-roboto-bolditalic text-center text-md-start text-lg-center my-0 mx-auto mx-md-0 mx-lg-auto tx-white">
                                <?php echo $tel; ?>
                            </h5-footer>
                            <h5-footer class=" admisiones lh-sm font-roboto-bolditalic text-center text-md-start text-lg-center my-0 mx-auto mx-md-0 mx-lg-auto tx-white">
                                <?php echo $correo; ?>
                            </h5-footer>
                        </div>
                        <div id="info" class="d-flex flex-column w-auto mx-auto">
                            <p1-footer class="encuentranos font-roboto-bolditalic text-center text-md-start text-lg-center my-0 mx-auto mx-md-0 mx-lg-auto">
                                Encuéntranos
                            </p1-footer>
                            <?php echo $hmtl_social_media; ?>
                            <p-footer class="direccion-unicab-footer font-roboto-light text-center text-md-start text-lg-center mx-auto mx-md-0 mx-lg-auto mt-4 mb-0 tx-white">
                                <?php echo $direccion; ?>
                            </p-footer>
                            <p-footer class="direccion-unicab-footer font-roboto-light text-center text-md-start text-lg-center mx-auto mx-md-0 mx-lg-auto my-0 pb-3 tx-white">
                                <?php echo $ubicacion; ?>
                            </p-footer>
                        </div>
                    </div>
                </div>

                <!-- 9.3) SECCIÓN DE ALIADOS -->
                <?php echo $hmtl_aliados; ?>
            </div>

            <!-- SEGUNDO FOOTER: ENTIDADES + COPYRIGHT -->
            <div class="second-footer d-flex flex-column bg-orange w-100 pb-4" id="entidadesVigilan">
                <?php echo $html_copyright; ?>
            </div>
        </footer>
    </div>
</div>
