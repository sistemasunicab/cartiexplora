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

    $numero_de_sentencia = "1";
    $res_sentencia = $mysqli1->query($sentencia . $numero_de_sentencia);
    while ($row_sentencia = $res_sentencia->fetch_assoc()) {
        $condiciones = str_replace('|x|', '\'\'', $row_sentencia['condiciones']);
        $condiciones = str_replace('|y|', '\'\'', $condiciones);
        $sql_datos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $condiciones;
    }
    $res_datos = $mysqli1->query($sql_datos);
    // Validar que la consulta fue exitosa
    $html_base = '<ul id="menuDisplay" class="main-container h-100" >';
    if ($res_datos) {
        // Acceder a los datos 
        while ($row_datos = $res_datos->fetch_assoc()) {
            $id = $row_datos['id'];
            $html_base .= '<li class="nav-item h-100">';
            $html_base .= '<div class="menu-item h-100">';
            if ($row_datos[$levelSelect] != '') {
                $html_base .= '<a class = "m-auto menu-item-text" target="' . $row_datos['destino'] . '" href="' . $row_datos[$levelSelect] . '">';
                $html_base .= htmlspecialchars($row_datos['menu']);
                $html_base .= '</a>';
            } else {
                $html_base .= '<p class="m-auto menu-item-text">';
                $html_base .= htmlspecialchars($row_datos['menu']);
                $html_base .= '<i class="icon-row fas fa-chevron-down"></i>';
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
                $html_s = '<div class="dropdown-container">';
                $html_s .= '<ul class="dropdown">';
                $html_s2 = '';
                $count_base = 0;
                while ($row_datos_h = $res_datos_h->fetch_assoc()) {
                    if ($count_base % 7 === 0) {
                        if ($count_base > 0) {
                            $html_s .= '</div>'; // Cierra el contenedor anterior si no es el primero
                        }
                        $html_s .= '<div class="dropdown-column">'; // Nueva columna
                    }
                    $id_2 = $row_datos_h['id'];
                    $html_s .= '<li class="dropdown-item" id="submenu_' . $id . '.' . $id_2 . '">';
                    if ($row_datos_h[$levelSelect] != '') {
                        $html_s .= '<a href="' . $row_datos_h[$levelSelect] . '">';
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
    $numero_de_sentencia_logo = "24";
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
        $html .= '<a class="unicab-brand" href="index.php">';
        $html .= '<img src="' . $ruta_logo . '" alt="" width="55" height="55" class="d-inline-block align-text-center">';
        $html .= '</a>';
    } else if ($nivel == "uno") {
        $html .= '<a class="unicab-brand" href="../index.php">';
        $html .= '<img src="../' . $ruta_logo . '" alt="" width="55" height="55" class="d-inline-block align-text-center">';
        $html .= '</a>';
    } else if ($nivel == "dos") {
        $html .= '<a class="unicab-brand" href="../../index.php">';
        $html .= '<img src="../../' . $ruta_logo . '" alt="" width="55" height="55" class="d-inline-block align-text-center">';
        $html .= '</a>';
    } else if ($nivel == "tres") {
        $html .= '<a class="unicab-brand" href="../../../index.php">';
        $html .= '<img src="../../../' . $ruta_logo . '" alt="" width="55" height="55" class="d-inline-block align-text-center">';
        $html .= '</a>';
    }
?>

<nav class="navbar main-nav">
    <div class="main-container h-100">
        <div class="temporal-container">
            <?php echo $html; ?>
            <button class="navbar-toggler" type="button" id="menu-button">
                <i class="fas fa-bars" id="bars"></i>
            </button>
        </div>

        <?php
            echo $html_base;
        ?>
    </div>
</nav>

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