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

    $res_sentecia = $mysqli1->query($sentencia . "46");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '
          <section class="bg-light-gray-o26 py-5 margin-top-5rem">
               <div class="container">

        ';
    }

    // Obteniendo ultimo blog
    $res_sentencia = $mysqli1->query($sentencia."47");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
    }  

    $res_datos = $mysqli1->query($sql_datos);

    while($row_datos = $res_datos->fetch_assoc()){
         $lastBlog = [
              'imagenPrincipal' => $row_datos['imagenEncima'],
              'fechaPublicacion' => $row_datos['fechaPublicacion'],
              'descripcion' => $row_datos['descripcionPrincipal'], 
              'tituloBlog' => $row_datos['titulo'],
              'autor' => $row_datos['autor'],
         ];
    }

    // Obteniendo los parametros necesarios
    $res_sentencia = $mysqli1->query($sentencia."28");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $parametros[] = $row_datos;
    }   

    // Obteniendo los iconos necesarios
    $res_sentencia = $mysqli1->query($sentencia."48");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $iconos[] = ["ruta" => $row_datos['ruta'], "titulo" => $row_datos['titulo'], "posicion" => $row_datos['posicionTitulo']];
    }   

    if ($html != '') {

        $html .= '
          <div class="row">
               <div class="col-lg-12">
                    <div class="blog-newsletter-box flex-column align-items-end">
                         <div>
                              <p class="text-start special-paragraph font-roboto-bolditalic m-0">'.$parametros[0]['t1'].'</p>

                              <div class="blog-newsletter-container">
                                   <input type="email" placeholder="Ingresa tu correo" class="input-form-item"></input>
                                   <a href="#" class="blog-btn">
                                        <div class="blog-subscribe '.FlexTitleLoader::setDirection($iconos[0]['posicion']).' ">
                                             <p class="font-roboto-mediumitalic special-paragraph">'.$iconos[0]['titulo'].'</p>
                                             <img src="../../../'.$iconos[0]['ruta'].'" alt="" class="special-paragraph">
                                        </div>
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="row py-5">
        '; 

          $fecha = new DateTime($lastBlog['fechaPublicacion']);
          $formatter = new IntlDateFormatter("es_ES", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
          $fechaFormateada = $formatter->format($fecha);

          $html .= '
               <div class="col-lg-9">
                    <h2 class="font-roboto-black tx-blue m-0">'.$lastBlog['tituloBlog'].'</h2>
                    <p class="font-roboto-bolditalic m-0">Por: '.$lastBlog['autor'].'</p>
                    <p class="special-paragraph m-0">'.$fechaFormateada.'</p>
               </div>

               <div class="col-lg-3 d-flex justify-content-center">
                    <a href="">
                         <img src="../../../'.$iconos[1]['ruta'].'" alt="" class="blog-page-btnicon">
                    </a>

                    <a href="">
                         <img src="../../../'.$iconos[2]['ruta'].'" alt="" class="blog-page-btnicon">
                    </a>
               </div>

               <div class="col-lg-12 d-flex justify-content-center py-5">
                    <img src="../../../'.$lastBlog['imagenPrincipal'].'" alt="" class="img-fluid w-100">
               </div>
               
               <div class="col-lg-12">
                    <p class="special-paragraph">'.$lastBlog['descripcion'].'</p>
               </div>
          ';

        $html .= '
                    </div>
               </div>
          </section>

          <section class="container my-5">
               <div class="row">
                    <div class="col-lg-12 d-flex">
                         <div class="d-flex '.FlexTitleLoader::setDirection($iconos[3]['posicion']).'">
                              <h3 class="font-roboto-bolditalic tx-bold-blue mx-4">'.$iconos[3]['titulo'].'</h3>
                              <img src="../../../'.$iconos[3]['ruta'].'" alt="" class="blog-redes-icon">
                         </div>
        ';

        for ($i=0; $i <= 3; $i++) { 
          array_shift($iconos);
        }

        $html .= '<div class="d-lg-flex">';
        foreach ($iconos as $icono) {
          $html .= '<a href=""><img src="../../../'.$icono['ruta'].'" alt="" class="px-2 mb-2 blog-redes-icon"></a>';
        }
        $html .= '
                         </div>
                    </div>
               </div>
          </section>
        ';
    }

    echo $html;
?>