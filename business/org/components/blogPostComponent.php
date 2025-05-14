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

    $res_sentecia = $mysqli1->query($sentencia . "114");//46
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

    // Obteniendo blog para mostrar
    if (isset($_GET['blogId'])) {
        $blogId = intval($_GET['blogId']);
    }
    $res_sentencia = $mysqli1->query($sentencia."116");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
         $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$blogId;
    }  

    $res_datos = $mysqli1->query($sql_datos);

    while($row_datos = $res_datos->fetch_assoc()){
         $showBlog = [
              'imagenPrincipal' => $row_datos['imagenEncima'],
              'fechaPublicacion' => $row_datos['fechaPublicacion'],
              'descripcion' => $row_datos['descripcionPrincipal'], 
              'tituloBlog' => $row_datos['titulo'],
              'autor' => $row_datos['autor'],
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

     // Obteniendo los ultimos 3 blogs para el aside
     $res_sentencia = $mysqli1->query($sentencia."27");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
     }  

     $res_datos = $mysqli1->query($sql_datos);
     $newestBlogs = [];

     while($row_datos = $res_datos->fetch_assoc()){
          $newestBlogs[] = [
               'blogId' => $row_datos['id'],
               'imagenPrincipal' => $row_datos['imagenEncima'],
               'fechaPublicacion' => $row_datos['fechaPublicacion'],
               'textoBoton' => $row_datos['textoBoton'],
               'tituloBlog' => $row_datos['titulo'],
          ];
     }   

     // comentarios de este blog
     $res_sentencia = $mysqli1->query($sentencia."118");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$blogId;
     }  

     $res_datos = $mysqli1->query($sql_datos);
     $comentarios = [];

     while($row_datos = $res_datos->fetch_assoc()){
          $comentarios[] = [
               'comentario' => $row_datos['comentario'],
               'correo' => $row_datos['correo'],
               'fecha' => $row_datos['fecha'],
          ];
     } 
     
      // Obteniendo el formulario / campos para comentar
      $res_sentencia = $mysqli1->query($sentencia."119");
      while($row_sentencia = $res_sentencia->fetch_assoc()){
           $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
      }  
 
      $res_datos = $mysqli1->query($sql_datos);
      while($row_datos = $res_datos->fetch_assoc()){
           $camposComentar[] = $row_datos;
      }

      // Obteniendo links de interes aside
      $res_sentencia = $mysqli1->query($sentencia."121");
      while($row_sentencia = $res_sentencia->fetch_assoc()){
           $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
      }  
 
      $res_datos = $mysqli1->query($sql_datos);
      while($row_datos = $res_datos->fetch_assoc()){
           $links[] = $row_datos;
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

          <div class="row justify-content-center py-5">
        '; 

          $fecha = new DateTime($showBlog['fechaPublicacion']);
          $formatter = new IntlDateFormatter("es_ES", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
          $fechaFormateada = $formatter->format($fecha);

          $html .= '
               <div class="col-lg-8 col-md-10 col-sm-12 col-12 px-3">
                    <div class="row m-0">
                         <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                              <h3 class="font-roboto-black tx-blue m-0">'.$showBlog['tituloBlog'].'</h3>
                              <p class="font-roboto-bolditalic m-0">Por: '.$showBlog['autor'].'</p>
                              <p class="special-paragraph m-0">'.$fechaFormateada.'</p>
                         </div>

                         <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex justify-content-lg-end justify-content-center align-items-center gap-4 p-0">
                              <a href="" class="d-none" id="blog_dislikeBtn">
                                   <img src="../../../'.$imagenLike.'" alt="" class="img-fluid blog-page-btnicon m-0">
                              </a>
                         
                              <a href="" id="blog_likeBtn">
                                   <img src="../../../'.$iconos[1]['ruta'].'" alt="" class="img-fluid blog-page-btnicon m-0">
                              </a>

                              <a href="#comentariosCampos">
                                   <img src="../../../'.$iconos[2]['ruta'].'" alt="" class="img-fluid blog-page-btnicon m-0">
                              </a>
                         </div>

                         <div class="col-lg-12 col-md-12 col-sm-12 col-12 my-5 d-flex justify-content-center post-img">
                              <img src="../../../'.$showBlog['imagenPrincipal'].'" alt="" class="img-fluid w-100">
                         </div>

                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                              <p class="special-paragraph">'.$showBlog['descripcion'].'</p>
                         </div>
                    </div>
               </div>

               <aside class="col-lg-4 col-md-9 col-sm-12 col-12 d-flex flex-column gap-5 ps-lg-5 order-lg-last order-first mb-lg-0 mb-5">
                    <div class="d-flex flex-column align-items-center bg-white px-3 py-4">
                         <p class="font-roboto-bold d-block">Siguenos en Facebook</p>
                         <iframe name="f68d834d7301a08bb" width="1000px" height="1000px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v5.0/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df61df77fa7a2c9a63%26domain%3Dunicab.org%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Funicab.org%252Ffec1659497d47cfb9%26relation%3Dparent.parent&amp;container_width=260&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2Funicabvir%2F&amp;locale=es_LA&amp;sdk=joey&amp;show_facepile=false&amp;small_header=false&amp;tabs=timeline&amp;width=" style="border: none; visibility: visible; width: 260px; height: 500px;" class=""></iframe>
                    </div>

                    <div class="d-flex flex-column align-items-center bg-white p-4">
                         <p class="font-roboto-bold d-block">Ultimos articulos</p>
                         ';

                         $blogCount = 0;
                         foreach ($newestBlogs as $blog) {
                              $html .= '<div class="d-flex flex-column">';

                              $blogFecha = new DateTime($blog['fechaPublicacion']);
                              $format = new IntlDateFormatter("es_ES", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                              $blogActualFecha = $formatter->format($fecha);
                              $html .= '<p class="special-paragraph font-roboto-bold m-0">'.$blogActualFecha.'</p>';

                              $html .= '
                                   <div class="row mx-0 justify-content-between align-items-center mb-3">
                                        <p class="font-roboto m-0 col-7">'.$blog['tituloBlog'].'</p>
                                        <a href="../../../business/org/pages/blogPost.php?blogId='.urlencode($blog['blogId']).'" class="col-4 rounded-3 bg-orange tx-white text-center font-roboto-bolditalic py-2 m-0">'.$blog['textoBoton'].'</a>
                                   </div>
                                   <img src="../../../'.$blog['imagenPrincipal'].'" alt="blog img" class="img-fluid w-100">
                              </div>
                              ';

                              if ($blogCount < 2) {
                                   $html .= '<hr class="blog-separator border-1 w-75 my-4">';
                                   $blogCount++;
                              }
                         }

                    $html .= '</div>

                    <div class="d-flex flex-column align-items-center bg-white p-4">
                         <p class="font-roboto-bold d-block">Enlaces de interes</p>
                         
                         <div class="d-flex flex-wrap">';
                         
                         foreach ($links as $link) {
                              $html .= '<a href="../../../'.$link['link'].'" class="orange-btn-2 m-1">'.$link['identificacion'].'</a>';
                         }

               $html .= '</div>
                    </div>
               </aside>
          ';

          
          $enviarBoton = array_shift($camposComentar);
          $aceptarDatosCampo = array_shift($camposComentar);
          $correoCampo = array_shift($camposComentar);
          $comentarioCampo = array_shift($camposComentar);

        $html .= '
                    </div>
               </div>
          </section>
          
          <section class="container my-2rem">
               <div class="row mb-4">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                         <form class="d-flex flex-column gap-3 border-green px-0 pb-3" id="comentariosCampos">
                              <h4 class="bg-green tx-white py-3 text-center font-roboto-bolditalic m-0">Dejame tu comentario</h4>

                              <div class="row m-0 gap-3 justify-content-center">
                                   <div class="col-lg-5 col-md-5 col-sm-11 col-11 p-0">
                                        <input onkeyup="validarCampo(this, \''.$comentarioCampo['texto'].'\', \'texto\', 1, \'send_blog_comment\')" type="' . $comentarioCampo['tipo'] . '" id="' . $comentarioCampo['campo'] . '" class="campoFormulario w-100 p-2" ' . $comentarioCampo['obligatorio'] . ' ' . $comentarioCampo['soloLectura'] . ' ' . $comentarioCampo['habilitado'] . ' placeholder="'.$comentarioCampo['placeHolder'].'">
                                   </div>

                                   <div class="col-lg-5 col-md-5 col-sm-11 col-11 p-0">
                                        <input onkeyup="validarCampo(this, \''.$correoCampo['texto'].'\', \'correo\', 1, \'send_blog_comment\')" type="' . $correoCampo['tipo'] . '" id="' . $correoCampo['campo'] . '" class="campoFormulario w-100 p-2" ' . $correoCampo['obligatorio'] . ' ' . $correoCampo['soloLectura'] . ' ' . $correoCampo['habilitado'] . ' placeholder="'.$correoCampo['placeHolder'].'">
                                   </div>
                                   
                                   <div class="col-lg-5 col-md-8 col-sm-12 col-12 p-0 d-flex">
                                        <input class="campoFormulario m-3" type="' . $aceptarDatosCampo['tipo'] . '" id="' . $aceptarDatosCampo['campo'] . '" name="' . $aceptarDatosCampo['campo'] . '" ' . $aceptarDatosCampo['obligatorio'] . ' ' . $aceptarDatosCampo['soloLectura'] . ' ' . $aceptarDatosCampo['habilitado'] . '>
                                        <p class="special-paragraph mx-3">'.$aceptarDatosCampo['texto'].' *</p>
                                   </div>
                              </div>

                              <div class="row m-0 justify-content-center">
                                   <div class="col-lg-3 col-md-3 col-sm-8 col-8 p-0">
                                        <button type="submit" id="send_blog_comment" class="border-none bg-green tx-white rounded-3 border-0 d-block w-100 p-3 font-roboto-black">'.$enviarBoton['texto'].'</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
               
               <div id="comentario-plantilla" class="d-none">
                    <div class="comment-block col-lg-8 col-md-12 col-sm-12 col-12">
                         <hr class="blog-separator border-1 w-100">
                         <div class="row bg-light-gray-o26 py-3 m-0">
                              <div class="col-lg-8 col-md-8 col-sm-6 col-6 px-2">
                                   <p class="font-roboto special-paragraph comentario">Para un maestro en educación escolar virtual, es de vital importancia asumir los retos de los últimos años relacionados no solo son la pedagogía, sino también con la tecnología. Debemos demostrar que nuestra elección de ser maestros se hace por vocación y también por superación personal para responsabilidades en el campo laboral docente. Una clave importante está en aprender a adaptarse a nuevas situaciones para prosperar en el panorama educativo en constante evolución, mantenerse actualizado y ser muy proactivo con el progreso y las necesidades de los estudiantes. Disfrutar el placer de formar ciudadanos preparados para el futuro. Cordial saludo.</p>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic special-paragraph m-0 correo text-break">example@gmail.com</p>
                                   <p class="font-roboto-bolditalic m-0 fecha">01-01-25</p>
                              </div>
                         </div>
                    </div>
               </div>


               <div class="row mb-3" id="comentarios">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12 order-first">
                         <div class="row">
                              <div class="col-lg-8 col-md-8 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic">Comentario</p>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic">Correo - Fecha</p>
                              </div>
                         </div>
                    </div>';

          foreach ($comentarios as $comentario) {
               $html .= '
                    <div class="comment-block col-lg-8 col-md-12 col-sm-12 col-12">
                         <hr class="blog-separator border-1 w-100">

                         <div class="row bg-light-gray-o26 py-3 m-0">
                              <div class="col-lg-8 col-md-8 col-sm-6 col-6 px-2">
                                   <p class="font-roboto special-paragraph comentario">'.$comentario['comentario'].'</p>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic special-paragraph m-0 correo text-break">'.$comentario['correo'].'</p>
                                   <p class="font-roboto-bolditalic m-0 fecha">'.date('y-m-d', strtotime($comentario['fecha'])).'</p>
                              </div>
                         </div>
                    </div>
                    ';
          }

          $html .= '
               </div>

               <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end justify-content-lg-start">
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

         //alert
          $html .= '<div id="alert" style="margin-left: 2rem;">
                   <p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
                   <input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0"></p>
               </div>';
    }

    echo $html;     
?>
