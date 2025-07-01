<?php
    session_start();

    if (isset($_SESSION['est_fin'])) {
        function posicionTitulo($imgHTML, $titulo, $posicionTitulo)
        {
            $title = '';
            if (strtolower($posicionTitulo) == 'abajo') {
                $title .= '<div class="row align-items-center justify-content-center my-2">';
                $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">';
                $title .=        $imgHTML;
                $title .=    '</div>';
                $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">';
                $title .=        '<h2 class="h2-costos">' . $titulo . '</h2>';
                $title .=    '</div>';
                $title .= '</div>';
            } else if (strtolower($posicionTitulo) == 'derecha') {
                $title .= '<div class="row align-items-center justify-content-center my-2">';
                $title .=     '<div class="col-lg-3 col-md-3 col-sm-2 col-2"></div>';
                $title .=     '<div class="col-lg-2 col-md-2 col-sm-3 col-3">';
                $title .=         $imgHTML;
                $title .=     '</div>';
                $title .=     '<div class="col-lg-3 col-md-3 col-sm-4 col-4">';
                $title .=         '<h2 class="h2-costos">' . $titulo . '</h2>';
                $title .=     '</div>';
                $title .=     '<div class="col-lg-4 col-md-4 col-sm-3 col-3"></div>';
                $title .= '</div>';
            } else if (strtolower($posicionTitulo) == 'izquierda') {
                $title .= '<div class="row align-items-center justify-content-center my-2">';
                $title .=     '<div class="col-lg-4 col-md-4 col-sm-3 col-3"></div>';
                $title .=     '<div class="col-lg-3 col-md-3 col-sm-4 col-4">';
                $title .=         '<h2 class="h2-costos">' . $titulo . '</h2>';
                $title .=     '</div>';
                $title .=     '<div class="col-lg-2 col-md-2 col-sm-3 col-3">';
                $title .=         $imgHTML;
                $title .=     '</div>';
                $title .=     '<div class="col-lg-3 col-md-3 col-sm-2 col-2"></div>';
                $title .= '</div>';
            } else if (strtolower($posicionTitulo) == 'arriba') {
                $title .= '<div class="row align-items-center justify-content-center my-2">';
                $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">';
                $title .=        '<h2 class="h2-costos">' . $titulo . '</h2>';
                $title .=    '</div>';
                $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">';
                $title .=        $imgHTML;
                $title .=    '</div>';
                $title .= '</div>';
            }
            return $title;
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

        $res_sentecia = $mysqli1->query($sentencia . "78");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }

        $res_seccion = $mysqli1->query($sql_seccion);
        $html = '';
        while ($row_seccion = $res_seccion->fetch_assoc()) {
            $imagenes = [];
            $res_imagenes = $mysqli1->query($sentencia . "164");
            while ($row_sentencia = $res_imagenes->fetch_assoc()) {
                $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
            }
            $res_imagenes = $mysqli1->query($sql_imagenes);
            while ($row_imagenes = $res_imagenes->fetch_assoc()) {
                $imagenes[] = $row_imagenes;
            }

            $titulo = array_shift($imagenes);
            $html .= '<section class="section-titulo-costos">';
            $html .=    '<div class="container">';
            $html .=        posicionTitulo('<img class="img-fluid w-100 icono-titulo-costos" ' . ImageAttributeBuilder::buildAttributes($nivel, $titulo['ruta'], $titulo['descripcion']) . '>', $titulo['titulo'] ,$titulo['posicionTitulo']);
            $html .=    '</div>';
            $html .= '</section>';

            $iconoPDF = array_shift($imagenes);
            $res_circulares= $mysqli1->query($sentencia . "165");
            while ($row_sentencia = $res_circulares->fetch_assoc()) {
                $sql_circulares = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
            }
            $res_circulares = $mysqli1->query($sql_circulares);
            while ($row_circulares = $res_circulares->fetch_assoc()) {
                $html .=    '<div class="row align-items-center justify-content-center margin-circulares-costos">';
                $html .=        '<div class="col-lg-6 col-md-6 col-sm-6 col-6">';
                $html .=            '<p class="titulo-circular-costos">'. $row_circulares['titulo'] .'</p>';
                $html .=        '</div>';
                $html .=        '<div class="col-lg-6 col-md-6 col-sm-6 col-6 text-center">';
                $html .=            '<div class="row align-items-center">';
                $html .=                '<div class="col-lg-6 col-md-6 col-sm-6 col-6">';
                $html .=                    '<a href="'.$row_circulares['ruta'].'" target="'.$row_circulares['destino'].'" class="download-button mx-3">';
                $html .=                        '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $iconoPDF['ruta'], $iconoPDF['descripcion']) . ' class="img-fluid pdf-btn-costos">';
                $html .=                    '</a>';
                $html .=                '</div>';
                $html .=                '<div class="col-lg-6 col-md-6 col-sm-6 col-6">';
                $html .=                    '<a href="'.$row_circulares['linkLeer'].'" class="btn-circulares-costos">' . $iconoPDF['titulo'] . '</a>';
                $html .=                '</div>';
                $html .=            '</div>';
                $html .=        '</div>';
                $html .=    '</div>';
            }

            $html .= '</section>';
        }

        echo $html;
    }
    else{
        echo "<script>alert('Debes iniciar sesión');</script>";
        echo "<script>location.href='estadosFinancieros.php';</script>";
    }
