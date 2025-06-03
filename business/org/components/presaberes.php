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

    $res_sentecia = $mysqli1->query($sentencia . "115");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    // Obteniendo los iconos
    $res_sentencia = $mysqli1->query($sentencia."120");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
          $iconos[] = [
               "rutaIcono" => $row_datos['ruta'],
               "posicionTitulo" => $row_datos['posicionTitulo']
          ];
    }   


    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
          $iconoInicio = array_shift($iconos);
         $rutaIconoInicio = $iconoInicio['rutaIcono'];
         $posicionTitulo = $iconoInicio['posicionTitulo'];

        // renderiza la seccion
        $html .= '
          <main class="bg-bold-blue presaberes-globalSection">
               <div class="container py-5">
                    <div class="row">
                         <div class="col-lg-1 col-md-5 col-sm-4 col-4"></div>
                         <div class="col-lg-2 col-md-2 col-sm-4 col-4 d-flex justify-content-center align-items-center">
                              <img class="img-fluid w-75 d-block my-auto" src="../../../'.$rutaIconoInicio.'" alt="">
                         </div>
                         <div class="col-lg-1 col-md-5 col-sm-4 col-4"></div>
                         <div class="col-lg-8 col-md-12 col-sm-12 col-12 d-flex '.FlexTitleLoader::setDirection($posicionTitulo).' justify-content-center">
                              <h3 class="presaberes-title text-lg-start text-center">'.$row_datos_seccion['titulo'].'</h3>
                              <p class="presaberes-subtitle text-lg-start text-center">'.$row_datos_seccion['subTitulo'].'</p>
                         </div>
                         <div class="col-lg-1"></div>
                    </div>
               </div>
          </main>
        ';
    }

    if ($html != '') {
     $html .= '
     <section class="presaberes-globalSection">
          <div class="container-lg">
               <div class="row">
                    <div class="col-lg-2 col-md-2 py-3 presaberes-paso">
                         <h3 class="text-center">PASO1</h3>
                    </div>

                    <div class="col-lg-10 col-md-10 py-3 presaberes-paso-indicacion">
                         <h3 class="text-center">Informacion del estudiante</h3>
                    </div>
               </div>
          </div>

          <div class="container">
               <div class="row">
                    <div class="col-lg-12 my-2rem">
                         <h3 class="presaberes-paso-title text-center">Numero de documento de identidad del estudiante (sin puntos)</h3>
                    </div>
               </div>

               <div class="row">
                    <div class="col-lg-3 col-md-3"></div>
                    <div class="col-lg-6 col-md-6 mb-4">
                         <input type="text" class="w-100 p-3">
                    </div>
                    <div class="col-lg-3 col-md-3"></div>
               </div>

               <div class="row">
                    <div class="col-lg-5 col-md-4"></div>
                    <div class="col-lg-2 col-md-4">
                         <a class="presaberes-boton" href="">Iniciar</a>
                    </div>
                    <div class="col-lg-5 col-md-4"></div>
               </div>
          </div>
     </section>
     ';

     echo $html;
    }
?>

