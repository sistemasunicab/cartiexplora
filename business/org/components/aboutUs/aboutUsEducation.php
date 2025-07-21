<?php
$html_educacion = '';

// 1) Títulos de educación (sentencia 46)
$rowsTitulosEducacion = obtenerFilas($mysqli1, $sentencia, 46);
$rowsContenidoEducacion = obtenerFilas($mysqli1, $sentencia, 41);

if (!empty($rowsTitulosEducacion)) {
    $html_educacion .= '<div class="row col-12 mx-auto p-0 m-0">';
    
    $html_educacion .= '<div class="col-0 col-lg-1 p-0 m-0"></div>';
    // Columna izquierda: títulos
    $html_educacion .= '<div class="col-10 col-lg-3 d-flex flex-column p-0 gap-5 mx-auto mx-lg-0">';
    foreach ($rowsTitulosEducacion as $row) {
        $titulo    = $row['titulo'];
        $subTitulo = $row['subTitulo'];

        $html_educacion .= '
            <div class="mt-lg-20 mb-lg-3 mb-ws d-flex flex-column gap-3 ms-lg-0 ms-4">
                <h2-nosotros class="tx-blue font-roboto-light-title">' . $titulo . '</h2-nosotros>
                <h3-nosotros class="tx-black font-roboto-bold">' . $subTitulo . '</h3-nosotros>
            </div>';
    }
    $html_educacion .= '</div>';

    // Columna derecha: íconos, textos y descripciones (solo si hay contenido)
    if (!empty($rowsContenidoEducacion)) {
        $html_educacion .= '<div class="col-lg-1 col-0 p-0"></div>';
        $html_educacion .= '<div class="col-10 col-lg-6 d-flex flex-column gap-lg-5 gap-4 mt-0 p-0 mx-auto mx-lg-0">';

        foreach ($rowsContenidoEducacion as $row) {
            $titulo      = $row['titulo'];
            $descripcion = $row['descripcion'];
            $altern      = $row['textoAlterno'];
            $imgSrc      = rutaPorNivel($row['ruta']);

            $idSeccion = '';
            if (strtolower($titulo) === strtolower('Educación Regular(grado 1 a grado 11)')){
                $idSeccion = 'primariaYBachillerato';
            }else if (strtolower($titulo) === strtolower('Educación por ciclos para adultos')) {
                $idSeccion = 'ciclos';
            }

            $html_educacion .= '
                <div class="row d-flex flex-row align-items-start" id="'.$idSeccion.'">
                    <img class="col-2 img-fluid icon-education p-0 m-0" src="' . $imgSrc . '" alt="' . $altern . '">
                    <div class="col-10 d-flex flex-column p-0 m-0 ps-4 ps-lg-5">
                        <h3-nosotros class="font-roboto-black">' . $titulo . '</h3-nosotros>
                        <p-nosotros-1 class="mt-4">' . $descripcion . '</p-nosotros-1>
                    </div>
                </div>';
        }

        $html_educacion .= '</div>';
        $html_educacion .= '<div class="col-0 col-lg-1 p-0 m-0"></div>';
    }

    $html_educacion .= '</div>'; // Cierra row
}
?>

<div class="container-fluid my-ws mx-0 p-0" id="ofertaAcademica">
    <?= $html_educacion ?>
</div>
