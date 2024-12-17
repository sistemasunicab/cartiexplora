<!--// Blog //-->
<?php
     //-- Funciones --//

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
          $blogDatos[] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
     }   
     
     // Verificando la visibilidad de la seccion
     if ($html != '') {
          $html .= '
               <div class="container margin-top-5rem margin-bottom-5rem">
                    <hr class="blog-separator">
                    <img src="'.$blogDatos[0][0].'" alt="" class="blog-titleimg">
                    <h2 class="text-center blog-title">'.$titulo.'</h2>    

                    <div class="row gap-8_5rem justify-content-center margin-bottom-2rem margin-top-2rem">

                         <div class="col-3 blog-blockContainer"> <!-- Block start -->
                              <img src="assets/img/cc1.png" alt="" class="blog-blockImg">

                              <div class="blog-block">
                                   <p class="blog-blockDate lh-1">Fecha</p>
                                   <p class="blog-blockTitle lh-1">Titulo</p>
                                   <p class="blog-blockDescription lh-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et ad cupiditate sapiente eius necessitatibus</p>
                                   <a href="#" class="blog-blockReadMore lh-1">Leer más</a>
                              </div>
                         </div> <!-- Block End -->
                         
                    </div>

                    <p class="blog-newsletter-advice">Recibe nuestras newsletter semanal</p>
                    <div class="blog-newsletter-box">
                         <div class="blog-newsletter-container">
                              <input type="email" placeholder="Ingresa tu correo" class="input-form-item"></input>
                              <button class="blog-btn">
                                   <div class="blog-subscribe">
                                        <img src="'.$blogDatos[1][0].'" alt="" class="">
                                        <p>Suscribir</p>
                                   </div>
                              </button>
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