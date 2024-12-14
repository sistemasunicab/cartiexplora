<?php
    //nivel de la carpeta desde donde se llama este componente (archivo index.php de la raíz)
    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    }
    else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    }
    else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    }
    else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }
    
    $res_sentencia = $mysqli1->query($sentencia."26");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
        $sql_navbar = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }    
    $menuPrincipal = [];
    $menuNivelRaiz = [];
    $menuNivelUno = [];
    $res_navbar = $mysqli1->query($sql_navbar);
    while($row_navbar = $res_navbar->fetch_assoc()){
        if ($row_navbar['nivel'] == 'uno') {
            $menuNivelUno[$row_navbar['id']] = [
                'id' => $row_navbar['id'],
                'menu' => $row_navbar['menu'],
                'nivel' => $row_navbar['nivel'],
                'padre' => $row_navbar['padre'],
                'icono' => $row_navbar['icono'],
                'linkNivelRaiz' => $row_navbar['linkNivelRaiz'],
                'linkNivelTres' => $row_navbar['linkNivelTres'],
                'destino' => $row_navbar['destino']
            ];
        }
        else if ($row_navbar['nivel'] == 'raiz') {
            $menuNivelRaiz[$row_navbar['id']] = [
                'id' => $row_navbar['id'],
                'menu' => $row_navbar['menu'],
                'nivel' => $row_navbar['nivel'],
                'padre' => $row_navbar['padre'],
                'icono' => $row_navbar['icono'],
                'linkNivelRaiz' => $row_navbar['linkNivelRaiz'],
                'linkNivelTres' => $row_navbar['linkNivelTres'],
                'destino' => $row_navbar['destino']
            ];
        }
        else if ($row_navbar['nivel'] == '') {
            $menuPrincipal[$row_navbar['id']] = [
                'id' => $row_navbar['id'],
                'menu' => $row_navbar['menu'],
                'nivel' => $row_navbar['nivel'],
                'padre' => $row_navbar['padre'],
                'icono' => $row_navbar['icono'],
                'linkNivelRaiz' => $row_navbar['linkNivelRaiz'],
                'linkNivelTres' => $row_navbar['linkNivelTres'],
                'destino' => $row_navbar['destino']
            ];
        }
    }
    //Se arman los submenus dentro del array principal
    $subMenus = [];
    foreach($menuNivelRaiz as $clave1 => $valor1) {
        foreach($menuNivelUno as $clave2 => $valor2) {
            if ($valor1['id'] == $valor2['padre']) {                
                $subMenus[] = $menuNivelUno[$valor2['id']];
            }
        }
        $menuNivelRaiz[$valor1['id']]['submenus'] = $subMenus;
        $subMenus = [];
    }
    $subMenus = [];
    foreach($menuPrincipal as $clave1 => $valor1) {
        foreach($menuNivelRaiz as $clave2 => $valor2) {
            if ($valor1['id'] == $valor2['padre']) {                
                $subMenus[] = $menuNivelRaiz[$valor2['id']];
            }
            //$clave_array2 = array_search($valor['documento'], array_column($array2, 'documento'));
            //$array1[$clave]['url_foto'] = $array2[$clave_array2]['url_foto'];
        }
        $menuPrincipal[$valor1['id']]['submenus'] = $subMenus;
        $subMenus = [];
    }

    //Se arma el menú a cargar
    $html = '';
    if ($nivel == "raiz") {
        $html = '<nav class="navbar navbar-expand-lg navbar-light bg-light menu">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img src="assets/img/unicab.png" alt="" width="50" >
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">';
    }
    else if ($nivel == "tres") {
        $html = '<nav class="navbar navbar-expand-lg navbar-light bg-light menu">
                    <div class="container">
                        <a class="navbar-brand" href="#">
                            <img src="../../../assets/img/unicab.png" alt="" width="50" >
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">';
    }
    
    foreach($menuPrincipal as $clave1 => $valor1) {        
        if (count($valor1['submenus']) > 0) {
            $html .= '<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                '.$valor1['menu'].'
                            </a>
                            <ul class="dropdown-menu submenu">';
            foreach($valor1['submenus'] as $clave2 => $valor2) {
                if (count($valor2['submenus']) > 0) {
                    $html .= '<li class="nav-item dropdown ms-2">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    '.$valor2['menu'].'
                                </a>
                                <ul class="dropdown-menu submenu1">';
                    foreach($valor2['submenus'] as $clave3 => $valor3) {
                        if ($nivel == "raiz") {
                            if ($valor3['linkNivelRaiz'] == '') {
                                $html .= '<li>
                                            '.$valor3['icono'].'<a class="dropdown-item" href="#" target="'.$valor3['destino'].'">'.$valor3['menu'].'</a>
                                        </li>';
                            }
                            else {
                                $html .= '<li>
                                            '.$valor3['icono'].'<a class="dropdown-item" href="'.$valor3['linkNivelRaiz'].'" target="'.$valor3['destino'].'">'.$valor3['menu'].'</a>
                                        </li>';
                            }
                        }
                        else if ($nivel == "tres") {
                            if ($valor3['linkNivelTres'] == '') {
                                $html .= '<li>
                                            '.$valor3['icono'].'<a class="dropdown-item" href="#" target="'.$valor3['destino'].'">'.$valor3['menu'].'</a>
                                        </li>';
                            }
                            else {
                                $html .= '<li>
                                            '.$valor3['icono'].'<a class="dropdown-item" href="'.$valor3['linkNivelTres'].'" target="'.$valor3['destino'].'">'.$valor3['menu'].'</a>
                                        </li>';
                            }
                        }
                    }
                    $html .= '</ul>                            
                        </li>';
                }
                else {
                    if ($nivel == "raiz") {
                        if ($valor2['linkNivelRaiz'] == '') {
                            $html .= '<li class="nav-item">
                                        '.$valor2['icono'].'<a class="dropdown-item" href="#" target="'.$valor2['destino'].'">'.$valor2['menu'].'</a>
                                    </li>';
                        }
                        else {
                            $html .= '<li class="nav-item">
                                        '.$valor2['icono'].'<a class="dropdown-item" href="'.$valor2['linkNivelRaiz'].'" target="'.$valor2['destino'].'">'.$valor2['menu'].'</a>
                                    </li>';
                        }
                    }
                    else if ($nivel == "tres") {
                        if ($valor2['linkNivelTres'] == '') {
                            $html .= '<li class="nav-item">
                                        '.$valor2['icono'].'<a class="dropdown-item" href="#" target="'.$valor2['destino'].'">'.$valor2['menu'].'</a>
                                    </li>';
                        }
                        else {
                            $html .= '<li class="nav-item">
                                        '.$valor2['icono'].'<a class="dropdown-item" href="'.$valor2['linkNivelTres'].'" target="'.$valor2['destino'].'">'.$valor2['menu'].'</a>
                                    </li>';
                        }
                    }
                }
            }
                    $html .= '</ul>
                            </li>';
        }
        else {
            if ($nivel == "raiz") {
                if ($valor1['linkNivelRaiz'] == '') {
                    $html .= '<li class="nav-item">
                                '.$valor1['icono'].'<a class="nav-link" href="#" target="'.$valor1['destino'].'">'.$valor1['menu'].'</a>
                            </li>';
                }
                else {
                    $html .= '<li class="nav-item">
                                '.$valor1['icono'].'<a class="nav-link" href="'.$valor1['linkNivelRaiz'].'" target="'.$valor1['destino'].'">'.$valor1['menu'].'</a>
                            </li>';
                }
            }
            else if ($nivel == "tres") {
                if ($valor1['linkNivelTres'] == '') {
                    $html .= '<li class="nav-item">
                                '.$valor1['icono'].'<a class="nav-link" href="#" target="'.$valor1['destino'].'">'.$valor1['menu'].'</a>
                            </li>';
                }
                else {
                    $html .= '<li class="nav-item">
                                '.$valor1['icono'].'<a class="nav-link" href="'.$valor1['linkNivelTres'].'" target="'.$valor1['destino'].'">'.$valor1['menu'].'</a>
                            </li>';
                }
            }
        }
        
    }
            $html .= '</ul>
                </div>
            </div>
        </nav>';

    echo $html;//.'<br>'.basename(dirname(__FILE__));
?>
<!--<nav class="navbar navbar-expand-lg navbar-light bg-light menu">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="assets/img/unicab.png" alt="" width="50" >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Colegio UNICAB Virtual
                    </a>
                    <ul class="dropdown-menu submenu">
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dirección y Administración
                            </a>
                            <ul class="dropdown-menu submenu1">
                                <li><a class="dropdown-item" href="#">Estudiantes</a></li>
                                <li><a class="dropdown-item" href="#">Educación Regular</a></li>
                                <li><a class="dropdown-item" href="#">Solicitud de Certificaciones y Papeles</a></li>
                                <li><a class="dropdown-item" href="#">Manual de Convivencia</a></li>
                                <li><a class="dropdown-item" href="#">Educación por Ciclos Propedéuticos (Mayores 18 años)</a></li>
                            </ul>                            
                        </li>
                        <li><a class="dropdown-item" href="#">Consejo Directivo</a></li>
                        <li><a class="dropdown-item" href="#">Rectoría</a></li>
                        <li><a class="dropdown-item" href="#">Consejo de Padres</a></li>
                        <li><a class="dropdown-item" href="#">Consejo Estudiantil</a></li>
                        <li><a class="dropdown-item" href="#">Coordinación Académica</a></li>
                        <li><a class="dropdown-item" href="#">Secretaría Académica</a></li>
                        <li><a class="dropdown-item" href="#">Equipo de Maestros Mediadores</a></li>
                        <li><a class="dropdown-item" href="#">Asesores Pedagógicos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CARTI Explora
                    </a>
                    <ul class="dropdown-menu submenu">
                        <li><a class="dropdown-item" href="#">Misión y Visión</a></li>
                        <li><a class="dropdown-item" href="#">Principios y Valores</a></li>
                        <li><a class="dropdown-item" href="#">Servicios</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        UNICAB Solutions
                    </a>
                    <ul class="dropdown-menu submenu">
                        <li><a class="dropdown-item" href="#">¿Quienes Somos?</a></li>
                        <li><a class="dropdown-item" href="#">Misión</a></li>
                        <li><a class="dropdown-item" href="#">Visión</a></li>
                        <li><a class="dropdown-item" href="#">Director del Programa de Educación Formal</a></li>
                        <li><a class="dropdown-item" href="#">Servicios de Educación Informal</a></li>
                        <li><a class="dropdown-item" href="#">Consultoría Empresarial</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admisiones
                    </a>
                    <ul class="dropdown-menu submenu">
                        <li><a class="dropdown-item" href="#">Entrevista</a></li>
                        <li><a class="dropdown-item" href="#">Evaluación Presaberes</a></li>
                        <li><a class="dropdown-item" href="#">Costos</a></li>
                        <li><a class="dropdown-item" href="#">Pagos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Aula Virtual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Registro Académico</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Correo</a>
                </li>
            </ul>
        </div>
    </div>
</nav>-->