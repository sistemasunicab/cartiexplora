<?php  
    //-- Runtime --//

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "150");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '
          <section class="presaberes-globalSection">
               <div class="container-lg">
                    <div class="row">
                         <div class="col-lg-2 col-md-2 py-3 presaberes-paso">
                              <h3 class="text-center">'.$row_datos_seccion['titulo'].'</h3>
                         </div>

                         <div class="col-lg-10 col-md-10 py-3 presaberes-paso-indicacion">
                              <h3 class="d-block w-100 text-lg-start text-center">Miguel Angel Ortiz Rodriguez <!-- CAMBIAR ESTO POR EL NOMBRE DEL USUARIO / ESTUDIANTE --></h3>
                         </div>
                    </div>
               </div>

               <div class="container">
          ';

          // Obteniendo los parametros necesarios.
          $res_sentencia = $mysqli1->query($sentencia."151");
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
          }  

          $res_datos = $mysqli1->query($sql_datos);

          while($row_datos = $res_datos->fetch_assoc()){
               if ($row_datos['identificacion'] == 'indicacion') {
                    $html .= '
                    <div class="row">
                         <div class="col-lg-2 col-md-2 col-sm-0 col-0"></div>
                         <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                              <p class="presaberes-main-descripcion">'.$row_datos['texto'].'</p>
                         </div>
                         <div class="col-lg-2 col-md-2 col-sm-0 col-0"></div>
                    </div>';
               }
          }

          $html .= '
               </div>

               <div class="container">
                    <div class="row">
                         <div class="col-lg-5 col-md-4"></div>
                         <div class="col-lg-2 col-md-4">
                              <button class="presaberes-boton border-0" type="submit">Comenzar</button>
                         </div>
                         <div class="col-lg-5 col-md-4"></div>
                    </div>
               </div>
          </section>
          ';

          $html .= '
          <section class="presaberes-globalSection">
               <div class="container">
                    <div class="row">
                         <div class="col-lg-2 col-md-2 col-sm-0 col-0"></div>
                         <div class="col-lg-8 col-md-8 col-sm-12 col-12 bg-orange">
                              <h2 class="presaberes-main-preguntatitle">Pregunta 0 de 0</h2>
                         </div>
                         <div class="col-lg-2 col-md-2 col-sm-0 col-0"></div>
                    </div>
               </div>

               <div class="container">
                    <div class="row">
                         <div class="col-lg-2 col-md-2 col-sm-0 col-0 order-lg-first order-last"></div>

                         <div class="col-lg-4 col-md-4 col-sm-12 col-12 order-lg-first order-last contenedor-datos"> 
                              <!-- AQUI IRA LA IMAGEN, ETC.--> 
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-12 col-12 order-lg-first order-last bg-blue contenedor-datos"> 
                              <p class="font-roboto-regular tx-white my-2">ejemplo</p>

                              <form id="ejemplo">
                                   <div class="row">
                                        <div class="col-12">
                                             <input type="checkbox">
                                             <p class="d-inline tx-white">ejemplo</p>
                                        </div>
                                   </div>
                              </form>

                              <!-- AQUI IRA LA PREGUNTA CON LAS RESPUESTAS.--> 
                         </div>

                         <div class="col-lg-2 col-md-2 col-sm-0 col-0 order-lg-first order-last"></div>
                    </div>
               </div>
          </section>
          ';

          echo $html;
    }
?>



