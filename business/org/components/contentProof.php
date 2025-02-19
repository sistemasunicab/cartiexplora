<?php
    //nivel de la carpeta desde donde se llama este componente (archivo prueba.php de la carpeta business/org/pages)
    $nivel = "tres";
    require('../../../business/repositories/1cc2s4Home.php');
    $res_sentencia = $mysqli1->query($sentencia."1");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
        $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        $tel = $row_datos['t1'];
    }

    $res_sentencia = $mysqli1->query($sentencia."2");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
        $sql_imagenes = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    $res_imagenes = $mysqli1->query($sql_imagenes);
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

<h1>Bienvenido</h1>
<div class="container">
    <div class="row">
        <div class="col-3"><i class="fa-solid fa-spinner fa-spin-pulse"></i> col3</div>
        <div class="col-3"><span style="color: Tomato;"><i class="fa-solid fa-user"></i></span> col3</div>
        <div class="col-3"><i class="fa-solid fa-user fa-xs fa-fade"></i> col3</div>
        <div class="col-3"><i class="fa-solid fa-user fa-3x"></i> col3</div>
    </div>
    <div class="row">
        <div class="col-3"><i class="fa-solid fa-user fa-rotate-90"></i> col3</div>
        <div class="col-3"><span style="color: Tomato;"><i class="fa-solid fa-user fa-flip-vertical"></i></span> col3</div>
        <div class="col-3"><i class="fa-solid fa-user fa-sm fa-beat"></i> col3</div>
        <div class="col-3"><i class="fa-solid fa-user fa-3x fa-rotate-by" style="--fa-rotate-angle: 80deg;"></i> col3</div>
    </div>
    <div class="row">
        <div class="col-3"><input type="text" class="form-control" name="txt1" id="txt1" value="123"></div>
        <div class="col-3">
            <select name="sel1" id="sel1" class="form-control select2">
                <option value="Colombia">Colombia</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Perú">Perú</option>
                <option value="Brasil">Brasil</option>
                <option value="Argentina">Argentina</option>
                <option value="Chile">Chile</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Uruguay">Uruguay</option>
            </select>
        </div>
        <div class="col-3">
            <select name="sel2[]" id="sel2" class="form-control select2" multiple>
                <option value="Colombia">Colombia</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Perú">Perú</option>
                <option value="Brasil">Brasil</option>
                <option value="Argentina">Argentina</option>
                <option value="Chile">Chile</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Uruguay">Uruguay</option>
            </select>
        </div>
        <div class="col-3"><label for=""><?php echo $tel; ?></label></div>
    </div><br>
    <div class="row">
        <?php
            $html = '';
            while($row_imagenes = $res_imagenes->fetch_assoc()){
                if ($nivel == "raiz") {
                    $html .= '<div class="col-3"><img src="'.$row_imagenes['ruta'].'" id="img1" class="img-fluid" 
                    onmouseout="this.src='."'".$row_imagenes['ruta']."'".';" onmouseover="this.src='."'".$row_imagenes['rutaEncima']."'".';"/></div>';
                }
                else if ($nivel == "uno") {
                    $html .= '<div class="col-3"><img src="../'.$row_imagenes['ruta'].'" id="img1" class="img-fluid" 
                    onmouseout="this.src='."'../".$row_imagenes['ruta']."'".';" onmouseover="this.src='."'../".$row_imagenes['rutaEncima']."'".';"/></div>';
                }
                else if ($nivel == "dos") {
                    $html .=  '<div class="col-3"><img src="../../'.$row_imagenes['ruta'].'" id="img1" class="img-fluid" 
                    onmouseout="this.src='."'../../".$row_imagenes['ruta']."'".';" onmouseover="this.src='."'../../".$row_imagenes['rutaEncima']."'".';"/></div>';
                }
                else if ($nivel == "tres") {
                    $html .=  '<div class="col-3"><img src="../../../'.$row_imagenes['ruta'].'" id="img1" class="img-fluid" 
                    onmouseout="this.src='."'../../../".$row_imagenes['ruta']."'".';" onmouseover="this.src='."'../../../".$row_imagenes['rutaEncima']."'".';"/></div>';
                }
            }
            echo $html;
        ?>
    </div>
</div>