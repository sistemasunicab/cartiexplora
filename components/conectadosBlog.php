<!--// Blog //-->
<?php
     //-- Funciones --//
     function generarBlog($datos, $position) {
          $bloque = '
               <div class="col-lg-4 col-md-4 col-sm-4 col-4 '.$position.'">
                    <div class="noticias-hover position-relative">
                         <div>
                              <a href="business/org/pages/blog.php?blogId='.$datos['blogId'].'#blog_post" class="noticias-botonCompleto"></a>
                         </div>

                         <div class="noticias-img-effect">
                              <img src="'.$datos['rutaImagen'].'" class="noticias-img">
                         </div>

                         <div class="noticias-container">
                              <div class="noticias-box d-flex flex-column justify-content-between">
                                   <div>
                                        <p class="noticias-date lh-1">'.$datos['fechaPublicacion'].'</p><br>
                                        <p class="noticias-title lh-1">'.$datos['tituloBlog'].'</p>
                                        <p class="noticias-p lh-1 mt-3">'.substr($datos['descripcion'], 0, 197).'...</p>
                                   </div>                                   
                                   
                                   <div class="mt-lg-0 mt-md-0 mt-sm-2 mt-3">
                                        <a href="business/org/pages/blog.php?blogId='.$datos['blogId'].'#blog_post" class="noticias-link lh-1">'.$datos['textoBoton'].'</a>
                                        <hr class="noticias-littlebar">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          ';
          
          return $bloque;
     }

     $nivel = "raiz";
     require('business/repositories/1cc2s4Home.php');
     require('business/repositories/1cc2s4Org.php');

     // obteniendo informacion principal
     $res_sentencia = $mysqli1->query($sentencia."10");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }
     
     // obteniendo datos importantes y inicializando $html
     $res_datos = $mysqli1->query($sql_datos);
     $html = '';
     while($row_datos = $res_datos->fetch_assoc()){
          $titulo = $row_datos['titulo'];

          // Renderizando la seccion
          $html .= '
          <section class="container noticias-section">
          ';

          // Obteniendo los parametros necesarios
          $res_sentencia = $mysqli1->query($sentencia."28");
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
          }  
          $parametros = [];

          $res_datos = $mysqli1->query($sql_datos);
          while($row_datos = $res_datos->fetch_assoc()){
               array_push($parametros, $row_datos['t1']);
          }
          
          // Obteniendo los iconos de los links
          $res_sentencia = $mysqli1->query($sentencia."23");
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
          }  

          $res_datos = $mysqli1->query($sql_datos);
          while($row_datos = $res_datos->fetch_assoc()){
               $datosImagenes[] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo'], $row_datos['descripcion']];
          }   

          // Obteniendo los ultimos 3 blogs
          $res_sentencia = $mysqli1->query($sentencia."27");
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

          $html .= '
          <div class="row mb-4">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="noticias-separator">
               </div>
          </div>
          
          <div class="row mb-4">
               <div class="col-lg-5 col-md-5 col-sm-3 col-3"></div>
               <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                    <img src="'.$datosImagenes[0][0].'" alt="" class="img-fluid mx-auto noticias-logo">
               </div>
               <div class="col-lg-5 col-md-5 col-sm-3 col-3"></div>
          </div>

          <div class="row mb-4">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2 class="noticias-mainTitle">'.$titulo.'</h2>    
               </div>
          </div>

          <div class="row my-4">
          ';

          $blogActual = 0;
          foreach($blogs as $datosBlog) {
               $blogActual++;
               $position = 'noticias-left';
               if ($blogActual == 3) {
                    $position = 'noticias-right';
                    $blogActual = 0;
               }elseif ($blogActual > 1) {
                    $position = 'noticias-center';
               }

               $html .= generarBlog($datosBlog, $position);
          } 

          array_shift($datosImagenes);
          $direction = FlexTitleLoader::setDirection($datosImagenes[0][2]);
          
          // Obteniendo el formulario
          $res_sentencia = $mysqli1->query($sentencia."151");//152
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
          }  
     
          $res_datos = $mysqli1->query($sql_datos);
          while($row_datos = $res_datos->fetch_assoc()){
               $camposNewsletter[] = $row_datos;
          }

          $correoCampo = array_shift($camposNewsletter);
          $campoCancelarSuscripcion = array_shift($camposNewsletter);
          $cancelarSuscripcionBoton = array_shift($camposNewsletter);
          $texto1 = array_shift($parametros);
          $textoUnsubscribe = array_shift($parametros);
          $textoCajaUnsubscribe = array_shift($parametros);

          $html .= '
               </div>
               
               <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-1 col-1"></div>
                    <div class="col-lg-4 col-md-6 col-sm-11 col-11">
                         <p class="noticias-newsletter-p text-end w-100">'.$texto1.'</p>
                    </div>
               </div>

               <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-4 col-1"></div>
                    <div class="col-lg-4 col-md-6 col-sm-8 col-11" id="newsletterBox">
                         <form 
                              id="newsletterForm" 
                              data-form-instance 
                              data-form-configuracion=\'{
                                 "botonSubmit": "registerNewsletter"
                              }\'
                         >
                              <div class="row m-0 noticias-newsletter-main">
                                   <div class="col-8 p-0">
                                        <input data-descripcion="'.$correoCampo['texto'].'" data-regla-validacion="correo" data-control-submit="1" type="' . $correoCampo['tipo'] . '" id="' . $correoCampo['campo'] . '" class="noticias-newsletter-input" ' . $correoCampo['obligatorio'] . ' ' . $correoCampo['soloLectura'] . ' ' . $correoCampo['habilitado'] . ' placeholder="'.$correoCampo['placeHolder'].'">
                                   </div>
                                   
                                   <button type="submit" id="registerNewsletter" class="col-4 noticias-newsletter-btn" style="display: none;">
                                        <img src="'.$datosImagenes[0][0].'">
                                        '.$datosImagenes[0][3].'
                                   </button>
                              </div>
                         </form>
                    </div>
               </div>

               <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-1 col-1"></div>
                    <div class="col-lg-4 col-md-6 col-sm-11 col-11">
                         <a role="button" id="unsubscribe-newsletter" class="d-block m-0 mt-2 noticias-newsletter-p text-end w-100 tx-blue logros-unsubscribe">'.$textoUnsubscribe.'</a>
                    </div>
               </div>
               
               <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-1 col-1"></div>
                    <div class="col-lg-4 col-md-6 col-sm-11 col-11">
                         <p class="noticias-newsletter-response d-none" data-response-type="success" id="newsletter-response"></p>
                    </div>
               </div>
          ';

          $html .= '
               </div>

               <div class="container newsletter-unsubscribe" style="display: none;" id="newsletter-cancelarSuscripcion">
                    <div class="row">
                         <div class="col-lg-3 col-md-3 col-sm-2 col-2"></div>

                         <div class="col-lg-6 col-md-6 col-sm-8 col-8 unsubscribe-container">
                              <p>'.$textoCajaUnsubscribe.'</p>

                              <form 
                                   id="newsletterUnsubscribeForm" 
                                   data-form-instance 
                                   data-form-configuracion=\'{
                                      "botonSubmit": "unsubscribeNewsletterButton"
                                   }\'
                              >
                                   <input data-descripcion="'.$campoCancelarSuscripcion['texto'].'" data-regla-validacion="correo" data-control-submit="1" type="' . $campoCancelarSuscripcion['tipo'] . '" id="' . $campoCancelarSuscripcion['campo'] . '" ' . $campoCancelarSuscripcion['obligatorio'] . ' ' . $campoCancelarSuscripcion['soloLectura'] . ' ' . $campoCancelarSuscripcion['habilitado'] . ' placeholder="'.$campoCancelarSuscripcion['placeHolder'].'">

                                   <button type="' . $cancelarSuscripcionBoton['tipo'] . '" id="unsubscribeNewsletterButton" class="unsubscribe-button" style="display: none;">
                                        '.$cancelarSuscripcionBoton['texto'].'
                                   </button>
                              </form>

                              <p class="noticias-newsletter-response d-none" data-response-type="success" id="unsubscribe-newsletter-response"></p>
                         </div>

                         <div class="col-lg-3 col-md-3 col-sm-2 col-2"></div>
                    </div>
               </div>
          </section>
          ';
          
          echo $html;
     }
?>