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
          <section class="container margin-top-5rem">
               <div class="row">
                    <div class="col-lg-12">
                         <h2 class="lh-1 tx-blue mb-5 p-0 font-roboto-light-title"> <b>'.$row_datos['titulo'].'</b> <br> '.$row_datos['subTitulo'].' </h2>
                         <p class="mb-5 special-paragraph p-0">'.$row_datos['texto'].'</p>
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
          <div class="row justify-content-between row-gap-3">
          ';

          // Renderizando las imagenes del campus
          foreach ($campusImgs as $img) {
               $html .= '
               <div class="col-lg-3">
                    <img src="'.$img.'" alt="" class="campus-img img-fluid w-100">
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

