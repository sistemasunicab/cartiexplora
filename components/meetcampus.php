<!--// Meet our Campus //-->
<?php

     // Setting up level
     $nivel = "raiz";
     require('business/repositories/1cc2s4Home.php');

     // Getting campus data
     $res_sentencia = $mysqli1->query($sentencia."8");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     // Getting all important info & initializing $html
     $res_datos = $mysqli1->query($sql_datos);
     $html = '';

     while ($row_datos = $res_datos->fetch_assoc()) {
          // Renderizing main section
          $html .= '
          <section>
          <div class="container margin-top-5rem">
          <h2 class="campus-title lh-1 text-blue">'.$row_datos['titulo'].'</h2>
          <h2 class="campus-subtitle lh-1 text-blue">'.$row_datos['subTitulo'].'</h2>
          <p class="campus-p">'.$row_datos['texto'].'</p>
          ';
     }

     // Getting campus images
     $res_sentencia = $mysqli1->query($sentencia."21");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $campusImgs[] = $row_datos['ruta'];
     }    

     if ($html != '') {
          $html .= '
          <div class="row gap-4 justify-content-center">
          ';

          // printing every image for this section
          foreach ($campusImgs as $img) {
               $html .= '<img src="'.$img.'" alt="" class="col-2 campus-img p-0">';
          }

          $html .= '
          </div>   
          </div>
          </section>
          ';
     }  
     
     echo $html;
?>