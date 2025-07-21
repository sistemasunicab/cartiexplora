<!--// Meet our Campus //-->
<?php

     // Cargando el nivel
     $nivel = "raiz";
     require('business/repositories/1cc2s4Home.php');

     // Obteniendo los datos del campus
     $res_sentencia = $mysqli1->query($sentencia."8");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     // Obteniendo todos los datos importantes y inicializando $html
     $res_datos = $mysqli1->query($sql_datos);
     $html = '';

     while ($row_datos = $res_datos->fetch_assoc()) {
          // Renderizando la seccion
          $html .= '
          <section class="container campus-section d-lg-block d-md-none d-sm-none d-none">

               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                         <h2 class="campus-title font-roboto-light tx-blue"> <span class="font-roboto-black">'.$row_datos['titulo'].'</span> <br> '.$row_datos['subTitulo'].' </h2>
                    </div>
               </div>

               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                         <p class="campus-p">'.$row_datos['texto'].'</p>
                    </div>
               </div>
          ';
     }

     // Obteniendo las imagenes del campus
     $res_sentencia = $mysqli1->query($sentencia."21");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $campusImgs[] = $row_datos['ruta'];
     }    

     // Verificando la visibilidad de la seccion
     if ($html != '') {
          $html .= '
          <div class="row">
          ';

          // Renderizando las imagenes del campus
          $campusImgActual = 0;
          foreach ($campusImgs as $img) {
               $campusImgActual++;
               $position = 'campus-position-left';

               if ($campusImgActual == 3) {
                    $position = 'campus-position-right';
                    $campusImgActual = 0;
               }elseif ($campusImgActual > 1) {
                    $position = 'campus-position-center';
               }

               $html .= '
               <div class="col-lg-4 col-md-4 col-sm-12 col-12 '.$position.'">
                    <div>
                         <img src="'.$img.'" alt="" class="img-fluid w-100">
                    </div>
               </div>
               ';
          }

          $html .= '
               </div>
          </section>
          ';
     }  
     
     echo $html;
?>

