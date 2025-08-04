<?php
//nivel de la carpeta desde donde se llama este componente (archivo index.php de la raíz)

if ($nivel == 'raiz') {
    $levelSelect = 'linkNivelRaiz';
    require('business/repositories/1cc2s4Home.php');
}
if ($nivel == 'uno') {
    $levelSelect = 'linkNivelUno';
    require('../business/repositories/1cc2s4Home.php');
}
if ($nivel == 'dos') {
    $levelSelect = 'linkNivelDos';
    require('../../business/repositories/1cc2s4Home.php');
}
if ($nivel == 'tres') {
    $levelSelect = 'linkNivelTres';
    require('../../../business/repositories/1cc2s4Home.php');
}

$numero_de_sentencia = "32";
$res_sentencia = $mysqli1->query($sentencia . $numero_de_sentencia);
while ($row_sentencia = $res_sentencia->fetch_assoc()) {
    $condiciones = str_replace('|x|', '\'\'', $row_sentencia['condiciones']);
    $condiciones = str_replace('|y|', '\'\'', $condiciones);
    $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $condiciones;
}
$res_datos = $mysqli1->query($sql_datos);
// Validar que la consulta fue exitosa
$html_base = '<ul id="menuDisplay" class="p-0 d-none d-md-flex text-start" >';
if ($res_datos) {
    // Acceder a los datos 
    while ($row_datos = $res_datos->fetch_assoc()) {
        $id = $row_datos['id'];
        $html_base .= '<li class="nav-item py-2 py-md-0 h-100 mx-auto mx-sm-0">';
        $html_base .= '<div class="menu-item d-md-flex m-md-auto px-md-2 h-100">';
        if ($row_datos[$levelSelect] != '') {
            $html_base .= '<div class = "m-auto font-roboto-regular tx-white special-paragraph menu-item-text" target="' . $row_datos['destino'] . '" href="' . $row_datos[$levelSelect] . '">';
            $html_base .= '<a>';
            $html_base .= htmlspecialchars($row_datos['menu']);
            $html_base .= '</a>';
            $html_base .= '<i class="icon-row fas fa-chevron-right p-0 mx-2 w-auto"></i>';
            $html_base .= '</div>';
        } else {
            $html_base .= '<p class="m-auto font-roboto-regular tx-white special-paragraph menu-item-text">';
            $html_base .= htmlspecialchars($row_datos['menu']);
            $html_base .= '<i class="icon-row fas fa-chevron-down p-0 mx-2 w-auto"></i>';
            $html_base .= '</p>';
        }
        $html_base .= '</div>';
        $res_sentencia_h = $mysqli1->query($sentencia . $numero_de_sentencia);
        while ($row_sentencia_h = $res_sentencia_h->fetch_assoc()) {
            $condiciones = str_replace('|x|', '\'' . 'raiz' . '\'', $row_sentencia_h['condiciones']);
            $condiciones = str_replace('|y|', '\'' . $id . '\'', $condiciones);
            $sql_datos_h = $row_sentencia_h['campos'] . $row_sentencia_h['tablas'] . $condiciones;
        }
        $res_datos_h = $mysqli1->query($sql_datos_h);
        if ($res_datos_h && $res_datos_h->num_rows > 0) {
            $html_s = '<div class="dropdown_our-container w-100 d-flex">';
            $html_s .= '<ul class="dropdown_our w-100 d-none py-4 bg-blue">';
            $html_s2 = '';
            $count_base = 0;
            while ($row_datos_h = $res_datos_h->fetch_assoc()) {
                if ($count_base % 7 === 0) {
                    if ($count_base > 0) {
                        $html_s .= '</div>'; // Cierra el contenedor anterior si no es el primero
                    }
                    $html_s .= '<div class="d-md-flex flex-column me-md-3">'; // Nueva columna
                }
                $id_2 = $row_datos_h['id'];
                $html_s .= '<li class="dropdown_our-item position-relative tx-white font-roboto-regular px-3 mb-2 text-start" id="submenu_' . $id . '.' . $id_2 . '">';
                if ($row_datos_h[$levelSelect] != '') {
                    $html_s .= '<a class="w-auto col-md-12 d-block text-center text-md-start" href="' . $row_datos_h[$levelSelect] . '">';
                    $html_s .= htmlspecialchars($row_datos_h['menu']);
                    $html_s .= '</a>';
                } else {
                    $html_s .= htmlspecialchars($row_datos_h['menu']);
                    $html_s .= '<i class="icon-row fas fa-chevron-right"></i>';
                }
                $res_sentencia_h2 = $mysqli1->query($sentencia . $numero_de_sentencia);
                while ($row_sentencia_h2 = $res_sentencia_h2->fetch_assoc()) {
                    $condiciones = str_replace('|x|', '\'' . 'uno' . '\'', $row_sentencia_h2['condiciones']);
                    $condiciones = str_replace('|y|', '\'' . $id_2 . '\'', $condiciones);
                    $sql_datos_h2 = $row_sentencia_h2['campos'] . $row_sentencia_h2['tablas'] . $condiciones;
                }
                $res_datos_h2 = $mysqli1->query($sql_datos_h2);
                if ($res_datos_h2 && $res_datos_h2->num_rows > 0) {
                    $html_s2 .= '<ul class="dropdown_our2 w-100 w-md-auto" id="submenu_' . $id . '.' . $id_2 . '_dropdown_our">';
                    $count = 0;
                    while ($row_datos_h2 = $res_datos_h2->fetch_assoc()) {
                        // Añadir un contenedor cada 6 elementos
                        if ($count % 6 === 0) {
                            if ($count > 0) {
                                $html_s2 .= '</div>'; // Cierra el contenedor anterior si no es el primero
                            }
                            $html_s2 .= '<div class="d-md-flex flex-column me-md-3">'; // Nueva columna
                        }
                        $html_s2 .= '<li class="dropdown_our-item position-relative tx-white font-roboto-regular px-3 mb-2 text-start">';
                        $html_s2 .= '<a href="' . $row_datos_h2[$levelSelect] . '">';
                        $html_s2 .= htmlspecialchars($row_datos_h2['menu']);
                        $html_s2 .= '</a>';
                        $html_s2 .= '</li>';
                        $count++;
                    }
                    if ($count > 0) {
                        $html_s2 .= '</div>'; // Cierra la última columna
                    }
                    $html_s2 .= '</ul>';
                }
                $html_s .= '</li>';
                $count_base++;
            }
            if ($count_base > 0) {
                $html_s .= '</div>'; // Cierra la última columna
            }
            $html_s .= '</ul>';
            $html_s .= $html_s2;
            $html_s .= '</div>';
            $html_base .= $html_s;
        }
        $html_base .= '</li>';
    }
} else {
    // Manejo de errores en caso de fallo en la consulta
    echo "Error en la consulta: " . $mysqli1->error;
}
$html_base .= '</ul>';
?>

<?php
$numero_de_sentencia_logo = "33";
$res_sentencia_logo = $mysqli1->query($sentencia . $numero_de_sentencia_logo);
while ($row_sentencia_logo = $res_sentencia_logo->fetch_assoc()) {
    $condiciones = str_replace('|', '\'', $row_sentencia_logo['condiciones']);
    $sql_datos_logo = $row_sentencia_logo['campos'] . $row_sentencia_logo['tablas'] . $condiciones;
}
$res_datos_logo = $mysqli1->query($sql_datos_logo);
while ($row_datos_logo = $res_datos_logo->fetch_assoc()) {
    $ruta_logo = $row_datos_logo['ruta'];
}

$html = '';
if ($nivel == "raiz") {
    //$html .= '<a class="unicab-brand" href="business/solutions/pages/somos.php">';
    $html .= '<a class="unicab-brand" href="https://unicab.solutions/nus/business/solutions/pages/somos.php">';
    $html .= '<img src="' . $ruta_logo . '" alt="" width="162" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
} else if ($nivel == "uno") {
    //$html .= '<a class="unicab-brand" href="../business/solutions/pages/somos.php">';
    $html .= '<a class="unicab-brand" href="https://unicab.solutions/nus/business/solutions/pages/somos.php">';
    $html .= '<img src="../' . $ruta_logo . '" alt="" width="162" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
} else if ($nivel == "dos") {
    //$html .= '<a class="unicab-brand" href="../../business/solutions/pages/somos.php">';
    $html .= '<a class="unicab-brand" href="https://unicab.solutions/nus/business/solutions/pages/somos.php">';
    $html .= '<img src="../../' . $ruta_logo . '" alt="" width="162" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
} else if ($nivel == "tres") {
    //$html .= '<a class="unicab-brand" href="../../../business/solutions/pages/somos.php">';
    $html .= '<a class="unicab-brand" href="https://unicab.solutions/nus/business/solutions/pages/somos.php">';
    $html .= '<img src="../../../' . $ruta_logo . '" alt="" width="162" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
}
?>
<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <nav class="navbar col-12 bg-orange p-0 h-md-70 main-nav">
            <div class="d-md-flex m-auto text-start p-0 col-12 col-md-11 h-100 justify-content-between">
                <div class="p-md-0 d-flex flex-row m-auto mx-md-0 p-3 justify-content-between">
                    <?php echo $html; ?>
                    <button class="navbar-toggler d-md-none" type="button" id="menu-button">
                        <i class="fas fa-bars tx-white p-2" id="bars"></i>
                    </button>
                </div>
                <?php
                echo $html_base;
                ?>
            </div>
        </nav>
    </div>
</div>

<?php
if ($nivel == 'raiz') {
    echo '<script src="assets/js/script.js?v=1.0"></script>';
}
if ($nivel == 'uno') {
    echo '<script src="../assets/js/script.js?v=1.0"></script>';
}
if ($nivel == 'dos') {
    echo '<script src="../../assets/js/script.js?v=1.0"></script>';
}
if ($nivel == 'tres') {
    echo '<script src="../../../assets/js/script.js?v=1.0"></script>';
}
?>