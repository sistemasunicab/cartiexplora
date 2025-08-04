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

    $res_sentecia = $mysqli1->query($sentencia . "68");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        $html .= '<section class="bg-bold-blue historia-informacion-section">';
    }

    $res_sentencia = $mysqli1->query($sentencia."73");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        $imagenesArriba[] = $row_datos['ruta'];
    }

    $res_sentencia = $mysqli1->query($sentencia."74");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        $rutaImgHistoria = $row_datos['ruta'];
        $rutaImgHistoriaMovil = $row_datos['rutaMovil'];
        $rutaImgHistoriaTabletas = $row_datos['rutaTabletaVertical'];
    }

    if ($html != '') {
        $html .= '
        <div class="container historia-informacion-container">
            <div class="row">
        ';
        
        $count = 0;
        foreach ($imagenesArriba as $imgRuta) {
            $mobileCol = 'col-md-6 col-sm-6 col-6';

            if ($count % 3 == 2) {
                $mobileCol = 'col-md-12 col-sm-12 col-12';
            }

            $html .= '
            <div class="col-lg-4 '.$mobileCol.' mb-4">
                <img class="img-fluid w-100 p-0 historia-informacion-imgs" src="../../../'.$imgRuta.'" alt="">
            </div>
            
            ';
            $count++;
        }
        
        $html .= '
            </div>
        </div>

        </section>

        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-2 d-lg-none d-block"></div>
                <div class="col-lg-12 col-md-8 col-sm-8 col-8">
                    <picture>
                        <source '.ImageAttributeBuilder::buildsrcset($nivel, $rutaImgHistoria).' media="(min-width: 992px)">
                        <source '.ImageAttributeBuilder::buildsrcset($nivel, $rutaImgHistoriaTabletas).' media="(min-width: 768px)">
                        <img class="img-fluid historia-informacion-main" src="../../../'.$rutaImgHistoriaMovil.'" alt="">
                    </picture>
                </div>
                <div class="col-md-2 col-sm-2 col-2 d-lg-none d-block"></div>
            </div>
        </div>
        ';
    }

    echo $html;
?>