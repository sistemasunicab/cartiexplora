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
          <main class="container margin-top-5rem mb-5">
               <div class="row">
                    <div class="col-lg-12 d-flex '.FlexTitleLoader::setDirection($datosImgTitulo[1]).' gap-5 align-items-center">
                         <img '.ImageAttributeBuilder::BuildAttributes($nivel, $datosImgTitulo[0]).' alt="" class="img-fluid" style="width: 20%;">
                         <h2 class="font-roboto-light tx-blue">'.$row_datos_seccion['titulo'].'</h2>
                    </div>
               </div>
          </main>';
    }

    // Obteniendo datos
    $res_sentencia = $mysqli1->query($sentencia."97");//42
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $links[] = ["linkName" => $row_datos['texto']];
    }

    $res_sentencia = $mysqli1->query($sentencia."96");//43
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $searchBar = ["placeholder" => $row_datos['texto']];
    }

    if ($html != '') {
        $html .= '
          <section class="bg-bold-blue margin-top-5rem mb-5">
               <div class="container blogsearch-main">
                    <div class="row justify-content-center mb-5">
                    '; 

        foreach ($links as $link) {
          $html .= '
               <div class="col-lg-3 d-flex justify-content-center">
                    <a href="" class="blogsearch-link bg-orange">'.$link["linkName"].'</a>
               </div>
          ';
        }

        $html .= '
          </div>

          <div class="row mt-5">
               <div class="col-lg-12 d-flex align-items-center">
                    <input type="text" class="blogsearch-bar" placeholder="'.$searchBar["placeholder"].'" id="searchbar-blog">
               </div>
        ';

        $html .= '
                    </div>
               </div>
          </section>
        ';
    }

    echo $html;
?>

               