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
          <div class="col-lg-2 col-md-4 col-sm-8 col-8 p-0 d-flex align-items-center flex-column transform-hover" '.construirAtributosBlog($datos['rutaImagen'], $datos['rutaImagenEncima']).' > <!-- Block start -->
               <img src="'.$datos['rutaImagen'].'" alt="" class="blog-img box-shadow-o5rem">
               

               <div class="p-3 bg-white box-shadow-o5rem blog-blocksize d-flex flex-column justify-content-between w-100">
                    <div>
                         <p class="little-paragraph m-0">'.$datos['fechaPublicacion'].'</p>
                         <h4 class="font-roboto-bolditalic m-0">'.$datos['tituloBlog'].'</h4>
                    </div>

                    <p class="m-0 little-paragraph text-center">'.substr($datos['descripcion'], 0, 100).'</p>
                    <a href="business/org/pages/blogPost.php?blogId='.urlencode($datos['blogId']).'" class="font-roboto-italic">'.$datos['textoBoton'].'</a> 
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
          <section class="container my-2rem">
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
               'rutaImagenEncima' => $row_datos['imagenEncima'],
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
          <div class="row gap-5">
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <hr class="blog-separator">
               </div>
          
               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <img src="'.$datosImagenes[0][0].'" alt="" class="img-fluid d-block mx-auto" style="width: 15rem;">
               </div>

               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2 class="text-center font-roboto-black">'.$titulo.'</h2>    
               </div>
          </div>
               
          <div class="row justify-content-lg-around justify-content-center my-4 gap-5">
          ';

          foreach($blogs as $datosBlog) {
               $html .= generarBlog($datosBlog);
          } 

          array_shift($datosImagenes);
          $direction = FlexTitleLoader::setDirection($datosImagenes[0][2]);

          $html .= '
               </div>

               <div class="row m-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end p-0">
                         <p class="text-start special-paragraph font-roboto-lightitalic m-0">'.$parametros[0]['t1'].'</p>
                    </div>    
               </div>
               
               <div class="row justify-content-end m-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0 d-flex justify-content-end blog-newsletter">
                         <input type="email" placeholder="Ingresa tu correo" class="input-form-item"></input>

                         <a href="#" class="blog-btn blog-subscribe '.$direction.'">
                              <img src="'.$datosImagenes[0][0].'" alt="" class="img-fluid">
                              <p class="font-roboto-mediumitalic special-paragraph m-0">'.$datosImagenes[0][3].'</p>
                         </a>
                    </div>
               </div>
          </section>
          ';
     }

     echo $html;
?>