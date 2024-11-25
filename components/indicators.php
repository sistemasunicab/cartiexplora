<!--// Indicators //-->
<?php
     $nivel = "raiz";
     require('business/repositories/1cc2s4Home.php');
     $res_sentencia = $mysqli1->query($sentencia."3");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $indicatorsTitle = $row_datos['titulo'];
          $indicatorsVisible = $row_datos['visible'];
     }    

     if ($indicatorsVisible != 1) { return; }
?>

<section>
     <div class="background-blue padding-top-bottom-1rem margin-top-4rem">
          <?php
               echo '<h2 class="text-white text-center margin-bottom-0_3rem roboto-light-font lh1">'.$indicatorsTitle.'</h2>'
          ?>
     
          <div class="container">
               <div class="row gap-3 justify-content-center">
                    <div class="col-3 background-white radius-1rem indicator">
                         <img src="assets/img/estudiantes.png" alt="">

                         <div>
                              <p class="indicator-number lh-1">1000</p>
                              <p class="indicator-type lh-1">Estudiantes</p>  
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

