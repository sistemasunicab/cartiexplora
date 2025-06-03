<!--// Blog //-->
<?php
     //-- Funciones --//
     function generarBlog($datos, $position) {
          $bloque = '
               <div class="col-lg-4 col-md-4 col-sm-12 col-12 '.$position.'">
                    <div class="noticias-hover">
                         <div class="noticias-img-effect">
                              <img src="'.$datos['rutaImagen'].'" class="noticias-img">
                         </div>

                         <div class="noticias-container">
                              <div class="noticias-box d-flex flex-column justify-content-between">
                                   <div>
                                        <p class="noticias-date lh-1">'.$datos['fechaPublicacion'].'</p>
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

     //-- Runtime --//

     // Poniendo el nivel
     $nivel = "raiz";

     // obteniendo informacion principal
     require('business/repositories/1cc2s4Home.php');
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

     // Obteniendo los parametros necesarios
     $res_sentencia = $mysqli1->query($sentencia."28");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  

     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $parametros[] = $row_datos;
     }   
     
     // Verificando la visibilidad de la seccion
     if ($html != '') {
          
          $html .= '
          <div class="row mb-4">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="noticias-separator" style="height: 3px;">
               </div>
          </div>
          
          <div class="row mb-4">
               <div class="col-lg-5 col-md-5 col-sm-3 col-3"></div>
               <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                    <img src="'.$datosImagenes[0][0].'" alt="" class="img-fluid mx-auto">
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
          
          $html .= '
               </div>
               
               <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-1 col-1"></div>
                    <div class="col-lg-4 col-md-6 col-sm-11 col-11">
                         <p class="noticias-newsletter-p text-end w-100">'.$parametros[0]['t1'].'</p>
                    </div>
               </div>

               <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-4 col-1"></div>
                    <div class="col-lg-4 col-md-6 col-sm-8 col-11">
                         <div class="row m-0 noticias-newsletter-main">
                              <div class="col-8 p-0">
                                   <input class="noticias-newsletter-input" placeholder="Ingresa tu correo">
                              </div>

                              <button class="col-4 bg-green noticias-newsletter-btn">
                                   <img src="'.$datosImagenes[0][0].'">
                                   '.$datosImagenes[0][3].'
                              </button>
                         </div>
                    </div>
               </div>
          ';
       
          $html .= '
               </div>
          </section>
          ';
     }

     echo $html;
?>