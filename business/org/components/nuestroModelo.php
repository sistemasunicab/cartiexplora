<?php

     //-- Funciones --//

     function generarItem($rutaIcono, $texto, $posicionTexto) {
          $item = '
               <div class="col-lg-4 col-md-4 col-sm-12 col-12 modelo-item '.FlexTitleLoader::setDirection($posicionTexto).' align-items-center align-items-lg-start"> <!-- Item -->
                    <img src="../../../../cartiexplora/'.$rutaIcono.'" alt="" class="mb-5">
                    <p class="lh-1 font-roboto-black tx-blue text-lg-start text-center">'.$texto.'</p>
               </div> <!-- Item End -->
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
               <main class="container margin-top-5rem mb-5">
                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <h2 class="margin-bottom-2rem tx-orange font-roboto-black">'.$row_datos_seccion['titulo'].'</h2>
                              <h1 class="margin-bottom-2rem tx-blue font-roboto-light"> <span class="font-roboto-black">'.$titulo.'</span> <br> '.$subtitulo.' </h1>
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

          $html .= '
                    <div class="row gap-5 '.FlexTitleLoader::setDirection($modeloImg[2]).'">
                         <div class="d-flex col-lg-6 col-md-6 col-sm-12 col-12 nuestro-modelo-img">
                              <img class="img-fluid w-100 box-shadow-2rem" src="../../../../cartiexplora/'.$modeloImg[0].'" alt="">
                         </div>

                         <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                              <p class="special-paragraph">'.$descripcion.'</p>
                         </div>
                    </div>
               </main>

               <section class="margin-top-5rem mb-5">
                    <div class="bg-light-gray-o26">
                         <div class="container">
                              <div class="row justify-content-center align-items-center m-0">
          ';

          foreach ($imagenes as $datos) {
               $html .= generarItem($datos[0], $datos[1], $datos[2]);
          }

          $html .= '
                         </div>
                    </div>
               </div>
          </section>
          ';
    }
    
    echo $html;
?>
