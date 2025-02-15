<?php

    require('../../repositories/1cc2s4Sol.php');  

    $html = '';

    // Obtener la imagen
    $res_sentecia = $mysqli1->query($sentencia . "13");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagen_hero = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia_imagen = $mysqli1->query($sql_imagen_hero);

    while($row_imagen = $res_sentencia_imagen->fetch_assoc()){
        $imagen = $row_imagen['ruta'];
    }

    // Obtener el icono y titulo 
    $res_sentecia = $mysqli1->query($sentencia . "17");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_consulta = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia = $mysqli1->query($sql_consulta);

    while($row_imagen = $res_sentencia->fetch_assoc()){
        $icono = $row_imagen['ruta'];
        $titulo = $row_imagen['titulo'];
    }


    // Verificar si la seccion es visible y obtener texto
    $res_sentecia = $mysqli1->query($sentencia . "7");
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

        $html .= '  <div class="row">
                        <div class="col-2"></div>
                        <div class="col-10">' . 
                         $row_datos_seccion['texto']  . 
                        '</div>
                    </div>
                </main>';

    }

    echo $html;
?>

    <!-- <img src="../../../assets/img/solutions-imagen-capacitacion2x.png" alt="" class="img-fluid w-100">
    <main class="container">
        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center"><img class="solutions-icon" src="../../../assets/img/solutions-icon-capacitacion.png" alt=""></div>
            <div class="col-10">
                <h1 class="titulo-md text-blue titulo-servicio">Servicios de <span>capacitación con metodología virtual, e híbrida</span> en diferentes modalidades</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <ul class="ul-solutions">
                    <li>
                        <p class="texto-base descripcion-servicio">
                           <span>Capacitación en manejo de herramientas digitales para enseñanza
                            aprendizaje para docentes</span> a través de cursos, diplomados y seminarios prácticos ajustados a
                            las necesidades propias del grupo.
                        </p>

                    </li>
                    <li>
                        <p class="texto-base descripcion-servicio">
                            <span>Formación y transformación de liderazgo digital para implementar procesos de cambio digital
                            en los trabajadores</span> y asumir el crecimiento de sus organizaciones.
                        </p>
                    </li>
                </ul>
            </div>
        </div>

    </main> -->