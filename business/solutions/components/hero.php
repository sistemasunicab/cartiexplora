<?php

    require('../../repositories/1cc2s4Sol.php');  

    $html = '';

    //Obtener imagen
    $res_sentecia = $mysqli1->query($sentencia . "8");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes_hero = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia_imagenes = $mysqli1->query($sql_imagenes_hero);

    while($row_imagenes_hero = $res_sentencia_imagenes->fetch_assoc()){

        // 0 -> Imagen escritorio - tableta horizontal
        // 1 -> Imagen movil - tableta vertical
        $imagenes_hero[] = $row_imagenes_hero;
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

    $imagenHorizontal = array_shift($imagenes_hero);
    $imagenVertical = array_shift($imagenes_hero);

    $imagenes = [
        // Escritorio - Tableta Horizontal
        [
            'atributos' => ImageAttributeBuilder::buildAttributes($nivel, $imagenHorizontal['ruta'], $imagenHorizontal['descripcion']),
            'clases'    => 'd-lg-inline d-md-inline d-sm-none d-none img-fluid w-100'
        ],
        //Movil - Tableta Vertical
        [
            'atributos' => ImageAttributeBuilder::buildAttributes($nivel, $imagenVertical['ruta'], $imagenVertical['descripcion']),
            'clases'    => 'd-lg-none d-md-none d-sm-inline d-inline img-fluid w-100'
        ]
    ];

    while($row_datos_seccion = $res_seccion_hero->fetch_assoc()){

        $html .= '<div class="w-100">';

        foreach ($imagenes as $img) {
            $html .= '<img ' . $img['atributos'] . ' class="' . $img['clases'] . '">';
        }

        $html .= '</div>';
        $html .= '<section class="container">';
        $html .=    '<div class="row justify-content-center">';
        $html .=       '<div class="col-lg-7 col-md-8 col-sm-10 col-11 hero-card">';
        //$html .=          '<h2 class="font-roboto-light-title">'.$row_datos_seccion['titulo'].'</h2>';
        $html .=          '<a href="transformacionDigital.php#cursoDesarrolloPensamientoLogico" class="solutions-card-button tx-white bg-orange font-roboto-bolditalic d-lg-inline d-md-block d-sm-block d-block">'.$row_datos_seccion['subTitulo'].'</a>';
        $html .=       '</div>'; 
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p class="text-center font-roboto">' ; 
        $html .=                $row_datos_seccion['texto'] ; 
        $html .=            '</p>'; 
        $html .=        '</div>';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p class="text-center font-roboto-italic tx-orange">'; 
        $html .=                $slogan ; 
        $html .=            '</p>' ; 
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
    }

    echo $html;
?>