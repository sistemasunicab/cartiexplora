<?php
    //-- Funciones --//
   function generarLineaTiempo($iconoLinea, $tituloLinea, $orientacion, $descripcionLinea) {
        $bloque = '
        <div class="col-lg-12 d-flex gap-5 justify-content-between mb-5 flex-column flex-lg-row">
            <div class="p-0 m-0 d-flex '.FlexTitleLoader::setDirection($orientacion).' align-items-center linea-tiempo">
                <img class="linea-tiempo-icono" src="../../../../cartiexplora/'.$iconoLinea.'" alt="">
                <h4 class="text-center tx-orange font-roboto-black">'.$tituloLinea.'</h4>
            </div>

            <p class="ps-5 m-0">'.$descripcionLinea.'</p>
        </div>
        ';

        return $bloque;
   }

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "67");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // Obtiene el titulo de la sección y lo renderiza
        $html .= '
        <main class="container d-flex flex-column gap-2rem margin-top-5rem">
            <div class="row">
                <div class="col-lg-12 d-flex gap-5 justify-content-center mb-5">
                    <h2 class="p-0 m-0 tx-blue font-roboto-black text-center">' . $row_datos_seccion['titulo'] . '</h2>
                </div>
        ';
    }

    // Obteniendo linea del tiempo
    $res_sentencia = $mysqli1->query($sentencia."71");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    $datosLineas =[];
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $datosLineas[$row_datos['titulo']] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
    }

    $res_sentencia = $mysqli1->query($sentencia."72");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        if ($datosLineas[$row_datos['identificacion']]) {
            array_push($datosLineas[$row_datos['identificacion']], $row_datos['texto']);
        }
    }

    if ($html != '') {

        foreach ($datosLineas as $datos) {
            $html .= generarLineaTiempo($datos[0], $datos[1], $datos[2], $datos[3]);
        }

        $html .= '
            </div>
        </main>
        ';
    }
    echo $html;
?>

        
        