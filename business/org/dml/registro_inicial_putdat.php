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
	//$sql_grado = "SELECT grado FROM grados WHERE id = $idgra";
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
	//$sql_premat = "SELECT COUNT(1) ct FROM tbl_pre_matricula WHERE documento_est = '$documentoe' AND año = $año_matricula";
	$ct_premat = 0;
	$sentenciaFinal = $sentencia2."'datos tbl_pre_matricula1'";
	$valores = [
		'_documento*' => $documentoe,
		'_fanio*' => $año_matricula
	];
	$sql_premat = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$res_premat = $mysqli2->query($sql_premat);	
	while($row_premat = $res_premat->fetch_assoc()){
		$ct_premat = $row_premat['ct'];
	}
	echo "<br>ct_premat: ".$ct_premat;
	
	/*if ($ct_premat > 0) {
		$sql_insupd_prem = "UPDATE tbl_pre_matricula 
		SET id_grado = $idgra, nombres_est = '$nombres', apellidos_est = '$apellidos', fecha = '$fecha2', actividad_extra = '$extra', 
		nombre_a = '$nombreA', celular_a = '$celA', email_a = '$emailA', ciudad_a = '$ciudadA', id_medio = $medio 
		WHERE documento_est = '$documentoe' AND año = $año_matricula";
		
	}
	else {
		$sql_insupd_prem = "INSERT INTO tbl_pre_matricula (id_empleado, id_grado, documento_est, nombres_est, apellidos_est, fecha, actividad_extra, 
		nombre_a, celular_a, email_a, ciudad_a, entrevista, eval, id_medio, año) 
		VALUES (18, $idgra, '$documentoe', '$nombres', '$apellidos', '$fecha2', '$extra', 
		'$nombreA', '$celA', '$emailA', '$ciudadA', 'NO', 0, $medio, $año_matricula)";
	}
	echo "<br>".$sql_insupd_prem;
	$exe_insupd_prem = mysqli_query($conexion,$sql_insupd_prem);
    
    //Se valida si el documento ya existe en estudiantes
	$sql_est = "SELECT COUNT(1) ct FROM estudiantes WHERE n_documento = '$documentoe'";
	echo "<br>".$sql_est;
	$res_est = $mysqli1->query($sql_est);	
	while($row_est = $res_est->fetch_assoc()){
		$ct_est = $row_est['ct'];
	}
	echo "<br>ct_est: ".$ct_est;
	
	if ($ct_est > 0) {
		$sql_insupd_est = "UPDATE estudiantes SET apellidos = '$apellidos', nombres = '$nombres', genero = '$genero', tipo_documento = $tdoc, telefono_estudiante = '$cel', 
		actividad_extra = '$extra', email_acudiente_1 = '$emailA', acudiente_1 = '$nombreA', telefono_acudiente_1 = '$celA', parentesco_acudiente_1 = '$parentesco1', 
		fecha_datos = '$fecha2', documento_responsable = '$documentoA', ciudad = '$ciudadA', a_matricula = $año_matricula WHERE n_documento = '$documentoe'";
	}
	else {
		$sql_insupd_est = "INSERT INTO estudiantes (apellidos, nombres, genero, tipo_documento, n_documento, ciudad, telefono_estudiante, actividad_extra, 
		email_acudiente_1, acudiente_1, telefono_acudiente_1, parentesco_acudiente_1, fecha_datos, documento_responsable, a_matricula) 
		VALUES ('$apellidos', '$nombres', '$genero', $tdoc, '$documentoe', '$ciudadA', '$cel', '$extra', 
		'$emailA', '$nombreA', '$celA', '$parentesco1', '$fecha2', '$documentoA', ".$año_matricula.")";
	}
	echo "<br>".$sql_insupd_est;
	$exe_insupd_est = mysqli_query($conexion,$sql_insupd_est);
	
	//Se direcciona para completar los datos de solicitud de matrícula
	if ($estnuevo == "SI") {
		//header('Location: admisiones_nuevos.php?documento='.$documentoe);
		//header('Location: pre_admisiones1_us_nuevos2025.php?documento='.$documentoe.'&idgra='.$idgra.'&email='.$emailA);
		header('Location: https://unicab.solutions/pre_admisiones1_us_nuevos2025.php?documento='.$documentoe);
	}
	else if ($estnuevo == "NO") {
		//header('Location: admisiones_antiguos.php?documento='.$documentoe);
		//header('Location: pre_admisiones1_us_antiguos2025.php?documento='.$documentoe.'&idgra='.$idgra.'&email='.$emailA);
		//header('Location: https://unicab.solutions/pre_admisiones1_us_antiguos2025.php?documento='.$documentoe);
	}*/
    	
?>

