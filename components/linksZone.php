<!--// LinksZone //-->
<?php
     //-- Funciones --//

     function crearLink($datos){
          $direccion = FlexTitleLoader::setDirection($datos[2]);
          $link = '   
                    <div class="col-lg-4 linksZone-linkGlobal '.$direccion.'"> <!-- Link -->
                         <img src="'.$datos[0].'" alt="" class="linksZone-img">
                         <a href="#" class="font-roboto-bolditalic m-0 linksZone-a special-paragraph">'.$datos[1].'</a>
                    </div> <!-- Link End -->
          ';

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
          <section class="container margin-top-5rem">
               <div class="row">
                    <div class="col-lg-12">
                         <h2 class="font-roboto-black text-center tx-blue mb-4">'.$row_datos['titulo'].'</h2>
                    </div>
               </div>

               <div class="row justify-content-center row-gap-1rem">
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

     // Verificando la visibilidad de la seccion
     if ($html != '') {

          foreach($linksDatos as $datos) {
               $html .= crearLink($datos);
          }

          $html .= '
                    </div>
               </div>
          </section>
          ';
     }

     echo $html;
?>

