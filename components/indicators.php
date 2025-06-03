<!--// Indicators //-->
<?php

     //-- Funciones --//

     function crearIndicador($datos, $posicion){
          $indicator = '
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 '.$posicion.'">
                         <div class="indicator-main '.FlexTitleLoader::setDirection($datos[2]).'">
                              <img src="'.$datos[0].'">

                              <div class="indicator-data">
                                   <h3 class="lh-1 m-0">1000</h3>
                                   <p>'.$datos[1].'</p>
                              </div>
                         </div>
                    </div>
          ';

          return $indicator;
     }

     //-- Runtime --//

     // Cargando el nivel
     $nivel = "raiz";

     // Obteniendo los datos de los indicadores
     require('business/repositories/1cc2s4Home.php');
     $res_sentencia = $mysqli1->query($sentencia."7");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }     

     // Obteniendo todos los datos importantes y inicializando $html
     $res_datos = $mysqli1->query($sql_datos);
     $html = '';
     while($row_datos = $res_datos->fetch_assoc()){
          // Renderizando la seccion
          $html .= '
          <section class="bg-blue indicators-section">
               <div class="container py-5">

                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <h3 class="indicator-title mb-4">'.$row_datos['titulo'].'</h3>
                         </div>
                    </div>
          ';
     }    

     // Obteniendo las imagenes de los indicadores
     $res_sentencia = $mysqli1->query($sentencia."20");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $indicadoresDatos[] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
     }    
     
     // Verificando la visibilidad de la seccion
     if ($html != '') {

          $html .= '
               <div class="row">
               ';

          // Renderizando los indicadores
          $indicator = 0;
          foreach ($indicadoresDatos as $datos) {
               $indicator++;
               $posicion = 'indicator-right';
               
               if ($indicator == 3) {
                    $posicion = 'indicator-left';
                    $indicator = 0;
               }elseif ($indicator > 1) {
                    $posicion = 'indicator-center';
               }

               $html .= crearIndicador($datos, $posicion);
          }

          $html .= '
               </div>
          </section>
          ';
     }

     echo $html;
?>