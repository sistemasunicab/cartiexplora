<?php	
	//http://localhost:90/cartiexplora/business/org/ajax/consulta_pago_getdat_f.php?ndoc=1049639438&a=2025&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=E&tconc=pm6
	//datos = "ndoc=" + ndoc + "&a=" + ano + "&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=TC&tconc=" + tipo_conc;

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
	
	$ndoc = $_REQUEST['ndoc'];
	$a = $_REQUEST['a'];
	$tabla = $_REQUEST['tabla'];
	$convenio = str_replace("_"," ",$_REQUEST['conv']);
	$tipo = $_REQUEST['tipo'];
	$tconc = $_REQUEST['tconc'];
	//$tconc = $_REQUEST['tconc'];
	//$tabla = "tbl_costos_unicab";
	//https://unicab.org/registro/docenteunicab/updreg/sogap/consulta_pago_getdat_f.php?ndoc=1014859175&a=2020&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PEB&tconc=m
	//https://unicab.org/registro/docenteunicab/updreg/sogap/consulta_pago_getdat_f.php?ndoc=9397454&a=2021&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PEB&tconc=pm2
	//https://unicab.org/registro/docenteunicab/updreg/sogap/consulta_pago_getdat_f.php?ndoc=9397454&a=2021&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PEB&tconc=mocp
	//https://unicab.org/registro/docenteunicab/updreg/sogap/consulta_pago_getdat_f.php?ndoc=9397454&a=2022&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PEB&tconc=icfes
	//https://unicab.org/registro/docenteunicab/updreg/sogap/consulta_pago_getdat_f.php?ndoc=9397454&a=2023&tabla=tbl_costos_unicab&conv=UNICAB_COLEGIO_VIRTUAL&tipo=PEB&tconc=pp
	
	date_default_timezone_set('America/Bogota');
    $dia = date("d");
    $mes = date("m");
    $mesLetra = date("M");
    $fanio = date("Y");
    $fecha2 = $fanio."/".$mes."/". $dia;
    //La última modificación fue el 2022/02/11
    $fecha_mat_ordinarias = "2023/12/15";
	$fecha_icfes_ordinarias = "2024/04/30";
	
	$valor = 0;
	$concepto = "PAGO ";
	$concepto1 = "";

	//Se consulta el grado del estudiante
	$sentenciaFinal = $sentencia2."'grado estudiante'";
	$valores = [
		'_ndoc*' => $ndoc
	];
	$query0 = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
    //echo $query0;
	$resultado0 = $mysqli2->query($query0);
	while($row0 = $resultado0->fetch_assoc()) {
	    $idgra = $row0['id_grado'];
	}
	
	//Se consulta si tiene incrementos el convenio de pago
	$sentenciaFinal = $sentencia2."'incrementos convenio pago'";
	$valores = [
		'_convenio*' => $convenio
	];
	$queryIncrementosConvenio = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$res_inc = $mysqli2->query($queryIncrementosConvenio);
	while($row_inc = $res_inc->fetch_assoc()){
		$inc = $row_inc['incremento'];
	}
	
	//Se consulta el valor del pago
	//El id_grado 0 de la tabla de costos es para el valor del ICFES. pp es para el valor ordinario y mocp es para el valor extraordinario
	//que esta relacionado con la variable $fecha_icfes_ordinarias
	if($tconc == "icfes") {
	    //$query0 = "SELECT * FROM $tabla cu WHERE id_grado = 0 AND a = $a";
		$sentenciaFinal = $sentencia2."'valor pago icfes'";
		$valores = [
			'_tabla*' => $tabla,
			'_a*' => $a
		];
		
	}
	else {
	    //$query0 = "SELECT * FROM $tabla cu WHERE id_grado = $idgra AND a = $a";
		$sentenciaFinal = $sentencia2."'valor pago'";
		$valores = [
			'_tabla*' => $tabla,
			'_idgrado*' => $idgra,
			'_a*' => $a
		];
	}
	//echo $query0;
	$queryValorPago = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$resultado = $mysqli2->query($queryValorPago);
	
	$datos = array();
	while($row = $resultado->fetch_assoc()){
		$datos[] = $row;
		if($tconc == "m") {
		    $valor = $row['matricula'];
			$valor = $valor + round($valor * 0.1, 0);
		    $concepto1 = "MATRICULA";
		}
		else if($tconc == "pm1") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M1";
			if($fecha2 > "2025/02/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm2") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M2";
		    if($fecha2 > "2025/03/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm3") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M3";
		    if($fecha2 > "2025/04/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm4") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M4";
		    if($fecha2 > "2025/05/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm5") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M5";
		    if($fecha2 > "2025/06/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm6") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M6";
		    if($fecha2 > "2025/07/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm7") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M7";
		    if($fecha2 > "2025/08/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm8") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M8";
		    if($fecha2 > "2025/09/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm9") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M9";
		    if($fecha2 > "2025/10/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "pm10") {
		    $valor = $row['pension'];
		    $concepto1 = "PENSION M10";
		    if($fecha2 > "2025/11/10") {
		        $valor = $valor + round($valor * 0.05, 0);
				//$valor = $valor + 1000;
		    }
		}
		else if($tconc == "ocp") {
		    $valor = $row['ocp'];
		    $concepto1 = "OCP";
		}
		/*else if($tconc == "p") {
		    $valor = $row['poliza'];
		    $concepto1 = "POLIZA";
		}*/
		else if($tconc == "dg") {
		    $valor = $row['dg'];
		    $concepto1 = "DERECHOS GRADO PRESENCIAL";
		}
		else if($tconc == "dgv") {
		    $valor = $row['dgv'];
		    $concepto1 = "DERECHOS GRADO VIRTUAL";
		}
		else if($tconc == "pp") {
		    $valor = $row['pp'];
		    $concepto1 = "PRIMER PAGO";
		    /*if($fecha2 > $fecha_mat_ordinarias) {
		        $valor = $valor + round($valor * 0.03, 0);
		    }*/
		}
		/*else if($tconc == "mocp") {
		    $valor = $row['mocp'];
		    $concepto1 = "MATRICULA + OCP";
		    if($fecha2 > $fecha_mat_ordinarias) {
		        $valor = $valor + round($valor * 0.03, 0);
		    }
		    //echo $valor;
		}
		else if($tconc == "icfes") {
		    
		    $concepto1 = "ICFES";
		    if($fecha2 <= $fecha_icfes_ordinarias) {
		        $valor = $row['pp'];
		    }
			else {
				$valor = $row['mocp'];
			}
		    //echo $valor;
		}*/
	}
	$concepto = $concepto.$concepto1." ".$a;
	
	//Se consultan los incrementos
	if($valor < 60000 && $tipo == "PEB") {
	    //$sql_inc1 = "SELECT * FROM tbl_incrementos WHERE tipo = 'PSE'";
		$sentenciaFinal = $sentencia2."'incrementos pse'";
		$valores = [
			'_PSE*' => 'PSE'
		];
	}
	else {
	    //$sql_inc1 = "SELECT * FROM tbl_incrementos WHERE tipo = '$tipo'";
		$sentenciaFinal = $sentencia2."'incrementos'";
		$valores = [
			'_tipo*' => $tipo
		];
	}
	$queryIncrementos = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$res_inc1 = $mysqli2->query($queryIncrementos);
	$incrementos = array();

	while($row_inc1 = $res_inc1->fetch_assoc()){
		$incrementos[] = $row_inc1;
	}
	
	//Se consulta el valor gateway
	/*$sql_gt = "SELECT ifnull(val_fijo_gateway, 0) val_gateway, ct_actual FROM tbl_gateway WHERE estado = 'ACTIVO' 
	    AND id_convenio = (SELECT id FROM tbl_cp WHERE convenio = '$convenio')";*/
	//echo $sql_gt;
	$sentenciaFinal = $sentencia2."'valor gateway'";
	$valores = [
		'_estado*' => 'ACTIVO',
		'_convenio*' => $convenio
	];
	$queryValorGateway = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	$res_gt = $mysqli2->query($queryValorGateway);
	while($row_gt = $res_gt->fetch_assoc()){
		$val_gt = $row_gt['val_gateway'];
	}
	
	if ($datos) { 
  
         $datos1["estado"] = 1;
         $datos1["inc"] = $inc;
         $datos1["valor"] = $valor;
         $datos1["concepto"] = $concepto;
         $datos1["val_gateway"] = $val_gt;
         $datos1["id_grado_est"] = $idgra;
         $datos1["registros"] = $datos;
         $datos1["incrementos"] = $incrementos;
         $datos1["fecha"] = $fecha2;
         $datos1["fecha_mat_ordinarias"] = $fecha_mat_ordinarias;
  
         echo json_encode($datos1); 
     } else { 
         print json_encode(array( 
             "estado" => 2, 
             "mensaje" => "Ha ocurrido un error" 
         )); 
     }
	
	//echo json_encode($datos);
	$resultado->close();
	$mysqli2->close();
	
?>