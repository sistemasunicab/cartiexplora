<?php

    require('../../repositories/1cc2s4Sol.php');  

    $html = '';

    // Obtener la imagen
    $res_sentecia = $mysqli1->query($sentencia . "10");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagen_hero = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia_imagen = $mysqli1->query($sql_imagen_hero);

    while($row_imagen = $res_sentencia_imagen->fetch_assoc()){
        $imagen = $row_imagen['ruta'];
    }

    // Obtener el icono y titulo 
    $res_sentecia = $mysqli1->query($sentencia . "14");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_consulta = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia = $mysqli1->query($sql_consulta);

    while($row_imagen = $res_sentencia->fetch_assoc()){
        $icono = $row_imagen['ruta'];
        $titulo = $row_imagen['titulo'];
    }


    // Verificar si la seccion es visible y obtener texto
    $res_sentecia = $mysqli1->query($sentencia . "4");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_disenio = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_disenio = $mysqli1->query($sql_seccion_disenio);

    while($row_datos_seccion = $res_seccion_disenio->fetch_assoc()){

        $html .= '<img'. ImageAttributeBuilder::buildAttributes($nivel, $imagen,'imagen-principal') .'class="img-fluid w-100">';

        $html .= '<main class="container">
                    <div class="row">
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <img class="solutions-icon" '.ImageAttributeBuilder::buildAttributes($nivel, $icono, 'icono') .'>
                        </div>
                        <div class="col-10">
                            <h1 class="titulo-md text-blue titulo-servicio">'. $titulo .'</h1>
                        </div>
                    </div>';

        $html .= '  <div class="row my-5">
                        <div class="col-2"></div>
                        <div class="col-10">' . 
                         $row_datos_seccion['texto']  . 
                        '</div>
                    </div>
                </main>';

    }

    echo $html;
?>

<!-- <img src="../../../assets/img/solutions-imagen-sistemas2x.png" alt="" class="img-fluid w-100">
<main class="container">

    <div class="row">
        <div class="col-2 d-flex justify-content-center align-items-center"><img class="solutions-icon" src="../../../assets/img/solutions-icon-sistemas.png" alt=""></div>
        <div class="col-10">
            <h1 class="titulo-md text-blue titulo-servicio">Diseño de Sistemas y <b>Material Educativo Innovador</b></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-10">
            <p class="texto-base descripcion-servicio">
                <span>Desarrollo de plataformas educativas LMS </span>personalizadas, desarrollo de plataformas de
                contenidos académicos interactivos y gamificados según necesidades y modelo pedagógico,
                aplicaciones móviles para la educación formal e informal.
            </p>
            <ul class="ul-solutions">
                <li>
                    <p class="texto-base descripcion-servicio">
                        <span>Diseño de plataformas educativas virtuales personalizadas (LMS):</span> Sistemas intuitivos y escalables que facilitan la enseñanza y el aprendizaje online.
                    </p>
                </li>
                <li>
                    <p class="texto-base descripcion-servicio">
                        <span>Elaboración de materiales educativos digitales:</span> Contenidos interactivos y multimedia
                        diseñados con metodologías pedagógicas modernas y personalizados.
                    </p>
                </li>
                <li>
                    <p class="texto-base descripcion-servicio">
                        <span>Capacitación para docentes y estudiantes:</span> Formación en el uso de herramientas
                        tecnológicas aplicadas a educación.
                    </p>
                </li>
            </ul>
        </div>
    </div>
</main> -->