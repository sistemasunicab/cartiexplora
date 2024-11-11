<?php
    //nivel de la carpeta desde donde se llama este componente (archivo prueba.php de la business/org/pages)
    $nivel = "tres";
    require('../../../business/repositories/1cc2s4Home.php');

    $sql_datos = "SELECT * FROM tbl_parametros WHERE parametro = 'telefono_admisiones'";
    $res_datos = $mysqli1->query($sql_datos);
    while($row_datos = $res_datos->fetch_assoc()){
        $tel = $row_datos['t1'];
    }
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
    </div>
</div>