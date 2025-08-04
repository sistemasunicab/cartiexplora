<?php

$nivel = "tres";
if ($nivel == "raiz") {
    require('business/repositories/1cc2s4Home.php');
} else if ($nivel == "uno") {
    require('../business/repositories/1cc2s4Home.php');
} else if ($nivel == "dos") {
    require('../../business/repositories/1cc2s4Home.php');
} else if ($nivel == "tres") {
    require('../../../business/repositories/1cc2s4Home.php');
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $verTodo = trim($_POST['verTodo']) ?? 'false';
    $value = trim($_POST['input']) ?? '';
    $valueFiltrado = '\'%' . strtolower($value) . '%\'';

    if ($verTodo == 'true') {
          $res_sentecia = $mysqli1->query($sentencia . "160");//161

          while ($row_sentencia = $res_sentecia->fetch_assoc()) {
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|?|', $valueFiltrado, $row_sentencia['condiciones']);
          }

          $res_datos = $mysqli1->query($sql_datos);
          $cantidad_filas = 0;
          $blogPos = 0;

          $html = '';
          while($row_datos = $res_datos->fetch_assoc()){
               $cantidad_filas++;

               $position = 'logros-md-noticias-left';
               if ($blogPos == 3) {
                    $position = 'logros-md-noticias-right';
                    $blogPos = 0;
               }elseif ($blogPos > 1) {
                    $position = 'logros-md-noticias-center';
               }

               $html .= '
               <div class="col-lg-3 col-md-4 col-sm-4 col-4 logros-noticias-separation mt-3 '.$position.'">
                    <div class="noticias-hover position-relative">
                         <div>
                              <a href="blog.php?blogId='.$row_datos['id'].'#blog_post" class="noticias-botonCompleto"></a>
                         </div>
                         
                         <div class="noticias-img-effect">
                              <img src="'.$row_datos['imagen'].'" class="noticias-img">
                         </div>

                         <div class="noticias-container">
                              <div class="noticias-box d-flex flex-column justify-content-between">
                                   <div>
                                        <p class="noticias-date lh-1">'.$row_datos['fechaPublicacion'].'</p>
                                        <p class="noticias-title lh-1">'.$row_datos['titulo'].'</p>
                                        <p class="noticias-p lh-1 mt-3">'.substr($row_datos['descripcionPrincipal'], 0, 157).'...</p>
                                   </div>     
                                   
                                   <div class="mt-lg-0 mt-md-0 mt-sm-2 mt-3">
                                        <a role="button" data-button-blog data-blog-id="'.$row_datos['id'].'" class="noticias-link lh-1">'.$row_datos['textoBoton'].'</a>
                                        <hr class="noticias-littlebar">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               ';
          } 

          // Respuesta de éxito
          if ($cantidad_filas > 0) {
               echo json_encode([
                    'status' => 'success',
                    'searchData' => $html
               ]);
          } else {
               echo json_encode([
                   'status' => 'success',
                   'searchData' => '
                   <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                         <h4 class="blog-search-error">No se encontraron resultados.</h4>
                   </div>'
               ]);
          }
    }

    if ($verTodo == 'false') {

          if (!empty($value)) {
                $res_sentecia = $mysqli1->query($sentencia . "153");//154

                while ($row_sentencia = $res_sentecia->fetch_assoc()) {
                     $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|?|', $valueFiltrado, $row_sentencia['condiciones']);
                }
           
                $res_datos = $mysqli1->query($sql_datos);
                $cantidad_filas = 0;
           
                $html = '';
                while($row_datos = $res_datos->fetch_assoc()){
                     $cantidad_filas++;

                     $html .= '
                     <li>
                          <a role="button" class="blogsearch-result" data-blog-id="'.$row_datos['id'].'">
                              <div class="row blog-search-found">
                                    <div class="col-6">
                                         <h5>Titulo</h5>
                                    </div>
                                    <div class="col-6">
                                         <h5>Descripcion</h5>
                                    </div>

                                    <div class="col-6">
                                         <h6>'.$row_datos['titulo'].'</h6>
                                    </div>
                                    <div class="col-6">
                                         <h6>'.str_replace('<br>', '', substr($row_datos['descripcionPrincipal'], 0, 57)).'...</h6>
                                    </div>
                               </div>
                          </a>
                     </li>
                     ';
                } 
           
                $html .= '
                     <li>
                          <a role="button" class="blogsearch-result" data-see-more-blogs>
                              <div class="row blog-search-found">
                                    <div class="col-12">
                                         <h6 class="text-center">Ver todos los resultados.</h6>
                                    </div>
                               </div>
                          </a>
                     </li>
                     ';
           
                // Respuesta de éxito
                if ($cantidad_filas > 0) {
                     echo json_encode([
                          'status' => 'success',
                          'searchData' => $html
                     ]);
                } else {
                     echo json_encode([
                         'status' => 'success',
                         'searchData' => '
                         <li>
                               <h4 class="blog-search-error">No se encontraron resultados.</h4>
                         </li>'
                     ]);
                }
          } else {
              http_response_code(400); // Código HTTP 400 (Bad Request)
              echo json_encode([
                  'status' => 'error'
              ]);
          }
    }
} else {
    // Respuesta de error por método no permitido
    http_response_code(405); // Código HTTP 405 (Method Not Allowed)
    echo json_encode([
        'status' => 'error',
        'message' => "Método no permitido"
    ]);
}

?>