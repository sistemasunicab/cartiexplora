<?php
    include('../../../clases/ImageAttributeBuilder.php');    
    include('../../../clases/GenerateQuery.php');
    //http://localhost:90/cartiexplora/business/org/pages/resultado_eval_pres.php?n_documento=1076742600&idgra=9

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

    $documento = $_REQUEST['n_documento'];
    $idgra = $_REQUEST['idgra'];
    
    date_default_timezone_set('America/Bogota');
    $dia=date("d");
    $mes=date("m");
    $mesLetra=date("M");
    $fanio=date("Y");
    
    $array_materiasf = array(1, 4, 5, 6, 7, 9, 11);
	$array_materias = array(1, 4, 5, 6, 7, 9);
	$array_materias_1011 = array(10, 12, 5, 15, 7, 9);
	$array_materias_1011f = array(10, 12, 5, 15, 7, 9, 11);

    //Se consulta nombres y apellidos del documento
    /*$sql_n = "SELECT e.id, e.nombres, e.apellidos 
    FROM estudiantes e 
    WHERE e.n_documento = '$documento'";*/
    $sentenciaFinal = $sentencia2."'nombre estudiante'";
	$valores = [
		'_documento*' => $documento
	];
	$sql_n = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

	//echo $sql_n;
	$exe_n = $mysqli2->query($sql_n);
	while($row_n = $exe_n->fetch_assoc()) {
	    $nombre_completo = $row_n['nombres']." ".$row_n['apellidos'];
	}
	//echo $nombre_completo;

    //Se consulta el nombre del grado
	/*$sql_grado = "SELECT * FROM equivalence_idgra WHERE id_grado_ra = $idgra";*/
    $sentenciaFinal = $sentencia2."'grado'";
	$valores = [
		'_idGrado*' => $idgra
	];
	$sql_grado = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

	//echo $sql_grado;
	$exe_grado = $mysqli2->query($sql_grado);
	while($row_grado = $exe_grado->fetch_assoc()) {
	    $grado_ra = $row_grado['grado'];
	}
	//echo "grado_ra=".$grado_ra;
	
	if($idgra == 11 || $idgra == 12 || $idgra == 17 || $idgra == 18 ) {
	    //$array_materias_final = $array_materiasf;
	    $array_materias_final = $array_materias_1011f;
	    $con_fisica = "SI";
	}
	else {
	    $array_materias_final = $array_materias;
	}
	
	//Se consulta el resultado de las preguntas
    /*$sql = "SELECT m.materia, m.pensamiento, p.pregunta, r.respuesta, r.resultado, 
    case r.resultado when 'OK' then 'MUY BIEN' else p.retroalimentacion end comentarios, 
    substring(p.imagen, 7) ruta 
    FROM tbl_respuestas r, tbl_preguntas p, materias m 
    WHERE r.id_pregunta = p.id AND r.id_materia = m.id 
    AND r.a = $fanio AND r.identificacion = '$documento'";*/
    $sentenciaFinal = $sentencia2."'resultado preguntas'";
	$valores = [
		'_resultado*' => 'OK',
		'_muyBien*' => 'MUY BIEN',
		'_a*' => $fanio,
		'_documento*' => $documento
	];
	$sql = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	//echo $sql;
	
	//Se hace la consulta de las recomendaciones para numérico
	/*$sql_retro_num_ct = "SELECT COUNT(1) ct 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = 5";*/
    $sentenciaFinal = $sentencia2."'conteos no num'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_retro_num_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_retro_num_ct = $mysqli2->query($sql_retro_num_ct);
	while($row_retro_num_ct = $exe_retro_num_ct->fetch_assoc()) {
	    $ct_num = $row_retro_num_ct['ct'];
	}
    
    //echo $ct_num;
    /*$sql_retro_num = "SELECT DISTINCT p.retroalimentacion 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = $array_materias_final[2]";*/
    $sentenciaFinal = $sentencia2."'retroalimentacion no num'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio,
		'_idmateria*' => $array_materias_final[2]
	];
	$sql_retro_num = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	
	//Se hace la consulta de las recomendaciones para bioético
    /*$sql_retro_bio_ct = "SELECT COUNT(1) ct 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = 1";*/
    $sentenciaFinal = $sentencia2."'conteos no bio'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_retro_bio_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_retro_bio_ct = $mysqli2->query($sql_retro_bio_ct);
	while($row_retro_bio_ct = $exe_retro_bio_ct->fetch_assoc()) {
	    $ct_bio = $row_retro_bio_ct['ct'];
	}

    /*$sql_retro_bio = "SELECT DISTINCT p.retroalimentacion 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = $array_materias_final[0]";*/
    $sentenciaFinal = $sentencia2."'retroalimentacion no bio'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio,
		'_idmateria*' => $array_materias_final[0]
	];
	$sql_retro_bio = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    
    //Se hace la consulta de las recomendaciones para social
    /*$sql_retro_soc_ct = "SELECT COUNT(1) ct 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = 4";*/
    $sentenciaFinal = $sentencia2."'conteos no soc'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_retro_soc_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_retro_soc_ct = $mysqli2->query($sql_retro_soc_ct);
	while($row_retro_soc_ct = $exe_retro_soc_ct->fetch_assoc()) {
	    $ct_soc = $row_retro_soc_ct['ct'];
	}

    /*$sql_retro_soc = "SELECT DISTINCT p.retroalimentacion 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = $array_materias_final[1]";*/
    $sentenciaFinal = $sentencia2."'retroalimentacion no soc'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio,
		'_idmateria*' => $array_materias_final[1]
	];
	$sql_retro_soc = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    
    //Se hace la consulta de las recomendaciones para español
    /*$sql_retro_esp_ct = "SELECT COUNT(1) ct 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = 6";*/
    $sentenciaFinal = $sentencia2."'conteos no esp'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_retro_esp_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_retro_esp_ct = $mysqli2->query($sql_retro_esp_ct);
	while($row_retro_esp_ct = $exe_retro_esp_ct->fetch_assoc()) {
	    $ct_esp = $row_retro_esp_ct['ct'];
	}

    /*$sql_retro_esp = "SELECT DISTINCT p.retroalimentacion 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = $array_materias_final[3]";*/
    $sentenciaFinal = $sentencia2."'retroalimentacion no esp'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio,
		'_idmateria*' => $array_materias_final[3]
	];
	$sql_retro_esp = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    
    //Se hace la consulta de las recomendaciones para inglés
    /*$sql_retro_ing_ct = "SELECT COUNT(1) ct 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = 7";*/
    $sentenciaFinal = $sentencia2."'conteos no ing'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_retro_ing_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_retro_ing_ct = $mysqli2->query($sql_retro_ing_ct);
	while($row_retro_ing_ct = $exe_retro_ing_ct->fetch_assoc()) {
	    $ct_ing = $row_retro_ing_ct['ct'];
	}

    /*$sql_retro_ing = "SELECT DISTINCT p.retroalimentacion 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = $array_materias_final[4]";*/
    $sentenciaFinal = $sentencia2."'retroalimentacion no ing'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio,
		'_idmateria*' => $array_materias_final[4]
	];
	$sql_retro_ing = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    
    //Se hace la consulta de las recomendaciones para tecnológico
    /*$sql_retro_tec_ct = "SELECT COUNT(1) ct 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = 9";*/
    $sentenciaFinal = $sentencia2."'conteos no tec'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_retro_tec_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_retro_tec_ct = $mysqli2->query($sql_retro_tec_ct);
	while($row_retro_tec_ct = $exe_retro_tec_ct->fetch_assoc()) {
	    $ct_tec = $row_retro_tec_ct['ct'];
	}

    /*$sql_retro_tec = "SELECT DISTINCT p.retroalimentacion 
    FROM tbl_respuestas r, tbl_preguntas p 
    WHERE r.id_pregunta = p.id 
    AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = $array_materias_final[5]";*/
    $sentenciaFinal = $sentencia2."'retroalimentacion no tec'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio,
		'_idmateria*' => $array_materias_final[5]
	];
	$sql_retro_tec = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    
    if($idgra == 11 || $idgra == 12 || $idgra == 17 || $idgra == 18 ) {
        //Se hace la consulta de las recomendaciones para física
        /*$sql_retro_fis_ct = "SELECT COUNT(1) ct 
        FROM tbl_respuestas r, tbl_preguntas p 
        WHERE r.id_pregunta = p.id 
        AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = 11";*/
        $sentenciaFinal = $sentencia2."'conteos no fis'";
        $valores = [
            '_resultado*' => 'NO',
            '_documento*' => $documento,
            '_a*' => $fanio
        ];
        $sql_retro_fis_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        $exe_retro_fis_ct = $mysqli2->query($sql_retro_fis_ct);
        while($row_retro_fis_ct = $exe_retro_fis_ct->fetch_assoc()) {
            $ct_fis = $row_retro_fis_ct['ct'];
        }
        //echo $ct_fis;

        /*$sql_retro_fis = "SELECT DISTINCT p.retroalimentacion 
        FROM tbl_respuestas r, tbl_preguntas p 
        WHERE r.id_pregunta = p.id 
        AND r.resultado = 'NO' AND r.identificacion ='$documento' AND r.a = $fanio AND r.id_materia = $array_materias_final[6]";*/
        $sentenciaFinal = $sentencia2."'retroalimentacion no fis'";
        $valores = [
            '_resultado*' => 'NO',
            '_documento*' => $documento,
            '_a*' => $fanio,
            '_idmateria*' => $array_materias_final[6]
        ];
        $sql_retro_fis = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    }
    
    //Se hacen los conteos generales
    $conteos = array('ctok'=>0, 'ctno'=>0, 'ctna'=>0, 'ctpen'=>0);
    $resumen = new stdClass();
    $resumen->bio = $conteos;
    $resumen->soc = $conteos;
    $resumen->num = $conteos;
    $resumen->esp = $conteos;
    $resumen->ing = $conteos;
    $resumen->tec = $conteos;
    $resumen->fis = $conteos;
    $obj_json = json_encode($resumen, JSON_UNESCAPED_UNICODE);
    $obj_json_decode = json_decode($obj_json, true);
    //echo $obj_json;
    
    //Totales por pensamiento
    $totbio = 0;
    $totsoc = 0;
    $totnum = 0;
    $totesp = 0;
    $toting = 0;
    $tottec = 0;
    $totfis = 0;
    $total_todos = 0;
    $total_todos_ok = 0;
    
    //Nivel por pensamiento
    $nivbio = "";
    $nivsoc = "";
    $nivnum = "";
    $nivesp = "";
    $niving = "";
    $nivtec = "";
    $nivfis = "";
    $nivglo = "";
    
    $colbio = "";
    $colsoc = "";
    $colnum = "";
    $colesp = "";
    $coling = "";
    $coltec = "";
    $colfis = "";
    $colglo = "";
    
    /*$sql_ctok = "SELECT COUNT(1) ct_ok, identificacion, id_materia FROM tbl_respuestas WHERE resultado = 'OK' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion, id_materia";*/
    $sentenciaFinal = $sentencia2."'conteos ok por pensamiento'";
	$valores = [
		'_resultado*' => 'OK',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_ctok = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    //echo $sql_ctok;
    $exe_ctok = $mysqli2->query($sql_ctok);
    while($row_ctok = $exe_ctok->fetch_assoc()) {
        if($row_ctok['id_materia'] == 1) {
            $obj_json_decode['bio']['ctok'] = $row_ctok['ct_ok'];
            $totbio += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 10) {
            $obj_json_decode['bio']['ctok'] = $row_ctok['ct_ok'];
            $totbio += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 4) {
            $obj_json_decode['soc']['ctok'] = $row_ctok['ct_ok'];
            $totsoc += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 12) {
            $obj_json_decode['soc']['ctok'] = $row_ctok['ct_ok'];
            $totsoc += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 5) {
            $obj_json_decode['num']['ctok'] = $row_ctok['ct_ok'];
            $totnum += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 6) {
            $obj_json_decode['esp']['ctok'] = $row_ctok['ct_ok'];
            $totesp += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 15) {
            $obj_json_decode['esp']['ctok'] = $row_ctok['ct_ok'];
            $totesp += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 7) {
            $obj_json_decode['ing']['ctok'] = $row_ctok['ct_ok'];
            $toting += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 9) {
            $obj_json_decode['tec']['ctok'] = $row_ctok['ct_ok'];
            $tottec += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
        else if($row_ctok['id_materia'] == 11) {
            $obj_json_decode['fis']['ctok'] = $row_ctok['ct_ok'];
            $totfis += $row_ctok['ct_ok'];
            $total_todos_ok += $row_ctok['ct_ok'];
        }
    }
    //echo $ct_ok;
    
    /*$sql_ctno = "SELECT COUNT(1) ct_no, identificacion, id_materia FROM tbl_respuestas WHERE resultado = 'NO' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion, id_materia";*/
    $sentenciaFinal = $sentencia2."'conteos no por pensamiento'";
	$valores = [
		'_resultado*' => 'NO',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_ctno = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    //echo $sql_ctno;
    $exe_ctno = $mysqli2->query($sql_ctno);
    while($row_ctno = $exe_ctno->fetch_assoc()) {
        if($row_ctno['id_materia'] == 1) {
            $obj_json_decode['bio']['ctno'] = $row_ctno['ct_no'];
            $totbio += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 10) {
            $obj_json_decode['bio']['ctno'] = $row_ctno['ct_no'];
            $totbio += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 4) {
            $obj_json_decode['soc']['ctno'] = $row_ctno['ct_no'];
            $totsoc += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 12) {
            $obj_json_decode['soc']['ctno'] = $row_ctno['ct_no'];
            $totsoc += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 5) {
            $obj_json_decode['num']['ctno'] = $row_ctno['ct_no'];
            $totnum += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 6) {
            $obj_json_decode['esp']['ctno'] = $row_ctno['ct_no'];
            $totesp += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 15) {
            $obj_json_decode['esp']['ctno'] = $row_ctno['ct_no'];
            $totesp += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 7) {
            $obj_json_decode['ing']['ctno'] = $row_ctno['ct_no'];
            $toting += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 9) {
            $obj_json_decode['tec']['ctno'] = $row_ctno['ct_no'];
            $tottec += $row_ctno['ct_no'];
        }
        else if($row_ctno['id_materia'] == 11) {
            $obj_json_decode['fis']['ctno'] = $row_ctno['ct_no'];
            $totfis += $row_ctno['ct_no'];
        }
    }
    //echo $ct_no;
    
    /*$sql_ctna = "SELECT COUNT(1) ct_na, identificacion, id_materia FROM tbl_respuestas WHERE resultado = 'NA' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion, id_materia";*/
    $sentenciaFinal = $sentencia2."'conteos na por pensamiento'";
	$valores = [
		'_resultado*' => 'NA',
		'_documento*' => $documento,
		'_a*' => $fanio
	];
	$sql_ctna = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_ctna = $mysqli2->query($sql_ctna);
    while($row_ctna = $exe_ctna->fetch_assoc()) {
        if($row_ctna['id_materia'] == 1) {
            $obj_json_decode['bio']['ctna'] = $row_ctna['ct_na'];
            $totbio += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 10) {
            $obj_json_decode['bio']['ctna'] = $row_ctna['ct_na'];
            $totbio += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 4) {
            $obj_json_decode['soc']['ctna'] = $row_ctna['ct_na'];
            $totsoc += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 12) {
            $obj_json_decode['soc']['ctna'] = $row_ctna['ct_na'];
            $totsoc += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 5) {
            $obj_json_decode['num']['ctna'] = $row_ctna['ct_na'];
            $totnum += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 6) {
            $obj_json_decode['esp']['ctna'] = $row_ctna['ct_na'];
            $totesp += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 15) {
            $obj_json_decode['esp']['ctna'] = $row_ctna['ct_na'];
            $totesp += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 7) {
            $obj_json_decode['ing']['ctna'] = $row_ctna['ct_na'];
            $toting += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 9) {
            $obj_json_decode['tec']['ctna'] = $row_ctna['ct_na'];
            $tottec += $row_ctna['ct_na'];
        }
        else if($row_ctna['id_materia'] == 11) {
            $obj_json_decode['fis']['ctna'] = $row_ctna['ct_na'];
            $totfis += $row_ctna['ct_na'];
        }
    }
    //echo $ct_na;
    
    $obj_json_decode['bio']['ctpen'] = $totbio;
    $obj_json_decode['soc']['ctpen'] = $totsoc;
    $obj_json_decode['num']['ctpen'] = $totnum;
    $obj_json_decode['esp']['ctpen'] = $totesp;
    $obj_json_decode['ing']['ctpen'] = $toting;
    $obj_json_decode['tec']['ctpen'] = $tottec;
    $obj_json_decode['fis']['ctpen'] = $totfis;
    
    $total_todos = $totbio + $totsoc + $totnum + $totesp + $toting + $tottec + $totfis;
    
    if($obj_json_decode['bio']['ctok'] / $totbio > 0.75) {
        $nivbio = "SUPER ALTO";
        $colbio = "#138726";
    }
    else if($obj_json_decode['bio']['ctok'] / $totbio > 0.5) {
        $nivbio = "ALTO";
        $colbio = "#4b9db9";
    }
    else if($obj_json_decode['bio']['ctok'] / $totbio > 0.25) {
        $nivbio = "MEDIO";
        $colbio = "#FFC300";
    }
    else {
        if($totbio > 0) {
            $nivbio = "BAJO";
            $colbio = "#e8222e";
        }
        else {
            $nivbio = "NO APLICA";
            $colbio = "#000";
        }
    }
    
    if($obj_json_decode['soc']['ctok'] / $totsoc > 0.75) {
        $nivsoc = "SUPER ALTO";
        $colsoc = "#138726";
    }
    else if($obj_json_decode['soc']['ctok'] / $totsoc > 0.5) {
        $nivsoc = "ALTO";
        $colsoc = "#4b9db9";
    }
    else if($obj_json_decode['soc']['ctok'] / $totsoc > 0.25) {
        $nivsoc = "MEDIO";
        $colsoc = "#FFC300";
    }
    else {
        if($totsoc > 0) {
            $nivsoc = "BAJO";
            $colsoc = "#e8222e";
        }
        else {
            $nivsoc = "NO APLICA";
            $colsoc = "#000";
        }
    }
    
    if($obj_json_decode['num']['ctok'] / $totnum > 0.75) {
        $nivnum = "SUPER ALTO";
        $colnum = "#138726";
    }
    else if($obj_json_decode['num']['ctok'] / $totnum > 0.5) {
        $nivnum = "ALTO";
        $colnum = "#4b9db9";
    }
    else if($obj_json_decode['num']['ctok'] / $totnum > 0.25) {
        $nivnum = "MEDIO";
        $colnum = "#FFC300";
    }
    else {
        if($totnum > 0) {
            $nivnum = "BAJO";
            $colnum = "#e8222e";
        }
        else {
            $nivnum = "NO APLICA";
            $colnum = "#000";
        }
    }
    
    if($obj_json_decode['esp']['ctok'] / $totesp > 0.75) {
        $nivesp = "SUPER ALTO";
        $colesp = "#138726";
    }
    else if($obj_json_decode['esp']['ctok'] / $totesp > 0.5) {
        $nivesp = "ALTO";
        $colesp = "#4b9db9";
    }
    else if($obj_json_decode['esp']['ctok'] / $totesp > 0.25) {
        $nivesp = "MEDIO";
        $colesp = "#FFC300";
    }
    else {
        if($totesp > 0) {
            $nivesp = "BAJO";
            $colesp = "#e8222e";
        }
        else {
            $nivesp = "NO APLICA";
            $colesp = "#000";
        }
    }
    
    if($obj_json_decode['ing']['ctok'] / $toting > 0.75) {
        $niving = "SUPER ALTO";
        $coling = "#138726";
    }
    else if($obj_json_decode['ing']['ctok'] / $toting > 0.5) {
        $niving = "ALTO";
        $coling = "#4b9db9";
    }
    else if($obj_json_decode['ing']['ctok'] / $toting > 0.25) {
        $niving = "MEDIO";
        $coling = "#FFC300";
    }
    else {
        if($toting > 0) {
            $niving = "BAJO";
            $coling = "#e8222e";
        }
        else {
            $niving = "NO APLICA";
            $coling = "#000";
        }
    }
    
    if($obj_json_decode['tec']['ctok'] / $tottec > 0.75) {
        $nivtec = "SUPER ALTO";
        $coltec = "#138726";
    }
    else if($obj_json_decode['tec']['ctok'] / $tottec > 0.5) {
        $nivtec = "ALTO";
        $coltec = "#4b9db9";
    }
    else if($obj_json_decode['tec']['ctok'] / $tottec > 0.25) {
        $nivtec = "MEDIO";
        $coltec = "#FFC300";
    }
    else {
        if($tottec > 0) {
            $nivtec = "BAJO";
            $coltec = "#e8222e";
        }
        else {
            $nivtec = "NO APLICA";
            $coltec = "#000";
        }
    }
    
    if($idgra == 11 || $idgra == 12 || $idgra == 17 || $idgra == 18 ) {
        if($obj_json_decode['fis']['ctok'] / $totfis > 0.75) {
            $nivfis = "SUPER ALTO";
            $colfis = "#138726";
        }
        else if($obj_json_decode['fis']['ctok'] / $totfis > 0.5) {
            $nivfis = "ALTO";
            $colfis = "#4b9db9";
        }
        else if($obj_json_decode['fis']['ctok'] / $totfis > 0.25) {
            $nivfis = "MEDIO";
            $colfis = "#FFC300";
        }
        else {
            if($totfis > 0) {
                $nivfis = "BAJO";
                $colfis = "#e8222e";
            }
            else {
                $nivfis = "NO APLICA";
                $colfis = "#000";
            }
        }
    }
    
    if($total_todos_ok / $total_todos > 0.75) {
        $nivglo = "SUPER ALTO";
        $colglo = "#138726";
    }
    else if($total_todos_ok / $total_todos > 0.5) {
        $nivglo = "ALTO";
        $colglo = "#4b9db9";
    }
    else if($total_todos_ok / $total_todos > 0.25) {
        $nivglo = "MEDIO";
        $colglo = "#FFC300";
    }
    else {
        $nivglo = "BAJO";
        $colglo = "#e8222e";
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php 
    $nivel = "tres";
    $page_title = "Evaluacion";
    include('../../../components/headMain.php');
?>
<body>
    <?php 
        $nivel = "tres";
        include('../../../components/navBar.php');
        
        include("../components/resultado_eval_pres1.php");
        
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>  
<body>
    
</html>