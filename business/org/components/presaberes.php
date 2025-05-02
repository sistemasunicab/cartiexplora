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
    $res_sentencia = $mysqli1->query($sentencia."121");
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
          <main class="bg-bold-blue margin-top-5rem">
               <div class="container py-5">
                    <div class="row justify-content-center">
                         <div class="col-lg-1 col-md-3 col-sm-3 col-3 my-auto">
                              <img class="img-fluid w-100" src="../../../'.$rutaIconoInicio.'" alt="">
                         </div>

                         <div class="col-lg-7 col-md-12 col-sm-12 col-12 d-flex '.FlexTitleLoader::setDirection($posicionTitulo).' align-items-center">
                              <h2 class="font-roboto-black tx-white text-lg-start text-center">'.$row_datos_seccion['titulo'].'</h2>
                              <p class="font-roboto tx-white text-lg-start text-center">'.$row_datos_seccion['subTitulo'].'</p>
                              <a class="orange-btn-1" href="">Iniciar</a>
                         </div>
                    </div>
               </div>
          </main>
        ';
    }

    if ($html != '') {

     $html .= '
     <section class="container margin-top-5rem mb-5">
          <div class="row">
               <div class="col-lg-2 col-md-2 col-sm-12 col-12 bg-orange py-3 d-flex align-items-center">
                    <h4 class="tx-bold-blue text-center m-0 font-roboto-bolditalic w-100">PASO1</h4>
               </div>

               <div class="col-lg-10 col-md-10 col-sm-12 col-12 bg-bold-blue py-3">
                    <h3 class="tx-white m-0 font-roboto-black text-center">Informacion del estudiante</h3>
               </div>
          </div>

          <div class="row align-items-center flex-column gap-4 mt-5">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <h3 class="tx-bold-blue m-0 font-roboto-light text-center">Numero de documento de identidad del estudiante (sin puntos)</h3>
               </div>

               <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-flex flex-column align-items-center gap-4">
                    <input type="text" class="w-100 p-3">
                    <a class="orange-btn-1" href="">Iniciar</a>
               </div>
          </div>
     </section>
     ';

     echo $html;
    }
?>

