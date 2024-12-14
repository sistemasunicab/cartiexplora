<!--// Indicators //-->
<?php
     // Setting up level
     $nivel = "raiz";

     // Getting main data
     require('business/repositories/1cc2s4Home.php');
     $res_sentencia = $mysqli1->query($sentencia."7");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }     
     // Getting all important info & initializing $html
     $res_datos = $mysqli1->query($sql_datos);
     $html = '';
     while($row_datos = $res_datos->fetch_assoc()){
          // Renderizing main section
          $html .= '
          <section>
               <div class="background-blue padding-top-bottom-1rem margin-top-5rem">
                    <h2 class="text-white text-center margin-bottom-0_3rem roboto-light-font lh1">'.$row_datos['titulo'].'</h2>
          ';
     }    

     // Checking section visibility
     if ($html != '') {
          $html .= '
          <div class="container">
               <div class="row gap-3 justify-content-center">                    
                    <div class="col-3 background-white radius-1rem indicator"> <!-- Indicator -->
                         <img src="assets/img/estudiantes.png" alt="">
                         <div>
                              <p class="indicator-number lh-1">1000</p>
                              <p class="indicator-type lh-1">Estudiantes</p>  
                         </div>
                    </div> <!-- Indicator End -->                    
               </div>
          </div>
          ';

          $html .= '</div>
               </section>
          ';
     }

     echo $html;
?>

