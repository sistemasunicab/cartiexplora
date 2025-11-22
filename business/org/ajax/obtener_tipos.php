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

    $sql = "SELECT DISTINCT tipo FROM tbl_encuesta_eeuu_preguntas WHERE respuesta_texto = 'NO' ORDER BY tipo";
    if ($res = $mysqli2->query($sql)) {
        $tipos = [];
        while ($row = $res->fetch_assoc()) {
            $tipos[] = $row['tipo'];
        }
        echo json_encode(["success" => true, "tipos" => $tipos]);
    } else {
        echo json_encode(["success" => false, "error" => $mysqli->error]);
    }
?>