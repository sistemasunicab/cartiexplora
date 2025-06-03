<!--// Indicators //-->
<?php

     //-- Funciones --//

     function formatearIndicador($numero) {
         // A partir de 1millón se añade "M" de sufijo
         if ($numero >= 1_000_000) {
             $reducido = $numero / 1_000_000;
             $sufijo = 'M';
         }

         // A partir de 10mil se añade "K" al sufijo
         elseif ($numero >= 10_000) {
             $reducido = $numero / 1_000;
             $sufijo = 'K';
         }

         // Entre 1000 y 9999 no se pone sufijo.
         elseif ($numero >= 1000) {
             return (string)$numero;
         }
         
         // Menor a 1000 no se pone sufijo.
         else {
             return (string)$numero;
         }

          // Elige número de decimales según tamaño
         if ($reducido >= 100) {
             $formato = number_format($reducido, 0);
         } elseif ($reducido >= 10) {
             $formato = number_format($reducido, 1);
         } else {
             $formato = number_format($reducido, 2);
         }

         // Recorta a máximo 5 caracteres incluyendo sufijo
         while (strlen($formato . $sufijo) > 5) {
             $formato = substr($formato, 0, -1);
         }

         return $formato . $sufijo;
     }


     function crearIndicador($datos, $posicion, $valor){
          $indicator = '
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 '.$posicion.'">
                         <div class="indicator-main '.FlexTitleLoader::setDirection($datos[2]).'">
                              <img src="'.$datos[0].'">

                              <div class="indicator-data">
                                   <h3 class="lh-1 m-0">'.formatearIndicador($valor).'</h3>
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

     // Obteniendo los parametros necesarios
     $res_sentencia = $mysqli1->query($sentencia."139");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  

     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $valoresIndicadores[$row_datos['parametro']] = ['valor' => $row_datos['v1']];
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

               if (isset($valoresIndicadores['indicador_'.strtolower($datos[1])])) {
                    $valor = $valoresIndicadores['indicador_'.strtolower($datos[1])]['valor'];
               }
               
               else {
                    $valor = 0;
               }

               $html .= crearIndicador($datos, $posicion, $valor);
          }

          $html .= '
               </div>
          </section>
          ';
     }

     echo $html;
?>