<?php
	//require("registro/docenteunicab/updreg/1cc3s4db.php");
	//http://localhost:90/cartiexplora/business/org/ajax/validacion_pres.php?documento=1099213997
	
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
	
	$documento = $_REQUEST["documento"];
	
	date_default_timezone_set('America/Bogota');
    $dia=date("d");
    $mes=date("m");
    $mesLetra=date("M");
    $fanio=date("Y");
	
	$datos = new stdClass();
	
	//Se hace la consulta
	$ct = 0;
	$ct1 = 0;
	$ct2 = 0;
	//$query0 = "SELECT COUNT(1) ct FROM tbl_respuestas WHERE identificacion = '$documento' AND respuesta = 'NA' AND a = $fanio";
	$sentenciaFinal = $sentencia2."'validacion presaberes'";
	$valores = [
		'_documento*' => $documento,
		'_NA*' => 'NA',
		'_fanio*' => $fanio
	];
	$query0 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	//echo $query0;
	$resultado0 = $mysqli2->query($query0);
	while($row0 = $resultado0->fetch_assoc()) {
	    $ct = $row0['ct'];
	}
	//echo "ct1 ".$ct1;
	
	if($ct > 0) {
	    $datos->estado = "SIN_PRESENTAR";
	}
	else {
	    //Se validan si existen preguntas cargadas en estado abierta para el documento
	    //$sql_ct_preg = "SELECT COUNT(1) ct FROM tbl_respuestas WHERE identificacion = '$documento' AND a = $fanio AND estado = 'ABIERTA'";
		$sentenciaFinal = $sentencia2."'valida ct preguntas abiertas'";
		$valores = [
			'_documento*' => $documento,
			'_fanio*' => $fanio,
			'_estado*' => 'ABIERTA'
		];
		$sql_ct_preg = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	    //echo $sql_ct_preg;
	    $exe_ct_preg = $mysqli2->query($sql_ct_preg);
	    while($row_ct_preg = $exe_ct_preg->fetch_assoc()) {
	        $ct1 = $row_ct_preg['ct'];
	    }
	    //echo $ct1;
	    if($ct1 > 0) {
	        $datos->estado = "SIN_PRESENTAR";
	    }
		else {
	        //Se validan si existen preguntas cargadas para el documento
    	    //$sql_ct_preg1 = "SELECT COUNT(1) ct FROM tbl_respuestas WHERE identificacion = '$documento' AND a = $fanio";
			$sentenciaFinal = $sentencia2."'valida ct preguntas cargadas'";
			$valores = [
				'_documento*' => $documento,
				'_fanio*' => $fanio
			];
			$sql_ct_preg1 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    	    //echo $sql_ct_preg1;
    	    $exe_ct_preg1 = $mysqli2->query($sql_ct_preg1);
    	    while($row_ct_preg1 = $exe_ct_preg1->fetch_assoc()) {
    	        $ct2 = $row_ct_preg1['ct'];
    	    }
			//echo "ct2: ".$ct2;
    	    if($ct2 == 0) {
    	        $datos->estado = "SIN_PRESENTAR";
    	    }
    	    else {
	            $datos->estado = "PRESENTADA";
    	    }
	    }
	}
	
	//Se valida si existen preguntas para el grado
	$idgra = "0";
	$grado = "_";
	
	/*$sql_grado = "SELECT m.id_grado, g.grado 
	FROM estudiantes e, matricula m, grados g 
	WHERE e.id = m.id_estudiante AND m.id_grado = g.id AND e.n_documento = '$documento' AND m.n_matricula like '%$fanio%' AND m.estado IN ('solicitud', 'activo')";";*/
	$sentenciaFinal = $sentencia2."'valida preguntas grado'";
	$valores = [
		'_documento*' => $documento,
		'_a*' => '\'%'.$fanio.'%\'',
		'_estado*' => 'solicitud',
		'_estado1*' => 'activo'
	];
	$sql_grado = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	//echo $sql_grado;
	$res_grado = $mysqli2->query($sql_grado);
	while($row_g = $res_grado->fetch_assoc()) {
	    $idgra = $row_g['id'];
	    $grado = $row_g['grado'];
	}
	if($idgra != "0") {
	    $datos->idgra = $idgra;
	    $datos->grado = $grado;
	    $datos->estado_doc = "EnBD";
	}
	else {
	    $datos->idgra = "0";
	    $datos->grado = "_";
	    $datos->estado_doc = "NoBD";
	}
	//echo $sql_grado;
	
	$ct_p = 0;
	//$sql_preg = "SELECT COUNT(1) ct FROM tbl_preguntas WHERE id_grado = $idgra";
	$sentenciaFinal = $sentencia2."'valida ct preguntas grado'";
	$valores = [
		'_idgra*' => $idgra
	];
	$sql_preg = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$res_preg = $mysqli2->query($sql_preg);
	while($row_p = $res_preg->fetch_assoc()) {
	    $ct_p = $row_p['ct'];
	}
	$datos->ct_preg = $ct_p;
	
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);
	
?>