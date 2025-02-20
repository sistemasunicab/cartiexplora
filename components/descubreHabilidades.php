<?php
    function posicionTituloImagen($imgHTML, $titulo, $posicionTitulo, $enlace)
    {
        if (strtolower($posicionTitulo) == 'abajo') {
            return
                '<a href="'.$enlace.'" class="img-container d-flex flex-column align-items-center gap-4 p-0 my-3">' . "\n" .
                     $imgHTML . "\n" .
                     '<p class="text-center">' . $titulo . '</p>' . "\n" .
                '</a>' . "\n";
        } else if (strtolower($posicionTitulo) == 'derecha') {
            return
                '<a href="'.$enlace.'" class="img-container d-flex align-items-center gap-4 p-0 mx-3">' . "\n" .
                     $imgHTML . "\n" .
                     '<p>' . $titulo . '</p>' . "\n" .
                '</a>' . "\n";
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            return
                '<a href="'.$enlace.'" class="img-container d-flex flex-row-reverse align-items-center gap-4 p-0 mx-3">' . "\n" .
                    $imgHTML . "\n" .
                    '<p>' . $titulo . '</p>' . "\n" .
                '</a>' . "\n";
        } else if (strtolower($posicionTitulo) == 'arriba') {
            return
                '<a href="'.$enlace.'" class="img-container d-flex flex-column-reverse align-items-center gap-2 p-0 my-3">' . "\n" .
                    $imgHTML . "\n" .
                    '<p class="text-center">' . $titulo . '</p>' . "\n" .
                '</a>' . "\n";
        }
        return '';
    }

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "5");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_habilidades = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_habilidades = $mysqli1->query($sql_seccion_habilidades);

    $html = '';

    while ($row_datos_seccion = $res_seccion_habilidades->fetch_assoc()) {
        // Obtiene el titulo de la sección y lo renderiza
        $html .= 
        '<section class="container">' . 
            '<div class="row mt-10 mx-0">' .
                '<h2 class="col text-center text-blue fm-black px-0">' . "\n" . $row_datos_seccion['titulo'] . '</h2>' . "\n";

        //Obtener subtitulo
        $subtitulo = explode(" ", $row_datos_seccion['subTitulo']);
        $html .= 
                '<h1 class="text-center">' . '<span class="fw-bold">' . $subtitulo[0] . '</span> ' . $subtitulo[1] . '</h1>' . "\n";
        //texto de esta sección 
        $html .= 
                '<p class="text-center">' . $row_datos_seccion['texto'] . '</p>' . "\n" .
            '</div>' . "\n";
    }

    if ($html !== '') {
        $res_sentecia = $mysqli1->query($sentencia . "18");

        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }

        $res_imagenes = $mysqli1->query($sql_imagenes);
        $html .= 
            '<div class="row px-5 mt-10 contenedor-imagenes-habilidades">' . "\n";

        while ($row_imagenes = $res_imagenes->fetch_assoc()) {
            $html .= '<div class="col-md-2 line">';
            $attributes = ImageAttributeBuilder::buildAttributes($nivel, $row_imagenes['ruta'], $row_imagenes['descripcion'], $row_imagenes['rutaEncima']);
            $html .= posicionTituloImagen('<img class="habilidades-img" ' . $attributes . '>', $row_imagenes['titulo'], $row_imagenes['posicionTitulo'], $row_imagenes['enlace']);
            $html .= '</div>'; 
        }

        $html .= 
            '</div>' . "\n".
        '</section>' . "\n";
    }
    echo $html;
