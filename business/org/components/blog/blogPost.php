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

    $res_sentecia = $mysqli1->query($sentencia . "100");//46
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '
          <section class="bg-light-gray-o26 py-5 my-2rem blogpost-section">
               <div class="container">

        ';
    }

    // Obteniendo ultimo blog
    $res_sentencia = $mysqli1->query($sentencia."101");//47
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
              'blogId' => $row_datos['id']
         ];
    }

    // Obteniendo los parametros necesarios
    $res_sentencia = $mysqli1->query($sentencia."28");//28
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $parametros[] = $row_datos;
    }   

    // Obteniendo los iconos necesarios
    $res_sentencia = $mysqli1->query($sentencia."102");//48
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
         $iconos[] = ["ruta" => $row_datos['ruta'], "titulo" => $row_datos['titulo'], "posicion" => $row_datos['posicionTitulo']];
    }   

    // Obteniendo imagen like
      $res_sentencia = $mysqli1->query($sentencia."132");
      while($row_sentencia = $res_sentencia->fetch_assoc()){
           $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
      }  
 
      $res_datos = $mysqli1->query($sql_datos);
      while($row_datos = $res_datos->fetch_assoc()){
           $imagenLike = $row_datos['ruta'];
      }  

    if ($html != '') {

        $html .= ' 
          <div class="row m-0">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end p-0">
                    <p class="text-start special-paragraph font-roboto-lightitalic m-0">'.$parametros[0]['t1'].'</p>
               </div>    
          </div>
          
          <div class="row justify-content-end m-0">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0 d-flex justify-content-end blog-newsletter">
                    <input type="email" placeholder="Ingresa tu correo" class="input-form-item"></input>

                    <a href="#" class="blog-btn blog-subscribe '.FlexTitleLoader::setDirection($iconos[0]['posicion']).'">
                         <p class="font-roboto-mediumitalic special-paragraph m-0">'.$iconos[0]['titulo'].'</p>
                         <img src="../../../'.$iconos[0]['ruta'].'" alt="" class="img-fluid">
                    </a>
               </div>
          </div>

          <div class="row justify-content-center py-5 gap-5">
        '; 

          $fecha = new DateTime($lastBlog['fechaPublicacion']);
          $formatter = new IntlDateFormatter("es_ES", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
          $fechaFormateada = $formatter->format($fecha);

          $html .= '
               <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                    <input type="hidden" id="blogId" value="'.$lastBlog['blogId'].'">

                    <h2 class="font-roboto-black tx-blue m-0">'.$lastBlog['tituloBlog'].'</h2>
                    <p class="font-roboto-bolditalic m-0">Por: '.$lastBlog['autor'].'</p>
                    <p class="special-paragraph m-0">'.$fechaFormateada.'</p>
               </div>

               <div class="col-lg-3 col-md-3 col-sm-12 col-12 justify-content-lg-end justify-content-center d-flex gap-4 p-0">
                    <a href="" class="d-none" id="blog_dislikeBtn">
                         <img src="../../../'.$imagenLike.'" alt="" class="img-fluid blog-page-btnicon m-0">
                    </a>
               
                    <a href="" id="blog_likeBtn">
                         <img src="../../../'.$iconos[1]['ruta'].'" alt="" class="img-fluid blog-page-btnicon m-0">
                    </a>

                    <a href="../../../business/org/pages/blogPost.php?blogId='.$lastBlog['blogId'].'#comentariosCampos">
                         <img src="../../../'.$iconos[2]['ruta'].'" alt="" class="img-fluid blog-page-btnicon m-0">
                    </a>
               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 col-12  d-flex justify-content-center post-img">
                    <img src="../../../'.$lastBlog['imagenPrincipal'].'" alt="" class="img-fluid w-75">
               </div>
               
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <p class="special-paragraph">'.$lastBlog['descripcion'].'</p>
               </div>
          ';

        $html .= '
                    </div>
               </div>
          </section>

          <section class="container my-5">
               <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-end justify-content-lg-start">
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