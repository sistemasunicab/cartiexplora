<?php

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "13");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    while ($row_data = $res_data->fetch_assoc()) {
        $tel = $row_data['t1'];
    }

    $res_sentecia = $mysqli1->query($sentencia . "14");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    while ($row_data = $res_data->fetch_assoc()) {
        $correo = $row_data['t1'];
    }

    $res_sentecia = $mysqli1->query($sentencia . "15");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    while ($row_data = $res_data->fetch_assoc()) {
        $direccion = $row_data['t1'];
    }

    $res_sentecia = $mysqli1->query($sentencia . "16");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    while ($row_data = $res_data->fetch_assoc()) {
        $ubicacion = $row_data['t1'];
    }


    // -----------------------------
    // 4) IMÁGENES DEL FOOTER (sección principal)
    // -----------------------------

    $res_sentecia = $mysqli1->query($sentencia . "34");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    $imagenesFooter = [];
    while ($row_data = $res_data->fetch_assoc()) {
        //$imagenesFooter[] = [$row_data['ruta'], $row_data['titulo'], $row_data['enlace']];
        $imagenesFooter[] = $row_data;
    }

    // 4.3) Tamaños de altura predefinidos (pueden ajustarse si cambian de número)
    $imagesHeights = [119.2, 111.2, 68];
    $hmtl_images = '<div class="row col-lg-7 col-md-9 d-flex flex-wrap h-auto gap-5 justify-content-center pt-5">';
    foreach ($imagenesFooter as $idx => $imagen) {
        //$rutaImg     = rutaPorNivel($imagen['ruta']);
        $rutaImg     = ImageAttributeBuilder::buildAttributes($nivel, $imagen['ruta'], $imagen['descripcion']);
        $altura      = $imagesHeights[$idx] ?? 100; // fallback genérico
        $tituloClean = $imagen['titulo'];
        $target      = $imagen['enlace'] ?? '';

        $hmtl_images .= '
            <div class="col-sm-3 col-4 image-footer d-flex flex-column align-items-center text-center">
                <a href="' . $target . '">
                <div class="d-flex justify-content-center align-items-center" style="height: 160px;">
                    <img class="zoom-hover img-fluid my-auto" 
                        style="height: ' . $altura . 'px;" 
                        '.ImageAttributeBuilder::buildAttributes($nivel, $imagen['ruta'], $imagen['descripcion']).' 
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
    $res_sentecia = $mysqli1->query($sentencia . "37");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    $linksMap = [];
    while ($row_data = $res_data->fetch_assoc()) {
        $linksMap[] = $row_data;
    }
    //$terminos = $linksMap[4]['t1'];
    //$copyRight = $linksMap[5]['t1'];

    $res_sentecia = $mysqli1->query($sentencia . "36");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    $smImagenesDatos = [];
    while ($row_data = $res_data->fetch_assoc()) {
        $smImagenesDatos[] = $row_data;
    }

    $i = 0;
    $hmtl_social_media = '<div class="mx-auto my-2">';
    foreach ($smImagenesDatos as $filaSM) {
        $titulo = $filaSM['titulo'];
        $ruta = ImageAttributeBuilder::buildAttributes($nivel, $filaSM['ruta'], $filaSM['descripcion']);
        $link = $linksMap[$i]['t1'] ?? '#';
        $height = $titulo == 'youtube' ? 20 : 25;

        if ($titulo != "x") {
            $hmtl_social_media .= '
                <a class="mt-2 mb-3 mx-2 mx-lg-2 mx-xl-3" href="' . $link . '" target="_blank">
                    <img class="social-media-icon zoom-hover" style="height:' . $height . 'px" 
                        ' . $ruta . '>
                </a>';
        }        
        $i++;
    }
    $hmtl_social_media .= '</div>';


    // -----------------------------
    // 6) ALIADOS
    // -----------------------------

    $res_sentecia = $mysqli1->query($sentencia . "138");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    $aliadosDatos = [];
    while ($row_data = $res_data->fetch_assoc()) {
        $aliadosDatos[] = $row_data;
    }

    $hmtl_aliados = '';
    foreach ($aliadosDatos as $aliado) {
        $titulo    = $aliado['titulo'];
        $ruta = ImageAttributeBuilder::buildAttributes($nivel, $aliado['ruta'], $aliado['descripcion']);
        
        $hmtl_aliados .= '
            <div class="row col-12 col-lg-7 col-md-7 d-flex flex-column flex-lg-row flex-md-row">
                <p3-footer class="col-12 col-lg-3 col-md-3 font-roboto-black tx-white my-4 my-lg-auto mx-auto mx-lg-0 text-center text-lg-start">'
                    . $titulo .
                '</p3-footer>
                <img class="col-12 col-lg-7 col-md-7 my-auto mx-auto mx-lg-0" 
                    ' . $ruta . ' 
                    style="width:200px;height:auto;">
            </div>';
    }


    // -----------------------------
    // 7) ENTIDADES QUE NOS VIGILAN
    // -----------------------------

    $res_sentecia = $mysqli1->query($sentencia . "49");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    $entidadesDatos = [];
    while ($row_data = $res_data->fetch_assoc()) {
        $entidadesDatos[] = $row_data;
    }

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
        $rutaEnt = ImageAttributeBuilder::buildAttributes($nivel, $filaEnt['ruta'], $filaEnt['descripcion']);
        $alturaEnt = $imagesHeightsEnt[$countEnt] ?? 50;

        $entities .= '
            <div class="text-center mb-3 mb-lg-0 mb-md-0">
                <div>
                    <img ' . $rutaEnt . ' 
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
    //$copyrightDatos = obtenerFilas($mysqli1, $sentencia, 38);
    $res_sentecia = $mysqli1->query($sentencia . "38");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    $copyrightDatos = [];
    while ($row_data = $res_data->fetch_assoc()) {
        $copyrightDatos[] = $row_data;
    }

    // 8.2) Construir HTML final
    $html_copyright = $entities;
    
    $res_sentecia = $mysqli1->query($sentencia . "170");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    while ($row_data = $res_data->fetch_assoc()) {
        $terminos = $row_data['t1'];
    }

    $res_sentecia = $mysqli1->query($sentencia . "171");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_data = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    
    $res_data = $mysqli1->query($sql_data);
    while ($row_data = $res_data->fetch_assoc()) {
        $copyRight = $row_data['t1'];
    }

    $html_copyright .= '
            <p4-footer class="terminos-condiciones-footer text-center m-auto font-roboto-light tx-white">'
                . $terminos .
            '</p4-footer>';
    $html_copyright .= '
            <p4-footer class="terminos-condiciones-footer text-center m-auto font-roboto-light tx-white">'
                . $copyRight .
            '</p4-footer>';
    
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
