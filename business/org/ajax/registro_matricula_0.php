<?php
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
	//https://unicab.org/registro_matricula_0.php?documento=1000270950
	
	$documento = $_REQUEST["documento"];
	$codigo = 0;
	
	$datos = new stdClass();
	$grados = array();
	$keys = ['id_gra','gra'];
	$i = 0;
	
	date_default_timezone_set('America/Bogota');
    $dia = date("d");
    $mes = date("m");
    $mesLetra = date("M");
    $fanio = date("Y");
	$fanio1 = date("Y");
    if($mes >= 10) {
        $fanio = $fanio + 1;
    }
	$fechaHoy = $fanio1."-".$mes."-".$dia;
	
	//Se hace la consulta del máximo registro en matrículas
	$sentenciaFinal = $sentencia2."'máximo registro en matricula'";
	$valores = [
		'_documento*' => $documento
	];
	$query0 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    //echo $query0;
	$resultado0 = $mysqli2->query($query0);
	while($row0 = $resultado0->fetch_assoc()) {
	    $maxid = $row0['maxid'];
	}
	
	$datos->acudiente = "";
	$datos->emailA = "";
	$datos->telA = "";
	$datos->ciudadA = "";
	
	$control_antiguos = 0;
	
	//echo $maxid;
	if($maxid == 0) {
	    $datos->estado = "nuevo";
	    //Se cargan los grados
	    $sentenciaFinal = $sentencia2."'grados'";
		$valores = [
			'*' => '*'
		];
		$query_g = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	    $resultadog = $mysqli2->query($query_g);
    	while($rowg = $resultadog->fetch_assoc()) {
    	    $valores = [$rowg['id'],$rowg['grado']];
    	    $grados_temp = array_combine($keys,$valores);
      		$grados[$i] = $grados_temp;
      		$i++;
    	}
		$datos->rh = "NA";
		
		//Se buscan datos iniciales... ¡si existen!
		$sentenciaFinal = $sentencia2."'buscar datos iniciales'";
		$valores = [
			'_documento*' => $documento
		];
		$query1 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	    //echo $query1;
        $resultado1 = $mysqli2->query($query1);
		while($row1 = $resultado1->fetch_assoc()) {
            $datos->acudiente = $row1['acudiente_1'];
    	    $datos->emailA = $row1['email_acudiente_1'];
    	    $datos->telA = $row1['telefono_acudiente_1'];
    	    $datos->ciudadA = $row1['ciudad'];
    	}
	}
	else {
		//Se valida que sea antiguo del presente año para matrículas ordinarias o del año anterior para matrículas extraordinarias
		$sentenciaFinal = $sentencia2."'se valida que sea antiguo'";
		$valores = [
			'_maxid*' => $maxid
		];
		$sql_val_estado = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
		//echo $sql_val_estado."<br>";
		$res_val_estado = $mysqli2->query($sql_val_estado);
        while($row_val_estado = $res_val_estado->fetch_assoc()) {
			$estado_val = $row_val_estado['estado'];
			$diferencia_val = $row_val_estado['diferencia'];
			$actual_val = $row_val_estado['actual'];
			$id_grado = $row_val_estado['id_grado'];
			$n_matricula = $row_val_estado['n_matricula'];
			$fecha_ingreso = $row_val_estado['fecha_ingreso'];
		}		
		
		//echo $estado_val." ".$diferencia_val." ".$actual_val."<br>";
		if ($estado_val != 'activo' && $diferencia_val == 0 && $actual_val == 2024) {
			$control_antiguos = 1;
		}
		else if ($estado_val != 'activo' && abs($diferencia_val) == 1 && $actual_val == 2024) {
			$control_antiguos = 2; //Se considera nuevo si no estuvo con Unicab en el año actual
		}
		else if ($estado_val == 'activo') {
			$datos->estado = $estado_val;
			//Se cargan los grados
			$sentenciaFinal = $sentencia2."'grado'";
			$valores = [
				'_idGrado*' => $id_grado
			];
			$query_g = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
			$resultadog = $mysqli2->query($query_g);
			while($rowg = $resultadog->fetch_assoc()) {
				$valores = [$rowg['id'],$rowg['grado']];
				$grados_temp = array_combine($keys,$valores);
				$grados[$i] = $grados_temp;
				$i++;
			}
		}
		else {
			$datos->estado = "nuevo";
			//Se cargan los grados
			$sentenciaFinal = $sentencia2."'grados'";
			$valores = [
				'*' => '*'
			];
			$query_g = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
			$resultadog = $mysqli2->query($query_g);
			while($rowg = $resultadog->fetch_assoc()) {
				$valores = [$rowg['id'],$rowg['grado']];
				$grados_temp = array_combine($keys,$valores);
				$grados[$i] = $grados_temp;
				$i++;
			}
			$datos->rh = "NA";
			
			//Se buscan datos iniciales... ¡si existen!
			$sentenciaFinal = $sentencia2."'buscar datos iniciales'";
			$valores = [
				'_documento*' => $documento
			];
			$query1 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
			//echo $query1;
			$resultado1 = $mysqli2->query($query1);
			while($row1 = $resultado1->fetch_assoc()) {
				$datos->acudiente = $row1['acudiente_1'];
				$datos->emailA = $row1['email_acudiente_1'];
				$datos->telA = $row1['telefono_acudiente_1'];
				$datos->ciudadA = $row1['ciudad'];
			}
		}
		$datos->control_antiguos = $control_antiguos;
		$datos->diferencia = $diferencia_val;
		$datos->n_matricula = $n_matricula;
		$datos->fecha_ingreso = $fecha_ingreso;
		$datos->id_matricula = $maxid;
		
		//echo $control_antiguos;
		if ($control_antiguos == 1 || $control_antiguos == 2) {
			$sentenciaFinal = $sentencia2."'datos estudiante0'";
			$valores = [
				'_documento*' => $documento,
				'_maxid*' => $maxid
			];
			$query1 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
			//echo $query1;
			$resultado1 = $mysqli2->query($query1);
			while($row1 = $resultado1->fetch_assoc()) {
				$datos->nombres = $row1['nombres'];
				$datos->apellidos = $row1['apellidos'];
				$datos->tel = $row1['telefono_estudiante'];
				$datos->tdoc = $row1['tipo_documento'];
				$datos->id_tdoc = $row1['id'];
				$datos->estado = $control_antiguos == 1 ? $row1['estado'] : ($control_antiguos == 2 ? $row1['estado'] : "nuevo");
				//$datos->estado = $row1['estado'];
				$datos->email = $row1['email_institucional'];
				$rh = str_replace("+", "mas", $row1['rh']);
				$rh = str_replace("-", "menos", $rh);
				$datos->rh = $rh;
				$datos->actividad_extra = $row1['actividad_extra'];
				$datos->genero = $row1['genero'];
				$datos->acudiente = $row1['acudiente_1'];
				$datos->emailA = $row1['email_acudiente_1'];
				$datos->direccion = $row1['direccion'];
				$datos->telA = $row1['telefono_acudiente_1'];
				$datos->docA = $row1['documento_responsable'];
				$datos->ciudadA = $row1['ciudad'];
				$datos->documento_responsable = $row1['documento_responsable'];
				$datos->parentesco_acudiente_1 = $row1['parentesco_acudiente_1'];
				
				if($row1['estado'] == "aprobado") {
					//Se cargan los grados
					$siguiente_grado = $row1['id_grado'] + 1;
					$sentenciaFinal = $sentencia2."'grado'";
					$valores = [
						'_idGrado*' => $siguiente_grado
					];
					$query_g = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
					$resultadog = $mysqli2->query($query_g);
					while($rowg = $resultadog->fetch_assoc()) {
						$valores = [$rowg['id'],$rowg['grado']];
						$grados_temp = array_combine($keys,$valores);
						$grados[$i] = $grados_temp;
						$i++;
					}
				}
				else  {
					//Se cargan los grados
					//$query_g = "SELECT * FROM grados WHERE id = ".$row1['id_grado'];
					$sentenciaFinal = $sentencia2."'grado activo'";
					$valores = [
						'_idGrado*' => $row1['id_grado']
					];
					$query_g = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
					$resultadog = $mysqli2->query($query_g);
					while($rowg = $resultadog->fetch_assoc()) {
						$valores = [$rowg['id'],$rowg['grado']];
						$grados_temp = array_combine($keys,$valores);
						$grados[$i] = $grados_temp;
						$i++;
					}
				}
				//echo $query_g;
			}
		}
	    
	}
	
	//Se consulta el código de entrevista para estudiatnes que no sean nuevos
	$id = 0;
	$sentenciaFinal = $sentencia2."'datos entrevista'";
	$valores = [
		'_documento*' => $documento
	];
	$sqlcodigo = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	//echo $sqlcodigo;
	$resultado_c = $mysqli2->query($sqlcodigo);
	while($rowc = $resultado_c->fetch_assoc()) {
	    $id = $rowc['id1'];
	}
	$id = (is_null($id)) ? 0 : $id;
	if($id == 0) {
	    //$sqlcodigo1 = "SELECT *, ifnull(id, 0) id1 FROM tbl_pre_matricula WHERE documento_est = '$documento' AND año < $fanio";
		$sentenciaFinal = $sentencia2."'datos tbl_pre_matricula'";
		$valores = [
			'_documento*' => $documento,
			'_fanio*' => $fanio
		];
		$sqlcodigo1 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    	//echo $sqlcodigo1;
    	$resultado_c1 = $mysqli2->query($sqlcodigo1);
    	while($rowc1 = $resultado_c1->fetch_assoc()) {
    	    $id = $rowc1['id1'];
    	}
	}
	$id = (is_null($id)) ? 0 : $id;
	$datos->cod_ent = $id;
    
	$datos->grados = $grados;
	
	//Se valida si ya tiene un proceso de pre matrícula abierto
	$datos->procesoAbierto = "NO";
	$datos->gradoSolicitado = 0;
	$sentenciaFinal = $sentencia2."'datos tbl_pre_matricula1'";
	$valores = [
		'_documento*' => $documento,
		'_fanio*' => $fanio
	];
	$sql_pre_matricula = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$resultado_pre_matricula = $mysqli2->query($sql_pre_matricula);
	while($rowpm = $resultado_pre_matricula->fetch_assoc()) {
	    $datos->procesoAbierto = "SI";
		$datos->gradoSolicitado = $rowpm['id_grado'];
	}
	
	//Se valida si ya se programó entrevista
	$datos->programoEntrevista = "NO";
	//$sql_prog_entrevista = "SELECT * FROM tbl_entrevistas WHERE documento_est = '$documento' AND fecha >= '2024-10-07'";
	$sentenciaFinal = $sentencia2."'datos tbl_entrevistas'";
	$valores = [
		'_documento*' => $documento
	];
	$sql_prog_entrevista = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$resultado_prog_entrevista = $mysqli2->query($sql_prog_entrevista);
	while($rowpe = $resultado_prog_entrevista->fetch_assoc()) {
	    $datos->programoEntrevista = "SI";
	}
	
	//Se valida si el código de pre-matricula corresponde al documento
	$ct_c1 = 0;
	/*$sql_c1 = "SELECT COUNT(1) ct, email_pre_mat 
	FROM tbl_cod_pre_matricula WHERE identificacion = $documento AND codigo = '$codigo' 
	GROUP BY email_pre_mat";*/
	//echo $sql_c1;
	$sentenciaFinal = $sentencia2."'validar codigo pre matricula documento'";
	$valores = [
		'_documento*' => $documento,
		'_codigo*' => $codigo
	];
	$sql_c1 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$email_premat = '';
	$resultado_c1 = $mysqli2->query($sql_c1);
	while($rowc1 = $resultado_c1->fetch_assoc()) {
	    $ct_c1 = $rowc1['ct'];
	    $email_premat = $rowc1['email_pre_mat'];
	}
	if($ct_c1 > 0) {
	    $datos->cod_prematricula = "OK";
	}
	else {
	    $datos->cod_prematricula = "NO";
	}
	$datos->email_prematricula = $email_premat;
	
	//Se busca si debe presentar evaluación de validación
	//$sql_val_ct = "SELECT COUNT(1) ct FROM tbl_validaciones WHERE documento_est = '$documento' AND año = '$fanio'";
	$ct_val_ct = 0;
	$sentenciaFinal = $sentencia2."'evaluacion de validacion'";
	$valores = [
		'_documento*' => $documento,
		'_fanio*' => $fanio
	];
	$sql_val_ct = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	//echo $sql_val_ct;
	$exe_val_ct= $mysqli2->query($sql_val_ct);
    while($row_val_ct = $exe_val_ct->fetch_assoc()) {
        $ct_val_ct = $row_val_ct['ct'];
    }
    //echo $ct_val_ct;
    if($ct_val_ct > 0) {
        $datos->eval_validacion = "SI";
        //Se busca el grado máximo
        /*$sql_max_grado = "SELECT g.id, g.grado 
        FROM (SELECT MAX(id_grado) id_grado FROM tbl_validaciones WHERE documento_est = '$documento' AND fecha_programacion like '%$fanio%') v, grados g 
        WHERE v.id_grado = g.id";*/
		$sentenciaFinal = $sentencia2."'grado maximo a validar'";
		$valores = [
			'_documento*' => $documento,
			'_fanio*' => $fanio
		];
		$sql_max_grado = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
        $exe_max_grado = $mysqli2->query($sql_max_grado);
        while($row_max_grado = $exe_max_grado->fetch_assoc()) {
            $max_idgrado = $row_max_grado['id'];
            $max_grado = $row_max_grado['grado'];
        }
        //echo $max_grado;
        $datos->idgra_validacion = $max_idgrado;
        $datos->gra_validacion = $max_grado;
        
    	/*$sql_eval_val = "SELECT COUNT(1) ct FROM tbl_validaciones WHERE documento_est = '$documento' AND resultado = 'APROBADO' 
    	AND id_grado = $max_idgrado";*/
    	//echo $sql_eval_val;
		$sentenciaFinal = $sentencia2."'grado maximo aprobado'";
		$valores = [
			'_documento*' => $documento,
			'_max_idgrado*' => $max_idgrado
		];
		$sql_eval_val = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    	$exe_eval_val = $mysqli2->query($sql_eval_val);
        while($row_eval_val = $exe_eval_val->fetch_assoc()) {
            $ct_eval_val = $row_eval_val['ct'];
        }
        if($ct_eval_val == 1) {
            $datos->res_validacion = "APROBADO";
            //Se consulta el grado a matricular
            /*$sql_grado_ant = "SELECT * FROM grados WHERE id = $max_idgrado + 1";*/
		    $idGrado = $max_idgrado + 1;
		    $sentenciaFinal = $sentencia2."'grado'";
			$valores = [
				'_idGrado*' => $idGrado
			];
			$sql_grado_ant = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
            $exe_grado_ant = $mysqli2->query($sql_grado_ant);
            while($row_grado_ant = $exe_grado_ant->fetch_assoc()) {
                $datos->idgra_a_matricular = $row_grado_ant['id'];
                $datos->gra_a_matricular = $row_grado_ant['grado'];
            }
        }
        else {
           $datos->res_validacion = "NO APROBADO";
            $datos->idgra_a_matricular = $max_idgrado;
            $datos->gra_a_matricular = $max_grado;
        }
    }
	else {
	   $datos->eval_validacion = "NO";
	   $datos->idgra_validacion = "NA";
	   $datos->gra_validacion = "NA";
	   $datos->res_validacion = "NA";
	   $datos->idgra_a_matricular = "NA";
       $datos->gra_a_matricular = "NA";
	}
	
	//Se valida si ya presentó la evaluación de presaberes
	$datos->evaluacionPresaberes = "NO";
	if ($documento == "9397454" || $documento == "46376709") {
		$datos->evaluacionPresaberes = "SI";
	}
	/*$sql_val_pre = "SELECT COUNT(1) ct FROM tbl_respuestas WHERE identificacion = '$documento' AND a = '$fanio1' AND estado = 'FINALIZADA'";*/
	//echo $sql_val_pre;
	$sentenciaFinal = $sentencia2."'evaluacion presaberes finalizada'";
	$valores = [
		'_documento*' => $documento,
		'_fanio1*' => $fanio1
	];
	$sql_val_pre = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

	$exe_val_pre = $mysqli2->query($sql_val_pre);
    while($row_val_pre = $exe_val_pre->fetch_assoc()) {
        $ct_val_pre = $row_val_pre['ct'];
    }
    //echo $ct_val_pre;
    if($ct_val_pre > 0) {
        $datos->evaluacionPresaberes = "SI";
    }
	
	//Se valida si el documento no presenta entrevista ni evalución
	$sin_entrevista = '0';
	$sin_evaluacion = '0';
	//$sql_exento = "SELECT * FROM tbl_estudiantes_sin_ee WHERE n_documento = '$documento'";
	$sentenciaFinal = $sentencia2."'valida no entrevista no evaluacion'";
	$valores = [
		'_documento*' => $documento
	];
	$sql_exento = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

	$exe_exento = $mysqli2->query($sql_exento);
	while($row_exento = $exe_exento->fetch_assoc()) {
        $sin_entrevista = $row_exento['sin_entrevista'];
		$sin_evaluacion = $row_exento['sin_evaluacion'];
    }
	if ($sin_entrevista == "1") {
		$datos->programoEntrevista = "SI";
	}
	if ($sin_evaluacion == "1") {
		$datos->evaluacionPresaberes = "SI";
	}
	
	if ($datos->gradoSolicitado == 2 || $datos->gradoSolicitado >= 13) {
		$datos->evaluacionPresaberes = "SI";
	}
	
	//Se consulta el rango de matrícula ordinaria
	//$sql_matricula = "SELECT f1, f2 FROM tbl_parametros WHERE parametro = 'mat_ordinarias'";
	$sentenciaFinal = $sentencia2."'rango matricula ordinaria'";
	$valores = [
		'*' => '*'
	];
	$sql_matricula = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$exe_matricula = $mysqli2->query($sql_matricula);
	while($row_matricula = $exe_matricula->fetch_assoc()) {
		$f1 = $row_matricula['f1'];
		$f2 = $row_matricula['f2'];
	}
	$datos->mat_ordinaria_desde = $f1;
	$datos->mat_ordinaria_hasta = $f2;
	
	if($fechaHoy >= $f1 && $fechaHoy <= $f2) {
		$datos->mat_ordinaria = "SI";
	}
	else {				
		if($fechaHoy < $f1) {
			$datos->mat_ordinaria = "AUN NO";
		}
		else {
			$datos->mat_ordinaria = "NO";
		}
	}
	
	//Se consulta el rango de matrícula extra ordinaria
	//$sql_matricula_extra = "SELECT f1, f2 FROM tbl_parametros WHERE parametro = 'mat_extraordinarias'";
	$sentenciaFinal = $sentencia2."'rango matricula extra ordinaria'";
	$valores = [
		'*' => '*'
	];
	$sql_matricula_extra = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$exe_matricula_extra = $mysqli2->query($sql_matricula_extra);
	while($row_matricula_extra = $exe_matricula_extra->fetch_assoc()) {
		$f1e = $row_matricula_extra['f1'];
		$f2e = $row_matricula_extra['f2'];
	}
	$datos->mat_extraordinaria_desde = $f1e;
	$datos->mat_extraordinaria_hasta = $f2e;
	
	if($fechaHoy >= $f1e && $fechaHoy <= $f2e) {
		$datos->mat_extraordinaria = "SI";
	}
	else {				
		if($fechaHoy < $f1e) {
			$datos->mat_extraordinaria = "AUN NO";
		}
		else {
			$datos->mat_extraordinaria = "NO";
		}
	}
	
	//Se valida si el estudiante esta bloqueado
	$bloqueado = "NO";
	$ct_bloqueado = 0;
	//$sql_bloqueado = "SELECT COUNT(1) ct FROM tbl_estudiantes_bloqueados WHERE n_documento = '$documento'";
	$sentenciaFinal = $sentencia2."'valida estudiante bloqueado'";
	$valores = [
		'_documento*' => $documento
	];
	$sql_bloqueado = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$exe_bloqueado = $mysqli2->query($sql_bloqueado);
	while($row_bloqueado = $exe_bloqueado->fetch_assoc()) {
		$ct_bloqueado = $row_bloqueado['ct'];
	}
	if($ct_bloqueado > 0) {
		$bloqueado = "SI";
	}
	$datos->bloqueado = $bloqueado;
	
	echo json_encode($datos, JSON_UNESCAPED_UNICODE);
	
?>