<!--// LinksZone //-->
<?php
     //-- Funciones --//

     function posicionamientoTitulo($direccion){
          $direcciones = [
               'izquierda' => 'linksZone-linkLeft',
               'derecha' => 'linksZone-linkRight',
               'abajo' => 'linksZone-linkBottom',
               'arriba' => 'linksZone-linkUp',
          ];

          return $direcciones[$direccion];
     }

     function crearLink($datos){
          $link = '   
                    <div class="col-3 linksZone-linkGlobal '.posicionamientoTitulo($datos[2]).'"> <!-- Link -->
                         <img src="'.$datos[0].'" alt="" class="linksZone-img">
                         <a href="#" class="linksZone-a">'.$datos[1].'</a>
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
          <section>
               <div class="container margin-top-5rem">
                    <h2 class="linksZone-title text-center text-blue">'.$row_datos['titulo'].'</h2>
                         <div class="row gap-column-1rem justify-content-center">
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

<!-- 

<div class="col-3 linksZone-linkGlobal linksZone-linkRight">
     <img src="assets/img/manual.png" alt="" class="linksZone-img">
     <a href="#" class="linksZone-a">Manual de convivencia</a>
</div>

-->

