<?php  
    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "94");//40
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);
    
    $res_sentencia = $mysqli1->query($sentencia."95");//41
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $datosImgTitulo = [$row_datos['ruta'], $row_datos['posicionTitulo']];
    }

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '
          <main class="container logros-busqueda-section">
               <div class="row">
                    <div class="col-lg-5 col-md-4 col-sm-2 col-2"></div>
                    <div class="col-lg-2 col-md-4 col-sm-8 col-8">
                         <img '.ImageAttributeBuilder::BuildAttributes($nivel, $datosImgTitulo[0]).' alt="" class="img-fluid w-100">
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-2 col-2"></div>
               </div>
               <div class="row">
                    <div class="col-lg-1 col-md-2"></div>
                    <div class="col-lg-10 col-md-8 col-sm-12 col-12 d-flex gap-5 align-items-center">
                         <h2 class="logros-title mx-auto">'.$row_datos_seccion['titulo'].'</h2>
                    </div>
                    <div class="col-lg-1 col-md-2"></div>
               </div>
          </main>';
    }

    // Obteniendo datos
    /*$res_sentencia = $mysqli1->query($sentencia."97");//42
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $links[] = ["linkName" => $row_datos['texto']];
    }*/

    $res_sentencia = $mysqli1->query($sentencia."96");//43
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $searchBar = ["placeholder" => $row_datos['texto']];
    }

     // parametros de seccion 37 (actual)
     $res_sentencia = $mysqli1->query($sentencia."168");//164
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  

     $botonesBusqueda = [];
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $botonesBusqueda[] = [
               "textoBoton" => $row_datos['t1'],
               "categoriaBoton" => $row_datos['v1']
          ];
     }

    if ($html != '') {
        $html .= '
          <section class="mt-4">
               <div class="bg-bold-blue">
                    <div class="container py-5">
                         <div class="row mb-5">
                    '; 

          $linkActual = 0;
          foreach ($botonesBusqueda as $link) {
               $linkActual++;
               $position = 'logros-busquedaSecciones-right';

               if ($linkActual == 3) {
                    $position = 'logros-busquedaSecciones-left';
                    $linkActual = 0;
               }elseif ($linkActual > 1) {
                    $position = 'logros-busquedaSecciones-center';
               }

               $html .= '
                    <div class="col-md-3 d-lg-none d-block"></div>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12 d-flex justify-content-center '.$position.'">
                         <a role="button" data-categoria-boton data-categoria="'.$link["categoriaBoton"].'" class="bg-orange w-100 d-flex justify-content-center align-items-center logros-busqueda-link">'.$link["textoBoton"].'</a>
                    </div>
                    <div class="col-md-3 d-lg-none d-block"></div>
               ';
          }

          $html .= '
               </div>

          <div class="row mt-5">
               <div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>
               <div class="col-lg-8 col-md-10 col-sm-10 col-10 d-flex p-0 align-items-center justify-content-center">
                    <input type="text" class="logros-busqueda-barra text-lg-start text-center" placeholder="'.$searchBar["placeholder"].'" id="searchbar-blog">
               </div>
               <div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>

               <div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>

               <div id="search-results" class="col-lg-8 col-md-10 col-sm-10 col-10">
                    <ul class="search-engine"></ul>
               </div>

               <div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>
        ';

        $html .= '
                         </div>
                    </div>
               </div>
          </section>
        ';
    }

    echo $html;
?>

               