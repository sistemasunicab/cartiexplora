<?php
    //nivel de la carpeta desde donde se llama este componente (archivo index.php de la raíz)
    $nivel = "raiz";
    require('business/repositories/1cc2s4Home.php');
    $res_sentencia = $mysqli1->query($sentencia."13");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
        $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }    
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        $tel = $row_datos['t1'];
    }    

    $res_sentencia = $mysqli1->query($sentencia."17");
    while($row_sentencia = $res_sentencia->fetch_assoc()){
        $sql_imagenes = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
    }
    $res_imagenes = $mysqli1->query($sql_imagenes);
?>

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