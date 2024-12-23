<style>
    .info {
        margin-block: 6rem;
        width: 100%;
    }

    .container-info {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 85%;
        margin-inline: auto;
    }

    .info-item{
        width: 26%;
        font-family: 'Roboto-regular';
        display: flex;
        flex-direction: column;

    }

    .info-item img{
        padding-left: 1rem;
        width: 50px;
        height: fit-content;
    }

    .info-item-data h2{
        color: #Fe9100;
        padding-left: 1rem;
        font-family: 'Roboto-light';
    }

    .info-item-data h2 b{
        font-family: 'Roboto-bold';
    }

    .info-item-data p{
        font-family: 'Roboto-regular';
        padding-block: .5rem;
        padding-left: 1rem;
        position: relative;
    }

    .info-item-data p::before {
        content: '';   
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 2px;
        max-height: 400px;
        border-left: 2px solid rgb(187, 187, 187);
    }
    

    .info-item-data {
        margin-bottom: 1rem;
    }

</style>

<?php
$numero_de_sentencia_info = "39";
$res_sentencia_info = $mysqli1->query($sentencia . $numero_de_sentencia_info);
while ($row_sentencia_info = $res_sentencia_info->fetch_assoc()) {
    $condiciones_info = str_replace('||', '\'\'', $row_sentencia_info['condiciones']);
    $sql_datos_info = $row_sentencia_info['campos'] . $row_sentencia_info['tablas'] . $condiciones_info;
}

$res_datos_info = $mysqli1->query($sql_datos_info);

if ($res_datos_info->num_rows > 0) {
    $html_info = '';

    $html_info = '<div class="info">';
    $html_info .= '<div class="container-info">';

    $numero_de_sentencia_info = "34";
    $res_sentencia_info = $mysqli1->query($sentencia . $numero_de_sentencia_info);
    while ($row_sentencia_info = $res_sentencia_info->fetch_assoc()) {
        $condiciones_info = str_replace('||', '\'\'', $row_sentencia_info['condiciones']);
        $sql_datos_info = $row_sentencia_info['campos'] . $row_sentencia_info['tablas'] . $condiciones_info;
    }

    $res_datos_info = $mysqli1->query($sql_datos_info);
    while ($row_datos_info = $res_datos_info->fetch_assoc()) {
        $path = $row_datos_info['ruta'];
        $altern = $row_datos_info['textoAlterno'];
        $descripcion = $row_datos_info['descripcion'];
        $titulo = $row_datos_info['titulo'];
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

        $html_info .= '<div class="info-item">';
        $html_info .= '<img src="' . $path_image . '" alt="' . $altern . '">';
        $html_info .= '<div class="info-item-data">';
        $html_info .= '<h2>' . $titulo . '</h2>';
        $html_info .= '<p>' . $descripcion . '</p>';
        $html_info .= '</div>';
        $html_info .= '</div>';
    }


    echo $html_info;
}
?>