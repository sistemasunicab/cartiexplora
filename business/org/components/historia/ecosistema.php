<?php
    
    //-- Funciones --//

    function tratarTexto($texto){
        $textoInsertarCienCaracteres = '<span data-tipo="dots">...</span><span data-tipo="text" class="d-none">';
        $textoInsertarFinalCadena = '</span>';
        $posicion = 200;
        $nuevaCadena = substr_replace($texto, $textoInsertarCienCaracteres, $posicion, 0);
        return $nuevaCadena . $textoInsertarFinalCadena;
    }    

    function generarEcosistema($rutaImagen, $titulo, $direccionTitulo, $texto, $posicion, $id) {
        $bloque = '
        <div class="col-md-2 col-sm-1 col-1 d-lg-none d-md-block"></div>
        <div class="col-lg-4 col-md-8 col-sm-10 col-10 '.$posicion.' historia-ecosistema-card">
            <div>
                <div class="d-flex '.FlexTitleLoader::setDirection($direccionTitulo).'">
                    <img src="../../../'.$rutaImagen.'" alt="" class="img-fluid historia-ecosistema-logo">
                    <h4 class="tx-orange historia-ecosistema-title">'.$titulo.'</h4>
                </div>

                <a class="historia-ecosistema-seeMore" role="button" data-texto-expandido="false" onclick="displayEcosistema(\'ecosistema'.$id.'\', this)">Leer más</a>
                <hr class="historia-ecosistema-separator">
                <p class="historia-ecosistema-p historia-ecosistema-efecto" id="ecosistema'.$id.'">'.tratarTexto($texto).'</p>
            </div>
        </div> <!-- Final de bloque -->
        <div class="col-md-2 col-sm-1 col-1 d-lg-none d-md-block"></div>
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

    $res_sentecia = $mysqli1->query($sentencia . "69");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '<section class="container historia-ecosistema-section" id="grupos">';
    }

    // Obteniendo datos
    $res_sentencia = $mysqli1->query($sentencia."75");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $datosBloques[$row_datos['titulo']] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
    }

    $res_sentencia = $mysqli1->query($sentencia."76");
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

        $total = 0;
        $ecosistemaActual = 0;
        foreach ($datosBloques as $datos) {
            $total++;
            $ecosistemaActual++;
            $posicion = "historia-ecosistema-left";
            $nuevaRow = "";

            if ($ecosistemaActual == 3) {
                $ecosistemaActual = 0;
                $posicion = "historia-ecosistema-right";

                $nuevaRow = '
                </div>

                <div class="row">
                ';
            }elseif ($ecosistemaActual > 1) {
                $posicion = "historia-ecosistema-center";
            }

            $html .= generarEcosistema($datos[0], $datos[1], $datos[2], $datos[3], $posicion, $total); 
            $html .= $nuevaRow;
        }

        $html .= '
            </div>
        </section>
        ';
    }

    echo $html;
?>