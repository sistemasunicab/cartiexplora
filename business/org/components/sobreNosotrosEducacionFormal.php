<style>
    .educacion {
        margin-block: 6rem;
        width: 100%;
    }

    .container-educacion {
        display: flex;
        width: 85%;
        justify-content: space-between;
        margin-inline: auto;
    }

    .titles {
        margin-top: 15%;
        width: 30%;
    }

    .titles h1 {
        font-family: 'Roboto-light';
        color: #127EB5;
    }

    .titles h1 b {
        font-family: 'Roboto-bold';
    }

    .titles h2 {
        font-family: 'Roboto-bold';
        margin-bottom: 3rem;
    }

    .educacion-data{
        width: 60%;
        display: flex;
        flex-direction: column;
    }

    .educacion-data img{
        width: 50px;
        height: fit-content;
    }

    .educacion-item{
        font-family: 'Roboto-regular';
        display: flex;
        flex-direction: row;
        gap: 2rem;
    }

    .educacion-item-data h2{
        font-family: 'Roboto-black';
    }

    .educacion-item-data {
        margin-bottom: 1rem;
    }

</style>
<?php
$numero_de_sentencia_educacion = "37";
$res_sentencia_educacion = $mysqli1->query($sentencia . $numero_de_sentencia_educacion);
while ($row_sentencia_educacion = $res_sentencia_educacion->fetch_assoc()) {
    $condiciones_educacion = str_replace('||', '\'\'', $row_sentencia_educacion['condiciones']);
    $sql_datos_educacion = $row_sentencia_educacion['campos'] . $row_sentencia_educacion['tablas'] . $condiciones_educacion;
}

$res_datos_educacion = $mysqli1->query($sql_datos_educacion);

if ($res_datos_educacion->num_rows > 0) {
    $html_educacion = '<div class="educacion">';
    $html_educacion .= '<div class="container-educacion">';

    while ($row_datos_educacion = $res_datos_educacion->fetch_assoc()) {
        $html_educacion .= '<div class="titles">';
        $html_educacion .= '<h1>' . $row_datos_educacion['titulo'] . '</h1>';
        $html_educacion .= '<h2>' . $row_datos_educacion['subTitulo'] . '</h2>';
        $html_educacion .= '</div>';
    }

    $numero_de_sentencia_educacion = "32";
    $res_sentencia_educacion = $mysqli1->query($sentencia . $numero_de_sentencia_educacion);
    while ($row_sentencia_educacion = $res_sentencia_educacion->fetch_assoc()) {
        $condiciones_educacion = str_replace('||', '\'\'', $row_sentencia_educacion['condiciones']);
        $sql_datos_educacion = $row_sentencia_educacion['campos'] . $row_sentencia_educacion['tablas'] . $condiciones_educacion;
    }

    $res_datos_educacion = $mysqli1->query($sql_datos_educacion);

    $html_educacion .= '<div class="educacion-data">';
    while ($row_datos_educacion = $res_datos_educacion->fetch_assoc()) {
        
        $path = $row_datos_educacion['ruta'];
        $altern = $row_datos_educacion['textoAlterno'];
        $descripcion = $row_datos_educacion['descripcion'];
        $titulo = $row_datos_educacion['titulo'];
        $path_image = '';
        if ($nivel == "raiz") {
            $path_image = $path;
        } else if ($nivel == "uno") {
            $path_image = '../' . $path;
        } else if ($nivel == "dos") {
            $path_image = '../../' . $path;
        } else if ($nivel == "tres") {
            $path_image = '../../../' . $path;
        }
        $html_educacion .= '<div class="educacion-item">';
        $html_educacion .= '<img src="' . $path_image . '" alt="' . $altern . '">';
        $html_educacion .= '<div class="educacion-item-data">';
        $html_educacion .= '<h2>' . $titulo . '</h2>';
        $html_educacion .= '<p>' . $descripcion . '</p>';
        $html_educacion .= '</div>';
        $html_educacion .= '</div>';
    }
    $html_educacion .= '</div>';

    $html_educacion .= '</div>';
    $html_educacion .= '</div>';

    echo $html_educacion;
}
?>