<?php
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

    $data = json_decode(file_get_contents("php://input"), true);
	$tipo = $data['tipo'] ?? '';

	try {
		$sql = "SELECT id, pregunta FROM tbl_encuesta_eeuu_preguntas WHERE tipo = ? AND respuesta_texto = 'NO'";
		$stmt = $mysqli2->prepare($sql);
		$stmt->bind_param("s", $tipo);
		$stmt->execute();
		$result = $stmt->get_result();

		$preguntas = [];
		while ($row = $result->fetch_assoc()) {
			$preguntas[] = $row;
		}

		echo json_encode(['success' => true, 'preguntas' => $preguntas]);
	} catch (Exception $e) {
		echo json_encode(['success' => false, 'error' => $e->getMessage()]);
	}
?>