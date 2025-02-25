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

    $res_sentecia = $mysqli1->query($sentencia . "30");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        $html .= '<section class="margin-top-5rem historia-info-main">';
    }

    $res_sentencia = $mysqli1->query($sentencia."34");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        $imagenesArriba[] = $row_datos['ruta'];
    }

    $res_sentencia = $mysqli1->query($sentencia."35");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        $rutaImgHistoria = $row_datos['ruta'];
    }

    if ($html != '') {
        $html .= '
        <div class="d-flex justify-content-center historia-imgcontainer">
        ';
        
        foreach ($imagenesArriba as $imgRuta) {
            $html .= '<img class="historia-info-img" src="../../../../cartiexplora/'.$imgRuta.'" alt="">';
        }
        

        $html .= '
        </div>     

        <div class="historia-info"></div>

        <img class="historia-info-mainimg d-flex justify-content-center" src="../../../../cartiexplora/'.$rutaImgHistoria.'" alt="">
        </section>
        ';
    }

    echo $html;
?>