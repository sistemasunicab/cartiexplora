<?php

     //-- Funciones --//

     function generarItem($rutaIcono, $texto, $posicionTexto) {
          $item = '
               <div class="col-lg-0 col-md-3 col-sm-2 col-2 d-lg-none d-md-block"></div>
               <div class="col-lg-4 col-md-6 col-sm-8 col-8 d-flex '.FlexTitleLoader::setDirection($posicionTexto).' align-items-center align-items-lg-start nuestroModelo-item"> <!-- Item -->
                    <img src="../../../'.$rutaIcono.'" alt="" class="mb-5 nuestroModelo-icon">
                    <p class="lh-1 nuestroModelo-item-p">'.$texto.'</p>
               </div> <!-- Item End -->
               <div class="col-lg-0 col-md-3 col-sm-2 col-2 d-lg-none d-md-block"></div>
          ';

          return $item;
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

    $res_sentecia = $mysqli1->query($sentencia . "70");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
          // Obtiene el titulo de la sección y lo renderiza
          $titulo = substr($row_datos_seccion['subTitulo'], 0, strpos($row_datos_seccion['subTitulo'], " "));
          $subtitulo = substr($row_datos_seccion['subTitulo'], strpos($row_datos_seccion['subTitulo'], " ") + 1);

          $html .= '
               <main class="container nuestroModelo-section">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <h2 class="nuestroModelo-title tx-orange font-roboto-black">'.$row_datos_seccion['titulo'].'</h2>
                              <h2 class="nuestroModelo-secondTitle tx-blue font-roboto-light"> <span class="font-roboto-black">'.$titulo.'</span> <br> '.$subtitulo.' </h2>
                         </div>
                    </div>
          ';

          $descripcion = $row_datos_seccion['texto'];
    }

    // Obteniendo Imagenes
    $res_sentencia = $mysqli1->query($sentencia."77");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  
    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $imagenes[] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
    }

    if ($html != '') {
          $modeloImg = array_shift($imagenes);

          /*$html .= '
                    <div class="row '.FlexTitleLoader::setDirection($modeloImg[2]).'">
                         <div class="col-lg-5 col-md-5 col-sm-12 col-12 align-items-center">
                              <img class="img-fluid w-100 box-shadow-2rem" src="../../../../cartiexplora/'.$modeloImg[0].'" alt="">
                         </div>

                         <div class="col-lg-7 col-md-7 col-sm-12 col-12 order-lg-last order-first">
                              <p class="nuestroModelo-p mb-3">'.$descripcion.'</p>
                         </div>
                    </div>
               </main>

               <section class="nuestroModelo-secondSection bg-light-gray-o26">
                    <div class="container">
                         <div class="row py-5">
          ';*/
          $html .= '
                    <div class="row">                         
                         <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                              <p class="nuestroModelo-p mb-3">'.$descripcion.'</p>
                         </div>
                         <div class="col-lg-5 col-md-5 col-sm-12 col-12 align-items-center">
                              <button class="modelo-abrirModal-boton" type="button" id="modelo_zoom">
                                   <img class="img-fluid w-100 box-shadow-2rem" src="../../../'.$modeloImg[0].'" alt="">
                              </button>
                         </div>

                    </div>
               </main>

               <section class="nuestroModelo-secondSection bg-light-gray-o26">
                    <div class="container">
                         <div class="row py-5">
          ';

          foreach ($imagenes as $datos) {
               $html .= generarItem($datos[0], $datos[1], $datos[2]);
          }

          $html .= '
                    </div>
               </div>
          </section>
          
          <div class="modelo-zoom-main w-100 h-100 d-none" id="modelo-zoomContainer">
               <div class="container modelo-zoom-holder">
                    <div class="row">
                         <div class="col-1"></div>
                         <div class="col-10">
                              <img src="../../../'.$modeloImg[0].'" class="w-100 img-fluid" id="modelo-imgzoom">
                         </div>
                         <div class="col-1"></div>
                    </div>
               </div>
          </div>
          
          ';
    }
    
    echo $html;
?>
