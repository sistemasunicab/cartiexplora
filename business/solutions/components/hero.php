<?php

    require('../../repositories/1cc2s4Sol.php');  

    $html = '';

    //Obtener imagen
    $res_sentecia = $mysqli1->query($sentencia . "8");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagen_hero = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia_imagen = $mysqli1->query($sql_imagen_hero);

    while($row_imagen_hero = $res_sentencia_imagen->fetch_assoc()){
        $imagen_hero = $row_imagen_hero['ruta'];
    }

    //Obtener slogan
    $res_sentencia = $mysqli1->query($sentencia."1");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
        $sql_slogan = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }  

    $res_sentencia_slogan = $mysqli1->query($sql_slogan);

    while($row_slogan = $res_sentencia_slogan->fetch_assoc()){
        $slogan = $row_slogan['t1'];
    }

    // Verificar sección
    $res_sentecia = $mysqli1->query($sentencia . "2");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_hero = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_hero = $mysqli1->query($sql_seccion_hero);

    while($row_datos_seccion = $res_seccion_hero->fetch_assoc()){
       $html .= '<img src="../../../'. $imagen_hero .'" alt="imagen-hero" class="img-fluid imagen-hero">';

       $html .= '<div class="hero-card">' .
                    '<h1>'.$row_datos_seccion['titulo'].'</h1>' .
                '</div>'; 

       $html .= '<section class="container my-4">' . 
                    '<p class="text-center texto-base">' . 
                        $row_datos_seccion['texto'] . 
                    '</p>'. 
                    '<p class="solutions-slogan text-center">'. 
                        $slogan . 
                    '</p>' . 
                '</section>';
    }

    echo $html;
?>


<!-- <img src="../../../assets/img/solutions-imagen-hero.png" alt="" class="img-fluid imagen-hero">

    <div class="hero-card">
        <h1>Innovación y Soluciones Tecnológicas con <strong>UNICAB Solutions</strong></h1>
    </div>

    <section class="container my-4">
        <p class="text-center texto-base">
            En <strong>UNICAB Solutions</strong> transformamos ideas en soluciones tecnológicas que marcan la diferencia. Desde plataformas educativas personalizadas hasta software a medida y programas de capacitación en transformación digital, estamos aquí para revolucionar la forma en que aprendes, trabajas y lideras.
            <br>
            <br>
            Nuestros servicios combinan innovación, personalización y tecnología avanzada para que alcances tus metas, sin importar el tamaño de tu proyecto o tu sector.
        </p>
        <p class="solutions-slogan text-center">¡Es momento de dar el salto hacia el futuro con nosotros!</p>

    </section> -->