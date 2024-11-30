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

//Obtencion items base del menu
$res_sentencia = $mysqli1->query($sentencia . "3");
while ($row_sentencia = $res_sentencia->fetch_assoc()) {
    $condiciones = str_replace('|x|', '\'\'', $row_sentencia['condiciones']);
    $condiciones = str_replace('|y|', '\'\'', $condiciones);
    $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $condiciones;
}
$res_datos = $mysqli1->query($sql_datos);


$html_base = '<ul class="navbar-nav">';
if ($res_datos) {
    // Acceder a los datos
    while ($row_datos = $res_datos->fetch_assoc()) {
        $id = $row_datos['id'];
        $html_base .= '<li class="nav-item">';
        $html_base .= '<div class="menu-item">';
        if ($row_datos[$levelSelect] != '') {
            $html_base .= '<a class = "menu-item-text" target="' . $row_datos['destino'] . '" href="' . $row_datos[$levelSelect] . '">';
            $html_base .= htmlspecialchars($row_datos['menu']);
            $html_base .= '</a>';
        } else {
            $html_base .= '<p class="menu-item-text">';
            $html_base .= htmlspecialchars($row_datos['menu']);
            $html_base .= '</p>';
        }
        $html_base .= '</div>';
        $res_sentencia_h = $mysqli1->query($sentencia . "3");
        while ($row_sentencia_h = $res_sentencia_h->fetch_assoc()) {
            $condiciones = str_replace('|x|', '\'' . 'raiz' . '\'', $row_sentencia_h['condiciones']);
            $condiciones = str_replace('|y|', '\'' . $id . '\'', $condiciones);
            $sql_datos_h = $row_sentencia_h['campos'] . $row_sentencia_h['tablas'] . $condiciones;
        }
        $res_datos_h = $mysqli1->query($sql_datos_h);
        if ($res_datos_h && $res_datos_h->num_rows > 0) {
            $html_s = '<div class="dropdown-container">';
            $html_s .= '<ul class="dropdown">';
            $html_s2 = '';
            while ($row_datos_h = $res_datos_h->fetch_assoc()) {
                $id_2 = $row_datos_h['id'];
                $html_s .= '<li class="dropdown-item" id="submenu_' . $id . '.' . $id_2 . '">';
                if ($row_datos_h[$levelSelect] != '') {
                    $html_s .= '<a href="' . $row_datos_h[$levelSelect] . '">';
                    $html_s .= htmlspecialchars($row_datos_h['menu']);
                    $html_s .= '</a>';
                } else {
                    $html_s .= htmlspecialchars($row_datos_h['menu']);
                }
                $res_sentencia_h2 = $mysqli1->query($sentencia . "3");
                while ($row_sentencia_h2 = $res_sentencia_h2->fetch_assoc()) {
                    $condiciones = str_replace('|x|', '\'' . 'uno' . '\'', $row_sentencia_h2['condiciones']);
                    $condiciones = str_replace('|y|', '\'' . $id_2 . '\'', $condiciones);
                    $sql_datos_h2 = $row_sentencia_h2['campos'] . $row_sentencia_h2['tablas'] . $condiciones;
                }
                $res_datos_h2 = $mysqli1->query($sql_datos_h2);
                if ($res_datos_h2 && $res_datos_h2->num_rows > 0) {
                    $html_s2 .= '<ul class="dropdown2" id="submenu_' . $id . '.' . $id_2 . '_dropdown">';
                    $count = 0;
                    while ($row_datos_h2 = $res_datos_h2->fetch_assoc()) {
                        // Añadir un contenedor cada 6 elementos
                        if ($count % 6 === 0) {
                            if ($count > 0) {
                                $html_s2 .= '</div>'; // Cierra el contenedor anterior si no es el primero
                            }
                            $html_s2 .= '<div class="dropdown-column">'; // Nueva columna
                        }
                        $html_s2 .= '<li class="dropdown-item divide-words">';
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
$html = '';
if ($nivel == "raiz") {
    $html .= '<a class="navbar-brand" href="index.php">';
    $html .= '<img src="assets/img/unicab.png" alt="" width="55" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
} else if ($nivel == "uno") {
    $html .= '<a class="navbar-brand" href="../index.php">';
    $html .= '<img src="../assets/img/unicab.png" alt="" width="55" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
} else if ($nivel == "dos") {
    $html .= '<a class="navbar-brand" href="../../index.php">';
    $html .= '<img src="../../assets/img/unicab.png" alt="" width="55" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
} else if ($nivel == "tres") {
    $html .= '<a class="navbar-brand" href="../../../index.php">';
    $html .= '<img src="../../../assets/img/unicab.png" alt="" width="55" height="55" class="d-inline-block align-text-center">';
    $html .= '</a>';
}
?>
<nav class="navbar navbar-expand-md navbar-light main-nav">
    <div class="container">
        <?php echo $html; ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNav">
            <?php echo $html_base; ?>
        </div>
        
    </div>
</nav>

<?php
if ($nivel == "raiz") {
    //<!-- script  -->
    echo '<script src="assets/js/script.js"></script>';
} else if ($nivel == "uno") {
    //<!-- script  -->
    echo '<script src="../assets/js/script.js"></script>';
} else if ($nivel == "dos") {
    //<!-- script  -->
    echo '<script src="../../assets/js/script.js"></script>';
} else if ($nivel == "tres") {
    //<!-- script  -->
    echo '<script src="../../../assets/js/script.js"></script>';
}
?>