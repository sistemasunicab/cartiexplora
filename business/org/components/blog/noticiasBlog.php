<?php  
     //-- Funciones --//
     function generarBlog($datos, $seOculta, $posicion) {
          $visibilidad =  $seOculta ? "d-lg-block d-none" : "";
          $bloque = '
               <div class="col-lg-3 col-md-4 col-sm-4 col-4 logros-noticias-separation '.$posicion.' '.$visibilidad.'">
                    <div class="noticias-hover position-relative">
                         <div>
                              <a href="blog.php?blogId='.$datos['blogId'].'#blog_post" class="noticias-botonCompleto"></a>
                         </div>

                         <div class="noticias-img-effect">
                              <img src="'.$datos['rutaImagen'].'" class="noticias-img">
                         </div>
                         
                         <div class="noticias-container">
                              <div class="noticias-box d-flex flex-column justify-content-between">
                                   <div>
                                        <p class="noticias-date lh-1">'.$datos['fechaPublicacion'].'</p><br>
                                        <p class="noticias-title lh-1">'.$datos['tituloBlog'].'</p>
                                        <p class="noticias-p lh-1 mt-3">'.substr($datos['descripcion'], 0, 157).'...</p>
                                   </div>     
                                   
                                   
                                   <div class="mt-lg-0 mt-md-0 mt-sm-2 mt-3">
                                        <!--<a role="button" data-button-blog data-blog-id="'.$datos['blogId'].'" class="noticias-link lh-1">'.$datos['textoBoton'].'</a>-->
                                        <a href="blog.php?blogId='.$datos['blogId'].'#blog_post" class="noticias-link lh-1">'.$datos['textoBoton'].'</a>
                                        <hr class="noticias-littlebar">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          ';

          return $bloque;
     }

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    //Cargar sección
    $res_sentecia = $mysqli1->query($sentencia . "98");//44
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '
          <section class="container logros-noticias-section" id="noticias-recientes">
               <div class="row">
                    <div class="col-lg-12">
                         <h3 class="logros-noticias-title text-center">'.$row_datos_seccion['titulo'].'</h3>
                    </div>
               </div>';
    }

     // Obteniendo los ultimos 4 blogs
     $res_sentencia = $mysqli1->query($sentencia."99");//45
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
     }  

     $res_datos = $mysqli1->query($sql_datos);
     $blogs = [];

     while($row_datos = $res_datos->fetch_assoc()){
          $blogs[] = [
               'rutaImagen' => $row_datos['imagen'],
               'fechaPublicacion' => $row_datos['fechaPublicacion'],
               'descripcion' => $row_datos['descripcionPrincipal'], 
               'textoBoton' => $row_datos['textoBoton'],
               'tituloBlog' => $row_datos['titulo'],
               'blogId' => $row_datos['id']
          ];
     }

     // Obteniendo textos
     $res_sentencia = $mysqli1->query($sentencia."167");//45 163
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  

     $datosTextos = [];
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          array_push($datosTextos, $row_datos['texto']);
     }

     $resultadosBusqueda = array_shift($datosTextos);
     $resultadosCategoria = array_shift($datosTextos);

    if ($html != '') {
        $html .= '<div class="row">'; 

        $blogActual = 0;
        $blogPosicionActual = 0;
        foreach($blogs as $datosBlog) {
          $blogActual++;
          $blogPosicionActual++;

          $seOculta = false;
          if ($blogActual % 4 == 0) {
               $seOculta = true;
          }

          $position = 'logros-md-noticias-left';
          if ($blogPosicionActual == 3) {
               $position = 'logros-md-noticias-right';
               $blogPosicionActual = 0;
          }elseif ($blogPosicionActual > 1) {
               $position = 'logros-md-noticias-center';
          }

          $html .= generarBlog($datosBlog, $seOculta, $position);
        }

        $html .= '
               </div>
          </section>
        ';

        $html .= '
          <section class="container logros-noticias-section d-none" id="resultados-busqueda-blog">
               <div class="row">
                    <div class="col-lg-12">
                         <h3 class="logros-noticias-title text-center" id="titulo-busqueda">'.$resultadosBusqueda.'</h3>
                         <h3 class="logros-noticias-title text-center d-none" id="titulo-busquedaCategorias">'.$resultadosCategoria.'</h3>
                    </div>
               </div>
               
               <div class="row" id="resultados"></div>
          </section>
        ';
    }

    echo $html;
?>