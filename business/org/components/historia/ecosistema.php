<?php
    
    //-- Funciones --//

    function generarEcosistema($rutaImagen, $titulo, $direccionTitulo, $texto) {
        $bloque = '
        <div class="col-lg-4 ecosistema-block">
            <div class="d-flex '.FlexTitleLoader::setDirection($direccionTitulo).'">
                <img src="../../../../cartiexplora/'.$rutaImagen.'" alt="">
                <h3 class="tx-orange ecosistema-title">'.$titulo.'</h3>
            </div>

            <a href="#">Leer mas</a>
            <p class="texto-base">'.$texto.'</p>
        </div> <!-- Final de bloque -->
        ';

        return $bloque;
    }
    
    //-- Runtime --//

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "64");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '<section class="container margin-top-5rem mb-5">';
    }

    // Obteniendo datos
    $res_sentencia = $mysqli1->query($sentencia."70");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $datosBloques[$row_datos['titulo']] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
    }

    $res_sentencia = $mysqli1->query($sentencia."71");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        foreach ($datosBloques as $identificador => $datos) {
            if (strpos(strtolower($identificador), strtolower($row_datos['identificacion']))) {
                array_push($datosBloques[$identificador], $row_datos['texto']);
            }
        }
    }

    if ($html != '') {
        $html .= '<div class="row">'; 

        foreach ($datosBloques as $datos) {
            $html .= generarEcosistema($datos[0], $datos[1], $datos[2], $datos[3]); 
        }

        $html .= '
            </div>
        </section>
        ';
    }

    echo $html;
?>