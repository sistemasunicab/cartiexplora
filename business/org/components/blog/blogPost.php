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
          <section class="pt-5 logros-post-section">
               <div class="container">

        ';
    }

     if (isset($_GET['blogId'])) {
          $blogId = intval($_GET['blogId']);

          // Obteniendo blog para mostrar
          $res_sentencia = $mysqli1->query($sentencia."116");
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$blogId;
          }  
     
          $res_datos = $mysqli1->query($sql_datos);
     
          while($row_datos = $res_datos->fetch_assoc()){
               $showBlog = [
                    'imagenPrincipal' => $row_datos['imagen'],
                    'fechaPublicacion' => $row_datos['fechaPublicacion'],
                    'descripcion' => $row_datos['descripcionPrincipal'], 
                    'tituloBlog' => $row_datos['titulo'],
                    'autor' => $row_datos['autor'],
                    'blogId' => $blogId
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
     }else {
          // Obteniendo ultimo blog
          $res_sentencia = $mysqli1->query($sentencia."101");//47
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
          }  
     
          $res_datos = $mysqli1->query($sql_datos);
     
          while($row_datos = $res_datos->fetch_assoc()){
               $showBlog = [
                    'imagenPrincipal' => $row_datos['imagen'],
                    'fechaPublicacion' => $row_datos['fechaPublicacion'],
                    'descripcion' => $row_datos['descripcionPrincipal'], 
                    'tituloBlog' => $row_datos['titulo'],
                    'autor' => $row_datos['autor'],
                    'blogId' => $row_datos['id']
               ];
          }

          // comentarios de este blog
          $res_sentencia = $mysqli1->query($sentencia."118");
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$showBlog['blogId'];
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

     // Obteniendo links de interes aside
     $res_sentencia = $mysqli1->query($sentencia."121");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
     }  
 
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $linksAside[] = [
               'identificacion' => $row_datos['identificacion'],
               'link' => $row_datos['link']
          ];
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
               'imagenPrincipal' => $row_datos['imagen'],
               'fechaPublicacion' => $row_datos['fechaPublicacion'],
               'textoBoton' => $row_datos['textoBoton'],
               'tituloBlog' => $row_datos['titulo'],
          ];
     }  

    if ($html != '') {

          $html .= '
               <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-5 col-2"></div>
                    <div class="col-lg-4 col-md-6 col-sm-7 col-10">
                         <p class="noticias-newsletter-p text-end w-100">'.$parametros[0]['t1'].'</p>
                    </div>
               </div>

               <div class="row mb-5">
                    <div class="col-lg-8 col-md-6 col-sm-5 col-2"></div>
                    <div class="col-lg-4 col-md-6 col-sm-7 col-10">
                         <div class="row m-0 noticias-newsletter-main">
                              <div class="col-8 p-0">
                                   <input class="noticias-newsletter-input" placeholder="Ingresa tu correo">
                              </div>

                              <button class="col-4 bg-green noticias-newsletter-btn">
                                   <img src="../../../'.$iconos[0]['ruta'].'">
                                   '.$iconos[0]['titulo'].'
                              </button>
                         </div>
                    </div>
               </div>
          ';
               
               
          $fecha = new DateTime($showBlog['fechaPublicacion']);
          $formatter = new IntlDateFormatter("es_ES", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
          $fechaFormateada = $formatter->format($fecha);
          
          $html .= '
          <div class="row m-0" id="blog_post" data-blog-id="'.$showBlog['blogId'].'">
               <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                    <h2 class="logros-post-title" id="blogTitle">'.$showBlog['tituloBlog'].'</h2>
                    <p class="logros-post-publisher" id="blogPublisher">Por: '.$showBlog['autor'].'</p>
                    <p class="logros-post-date" id="blogDate">'.$fechaFormateada.'</p>
               </div>

               <div class="col-lg-2 col-md-2 col-sm-12 col-12 justify-content-end justify-content-center d-flex gap-4 p-0 mb-4">
                    <a role="button" class="d-none" id="blog_dislikeBtn">
                         <img src="../../../'.$imagenLike.'" alt="" class="img-fluid  logros-post-icon m-0">
                    </a>

                    <a role="button" id="blog_likeBtn">
                         <img src="../../../'.$iconos[1]['ruta'].'" alt="" class="img-fluid  logros-post-icon m-0">
                    </a>

                    <a href="#comentariosCampos">
                         <img src="../../../'.$iconos[2]['ruta'].'" alt="" class="img-fluid logros-post-icon m-0">
                    </a>
               </div>
               
               <div class="col-lg-1 order-lg-last"></div>
          </div>
               
          <div class="row pb-5">
               <div class="col-md-1 d-lg-none d-block"></div>
               <div class="col-lg-8 col-md-10 col-sm-12 col-12">
                    <img src="../../../'.$showBlog['imagenPrincipal'].'" id="blogImage" alt="" class="logros-post-img">
                    <p class="logros-post-text" id="content">'.$showBlog['descripcion'].'</p>
               </div>
               <div class="col-md-1 d-lg-none d-block"></div>

               <div class="col-md-2 d-lg-none d-block order-lg-last order-first"></div>
               <aside class="col-lg-4 col-md-8 col-sm-12 col-12 d-flex flex-column gap-5 ps-lg-5 order-lg-last order-first mb-lg-0 mb-5">
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
                              $fechaFormatter = new IntlDateFormatter("es_ES", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                              $blogActualFecha = $fechaFormatter->format($blogFecha);

                              $html .= '<p class="noticias-date font-roboto-bold m-0">'.$blogActualFecha.'</p>';
                              $html .= '
                                   <div class="row mx-0 justify-content-between align-items-center mb-3">
                                        <p class="noticias-title col-7 p-0">'.$blog['tituloBlog'].'</p>
                                        <a href="../../../business/org/pages/blog.php?blogId='.urlencode($blog['blogId']).'#blog_post" class="col-4 logros-aside-boton font-roboto-bolditalic py-2 m-0">'.$blog['textoBoton'].'</a>
                                   </div>
                                   <img src="../../../'.$blog['imagenPrincipal'].'" alt="" class="img-fluid w-100">
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

                         foreach ($linksAside as $actualLink) {
                              $html .= '<a href="../../../'.$actualLink['link'].'" class="logros-aside-boton m-1">'.$actualLink['identificacion'].'</a>';
                         }

               $html .= '</div>
                    </div>
               </aside>
               <div class="col-md-2 d-lg-none d-block order-lg-last order-first"></div>
          ';

          $enviarBoton = array_shift($camposComentar);
          $aceptarDatosCampo = array_shift($camposComentar);
          $correoCampo = array_shift($camposComentar);
          $comentarioCampo = array_shift($camposComentar);

          $html .= '
                         </div>
                    </div>
               </div>
          </section>
          
          <section class="container my-2rem">
               <div class="row mb-4">
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                         <form class="d-flex flex-column gap-3 border-green px-0 pb-3" id="comentariosCampos">
                              <h4 class="">Dejame tu comentario</h4>

                              <div class="row m-0 justify-content-center">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <input onkeyup="validarCampo(this, \''.$comentarioCampo['texto'].'\', \'texto\', 1, \'send_blog_comment\')" type="' . $comentarioCampo['tipo'] . '" id="' . $comentarioCampo['campo'] . '" class="campoFormulario w-100 p-2" ' . $comentarioCampo['obligatorio'] . ' ' . $comentarioCampo['soloLectura'] . ' ' . $comentarioCampo['habilitado'] . ' placeholder="'.$comentarioCampo['placeHolder'].'">
                                   </div>
                              </div>
                                   
                              <div class="row m-0 justify-content-center">
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <input onkeyup="validarCampo(this, \''.$correoCampo['texto'].'\', \'correo\', 1, \'send_blog_comment\')" type="' . $correoCampo['tipo'] . '" id="' . $correoCampo['campo'] . '" class="campoFormulario w-100 p-2" ' . $correoCampo['obligatorio'] . ' ' . $correoCampo['soloLectura'] . ' ' . $correoCampo['habilitado'] . ' placeholder="'.$correoCampo['placeHolder'].'">
                                   </div>
                              </div>
                              
                              <div class="row m-0 justify-content-center">
                                   <div class="col-lg-2 col-md-2 col-sm-2 col-2 d-flex justify-content-center">
                                        <input class="campoFormulario m-2" type="' . $aceptarDatosCampo['tipo'] . '" id="' . $aceptarDatosCampo['campo'] . '" name="' . $aceptarDatosCampo['campo'] . '" ' . $aceptarDatosCampo['obligatorio'] . ' ' . $aceptarDatosCampo['soloLectura'] . ' ' . $aceptarDatosCampo['habilitado'] . '>
                                   </div>

                                   <div class="col-lg-10 col-md-10 col-sm-10 col-10">
                                        <p class="logros-aceptarDatos">'.$aceptarDatosCampo['texto'].' *<br><br>* indica los campos obligatorios.</p>
                                   </div>  
                              </div>

                              <div class="row m-0 justify-content-center">
                                   <div class="col-lg-4 col-md-4"></div>
                                   <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <button type="submit" id="send_blog_comment" class="border-none bg-green tx-white rounded-3 border-0 w-100 p-3 font-roboto-black">'.$enviarBoton['texto'].'</button>
                                   </div>
                                   <div class="col-lg-4 col-md-4"></div>
                              </div>
                         </form>
                    </div>
                    <div class="col-lg-2 col-md-2"></div>
               </div>

               <div id="comentario-plantilla" class="d-none">
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="comment-block col-lg-8 col-md-8 col-sm-12 col-12">
                         <hr class="border-1 w-100">
                         <div class="row bg-light-gray-o26 py-3 m-0">
                              <div class="col-lg-8 col-md-8 col-sm-6 col-6 px-2">
                                   <p class="font-roboto special-paragraph logros-comentario">Para un maestro en educación escolar virtual, es de vital importancia asumir los retos de los últimos años relacionados no solo son la pedagogía, sino también con la tecnología. Debemos demostrar que nuestra elección de ser maestros se hace por vocación y también por superación personal para responsabilidades en el campo laboral docente. Una clave importante está en aprender a adaptarse a nuevas situaciones para prosperar en el panorama educativo en constante evolución, mantenerse actualizado y ser muy proactivo con el progreso y las necesidades de los estudiantes. Disfrutar el placer de formar ciudadanos preparados para el futuro. Cordial saludo.</p>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic special-paragraph m-0 logros-correo text-break">example@gmail.com</p>
                                   <p class="font-roboto-bolditalic m-0 logros-fecha">01-01-25</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-2 col-md-2"></div>
               </div>

               <div class="row">
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                         <div class="row">
                              <div class="col-lg-8 col-md-8 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic">Comentario</p>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic">Correo - Fecha</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-2 col-md-2"></div>
               </div>

               <div class="row" id="comentarios">
                    ';
          foreach (array_reverse($comentarios) as $comentario) {
               $html .= '
                    <div class="col-lg-2 col-md-2"></div>
                    <div class="comment-block col-lg-8 col-md-8 col-sm-12 col-12">
                         <hr class="border-1 w-100">

                         <div class="row bg-light-gray-o26 py-3 m-0">
                              <div class="col-lg-8 col-md-8 col-sm-6 col-6 px-2">
                                   <p class="font-roboto special-paragraph logros-comentario">'.$comentario['comentario'].'</p>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                   <p class="font-roboto-bolditalic special-paragraph m-0 logros-correo text-break">'.$comentario['correo'].'</p>
                                   <p class="font-roboto-bolditalic m-0 logros-fecha">'.date('y-m-d', strtotime($comentario['fecha'])).'</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-2 col-md-2"></div>
                    ';
          }
        $html .= '
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