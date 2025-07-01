<?php
	//require("registro/docenteunicab/updreg/1cc3s4db.php");
	//http://localhost:90/cartiexplora/business/org/ajax/preguntas_est_getdat.php?idpreg=14
	
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
	
	date_default_timezone_set('America/Bogota');
    $dia=date("d");
    $mes=date("m");
    $mesLetra=date("M");
    $fanio=date("Y");
    
    $datos = new stdClass();
	
	//Se consulta la pregunta
	//$sql_preg = "SELECT * FROM tbl_preguntas WHERE id = $idpreg";
	$sentenciaFinal = $sentencia2."'consulta pregunta'";
	$valores = [
		'_idpreg*' => $idpreg
	];
	$sql_preg = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$exe_preg = $mysqli2->query($sql_preg);
	while($row_preg = $exe_preg->fetch_assoc()) {
	    $datos->id_tp = $row_preg['id_tipo_pregunta'];
	    $datos->pregunta = $row_preg['pregunta'];
	    $datos->r1ok = $row_preg['r1ok'];
	    $datos->r2ok = $row_preg['r2ok'];
	    $datos->r3ok = $row_preg['r3ok'];
	    $datos->r1no = $row_preg['r1no'];
	    $datos->r2no = $row_preg['r2no'];
	    $datos->r3no = $row_preg['r3no'];
	    $datos->retro = $row_preg['retroalimentacion'];
	    $datos->imagen = $row_preg['imagen'];
	}
	
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);
	
?>