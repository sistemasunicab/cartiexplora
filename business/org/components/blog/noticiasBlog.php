<?php  
     //-- Funciones --//

     function construirAtributosBlog($rutaImagenNormal, $rutaImagenEncima) {
          $atributos = '';

          $rutaEncima = '|../../../'.$rutaImagenEncima.'|';
          $rutaNormal = '|../../../'.$rutaImagenNormal.'|';

          $atributos .= 'onmouseover="cambiarImagenBlog(this, '.str_replace('|', "'", $rutaEncima).')" ';
          $atributos .= 'onmouseout="restaurarImagenBlog(this, '.str_replace('|', "'", $rutaNormal).')" ';

          return $atributos;
     }

     function generarBlog($datos) {
          $bloque = '
          <div class="col-lg-2 mx-4 d-flex align-items-center flex-column transform-hover" '.construirAtributosBlog($datos['rutaImagen'], $datos['rutaImagenEncima']).' > <!-- Block start -->
               <img src="../../../'.$datos['rutaImagen'].'" alt="" class="blog-blockImg">
               
               <div class="p-3 bg-white box-shadow-o5rem blog-blocksize d-flex flex-column justify-content-between">
                    <div>
                         <p class="little-paragraph m-0">'.$datos['fechaPublicacion'].'</p>
                         <h3 class="font-roboto-bolditalic m-0">'.$datos['tituloBlog'].'</h3>
                    </div>

                    <p class="m-0 little-paragraph text-center">'.substr($datos['descripcion'], 0, 100).'</p>
                    <a href="" class="font-roboto-italic">'.$datos['textoBoton'].'</a>
               </div>
          </div> <!-- Block End -->';
          
          return $bloque;
     }

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

    $res_sentecia = $mysqli1->query($sentencia . "98");//44
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '
          <section class ="container margin-top-5rem mb-5">
               <div class="row">
                    <div class="col-lg-12">
                         <h2 class="font-roboto-black text-center">'.$row_datos_seccion['titulo'].'</h2>
                    </div>
               </div>';
    }

     // Obteniendo los ultimos 4 blogs
     $res_sentencia = $mysqli1->query($sentencia."99");//45
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
               'tituloBlog' => $row_datos['titulo']
          ];
     }

    if ($html != '') {
        $html .= '<div class="row justify-content-between mt-5">'; 

        foreach($blogs as $datosBlog) {
          $html .= generarBlog($datosBlog);
        }

        $html .= '
               </div>
          </section>
        ';
    }

    echo $html;
?>