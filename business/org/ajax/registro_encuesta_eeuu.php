<?php
	//include('../../../clases/GenerateQuery.php');

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
	header("Content-Type: application/json"); // Establece que la respuesta será JSON
	set_time_limit(300);
	
	// Función de respuesta JSON
	function response($success, $message, $data = []) {
		echo json_encode(['success' => $success, 'message' => $message, 'data' => $data]);
		exit();
	}

	// RECUPERAR DATOS ENVIADOS POR FETCH (POST)
	if ($_SERVER["REQUEST_METHOD"] !== "POST") {
		response(false, "Método no permitido.");
	}

	// Decodificar el JSON del cuerpo de la solicitud
	$data = json_decode(file_get_contents("php://input"), true);

	if (empty($data)) {
		response(false, "No se recibieron datos.");
	}

	// Asignar variables y sanitizar (aunque las sentencias preparadas son la principal defensa)
	$nombre = $data['nombre'] ?? '';
	$email = $data['email'] ?? '';
	$celular = $data['celular'] ?? '';
	$profesion = $data['profesion'] ?? ''; // Puede ser NULL
	$acepta_terminos = $data['acepta_terminos'] ?? '';
	
	$tiempo_vinculacion = explode("|", $data['tiempo_vinculacion'] ?? '');
	$relacion_unicab = explode("|", $data['relacion_unicab'] ?? '');
	$otra_relacion = $data['otra_relacion'] ?? ''; // Opcional, solo si seleccionó 'Otro'
	$residencia = explode("|", $data['pais_residencia'] ?? '');
	$otra_residencia = $data['otra_residencia'] ?? ''; // Opcional, solo si seleccionó 'Otro'
	$expansion_eeuu = explode("|", $data['expansion_eeuu'] ?? '');
	$disposicion_matricula = explode("|", $data['disposicion_matricula'] ?? '');
	$beneficios = $data['beneficios'] ?? '';
	$conoce_familias = explode("|", $data['conoce_familias'] ?? '');
	$disposicion_recomendar = explode("|", $data['disposicion_recomendar'] ?? '');
	$embajador = explode("|", $data['embajador'] ?? '');
	$necesidades = $data['necesidades'] ?? '';
	$recibir_info = explode("|", $data['recibir_info'] ?? '');

	date_default_timezone_set('America/Bogota');
	$fecha = time();
	$dia = date("d",$fecha);
	$mes = date("m",$fecha);
	$fanio = date("Y",$fecha);
	$id_encuesta = 2;
	$control = 0;
	$opcion = "";
	$resultado = "";
	
	/*$resultado0 = $mysqli2->query($query0);
	while($row0 = $resultado0->fetch_assoc()) {
	    $maxid = $row0['maxid'];
	}*/

	//Se valida si ya existe el participante
	$registro = [];
	$sql_val_participante = "SELECT * FROM tbl_encuesta_eeuu_participantes 
	WHERE nombre = '$nombre' AND email = '$email' AND celular = '$celular'";
	$res_val_participante = $mysqli2->query($sql_val_participante);
	while ($row_val_participante = $res_val_participante->fetch_assoc()) {
		$registro = $row_val_participante;
	}
	if (count($registro) > 0) {
		response(true, "Encuesta enviada con éxito. ¡Gracias por participar!");
		exit;
	}

	$sql_participante = "INSERT INTO tbl_encuesta_eeuu_participantes (id_encuesta, nombre, email, celular, profesion) 
	VALUES (?, ?, ?, ?, ?)";
	$exe_participante = $mysqli2->prepare($sql_participante);
	$exe_participante->bind_param("issss", $id_encuesta, $nombre, $email, $celular, $profesion);
	$exe_participante->execute();
	$id_participante = $mysqli2->insert_id;

	for ($i = 1; $i <= 11; $i++) {
		// SENTENCIA PREPARADA PARA INSERCIÓN SEGURA
		$sql = "INSERT INTO tbl_encuesta_eeuu_resultados (id_encuesta, id_participante, id_pregunta, resultado, opcion, año) 
		VALUES (?, ?, ?, ?, ?, ?)";

		$exe_sql = $mysqli2->prepare($sql);
		//$exe_sql->bind_param("ss", $fecha, $hora);	

		try {
			// Vincular los parámetros (s = string, i = integer, d = double, b = blob)
			if ($i == 1) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $tiempo_vinculacion[1], $tiempo_vinculacion[0], $fanio);
			}
			else if ($i == 2) {
				$resultado = $otra_relacion != '' ? $otra_relacion :  $relacion_unicab[1];
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $resultado, $relacion_unicab[0], $fanio);
			}
			else if ($i == 3) {
				$resultado = $otra_residencia != '' ? $otra_residencia :  $residencia[1];
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $resultado, $residencia[0], $fanio);
			}
			else if ($i == 4) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $expansion_eeuu[1], $expansion_eeuu[0], $fanio);
			}
			else if ($i == 5) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $disposicion_matricula[1], $disposicion_matricula[0], $fanio);
			}
			else if ($i == 6) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $beneficios, $opcion, $fanio);
			}
			else if ($i == 7) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $conoce_familias[1], $conoce_familias[0], $fanio);
			}
			else if ($i == 8) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $disposicion_recomendar[1], $disposicion_recomendar[0], $fanio);
			}
			else if ($i == 9) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $embajador[1], $embajador[0], $fanio);
			}
			else if ($i == 10) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $necesidades, $opcion, $fanio);
			}
			else if ($i == 11) {
				$exe_sql->bind_param("iiissi", $id_encuesta, $id_participante, $i, $recibir_info[1], $recibir_info[0], $fanio);
			}

			// EJECUTAR LA CONSULTA
			if ($exe_sql->execute()) {
				//
			} else {
				$control++;
			}
		}
		catch(Exception $e) {
			$control++;
			$sql_del_participante = "DELETE FROM tbl_encuesta_eeuu_participantes WHERE id = $id_participante";
			$res_del_participante = $mysqli2->query($sql_del_participante);
			response(false, "Error al guardar la encuesta: ".$e);
		}
	}

	if ($control == 0) {
		response(true, "Encuesta enviada con éxito. ¡Gracias por participar!");
	} else {
		response(false, "Error al guardar la encuesta: ");
	}

	//$exe_sql->execute();
	//$result = $exe_sql->get_result();
	
?>