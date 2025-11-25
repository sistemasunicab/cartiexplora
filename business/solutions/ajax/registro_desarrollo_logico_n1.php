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

    $apellidos = $_REQUEST["register_apellidos"];
	$nombres = $_REQUEST["register_nombres"];
	$telefono = $_REQUEST["register_telefono"];
	$email = $_REQUEST["register_email"];
	$documento = $_REQUEST["register_documento"];
	$comprobante = $_FILES["register_comprobante"];
	$id_evento = $_REQUEST["id_evento"];
	$id_tipo_participante = $_REQUEST["id_tipo_participante"];
	$ref_epayco = $_REQUEST["ref_epayco"];
	
	$datos = new stdClass();
	$datos->email = $email;

	//Se sube el comprobante
	$uploadDir = 'cursos/desarrollo_pensamiento_logico/nivel1/comprobantes/'.$a."/";
	$fileName = $comprobante['name'];
	$filePath = $uploadDir . $fileName;
	$ruta = "https://unicab.solutions/".$filePath;

	$uploadDir1 = $_SERVER['DOCUMENT_ROOT']."/".$uploadDir;
	$filePath1 = $uploadDir1 . $fileName;
	// Crear carpeta si no existe
    if (!is_dir($uploadDir1)) {
        mkdir($uploadDir1, 0755, true);
    }

	if (move_uploaded_file($comprobante['tmp_name'], $filePath1)) {
		//Se hace el insert
		$sql_insert = "INSERT INTO tbl_participantes (id_tipo_participante, id_evento, nombres, apellidos, email, fecha_inscripcion, celular, 
		identificacion_est) 
		VALUES ($id_tipo_participante, $id_evento, '$nombres', '$apellidos', '$email', '$fecha2', '$telefono', '$documento') 
		ON DUPLICATE KEY UPDATE nombres = VALUES(nombres), apellidos = VALUES(apellidos), celular = VALUES(celular), email = VALUES(email)";
		$exe_insert = $mysqli1->query($sql_insert);
		
		//Se valida si el registro se guardo
		$sql_val = "SELECT COUNT(1) ct FROM tbl_participantes WHERE id_evento = $id_evento AND identificacion_est = '$documento'";
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

		//Se actualiza la tabla pagos
		$sql_upd_pagos = "UPDATE tbl_pagos SET estado = 'Aceptada', comprobante_pago = '$ruta' Where ref_epayco = '$ref_epayco'";
		$exe_upd_pagos = $mysqli1->query($sql_upd_pagos);

		//Se envían los datos para el envío de correo
		$data = [];
		// $documentos = [
		// 	'register_comprobante'
		// ];
		$url_solutions = "https://unicab.solutions/inscripcion_curso_correo.php";
		$data['data_original'] = json_encode($_POST);
		$data['ruta'] = $ruta;
		//$datos->data_enviada = $data;

		//Esto se utilizaría para enviar inputs files por curl
		// foreach ($documentos as $doc) {
		// 	if (isset($_FILES[$doc]) && $_FILES[$doc]['error'] === UPLOAD_ERR_OK) {
		// 		$data[$doc] = new CURLFile(
		// 			$_FILES[$doc]['tmp_name'],
		// 			$_FILES[$doc]['type'],
		// 			$_FILES[$doc]['name']
		// 		);
		// 	}
		// }
		
		// Usar cURL para hacer la llamada interna
		$ch = curl_init($url_solutions);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$respuesta_b = trim(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		$respuesta_json = json_decode($respuesta_b, true); // el "true" lo convierte en array asociativo
		$datos->respuesta_correo = $respuesta_json['mensaje'];
		//$datos->data_recibida = $respuesta_json['data_recibida'];
	}	
	
	$respuesta_json = json_encode($datos, JSON_UNESCAPED_UNICODE);

?>

<form id="redir" action="../pages/resultadoFormularioInscripcionCursos.php" method="POST">
    <input type="hidden" name="respuesta_json" value='<?php echo $respuesta_json; ?>'>
</form>

<script>
	document.getElementById("redir").submit();
</script>