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

        $html .= '<section class="row justify-content-center">';
        $html .=    '<div class="col-lg-12">';
        $html .=       '<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagen_hero, 'hero-img').' class="img-fluid w-100">';
        $html .=    '</div>';
        $html .=    '<div class="col-lg-6 hero-card">';
        $html .=       '<h2 class="font-roboto-light-title">'.$row_datos_seccion['titulo'].'</h2>';
        $html .=    '</div>'; 
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<p class="text-center font-roboto">' ; 
        $html .=                $row_datos_seccion['texto'] ; 
        $html .=            '</p>'; 
        $html .=        '</div>';
        $html .=        '<div class="col-lg-12">';
        $html .=            '<p class="text-center font-roboto-italic tx-orange">'; 
        $html .=                $slogan ; 
        $html .=            '</p>' ; 
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
    }

    echo $html;
?>