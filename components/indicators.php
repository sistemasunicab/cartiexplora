<!--// Indicators //-->
<?php

     //-- Funciones --//

     function crearIndicador($datos){
          $indicator = '                  
                    <div class="col-3 background-white radius-1rem indicator '.FlexTitleLoader::setDirection($datos[2]).' "> <!-- Indicator -->
                         <img src="'.$datos[0].'" alt="" class="indicator-img">
                         <div class="indicator-data">
                              <p class="indicator-type indicator-p lh-1">'.$datos[1].'</p> 
                              <p class="indicator-number indicator-p lh-1">1000</p>
                         </div>
                    </div> <!-- Indicator End -->
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
          <section>
               <div class="background-blue padding-top-bottom-1rem margin-top-5rem">
                    <h2 class="text-white text-center margin-bottom-0_3rem roboto-light-font lh1">'.$row_datos['titulo'].'</h2>
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
          <div class="container">
               <div class="row gap-3 justify-content-center">  
               ';

          // Renderizando los indicadores
          foreach ($indicadoresDatos as $datos) {
               $html .= crearIndicador($datos);
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

