<?php
	//require("registro/docenteunicab/updreg/1cc3s4db.php");
    //http://localhost:90/cartiexplora/business/org/ajax/conteos_resp_pres.php?documento=1076742600
	
	include('../../../clases/GenerateQuery.php');

	$nivel = "dos";
	if ($nivel == "raiz") {
		require('repositories/1cc2s4Org.php');
	} else if ($nivel == "uno") {
		require('../repositories/1cc2s4Org.php');
	} else if ($nivel == "dos") {
		$nivel = "tres";
		require('../../repositories/1cc2s4Org.php');
	} else if ($nivel == "tres") {
		require('../../../repositories/1cc2s4Org.php');
	}

	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
	set_time_limit(300);

	//https://unicab.org/conteos_resp_pres.php?documento=999999
	
	$documento = $_REQUEST["documento"];
	
	date_default_timezone_set('America/Bogota');
    $dia=date("d");
    $mes=date("m");
    $mesLetra=date("M");
    $fanio=date("Y");
	
	$datos = new stdClass();
	
	//Se hacen los conteos generales
    $ct_ok = 0;
    $ct_no = 0;
    $ct_na = 0;
    /*$sql_ctok = "SELECT COUNT(1) ct_ok, identificacion FROM tbl_respuestas WHERE resultado = 'OK' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion";*/
    $sentenciaFinal = $sentencia2."'conteos ok'";
	$valores = [
		'_resultado*' => 'OK',
        '_documento*' => $documento,
        '_a*' => $fanio
	];
	$sql_ctok = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    //echo $sql_ctok;
    $exe_ctok = $mysqli2->query($sql_ctok);
    while($row_ctok = $exe_ctok->fetch_assoc()) {
        $ct_ok = $row_ctok['ct_ok'];
    }
    //echo $ct_ok;

    /*$sql_ctno = "SELECT COUNT(1) ct_no, identificacion FROM tbl_respuestas WHERE resultado = 'NO' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion";*/
    $sentenciaFinal = $sentencia2."'conteos no'";
	$valores = [
		'_resultado*' => 'NO',
        '_documento*' => $documento,
        '_a*' => $fanio
	];
	$sql_ctno = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_ctno = $mysqli2->query($sql_ctno);
    while($row_ctno = $exe_ctno->fetch_assoc()) {
        $ct_no = $row_ctno['ct_no'];
    }
    //echo $ct_no;

    /*$sql_ctna = "SELECT COUNT(1) ct_na, identificacion FROM tbl_respuestas WHERE resultado = 'NA' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion";*/
    $sentenciaFinal = $sentencia2."'conteos na'";
	$valores = [
		'_resultado*' => 'NA',
        '_documento*' => $documento,
        '_a*' => $fanio
	];
	$sql_ctna = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_ctna = $mysqli2->query($sql_ctna);
    while($row_ctna = $exe_ctna->fetch_assoc()) {
        $ct_na = $row_ctna['ct_na'];
    }
    //echo $ct_na;
    
    $datos->ctok = $ct_ok;
    $datos->ctno = $ct_no;
    $datos->ctna = $ct_na;
	
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);
	
?>