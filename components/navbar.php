<?php
// 1) Mapeo de niveles / inclusión del repositorio (idéntico a antes)
$nivelMap = [
    'raiz' => ['repo_prefix' => '',      'link_class' => 'linkNivelRaiz'],
    'uno'  => ['repo_prefix' => '../',    'link_class' => 'linkNivelUno'],
    'dos'  => ['repo_prefix' => '../../', 'link_class' => 'linkNivelDos'],
    'tres' => ['repo_prefix' => '../../../', 'link_class' => 'linkNivelTres'],
];

if (!isset($nivel) || !array_key_exists($nivel, $nivelMap)) {
    $nivel = 'raiz';
}
$repoPrefix  = $nivelMap[$nivel]['repo_prefix'];
$levelSelect = $nivelMap[$nivel]['link_class'];

require_once "{$repoPrefix}business/repositories/1cc2s4Home.php";

// 2) Funciones auxiliares
require_once __DIR__ . '/auxiliares.php'; 

/**
 * Closure para menú: reemplaza |x| y |y| y devuelve todas las filas.
 */
$getMenuItems = function(mysqli $db, string $sentenciaPrefijo, int $numSentencia, string $valorX, string $valorY): array {
    $resSent = $db->query($sentenciaPrefijo . $numSentencia);
    if (!$resSent) {
        return [];
    }
    $sqlDatos = '';
    while ($filaSent = $resSent->fetch_assoc()) {
        $conds  = str_replace(
            ['|x|', '|y|'], 
            ["'" . $valorX . "'", "'" . $valorY . "'"], 
            $filaSent['condiciones']
        );
        $sqlDatos = $filaSent['campos'] . $filaSent['tablas'] . $conds;
    }
    if (empty($sqlDatos)) {
        return [];
    }
    $resDatos = $db->query($sqlDatos);
    if (!$resDatos) {
        return [];
    }
    $filas = [];
    while ($fila = $resDatos->fetch_assoc()) {
        $filas[] = $fila;
    }
    return $filas;
};

// 3) MENÚ PRINCIPAL + SUBMENÚS

// 3.1) Obtener menú principal: sentencia 1 con |x|='' y |y|=''
$menuPrincipal = $getMenuItems($mysqli1, $sentencia, 1, '', '');

$html_base = '<ul id="menuDisplay" class="p-0 d-none d-lg-flex text-start">';

if (empty($menuPrincipal) && $mysqli1->error) {
    echo "Error en la consulta del menú principal: " . $mysqli1->error;
} else {
    foreach ($menuPrincipal as $rowMenu) {
        $idItem   = $rowMenu['id'];
        $menuText = $rowMenu['menu'];
        $destino  = $rowMenu['destino'];
        $linkURL  = $rowMenu[$levelSelect];

        // --- Inicio de <li> y <div class="menu-item"> ---
        if (!empty($linkURL)) {
            $html_base .= '
                <li class="nav-item bg-aquamarine h-100 py-2 mx-auto py-lg-0 mx-sm-0">
                    <div class="menu-item h-100 m-lg-auto px-lg-2 d-lg-flex">
                        <div class="menu-item-text first-level-link font-roboto-regular tx-white m-auto">
                            <a 
                                target="' . $destino . '"
                                class="a-nav" 
                                href="' . $linkURL . '">
                                ' . $menuText . '
                            </a>
                            <i class="icon-row fas fa-chevron-right w-auto p-0 mx-2"></i>
                        </div>
                    </div> <!-- ←– ADICIÓN: cierro div.menu-item aquí -->';
        } else {
            $html_base .= '
                <li class="nav-item h-100 py-2 mx-auto py-lg-0 mx-sm-0">
                    <div class="menu-item h-100 m-lg-auto px-lg-2 d-lg-flex">
                        <p class="p-nav menu-item-text font-roboto-regular tx-white m-auto">
                            ' . $menuText . '
                            <i class="icon-row fas fa-chevron-down w-auto p-0 mx-2"></i>
                        </p>
                    </div> <!-- ←– ADICIÓN: cierro div.menu-item aquí -->';
        }

        // 3.2) Submenú de primer nivel (si existe)
        $submenuNivel1 = $getMenuItems($mysqli1, $sentencia, 1, 'raiz', $idItem);

        if (!empty($submenuNivel1)) {
            // Abrimos contenedor dropdown fuera de div.menu-item
            $html_s  = '<div class="dropdown_our-container w-100 d-flex">';
            $html_s .= '<ul class="dropdown_our w-100 bg-blue py-lg-4 py-2 d-none">';
            $html_s2 = '';

            $count_columna = 0;
            foreach ($submenuNivel1 as $rowSub1) {
                if ($count_columna % 7 === 0) {
                    if ($count_columna > 0) {
                        $html_s .= '</div>';
                    }
                    $html_s .= '<div class="me-lg-3 d-lg-flex flex-column">';
                }

                $idSub1   = $rowSub1['id'];
                $menuSub1 = htmlspecialchars($rowSub1['menu'], ENT_QUOTES, 'UTF-8');
                $linkSub1 = $rowSub1[$levelSelect];

                $html_s .= '<li class="dropdown_our-item position-relative font-roboto-regular tx-white mb-2 px-3 text-start" '
                        . 'id="submenu_' . $idItem . '.' . $idSub1 . '">';

                if (!empty($linkSub1)) {
                    $html_s .= '
                        <a target="' . $rowSub1['destino'] . '" class="a-nav col-lg-12 w-auto text-center text-lg-start my-1 d-block"
                           href="' . htmlspecialchars($linkSub1, ENT_QUOTES, 'UTF-8') . '">
                            ' . $menuSub1 . '
                        </a>';
                } else {
                    $html_s .= $menuSub1
                            . '<i class="icon-row fas fa-chevron-right"></i>';
                }

                // 3.3) Submenú de segundo nivel (si existe)
                $submenuNivel2 = $getMenuItems($mysqli1, $sentencia, 1, 'uno', $idSub1);

                if (!empty($submenuNivel2)) {
                    $html_s2 .= '<ul class="dropdown_our2 w-100 w-lg-auto" '
                              . 'id="submenu_' . $idItem . '.' . $idSub1 . '_dropdown_our">';
                    $count_sub2 = 0;
                    foreach ($submenuNivel2 as $rowSub2) {
                        if ($count_sub2 % 6 === 0) {
                            if ($count_sub2 > 0) {
                                $html_s2 .= '</div>';
                            }
                            $html_s2 .= '<div class="me-lg-3 d-lg-flex flex-column">';
                        }

                        $menuSub2 = htmlspecialchars($rowSub2['menu'], ENT_QUOTES, 'UTF-8');
                        $linkSub2 = $rowSub2[$levelSelect];

                        $html_s2 .= '<li class="dropdown_our-item position-relative font-roboto-regular tx-white mb-2 px-3 text-start">';
                        $html_s2 .= '<a class="a-nav" href="' . htmlspecialchars($linkSub2, ENT_QUOTES, 'UTF-8') . '">';
                        $html_s2 .= $menuSub2;
                        $html_s2 .= '</a>';
                        $html_s2 .= '</li>';

                        $count_sub2++;
                    }
                    if ($count_sub2 > 0) {
                        $html_s2 .= '</div>';
                    }
                    $html_s2 .= '</ul>';
                }

                $html_s .= '</li>';
                $count_columna++;
            }
            if ($count_columna > 0) {
                $html_s .= '</div>';
            }
            $html_s .= '</ul>';
            $html_s .= $html_s2;
            $html_s .= '</div>';

            // 3.4) Insertar el dropdown _después_ de cerrar div.menu-item
            $html_base .= $html_s;
        }

        // 3.5) Cerrar etiqueta </li> del menú principal
        $html_base .= '</li>';
    }
}

$html_base .= '</ul>';

// 2) Obtener la ruta del logo, como antes:
$logoRows  = obtenerFilas($mysqli1, $sentencia, 24);
$ruta_logo = $logoRows[0]['ruta'] ?? '';

// 3) Construir $html_logo con un solo bloque:
$prefix     = $nivelMap[$nivel]['repo_prefix'];
$logoWidth  = 48;//37

$html_logo = '
    <a class="unicab-brand" href="' . $prefix . 'index.php">
        <img 
          src="' . rutaPorNivel($ruta_logo) . '" 
          alt="" 
          width="' . $logoWidth . '" 
          class="h-auto d-inline-block align-text-center"
        >
    </a>';

// 4) Luego, en el footer o en el nav, lo inyectamos:
?>
<div class="container-fluid m-0 p-0" id="inicio">
    <div class="row m-0 p-0">
        <nav class="navbar main-nav bg-orange col-12 h-lg-70 p-0">
            <div class="col-12 col-lg-12 h-100 m-auto p-0 d-lg-flex justify-content-between text-start">
                <div class="m-auto mx-lg-0 ms-lg-5 p-3 p-lg-0 d-flex flex-row justify-content-between align-items-center">
                    <?= $html_logo ?>

                    <button class="navbar-toggler d-lg-none" type="button" id="menu-button">
                        <i class="fas fa-bars tx-white p-2" id="bars"></i>
                    </button>
                </div>

                <?= $html_base ?>
            </div>
        </nav>
    </div>
</div>

<?php
// 5) Incluir script.js usando el mismo prefijo:
$scriptPath = $nivelMap[$nivel]['repo_prefix'] . 'assets/js/script.js?v=1.0';
echo '<script src="' . $scriptPath . '"></script>';
?>