<?php

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "109");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion = $mysqli1->query($sql_seccion);

    $html = '';
    while ($row_datos_seccion = $res_seccion->fetch_assoc()) {

        $html .= '<section class="home-button-fixed px-md-2 py-md-2 p-1">';

        $res_sentecia = $mysqli1->query($sentencia . "110");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_iconos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_iconos = $mysqli1->query($sql_iconos);

        $iconos = [];
        while ($row_icono = $res_iconos->fetch_assoc()) {
            $iconos[] = $row_icono;
        }

        $whatsapp = array_shift($iconos);
        $html .=    '<a href="' . $whatsapp['enlace'] . '" class="button-move w-100" role="button" target="_blank">';
        $html .=       '<div class="button-move_content">';
        $html .=           '<p class="p-boton-flotante"> <span class="button-fixed-text">' . $whatsapp['titulo'] . '</span></p>';
        $html .=               '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $whatsapp['ruta'], $whatsapp['descripcion']) . ' class="button-move-icon img-fluid">';
        $html .=       '</div>';
        $html .=    '</a>';

        $ubicacion = array_shift($iconos);
        $html .=    '<a type="button" class="w-100 text-center location-btn" data-bs-toggle="modal" data-bs-target="#mapaModal">';
        $html .=       '<div class="button-move_content text-center">';
        $html .=           '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $ubicacion['ruta'], $ubicacion['descripcion']) . ' class="button-move-icon img-fluid">';
        $html .=       '</div>';
        $html .=    '</a>';

        $inscripcionesAbiertas = array_shift($iconos);
        $html .=    '<a href="' . $inscripcionesAbiertas['enlace'] . '" class="button-move w-100" role="button">';
        $html .=       '<div class="button-move_content">';
        $html .=           '<p class="p-boton-flotante"> <span class="button-fixed-text">' . $inscripcionesAbiertas['titulo'] . '</span></p>';
        $html .=           '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $inscripcionesAbiertas['ruta'], $inscripcionesAbiertas['descripcion']) . ' class="button-move-icon img-fluid">';
        $html .=       '</div>';
        $html .=    '</a>';
        $html .= '</section>';

                //<!-- Modal -->
        $html .= '<div class="modal fade" id="mapaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        $html .=    '<div class="modal-dialog modal-dialog-centered">';
        $html .=        '<div class="modal-content">';
        $html .=            '<div class="modal-body">';
        $html .=                '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d660.1120965263508!2d-72.93073875198606!3d5.720175396753541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e6a45d923d74d7b%3A0x1542d3785444bf06!2sCOLEGIO%20UNICAB%20VIRTUAL!5e0!3m2!1ses-419!2sco!4v1572036993671!5m2!1ses-419!2sco" width="500" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>';
        $html .=            '</div>';
        $html .=            '<div class="modal-footer">';
        $html .=                '<button type="button" class="btn close-btn-modal" data-bs-dismiss="modal">Cerrar</button>';
        $html .=            '</div>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</div>';

    }

    echo $html;
?>

