<!--// Meet our Campus //-->
<?php

     // Setting up level
     $nivel = "raiz";
     require('business/repositories/1cc2s4Home.php');

     // Getting campus data
     $res_sentencia = $mysqli1->query($sentencia."4");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $campusTitle = $row_datos['titulo'];
          $campusSubtitle = $row_datos['subTitulo'];
          $campusVisible = $row_datos['visible'];
          $campusContent = $row_datos['texto'];
     }    

     // Getting campus images
     $res_sentencia = $mysqli1->query($sentencia."5");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $campusImgs[] = $row_datos['ruta'];
     }    

     // Checking section visibility
     if ($campusVisible != 1) { return; }
?>

<section>
     <div class="container margin-top-4rem">

          <?php
               // Printing Titles and content
               echo '<h2 class="campus-title lh-1 text-blue">'.$campusTitle.'</h2>';
               echo '<h2 class="campus-subtitle lh-1 text-blue">'.$campusSubtitle.'</h2>';

               echo '<p class="campus-p">'.$campusContent.'</p>';
          ?>

          <div class="row gap-4 justify-content-center">
               <?php
                    // printing every image for this section
                    foreach ($campusImgs as $img) {
                         echo '<img src="'.$img.'" alt="" class="col-2 campus-img">';
                    }
               ?>
          </div>    
     </div>
</section>