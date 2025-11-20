<?php
	//require("registro/docenteunicab/updreg/1cc3s4db.php");
	//http://localhost:90/cartiexplora/business/org/ajax/respuestas_est_upddat.php
	
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
	
	$idpreg = $_REQUEST['idpreg'];
	$documento = $_REQUEST['documento'];
	$respuesta = $_REQUEST['respuesta'];
	$resultado = $_REQUEST['resultado'];
	
	date_default_timezone_set('America/Bogota');
    $dia=date("d");
    $mes=date("m");
    $mesLetra=date("M");
    $fanio=date("Y");
	if ($mes >= 10) {
		$fanio++;
	}
    
    //Se actualiza la respuesta
	/*$sql_updpreg = "UPDATE tbl_respuestas SET respuesta = '$respuesta', resultado = '$resultado' 
	    WHERE id_pregunta = $idpreg AND identificacion = '$documento' AND a = $fanio";*/
	$sentenciaFinal = $sentencia2."'actualizar respuesta presaberes'";
	$valores = [
		'_respuesta*' => $respuesta,
		'_resultado*' => $resultado,
		'_idpreg*' => $idpreg,
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_updpreg = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

	$exe_updpreg = $mysqli2->query($sql_updpreg);
	
	echo "UPDATE_OK";
	
?>