<?php
    require('../../repositories/1cc2s4Sol.php');

    function posicionTituloImagen($imgHTML, $titulo, $posicionTitulo, $enlace = '')
    {
        if (strtolower($posicionTitulo) == 'abajo') {
            return
            '<div class="col-5 solutions-card">
                <div class="solutions-card-img d-flex justify-content-center align-items-center">
                    '. $imgHTML .'
                </div>
                <div class="solutions-card-desc">
                    <p class="texto-lg">'. $titulo .'</p>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="'. $enlace .'" class="solutions-card-button texto-sm">Más Información</a>
                </div>
            </div>';
        }  else if (strtolower($posicionTitulo) == 'arriba') {
            return
            '<div class="col-5 solutions-card">   
                <div class="solutions-card-desc">
                    <p class="texto-lg">'. $titulo .'</p>
                </div> 
                <div class="solutions-card-img d-flex justify-content-center align-items-center">
                        '. $imgHTML .'
                    </div>
                <div class="d-flex justify-content-end">
                    <a href="'. $enlace .'" class="solutions-card-button texto-sm">Más Información</a>
                </div>
            </div>';
        }
        return '';
    }

    $html = '';

    // Verificar sección
    $res_sentecia = $mysqli1->query($sentencia . "3");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_servicios = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_servicios = $mysqli1->query($sql_seccion_servicios);

    while ($row_datos_seccion = $res_seccion_servicios->fetch_assoc()) {

        $html .= '<section class="container">' . 
                     '<div class="row my-5">'; 
        

        // Obtener imagenes
        $res_sentecia = $mysqli1->query($sentencia . "9");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_imagenes = $mysqli1->query($sql_imagenes);

        $numCards = 1;
        while ($row_imagenes = $res_imagenes->fetch_assoc()) {
           $html .= posicionTituloImagen('<img'.ImageAttributeBuilder::buildAttributes('tres', $row_imagenes['ruta'], 'card-icon').'>', $row_imagenes['titulo'], $row_imagenes['posicionTitulo'], $row_imagenes['enlace']);

            if(!($numCards++ % 2 === 0)){
                $html .=         '<div class="col-1"></div>';
                $html .=         '<div class="col-1"></div>';
            }
           
        }

        $html .=     '</div>' . 
                 '</section>';
    }

    echo $html;
?>


<!-- <section class="container">
    <div class="row my-5">

        <div class="col-1"></div>

        <div class="col-4 solutions-card">
            <div>
                <div class="solutions-card-img d-flex justify-content-center align-items-center">
                    <img src="../../../assets/img/solutions-icon-sistemas.png" alt="">
                </div>
            </div>
            <div class="solutions-card-desc">
                <p class="texto-lg">Diseño de Sistemas y Material Educativo Innovador</p>
            </div>
            <div class="d-flex justify-content-end">
                <a class="solutions-card-button texto-sm">Más Información</a>
            </div>
        </div>
        <div class="col-1"></div>

        <div class="col-1"></div>
        <div class="col-4 solutions-card">

            <div class="solutions-card-img d-flex justify-content-center align-items-center"><img src="../../../assets/img/solutions-icon-desarrollo.png" alt=""></div>
            <div class="solutions-card-desc">
                <p class="texto-lg ">Diseño y Desarrollo de Software</p>
            </div>
            <div class="d-flex justify-content-end">
                <a class="solutions-card-button texto-sm">Más Información</a>
            </div>
        </div>
        <div class="col-1"></div>

        <div class="col-1"></div>
        <div class="col-4 solutions-card">
            <div class="solutions-card-img d-flex justify-content-center align-items-center">
                <img src="../../../assets/img/solutions-icon-transformacion.png" alt="">
            </div>
            <div class="solutions-card-desc">
                <p class="texto-lg ">Capacitación en Transformación Digital</p>
            </div>
            <div class="d-flex justify-content-end">
                <a class="solutions-card-button texto-sm">Más Información</a>
            </div>
        </div>
        <div class="col-1"></div>

        <div class="col-1"></div>
        <div class="col-4 solutions-card">
            <div class="solutions-card-img d-flex justify-content-center align-items-center"><img src="../../../assets/img/solutions-icon-capacitacion.png" alt=""></div>
            <div class="solutions-card-desc">
                <p class="texto-lg ">Servicios de capacitación con metodología virtual, e híbrida en diferentes modalidades</p>
            </div>
            <div class="d-flex justify-content-end">
                <a class="solutions-card-button texto-sm">Más Información</a>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</section> -->