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
    $id_pregunta = $data['id_pregunta'] ?? 0;

    $preg_c = "NO";
    $preg_d = "NO";
    $preg_e = "NO";

    try {
        //Se arman los labels
        $sql_lbls = "SELECT * FROM tbl_encuesta_eeuu_preguntas WHERE id_encuesta = 2 AND id = $id_pregunta AND respuesta_texto = 'NO'";
        //echo $sql_lbls;
        $res_lbls = $mysqli2->query($sql_lbls);
        while($row_lbls = $res_lbls->fetch_assoc()){
            $preg_c = $row_lbls['c'];
            $preg_d = $row_lbls['d'];
            $preg_e = $row_lbls['e'];
            $pregunta = $row_lbls['pregunta'];
            if ($row_lbls['c'] == "NO") {
                $lbls = array($row_lbls['a'], $row_lbls['b']);
            }
            else if ($row_lbls['d'] == "NO") {
                $lbls = array($row_lbls['a'], $row_lbls['b'], $row_lbls['c']);
            }
            else if ($row_lbls['e'] == "NO") {
                $lbls = array($row_lbls['a'], $row_lbls['b'], $row_lbls['c'], $row_lbls['d']);
            }
            else if ($row_lbls['e'] != "NO") {
                $lbls = array($row_lbls['a'], $row_lbls['b'], $row_lbls['c'], $row_lbls['d'], $row_lbls['e']);
            }
        }
        
        $respuestas = new stdClass();

        $ct_2opciones = array();
        $ct_3opciones = array();
        $ct_4opciones = array();
        $ct_5opciones = array();
        
        
        $ct_2opciones[0] = 0;
        $ct_2opciones[1] = 0;

        $ct_3opciones[0] = 0;
        $ct_3opciones[1] = 0;
        $ct_3opciones[2] = 0;

        $ct_4opciones[0] = 0;
        $ct_4opciones[1] = 0;
        $ct_4opciones[2] = 0;
        $ct_4opciones[3] = 0;

        $ct_5opciones[0] = 0;
        $ct_5opciones[1] = 0;
        $ct_5opciones[2] = 0;
        $ct_5opciones[3] = 0;
        $ct_5opciones[4] = 0;

        //Se consultan las cantidades
        $sql_ct = "SELECT COUNT(1) ct, er.opcion, 
            CASE er.opcion WHEN 'a' THEN ep.a WHEN 'b' THEN ep.b WHEN 'c' THEN ep.c WHEN 'd' THEN ep.d WHEN 'e' THEN ep.e ELSE er.opcion END opcion1 
            FROM tbl_encuesta_eeuu_resultados er, tbl_encuesta_eeuu_preguntas ep 
            WHERE er.id_pregunta = ep.id AND er.id_encuesta = ep.id_encuesta 
            AND er.id_encuesta = 2 AND er.id_pregunta = $id_pregunta AND ep.respuesta_texto = 'NO' 
            GROUP BY er.opcion, 2";

        $res_ct = $mysqli2->query($sql_ct);
        while($row_ct = $res_ct->fetch_assoc()){
            if ($preg_c == 'NO') {
                if ($row_ct['opcion'] == "a") {
                    $ct_2opciones[0] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "b") {
                    $ct_2opciones[1] = $row_ct['ct'];
                }
            }
            else if ($preg_d == 'NO') {
                if ($row_ct['opcion'] == "a") {
                    $ct_3opciones[0] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "b") {
                    $ct_3opciones[1] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "c") {
                    $ct_3opciones[2] = $row_ct['ct'];
                }
            }
            else if ($preg_e == 'NO') {
                if ($row_ct['opcion'] == "a") {
                    $ct_4opciones[0] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "b") {
                    $ct_4opciones[1] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "c") {
                    $ct_4opciones[2] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "d") {
                    $ct_4opciones[3] = $row_ct['ct'];
                }
            }
            else if ($preg_e != 'NO') {
                if ($row_ct['opcion'] == "a") {
                    $ct_5opciones[0] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "b") {
                    $ct_5opciones[1] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "c") {
                    $ct_5opciones[2] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "d") {
                    $ct_5opciones[3] = $row_ct['ct'];
                }
                else if ($row_ct['opcion'] == "e") {
                    $ct_5opciones[4] = $row_ct['ct'];
                }
            }		
        }

        $respuestas->lbls = $lbls;
        if ($preg_c == 'NO') {
            $respuestas->cantidades = $ct_2opciones;
        }
        if ($preg_d == 'NO') {
            $respuestas->cantidades = $ct_3opciones;
        }
        else if ($preg_e == 'NO') {
            $respuestas->cantidades = $ct_4opciones;
        }
        else if ($preg_e != 'NO') {
            $respuestas->cantidades = $ct_5opciones;
        }
        $respuestas->pregunta = $pregunta;
        
        $sql = "SELECT resultado, COUNT(*) as cantidad FROM tbl_encuesta_eeuu_resultados
                WHERE id_pregunta = ? GROUP BY resultado";
        $stmt = $mysqli2->prepare($sql);
        $stmt->bind_param("i", $id_pregunta);
        $stmt->execute();
        $result = $stmt->get_result();

        $estadisticas = [];
        while ($row = $result->fetch_assoc()) {
            $estadisticas[] = $row;
        }

        echo json_encode(['success' => true, 'estadisticas' => $respuestas]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
?>