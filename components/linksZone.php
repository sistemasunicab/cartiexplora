<!--// LinksZone //-->
<?php
     //-- Funciones --//

     function crearLink($datos, $links){
          if ($datos[1] == "Biblioteca") {
               $link = '   
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 linksZone-container linkCarousel-block"> <!-- Link -->
                         <img src="'.$datos[0].'" alt="" class="img-fluid">
                         <a href="'.$links[$datos[1]].'" target="_blank">'.$datos[1].'</a>
                    </div>
               ';
          }
          else {
               $link = '   
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 linksZone-container linkCarousel-block"> <!-- Link -->
                         <img src="'.$datos[0].'" alt="" class="img-fluid">
                         <a href="'.$links[$datos[1]].'">'.$datos[1].'</a>
                    </div>
               ';
          }          

          return $link;
     }

     //-- Runtime --//

     // Poniendo el nivel
     $nivel = "raiz";

     // obteniendo informacion principal
     require('business/repositories/1cc2s4Home.php');
     $res_sentencia = $mysqli1->query($sentencia."9");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }     
     // obteniendo datos importantes y inicializando $html
     $res_datos = $mysqli1->query($sql_datos);
     $html = '';
     while($row_datos = $res_datos->fetch_assoc()){

          // Renderizando la seccion
          $html .= '
          <section class="linksZone-section">
               <div class="container">
                    <div class="row">
                         <div class="col-lg-12">
                              <h2 class="linksZone-title text-center">'.$row_datos['titulo'].'</h2>
                         </div>
                    </div>
               </div>
          
               <div class="container">
                    <div class="row">
                         <div class="col-lg-0 col-md-1 col-sm-0 col-0"></div>
                         <div class="col-lg-12 col-md-10 col-sm-12 col-12 position-relative">
                              <div class="row m-0" id="linksCarousel">
          ';
     }    

     // Obteniendo los iconos de los links
     $res_sentencia = $mysqli1->query($sentencia."22");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  
     
     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $linksDatos[] = [$row_datos['ruta'], $row_datos['titulo'], $row_datos['posicionTitulo']];
     }    

     $res_sentencia = $mysqli1->query($sentencia."131");
     while($row_sentencia = $res_sentencia->fetch_assoc()){
          $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
     }  

     $res_datos = $mysqli1->query($sql_datos);
     while($row_datos = $res_datos->fetch_assoc()){
          $links[$row_datos['identificacion']] = $row_datos['link'];
     }  

     // Verificando la visibilidad de la seccion
     if ($html != '') {
          

          foreach($linksDatos as $datos) {
               $html .= crearLink($datos, $links);
          }

          $html .= '
                         </div>

                         <a role="button" class="col-1" id="linksCarousel_next"></a>
                         <a role="button" class="col-1" id="linksCarousel_previous"></a>
                    </div>

                    <div class="col-lg-0 col-md-1 col-sm-0 col-0"></div>
               </div>
          </section>
          ';
     }

     echo $html;
?>

