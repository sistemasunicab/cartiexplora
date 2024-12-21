<style>
    .nosotros {
        margin-block: 4rem;
        width: 100%;
    }

    .container-nosotros {
        display: flex;
        width: 90%;
        margin-inline: auto;
    }

    .queEs {
        margin-inline: auto;
        width: 45%;
    }

    .queEs h1 {
        font-family: 'Roboto-light';
        color: #127EB5;
        margin-bottom: 6rem;
    }

    .queEs h1 b {
        font-family: 'Roboto-bold';
    }

    .queEs p {
        font-size: .95rem;
        font-family: 'Roboto-regular';
        margin-bottom: 3rem;
    }

    .organigrama {
        margin-inline: auto;
        margin-top: auto;
        width: 40%;
    }

    .organigrama img {
        width: 100%;
    }
</style>
<?php
$numero_de_sentencia_nosotros = "35";
$res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
    $condiciones_nosotros = str_replace('||', '\'\'', $row_sentencia_nosotros['condiciones']);
    $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
}

$res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

if ($res_datos_nosotros->num_rows > 0) {
    $html_nosotros = '<div class="nosotros">';
    $html_nosotros .= '<div class="container-nosotros">';

    while ($row_datos_nosotros = $res_datos_nosotros->fetch_assoc()) {
        $html_nosotros .= '<div class="queEs">';
        $html_nosotros .= '<h1>' . $row_datos_nosotros['titulo'] . '</h1>';
        $html_nosotros .= '<p>' . $row_datos_nosotros['texto'] . '</p>';
        $html_nosotros .= '</div>';
    }

    $numero_de_sentencia_nosotros = "30";
    $res_sentencia_nosotros = $mysqli1->query($sentencia . $numero_de_sentencia_nosotros);
    while ($row_sentencia_nosotros = $res_sentencia_nosotros->fetch_assoc()) {
        $condiciones_nosotros = str_replace('||', '\'\'', $row_sentencia_nosotros['condiciones']);
        $sql_datos_nosotros = $row_sentencia_nosotros['campos'] . $row_sentencia_nosotros['tablas'] . $condiciones_nosotros;
    }

    $res_datos_nosotros = $mysqli1->query($sql_datos_nosotros);

    while ($row_datos_nosotros = $res_datos_nosotros->fetch_assoc()) {
        $html_nosotros .= '<div class="organigrama">';
        $path = $row_datos_nosotros['ruta'];
        $altern = $row_datos_nosotros['textoAlterno'];
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
        $html_nosotros .= '<img src="' . $path_image . '" alt="' . $altern . '">';
        $html_nosotros .= '</div>';
    }

    $html_nosotros .= '</div>';
    $html_nosotros .= '</div>';

    echo $html_nosotros;
}
?>