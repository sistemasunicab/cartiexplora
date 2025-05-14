<!--// Indicators //-->
<?php

     //-- Funciones --//

     function crearIndicador($datos){
          $indicator = '                  
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 p-3 bg-white indicator '.FlexTitleLoader::setDirection($datos[2]).' "> <!-- Indicator -->
                         <img src="'.$datos[0].'" alt="" class="indicator-img img-fluid">
                         
                         <div class="indicator-data">
                              <p class="font-roboto-light indicator-p m-0 p-0 lh-1 little-paragraph-md">'.$datos[1].'</p> 
                              <h3 class="font-roboto-black p-0 m-0 lh-1 tx-blue">1000</h3>
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
          <section class="bg-blue my-2rem">
               <div class="container py-5">

                    <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <h3 class="tx-white text-center font-roboto-light lh-1 mb-4">'.$row_datos['titulo'].'</h3>
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
               <div class="row justify-content-evenly gap-3">
               ';

          // Renderizando los indicadores
          foreach ($indicadoresDatos as $datos) {
               $html .= crearIndicador($datos);
          }

          $html .= '        
                    </div>
               </div>
          </section>
          ';
     }

     echo $html;
?>