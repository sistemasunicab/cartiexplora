<?php
    $nivel = "tres";
	require("../../../business/repositories/1cc2s4Org.php");
	include('../../../clases/GenerateQuery.php');
    header("Cache-Control: no-store");
	//http://localhost:90/cartiexplora/business/org/dml/registro_inicial_putdat.php?register_nombrea=yenny&register_emaila=ghernandof@gmail.com&register_telefonoa=3006510212&register_ciudada=pesca&register_documentoe=46379709
    
    $documentoe = $_REQUEST['register_documentoe_f'];
	$estnuevo = $_REQUEST['estnuevo'];
    
	$apellidos = strtoupper($_REQUEST['register_apellidos']);
    $nombres = strtoupper($_REQUEST['register_nombres']);
    $idgra = $_REQUEST['register_grado'];
    $tdoc = $_REQUEST['register_tipo_documento'];
    $td_text = $_REQUEST['td_text'];
    $cel = $_REQUEST['register_telefono'];
    //$email = $_REQUEST['register_email'];
    //$rh = $_REQUEST['register_rh'];
	$medio = $_REQUEST['register_medio'];
    $extra = strtoupper($_REQUEST['activiadad_extra']);
	$genero = $_REQUEST['register_genero'];
	//$situacion = $_REQUEST['situacion'];
    $nombre_completo = $apellidos." ".$nombres;
    
    $nombreA = strtoupper($_REQUEST['register_nombreA']);
    $documentoA = $_REQUEST['register_documentoA'];
    $dirA = $_REQUEST['register_direccionA'];
    $celA = $_REQUEST['register_celularA'];
    $emailA = $_REQUEST['register_correoA'];
	$parentesco1 = $_REQUEST['parentesco_acudiente_1'];
	$ciudadA = strtoupper($_REQUEST['register_ciudada']);

	//Se busca el grado
	$sentenciaFinal = $sentencia2."'grado'";
	$valores = [
		'_idGrado*' => $idgra
	];
	$sql_grado = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$res_grado = $mysqli2->query($sql_grado);
	while($row_grado = $res_grado->fetch_assoc()){
		$grado = $row_grado['grado'];
	}
    
    date_default_timezone_set('America/Bogota');
    $dia = date("d");
    $mes = date("m");
    $mesLetra = date("M");
    $fanio = date("Y");
    $espaniol="";
    //echo $fanio;
    $fecha2 = $fanio."/".$mes."/". $dia;
	if($mes >= 10) {
        $año_matricula = $fanio + 1;
    }
	else {
		$año_matricula = $fanio;
	}
	
	//Se valida si el registro ya existe en tbl_pre_matricula
	$ct_premat = 0;
	$sentenciaFinal = $sentencia2."'existe registro en tbl_pre_matricula'";
	$valores = [
		'_documento*' => $documentoe,
		'_añoMatricula*' => $año_matricula
	];
	$sql_premat = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$res_premat = $mysqli2->query($sql_premat);	
	while($row_premat = $res_premat->fetch_assoc()){
		$ct_premat = $row_premat['ct'];
	}
	echo "<br>ct_premat: ".$ct_premat;
	
	$valores1 = [
		'_idGrado*' => $idgra,
		'_nombres*' => $nombres,
		'_apellidos*' => $apellidos,
		'_fecha2*' => $fecha2,
		'_extra*' => $extra,
		'_nombreA*' => $nombreA,
		'_celA*' => $celA,
		'_emailA*' => $emailA,
		'_ciudadA*' => $ciudadA,
		'_medio*' => $medio,
		'_documento*' => $documentoe,
		'_añoMatricula*' => $año_matricula,
		'_genero*' => $genero,
		'_tdoc*' => $tdoc,
		'_telefonoE*' => $cel,
		'_parentesco1*' => $parentesco1,
		'_documentoA*' => $documentoA
	];
	if ($ct_premat > 0) {
		$sentenciaFinal = $sentencia2."'update tbl_pre_matricula'";		
		$sql_insupd_prem = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores1);
	}
	else {
		$sentenciaFinal = $sentencia2."'insert tbl_pre_matricula'";		
		$sql_insupd_prem = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores1);
	}
	echo "<br>".$sql_insupd_prem;
	$exe_insupd_prem = $mysqli2->query($sql_insupd_prem);
    
    //Se valida si el documento ya existe en estudiantes
	$sentenciaFinal = $sentencia2."'existe registro en estudiantes'";
	$valores = [
		'_documento*' => $documentoe
	];
	$sql_est = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	echo "<br>".$sql_est;
	$res_est = $mysqli2->query($sql_est);	
	while($row_est = $res_est->fetch_assoc()){
		$ct_est = $row_est['ct'];
	}
	echo "<br>ct_est: ".$ct_est;
	
	if ($ct_est > 0) {
		$sentenciaFinal = $sentencia2."'update estudiantes'";		
		$sql_insupd_est = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores1);
	}
	else {
		$sentenciaFinal = $sentencia2."'insert estudiantes'";		
		$sql_insupd_est = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores1);
	}
	echo "<br>".$sql_insupd_est;
	$exe_insupd_est = $mysqli2->query($sql_insupd_est);
	
	//Se direcciona para completar los datos de solicitud de matrícula
	if ($estnuevo == "SI") {
		header('Location: https://unicab.solutions/pre_admisiones1_us_nuevos2025_newhome.php?documento='.$documentoe);
	}
	else if ($estnuevo == "NO") {
		//header('Location: admisiones_antiguos.php?documento='.$documentoe);
		//header('Location: pre_admisiones1_us_antiguos2025.php?documento='.$documentoe.'&idgra='.$idgra.'&email='.$emailA);
		//header('Location: https://unicab.solutions/pre_admisiones1_us_antiguos2025.php?documento='.$documentoe);
	}
    	
?>

