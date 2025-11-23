<?php
    $nivel = "tres";
    require('../../repositories/1cc2s4Sol.php');
    header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
	set_time_limit(300);

    date_default_timezone_set('America/Bogota');
	$fecha = time();
	$dia = date("d",$fecha);
	$mes = date("m",$fecha);
	$a = date("Y",$fecha);
	$hora = date("H",$fecha);
	$minutos = date("i",$fecha);
    $fecha2 = $a.$mes.$dia;

    $idevento = $_REQUEST["idevento"];
	$documento = $_REQUEST["documento"];
	$nombrepagador = $_REQUEST["nombre"];
	$valor = $_REQUEST["valor"];
	$estado = $_REQUEST["estado"];
	$ref_epayco = $_REQUEST["ref_epayco"];
	
	$nombre = str_replace("_", " ", $nombrepagador);

    $datos = new stdClass();
	
	//Se hace el insert
	$sql_insert = "INSERT INTO tbl_pagos (id_evento, n_documento, nombre_completo, estado, valor, ref_epayco, fecha) 
	VALUES ($idevento, '$documento', '$nombre', '$estado', $valor, '$ref_epayco', '$fecha2') 
    ON DUPLICATE KEY UPDATE estado = VALUES(estado)";
	$exe_insert = $mysqli1->query($sql_insert);
	
	//Se valida si el registro se guardo
	$sql_val = "SELECT COUNT(1) ct FROM tbl_pagos WHERE id_evento = $idevento AND n_documento = '$documento' AND ref_epayco = '$ref_epayco'";
	$exe_val = $mysqli1->query($sql_val);
	while($row_val = $exe_val->fetch_assoc()) {
		$ct = $row_val['ct'];
	}
	if ($ct > 0) {
		$datos->insert = "OK";
	}
	else {
		$datos->insert = "NO";
	}
	
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);

?>