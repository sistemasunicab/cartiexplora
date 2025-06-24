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

    $res_sentecia = $mysqli1->query($sentencia . "142");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    // Obteniendo las imagenes necesarios.
     $res_sentencia = $mysqli1->query($sentencia."146");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     } 
     $res_datos = $mysqli1->query($sql_datos);

     $imagenes = [];
     while($row_datos = $res_datos->fetch_assoc()){
          $imagenes[] = ['ruta' => $row_datos['ruta']];
     }

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
          // renderiza la seccion
          $html .= '
               <section class="container egresados-section">
                    <div class="row">
                         <div class="col-lg-6 col-md-12 col-sm-12 col-12 order-first">
                              <h2 class="egresados-card-title">'.$row_datos_seccion['titulo'].'<br><span class="egresados-card-subtitle">'.$row_datos_seccion['subTitulo'].'</span></h2>
                              <p class="egresados-card-description">'.$row_datos_seccion['texto'].'</p>
                         </div>

                         <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                              <img src="../../../'.array_shift($imagenes)['ruta'].'" alt="" class="img-fluid w-100 egresados-card-mainimg">
                         </div>
                    </div>
                    <div class="row">
          ';

          // renderizando imagenes
          $imagenActual = 0;
          $totalCargado = 0;
          foreach ($imagenes as $imagen) {
               $imagenActual++;
               $totalCargado++;
               
               $html .= '
               <div class="col-lg-3 col-md-4 col-sm-4 col-4">
                    <img src="../../../'.$imagen['ruta'].'" alt="" class="img-fluid w-100 egresados-card-subimg">
               </div>
               ';
               
               if ($totalCargado == count($imagenes) && $imagenActual - 4 != 0) {
                    $restantes = 4 - $imagenActual;

                    for ($i = 0; $i < $restantes; $i++) {
                         $html .= '<div class="col-lg-3 col-md-0 col-sm-0 col-0 order-first"></div>';
                    }
               }

               if ($imagenActual % 4 == 0) {
                    $html .= '
                    </div>

                    <div class="row">
                    ';
                    $imagenActual = 0;
               }
          }
           
          $html .= '
                    </div>
               </section>
          ';
        
          echo $html;
    }
?>







