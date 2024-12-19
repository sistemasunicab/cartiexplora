<!--// Blog //-->
<?php
     //-- Funciones --//
     
     function construirAtributosBlog($rutaImagenNormal, $rutaImagenEncima) {
          $atributos = '';

          $rutaEncima = '|'.$rutaImagenEncima.'|';
          $rutaNormal = '|'.$rutaImagenNormal.'|';

          $atributos .= 'onmouseover="cambiarImagenBlog(this, '.str_replace('|', "'", $rutaEncima).')" ';
          $atributos .= 'onmouseout="restaurarImagenBlog(this, '.str_replace('|', "'", $rutaNormal).')" ';

          return $atributos;
     }

     function generarBlog($datos) {
          $bloque = '
          <div class="col-3 blog-blockContainer" '.construirAtributosBlog($datos['rutaImagen'], $datos['rutaImagenEncima']).' > <!-- Block start -->
               <img src="'.$datos['rutaImagen'].'" class="blog-blockImg">
               
               <div class="blog-block">
                    <p class="blog-blockDate lh-1">'.$datos['fechaPublicacion'].'</p>
                    <p class="blog-blockTitle lh-1">'.$datos['tituloBlog'].'</p>

                    <p class="blog-blockDescription lh-1">'.substr($datos['descripcion'], 0, 100).'</p>
                    <a href="#" class="blog-blockReadMore lh-1">'.$datos['textoBoton'].'</a>
               </div>
          </div> <!-- Block End -->';

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
          <section>
          ';
     }

     // Obteniendo los iconos de los links
     $res_sentencia = $mysqli1->query($sentencia."23");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  

     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $datosImagenes[] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
     }   
     
     // Obteniendo los ultimos 3 blogs
     $res_sentencia = $mysqli1->query($sentencia."27");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  

     $res_datos = $mysqli1->query($sql_datos);
     $blogs = [];

     while($row_datos = $res_datos->fetch_assoc()){
          $blogs[] = [
               'rutaImagen' => $row_datos['imagen'],
               'rutaImagenEncima' => $row_datos['imagenEncima'],
               'fechaPublicacion' => $row_datos['fechaPublicacion'],
               'descripcion' => $row_datos['descripcionPrincipal'], 
               'textoBoton' => $row_datos['textoBoton'],
               'tituloBlog' => $row_datos['titulo']
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
          $direction = FlexTitleLoader::setDirection($datosImagenes[1][2]);

          $html .= '
               <div class="container margin-top-5rem margin-bottom-5rem">
                    <hr class="blog-separator">
                    <img src="'.$datosImagenes[0][0].'" alt="" class="blog-titleimg">
                    <h2 class="text-center blog-title">'.$titulo.'</h2>    

                    <div class="row gap-8_5rem justify-content-center margin-bottom-2rem margin-top-2rem">
          ';
                  
          foreach($blogs as $datosBlog) {
               $html .= generarBlog($datosBlog);
          } 

          $html .= '
                    </div>

                    <p class="blog-newsletter-advice">'.$parametros[0]['t1'].'</p>
                    <div class="blog-newsletter-box">
                         <div class="blog-newsletter-container">
                              <input type="email" placeholder="Ingresa tu correo" class="input-form-item"></input>
                              <button class="blog-btn">
                                   <div class="blog-subscribe '.$direction.'">
                                        <img src="'.$datosImagenes[1][0].'" alt="" class="">
                                        <p>'.$datosImagenes[1][1].'</p>
                                   </div>
                              </button>
                         </div>
                    </div>
               </div>
          </section>
          ';
     }

     echo $html;
?>