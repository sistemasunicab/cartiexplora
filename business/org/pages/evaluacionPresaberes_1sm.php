<?php
    include('../../../clases/ImageAttributeBuilder.php');
    include('../../../clases/ButtonStylesBannerBuilder.php');
    include('../../../clases/FlexTitleLoader.php');

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

    $documento = $_REQUEST['n_documento'];
    $ct_preg = $_REQUEST['ct_preg'];
    $idgrado = $_REQUEST['idgra'];

    date_default_timezone_set('America/Bogota');
    $dia=date("d");
    $mes=date("m");
    $mesLetra=date("M");
    $fanio=date("Y");
    if($mes >= 10) {
		$fanio++;
	}

    //Se consulta el grado del documento
    /*$sql = "SELECT e.*, g.grado 
    FROM estudiantes_eval_admision e, grados g 
    WHERE e.id_grado = g.id AND e.n_documento = '$documento'";*/
    $sentenciaFinal = $sentencia2."'nombre y grado presaberes'";
	$valores = [
		'_documento*' => $documento
	];
	$sql = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
	
	$peticion = $mysqli2->query($sql);
	while($row_pet = $peticion->fetch_assoc()) {
	    $nombre_completo = $row_pet['nombre'];
	    $grado = $row_pet['grado'];
	}

    //Se arma el array de cantidad de preguntas máximas por pensamiento
	//El orden del array es: [0] -> id_materia 1; [1] -> id_materia 4; [2] -> id_materia 5; [3] -> id_materia 6; [4] -> id_materia 7; [5] -> id_materia 9; [6] -> id_materia 11;
	$con_fisica = "NO";
	$array_materiasf = array(1, 4, 5, 6, 7, 9, 11);
	$array_materias = array(1, 4, 5, 6, 7, 9);
	$array_materias_1011f = array(10, 12, 5, 15, 7, 9, 11);
	
	$array_tot_preg = array(); //Esto es el total de preguntas por pensamiento o materia
	$array_tot_preg_q = array(); //Esto es el total de preguntas consultadas por pensamiento o materia
	$array_tot_preg_cargar = array(); //Esto es el total de preguntas a cargar en la evaluación por pensamiento o materia
	$i = 0;
	if($idgrado == 11 || $idgrado == 12 || $idgrado == 17 || $idgrado == 18 ) {
	    //$array_materias_final = $array_materiasf;
	    $array_materias_final = $array_materias_1011f;
	    $con_fisica = "SI";
	}
	else {
	    $array_materias_final = $array_materias;
	}
	//var_export ($array_materias_final);
	
	//************************************************************************************************************
	//$tabla_preguntas = "tbl_preguntas_bck";
	$tabla_preguntas = "tbl_preguntas";
	//************************************************************************************************************
	
	$temp = 0;
	$final = 0;
	$array_temp = array();
	$array_final = array(); //esto es para todos los pensamientos
	
	//********************** Se cargan las preguntas de bioético ******************************
	$array_id_temas_bio = array();
	$array_preg_tema_bio = array();
    $array_preg_tema_bio1 = array(); //Esto es para controlar las preguntas que se van seleccionando aleatoriamente
    $array_preg_bio_final = array();
    $bio = 0;
    
    //Se consultan los temas por pensamiento
    /*$sql_temas_bio = "SELECT DISTINCT tp.id, tp.tema 
        FROM tbl_preguntas p, tbl_temas_preguntas tp 
        WHERE p.id_tema = tp.id AND p.id_grado = $idgrado AND p.id_materia = ".$array_materias_final[0];*/
    $sentenciaFinal = $sentencia2."'temas pensamiento bio'";
	$valores = [
		'_idgrado*' => $idgrado,
		'_idmateria*' => $array_materias_final[0]
	];
	$sql_temas_bio = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_temas_bio = $mysqli2->query($sql_temas_bio);
    while($row_temas_bio = $exe_temas_bio->fetch_assoc()) {
        $array_id_temas_bio[$bio] = $row_temas_bio['id'];
        $bio++;
    }
    $bio = 0;
    //echo $sql_temas_bio;
    //print_r($array_id_temas_bio);
    
    //Se cargan las preguntas por cada tema
    $longitud_temas = count($array_id_temas_bio);
    for($i = 0; $i < $longitud_temas; $i++) {
	    /*$sql_preguntas_tema_bio = "SELECT id 
            FROM tbl_preguntas WHERE id_tema = $array_id_temas_bio[$i] AND id_grado = $idgrado AND id_materia = ".$array_materias_final[0];*/
        $sentenciaFinal = $sentencia2."'preguntas por tema bio'";
        $valores = [
            '_idtema*' => $array_id_temas_bio[$i],
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[0]
        ];
        $sql_preguntas_tema_bio = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        $exe_preguntas_tema_bio = $mysqli2->query($sql_preguntas_tema_bio);
        while($row_preguntas_tema_bio = $exe_preguntas_tema_bio->fetch_assoc()) {
            $array_preg_tema_bio[$bio] = $row_preguntas_tema_bio['id'];
            $array_preg_tema_bio1[$bio] = 0;
            $bio++;
        }
        $bio = 0;
        
        //Se consulta la cantidad de preguntas definidas por cada tema
    	/*$sql_cantidad_preg_tema = "SELECT ct_preguntas FROM tbl_temas_preguntas 
    	    WHERE id_grado = $idgrado AND id_materia = ".$array_materias_final[0]." AND id = ".$array_id_temas_bio[$i];*/
        $sentenciaFinal = $sentencia2."'ct preguntas por tema bio'";
        $valores = [
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[0],
            '_id*' => $array_id_temas_bio[$i]
        ];
        $sql_cantidad_preg_tema = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    	$exe_cantidad_preg_tema = $mysqli2->query($sql_cantidad_preg_tema);
        while($row_cantidad_preg_tema = $exe_cantidad_preg_tema->fetch_assoc()) {
            $ct_preguntas_tema = $row_cantidad_preg_tema['ct_preguntas'];
        }
        
        //Se seleccionan aleatoriamente la cantidad de preguntas definidas por cada tema
        $control = 0;
        $longitud_preg = count($array_preg_tema_bio);
        if($longitud_preg < $ct_preguntas_tema) {
            while($control < $longitud_preg) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_bio1[$ale-1] == 0) {
        		    $array_preg_tema_bio1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_bio[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        else {
            while($control < $ct_preguntas_tema) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_bio1[$ale-1] == 0) {
        		    $array_preg_tema_bio1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_bio[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        
        //Se limpian los array
        unset($array_preg_tema_bio);
        unset($array_preg_tema_bio1);
	}
	$array_preg_bio_final = $array_temp;
	shuffle($array_preg_bio_final);
	//var_export ($array_preg_bio_final);
	unset($array_temp);
	$temp = 0;
	//********************** FIN preguntas de bioético ******************************
	
	//********************** Se cargan las preguntas de sociales ******************************
	$array_id_temas_soc = array();
	$array_preg_tema_soc = array();
    $array_preg_tema_soc1 = array();
    $array_preg_soc_final = array();
    $soc = 0;
    
    //Se consultan los temas por pensamiento
    /*$sql_temas_soc = "SELECT DISTINCT tp.id, tp.tema 
        FROM tbl_preguntas p, tbl_temas_preguntas tp 
        WHERE p.id_tema = tp.id AND p.id_grado = $idgrado AND p.id_materia = ".$array_materias_final[1];*/
    $sentenciaFinal = $sentencia2."'temas pensamiento soc'";
	$valores = [
		'_idgrado*' => $idgrado,
		'_idmateria*' => $array_materias_final[1]
	];
	$sql_temas_soc = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_temas_soc = $mysqli2->query($sql_temas_soc);
    while($row_temas_soc = $exe_temas_soc->fetch_assoc()) {
        $array_id_temas_soc[$soc] = $row_temas_soc['id'];
        $soc++;
    }
    $soc = 0;
    //print_r($array_id_temas_soc);
    
    //Se cargan las preguntas por cada tema
    $longitud_temas = count($array_id_temas_soc);
    for($i = 0; $i < $longitud_temas; $i++) {
	    /*$sql_preguntas_tema_soc = "SELECT id 
            FROM tbl_preguntas WHERE id_tema = $array_id_temas_soc[$i] AND id_grado = $idgrado AND id_materia = ".$array_materias_final[1];*/
        $sentenciaFinal = $sentencia2."'preguntas por tema soc'";
        $valores = [
            '_idtema*' => $array_id_temas_soc[$i],
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[1]
        ];
        $sql_preguntas_tema_soc = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        //echo "<br>".$sql_preguntas_tema_soc;
        $exe_preguntas_tema_soc = $mysqli2->query($sql_preguntas_tema_soc);
        while($row_preguntas_tema_soc = $exe_preguntas_tema_soc->fetch_assoc()) {
            $array_preg_tema_soc[$soc] = $row_preguntas_tema_soc['id'];
            $array_preg_tema_soc1[$soc] = 0;
            $soc++;
        }
        $soc = 0;
        //print_r($array_preg_tema_soc);
        
        //Se consulta la cantidad de preguntas definidas por cada tema
        /*$sql_cantidad_preg_tema = "SELECT ct_preguntas FROM tbl_temas_preguntas 
    	    WHERE id_grado = $idgrado AND id_materia = ".$array_materias_final[1]." AND id = ".$array_id_temas_soc[$i];*/
        $sentenciaFinal = $sentencia2."'ct preguntas por tema soc'";
        $valores = [
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[1],
            '_id*' => $array_id_temas_soc[$i]
        ];
        $sql_cantidad_preg_tema = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores); 

    	//echo "<br>".$sql_cantidad_preg_tema;
    	$exe_cantidad_preg_tema = $mysqli2->query($sql_cantidad_preg_tema);
        while($row_cantidad_preg_tema = $exe_cantidad_preg_tema->fetch_assoc()) {
            $ct_preguntas_tema = $row_cantidad_preg_tema['ct_preguntas'];
        }
        
        //Se seleccionan aleatoriamente la cantidad de preguntas definidas por cada tema
        $control = 0;
        $longitud_preg = count($array_preg_tema_soc);
        //echo "<br>ct_preguntas_tema soc".$ct_preguntas_tema." longitud_preg soc ".$longitud_preg;
        if($longitud_preg < $ct_preguntas_tema) {
            while($control < $longitud_preg) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_soc1[$ale-1] == 0) {
        		    $array_preg_tema_soc1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_soc[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        else {
            while($control < $ct_preguntas_tema) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_soc1[$ale-1] == 0) {
        		    $array_preg_tema_soc1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_soc[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        
        //Se limpian los array
        unset($array_preg_tema_soc);
        unset($array_preg_tema_soc1);
	}
	$array_preg_soc_final = $array_temp;
	shuffle($array_preg_soc_final);
	//var_export ($array_preg_soc_final);
	unset($array_temp);
	$temp = 0;
	//********************** FIN preguntas de sociales ******************************
	
	//********************** Se cargan las preguntas de numérico ******************************
	$array_id_temas_num = array();
	$array_preg_tema_num = array();
    $array_preg_tema_num1 = array();
    $array_preg_num_final = array();
    $num = 0;
    
    //Se consultan los temas por pensamiento
    /*$sql_temas_num = "SELECT DISTINCT tp.id, tp.tema 
        FROM tbl_preguntas p, tbl_temas_preguntas tp 
        WHERE p.id_tema = tp.id AND p.id_grado = $idgrado AND p.id_materia = ".$array_materias_final[2];*/
    $sentenciaFinal = $sentencia2."'temas pensamiento num'";
	$valores = [
		'_idgrado*' => $idgrado,
		'_idmateria*' => $array_materias_final[2]
	];
	$sql_temas_num = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_temas_num = $mysqli2->query($sql_temas_num);
    while($row_temas_num = $exe_temas_num->fetch_assoc()) {
        $array_id_temas_num[$num] = $row_temas_num['id'];
        $num++;
    }
    $num = 0;
    //var_export ($array_id_temas_num);
    
    //Se cargan las preguntas por cada tema
    $longitud_temas = count($array_id_temas_num);
    for($i = 0; $i < $longitud_temas; $i++) {
	    /*$sql_preguntas_tema_num = "SELECT id 
            FROM tbl_preguntas WHERE id_tema = $array_id_temas_num[$i] AND id_grado = $idgrado AND id_materia = ".$array_materias_final[2];*/
        $sentenciaFinal = $sentencia2."'preguntas por tema num'";
        $valores = [
            '_idtema*' => $array_id_temas_num[$i],
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[2]
        ];
        $sql_preguntas_tema_num = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        //echo $sql_preguntas_tema_num;
        $exe_preguntas_tema_num = $mysqli2->query($sql_preguntas_tema_num);
        while($row_preguntas_tema_num = $exe_preguntas_tema_num->fetch_assoc()) {
            $array_preg_tema_num[$num] = $row_preguntas_tema_num['id'];
            $array_preg_tema_num1[$num] = 0;
            $num++;
        }
        $num = 0;
        //var_export ($array_preg_tema_num);
        
        //Se consulta la cantidad de preguntas definidas por cada tema
        /*$sql_cantidad_preg_tema = "SELECT ct_preguntas FROM tbl_temas_preguntas 
    	    WHERE id_grado = $idgrado AND id_materia = ".$array_materias_final[2]." AND id = ".$array_id_temas_num[$i];*/
        $sentenciaFinal = $sentencia2."'ct preguntas por tema num'";
        $valores = [
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[2],
            '_id*' => $array_id_temas_num[$i]
        ];
        $sql_cantidad_preg_tema = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    	$exe_cantidad_preg_tema = $mysqli2->query($sql_cantidad_preg_tema);
        while($row_cantidad_preg_tema = $exe_cantidad_preg_tema->fetch_assoc()) {
            $ct_preguntas_tema = $row_cantidad_preg_tema['ct_preguntas'];
        }
        //echo $ct_preguntas_tema;
        
        //Se seleccionan aleatoriamente la cantidad de preguntas definidas por cada tema
        $control = 0;
        $longitud_preg = count($array_preg_tema_num);
        //echo $longitud_preg;
        //echo "longitud_preg = ".$longitud_preg." ct_preguntas_tema =".$ct_preguntas_tema;
        if($longitud_preg < $ct_preguntas_tema) {
            while($control < $longitud_preg) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_num1[$ale-1] == 0) {
        		    $array_preg_tema_num1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_num[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        else {
            while($control < $ct_preguntas_tema) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_num1[$ale-1] == 0) {
        		    $array_preg_tema_num1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_num[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        //echo "<br>".var_export ($array_temp);
        
        //Se limpian los array
        unset($array_preg_tema_num);
        unset($array_preg_tema_num1);
	}
	$array_preg_num_final = $array_temp;
	shuffle($array_preg_num_final);
	//var_export ($array_preg_num_final);
	unset($array_temp);
	$temp = 0;
	//********************** FIN preguntas de numérico ******************************
	
	//********************** Se cargan las preguntas de español ******************************
	$array_id_temas_esp = array();
	$array_preg_tema_esp = array();
    $array_preg_tema_esp1 = array();
    $array_preg_esp_final = array();
    $esp = 0;
    
    //Se consultan los temas por pensamiento
    /*$sql_temas_esp = "SELECT DISTINCT tp.id, tp.tema 
        FROM tbl_preguntas p, tbl_temas_preguntas tp 
        WHERE p.id_tema = tp.id AND p.id_grado = $idgrado AND p.id_materia = ".$array_materias_final[3];*/
    $sentenciaFinal = $sentencia2."'temas pensamiento esp'";
	$valores = [
		'_idgrado*' => $idgrado,
		'_idmateria*' => $array_materias_final[3]
	];
	$sql_temas_esp = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_temas_esp = $mysqli2->query($sql_temas_esp);
    while($row_temas_esp = $exe_temas_esp->fetch_assoc()) {
        $array_id_temas_esp[$esp] = $row_temas_esp['id'];
        $esp++;
    }
    $esp = 0;
    
    //Se cargan las preguntas por cada tema
    $longitud_temas = count($array_id_temas_esp);
    for($i = 0; $i < $longitud_temas; $i++) {
	    /*$sql_preguntas_tema_esp = "SELECT id 
            FROM tbl_preguntas WHERE id_tema = $array_id_temas_esp[$i] AND id_grado = $idgrado AND id_materia = ".$array_materias_final[3];*/
        $sentenciaFinal = $sentencia2."'preguntas por tema esp'";
        $valores = [
            '_idtema*' => $array_id_temas_esp[$i],
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[3]
        ];
        $sql_preguntas_tema_esp = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        $exe_preguntas_tema_esp = $mysqli2->query($sql_preguntas_tema_esp);
        while($row_preguntas_tema_esp = $exe_preguntas_tema_esp->fetch_assoc()) {
            $array_preg_tema_esp[$esp] = $row_preguntas_tema_esp['id'];
            $array_preg_tema_esp1[$esp] = 0;
            $esp++;
        }
        $esp = 0;
        
        //Se consulta la cantidad de preguntas definidas por cada tema
    	/*$sql_cantidad_preg_tema = "SELECT ct_preguntas FROM tbl_temas_preguntas 
    	    WHERE id_grado = $idgrado AND id_materia = ".$array_materias_final[3]." AND id = ".$array_id_temas_esp[$i];*/
        $sentenciaFinal = $sentencia2."'ct preguntas por tema esp'";
        $valores = [
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[3],
            '_id*' => $array_id_temas_esp[$i]
        ];
        $sql_cantidad_preg_tema = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    	$exe_cantidad_preg_tema = $mysqli2->query($sql_cantidad_preg_tema);
        while($row_cantidad_preg_tema = $exe_cantidad_preg_tema->fetch_assoc()) {
            $ct_preguntas_tema = $row_cantidad_preg_tema['ct_preguntas'];
        }
        
        //Se seleccionan aleatoriamente la cantidad de preguntas definidas por cada tema
        $control = 0;
        $longitud_preg = count($array_preg_tema_esp);
        if($longitud_preg < $ct_preguntas_tema) {
            while($control < $longitud_preg) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_esp1[$ale-1] == 0) {
        		    $array_preg_tema_esp1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_esp[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        else {
            while($control < $ct_preguntas_tema) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_esp1[$ale-1] == 0) {
        		    $array_preg_tema_esp1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_esp[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        
        //Se limpian los array
        unset($array_preg_tema_esp);
        unset($array_preg_tema_esp1);
	}
	$array_preg_esp_final = $array_temp;
	shuffle($array_preg_esp_final);
	//var_export ($array_preg_esp_final);
	unset($array_temp);
	$temp = 0;
	//********************** FIN preguntas de español ******************************
	
	//********************** Se cargan las preguntas de inglés ******************************
	$array_id_temas_ing = array();
	$array_preg_tema_ing = array();
    $array_preg_tema_ing1 = array();
    $array_preg_ing_final = array();
    $ing = 0;
    
    //Se consultan los temas por pensamiento
    /*$sql_temas_ing = "SELECT DISTINCT tp.id, tp.tema 
        FROM tbl_preguntas p, tbl_temas_preguntas tp 
        WHERE p.id_tema = tp.id AND p.id_grado = $idgrado AND p.id_materia = ".$array_materias_final[4];*/
    $sentenciaFinal = $sentencia2."'temas pensamiento ing'";
	$valores = [
		'_idgrado*' => $idgrado,
		'_idmateria*' => $array_materias_final[4]
	];
	$sql_temas_ing = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_temas_ing = $mysqli2->query($sql_temas_ing);
    while($row_temas_ing = $exe_temas_ing->fetch_assoc()) {
        $array_id_temas_ing[$ing] = $row_temas_ing['id'];
        $ing++;
    }
    $ing = 0;
    
    //Se cargan las preguntas por cada tema
    $longitud_temas = count($array_id_temas_ing);
    for($i = 0; $i < $longitud_temas; $i++) {
	    /*$sql_preguntas_tema_ing = "SELECT id 
            FROM tbl_preguntas WHERE id_tema = $array_id_temas_ing[$i] AND id_grado = $idgrado AND id_materia = ".$array_materias_final[4];*/
        $sentenciaFinal = $sentencia2."'preguntas por tema ing'";
        $valores = [
            '_idtema*' => $array_id_temas_ing[$i],
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[4]
        ];
        $sql_preguntas_tema_ing = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        $exe_preguntas_tema_ing = $mysqli2->query($sql_preguntas_tema_ing);
        while($row_preguntas_tema_ing = $exe_preguntas_tema_ing->fetch_assoc()) {
            $array_preg_tema_ing[$ing] = $row_preguntas_tema_ing['id'];
            $array_preg_tema_ing1[$ing] = 0;
            $ing++;
        }
        $ing = 0;
        
        //Se consulta la cantidad de preguntas definidas por cada tema
    	/*$sql_cantidad_preg_tema = "SELECT ct_preguntas FROM tbl_temas_preguntas 
    	    WHERE id_grado = $idgrado AND id_materia = ".$array_materias_final[4]." AND id = ".$array_id_temas_ing[$i];*/
        $sentenciaFinal = $sentencia2."'ct preguntas por tema ing'";
        $valores = [
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[4],
            '_id*' => $array_id_temas_ing[$i]
        ];
        $sql_cantidad_preg_tema = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    	$exe_cantidad_preg_tema = $mysqli2->query($sql_cantidad_preg_tema);
        while($row_cantidad_preg_tema = $exe_cantidad_preg_tema->fetch_assoc()) {
            $ct_preguntas_tema = $row_cantidad_preg_tema['ct_preguntas'];
        }
        
        //Se seleccionan aleatoriamente la cantidad de preguntas definidas por cada tema
        $control = 0;
        $longitud_preg = count($array_preg_tema_ing);
        if($longitud_preg < $ct_preguntas_tema) {
            while($control < $longitud_preg) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_ing1[$ale-1] == 0) {
        		    $array_preg_tema_ing1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_ing[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        else {
            while($control < $ct_preguntas_tema) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_ing1[$ale-1] == 0) {
        		    $array_preg_tema_ing1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_ing[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        
        //Se limpian los array
        unset($array_preg_tema_ing);
        unset($array_preg_tema_ing1);
	}
	$array_preg_ing_final = $array_temp;
	shuffle($array_preg_ing_final);
	//var_export ($array_preg_ing_final);
	unset($array_temp);
	$temp = 0;
	//********************** FIN preguntas de inglés ******************************
	
	//********************** Se cargan las preguntas de tecnológico ******************************
	$array_id_temas_tec = array();
	$array_preg_tema_tec = array();
    $array_preg_tema_tec1 = array();
    $array_preg_tec_final = array();
    $tec = 0;
    
    //Se consultan los temas por pensamiento
    /*$sql_temas_tec = "SELECT DISTINCT tp.id, tp.tema 
        FROM tbl_preguntas p, tbl_temas_preguntas tp 
        WHERE p.id_tema = tp.id AND p.id_grado = $idgrado AND p.id_materia = ".$array_materias_final[5];*/
    $sentenciaFinal = $sentencia2."'temas pensamiento tec'";
	$valores = [
		'_idgrado*' => $idgrado,
		'_idmateria*' => $array_materias_final[5]
	];
	$sql_temas_tec = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_temas_tec = $mysqli2->query($sql_temas_tec);
    while($row_temas_tec = $exe_temas_tec->fetch_assoc()) {
        $array_id_temas_tec[$tec] = $row_temas_tec['id'];
        $tec++;
    }
    $tec = 0;
    
    //Se cargan las preguntas por cada tema
    $longitud_temas = count($array_id_temas_tec);
    for($i = 0; $i < $longitud_temas; $i++) {
	    /*$sql_preguntas_tema_tec = "SELECT id 
            FROM tbl_preguntas WHERE id_tema = $array_id_temas_tec[$i] AND id_grado = $idgrado AND id_materia = ".$array_materias_final[5];*/
        $sentenciaFinal = $sentencia2."'preguntas por tema tec'";
        $valores = [
            '_idtema*' => $array_id_temas_tec[$i],
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[5]
        ];
        $sql_preguntas_tema_tec = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        $exe_preguntas_tema_tec = $mysqli2->query($sql_preguntas_tema_tec);
        while($row_preguntas_tema_tec = $exe_preguntas_tema_tec->fetch_assoc()) {
            $array_preg_tema_tec[$tec] = $row_preguntas_tema_tec['id'];
            $array_preg_tema_tec1[$tec] = 0;
            $tec++;
        }
        $tec = 0;
        
        //Se consulta la cantidad de preguntas definidas por cada tema
    	/*$sql_cantidad_preg_tema = "SELECT ct_preguntas FROM tbl_temas_preguntas 
    	    WHERE id_grado = $idgrado AND id_materia = ".$array_materias_final[5]." AND id = ".$array_id_temas_tec[$i];*/
        $sentenciaFinal = $sentencia2."'ct preguntas por tema tec'";
        $valores = [
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[5],
            '_id*' => $array_id_temas_tec[$i]
        ];
        $sql_cantidad_preg_tema = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    	$exe_cantidad_preg_tema = $mysqli2->query($sql_cantidad_preg_tema);
        while($row_cantidad_preg_tema = $exe_cantidad_preg_tema->fetch_assoc()) {
            $ct_preguntas_tema = $row_cantidad_preg_tema['ct_preguntas'];
        }
        
        //Se seleccionan aleatoriamente la cantidad de preguntas definidas por cada tema
        $control = 0;
        $longitud_preg = count($array_preg_tema_tec);
        if($longitud_preg < $ct_preguntas_tema) {
            while($control < $longitud_preg) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_tec1[$ale-1] == 0) {
        		    $array_preg_tema_tec1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_tec[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        else {
            while($control < $ct_preguntas_tema) {
    	        $ale=mt_rand(1,$longitud_preg);
                if($array_preg_tema_tec1[$ale-1] == 0) {
        		    $array_preg_tema_tec1[$ale-1] = 1;
        		    $array_temp[$temp] = $array_preg_tema_tec[$ale-1];
        		    $temp++;
            	    $control++;
        		}
    	    }
        }
        
        //Se limpian los array
        unset($array_preg_tema_tec);
        unset($array_preg_tema_tec1);
	}
	$array_preg_tec_final = $array_temp;
	shuffle($array_preg_tec_final);
	//var_export ($array_preg_tec_final);
	unset($array_temp);
	$temp = 0;
	//********************** FIN preguntas de tecnológico ******************************
	
	//********************** Se cargan las preguntas de física ******************************
	if($idgrado == 11 || $idgrado == 12 || $idgrado == 17 || $idgrado == 18 ) {
	    $array_id_temas_fis = array();
    	$array_preg_tema_fis = array();
        $array_preg_tema_fis1 = array();
        $array_preg_fis_final = array();
        $fis = 0;
        
        //Se consultan los temas por pensamiento
        /*$sql_temas_fis = "SELECT DISTINCT tp.id, tp.tema 
            FROM tbl_preguntas p, tbl_temas_preguntas tp 
            WHERE p.id_tema = tp.id AND p.id_grado = $idgrado AND p.id_materia = ".$array_materias_final[6];*/
        $sentenciaFinal = $sentencia2."'temas pensamiento fis'";
        $valores = [
            '_idgrado*' => $idgrado,
            '_idmateria*' => $array_materias_final[6]
        ];
        $sql_temas_fis = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores); 

        $exe_temas_fis = $mysqli2->query($sql_temas_fis);
        while($row_temas_fis = $exe_temas_fis->fetch_assoc()) {
            $array_id_temas_fis[$fis] = $row_temas_fis['id'];
            $fis++;
        }
        $fis = 0;
        
        //Se cargan las preguntas por cada tema
        $longitud_temas = count($array_id_temas_fis);
        for($i = 0; $i < $longitud_temas; $i++) {
    	    /*$sql_preguntas_tema_fis = "SELECT id 
                FROM tbl_preguntas WHERE id_tema = $array_id_temas_fis[$i] AND id_grado = $idgrado AND id_materia = ".$array_materias_final[6];*/
            $sentenciaFinal = $sentencia2."'preguntas por tema fis'";
            $valores = [
                '_idtema*' => $array_id_temas_fis[$i],
                '_idgrado*' => $idgrado,
                '_idmateria*' => $array_materias_final[6]
            ];
            $sql_preguntas_tema_fis = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

            $exe_preguntas_tema_fis = $mysqli2->query($sql_preguntas_tema_fis);
            while($row_preguntas_tema_fis = $exe_preguntas_tema_fis->fetch_assoc()) {
                $array_preg_tema_fis[$fis] = $row_preguntas_tema_fis['id'];
                $array_preg_tema_fis1[$fis] = 0;
                $fis++;
            }
            $fis = 0;
            
            //Se consulta la cantidad de preguntas definidas por cada tema
        	/*$sql_cantidad_preg_tema = "SELECT ct_preguntas FROM tbl_temas_preguntas 
    	    WHERE id_grado = $idgrado AND id_materia = ".$array_materias_final[6]." AND id = ".$array_id_temas_fis[$i];*/
            $sentenciaFinal = $sentencia2."'ct preguntas por tema fis'";
            $valores = [
                '_idgrado*' => $idgrado,
                '_idmateria*' => $array_materias_final[6],
                '_id*' => $array_id_temas_fis[$i]
            ];
            $sql_cantidad_preg_tema = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        	$exe_cantidad_preg_tema = $mysqli2->query($sql_cantidad_preg_tema);
            while($row_cantidad_preg_tema = $exe_cantidad_preg_tema->fetch_assoc()) {
                $ct_preguntas_tema = $row_cantidad_preg_tema['ct_preguntas'];
            }
            
            //Se seleccionan aleatoriamente la cantidad de preguntas definidas por cada tema
            $control = 0;
            $longitud_preg = count($array_preg_tema_fis);
            if($longitud_preg < $ct_preguntas_tema) {
                while($control < $longitud_preg) {
        	        $ale=mt_rand(1,$longitud_preg);
                    if($array_preg_tema_fis1[$ale-1] == 0) {
            		    $array_preg_tema_fis1[$ale-1] = 1;
            		    $array_temp[$temp] = $array_preg_tema_fis[$ale-1];
            		    $temp++;
                	    $control++;
            		}
        	    }
            }
            else {
                while($control < $ct_preguntas_tema) {
        	        $ale=mt_rand(1,$longitud_preg);
                    if($array_preg_tema_fis1[$ale-1] == 0) {
            		    $array_preg_tema_fis1[$ale-1] = 1;
            		    $array_temp[$temp] = $array_preg_tema_fis[$ale-1];
            		    $temp++;
                	    $control++;
            		}
        	    }
            }
            
            //Se limpian los array
            unset($array_preg_tema_fis);
            unset($array_preg_tema_fis1);
    	}
    	$array_preg_fis_final = $array_temp;
    	shuffle($array_preg_fis_final);
    	//var_export ($array_preg_fis_final);
    	unset($array_temp);
    	$temp = 0;
	}
	//********************** FIN preguntas de física ******************************
	
	//Se hacen los conteos generales
    $ct_ok = 0;
    $ct_no = 0;
    $ct_na = 0;
    $ct_preg_ya = 0;
    /*$sql_ctok = "SELECT COUNT(1) ct_ok, identificacion FROM tbl_respuestas WHERE resultado = 'OK' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion";*/
    $sentenciaFinal = $sentencia2."'conteos ok'";
    $valores = [
        '_resultado*' => 'OK',
        '_documento*' => $documento,
        '_a*' => $fanio
    ];
    $sql_ctok = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    //echo $sql_ctok;
    $exe_ctok = $mysqli2->query($sql_ctok);
    while($row_ctok = $exe_ctok->fetch_assoc()) {
        $ct_ok = $row_ctok['ct_ok'];
    }
    //echo $ct_ok;

    /*$sql_ctno = "SELECT COUNT(1) ct_no, identificacion FROM tbl_respuestas WHERE resultado = 'NO' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion";*/
    $sentenciaFinal = $sentencia2."'conteos no'";
    $valores = [
        '_resultado*' => 'NO',
        '_documento*' => $documento,
        '_a*' => $fanio
    ];
    $sql_ctno = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores); 

    $exe_ctno = $mysqli2->query($sql_ctno);
    while($row_ctno = $exe_ctno->fetch_assoc()) {
        $ct_no = $row_ctno['ct_no'];
    }
    //echo $ct_no;

    /*$sql_ctna = "SELECT COUNT(1) ct_na, identificacion FROM tbl_respuestas WHERE resultado = 'NA' AND identificacion = '$documento' 
    AND a = $fanio GROUP BY identificacion";*/
    $sentenciaFinal = $sentencia2."'conteos na'";
    $valores = [
        '_resultado*' => 'NA',
        '_documento*' => $documento,
        '_a*' => $fanio
    ];
    $sql_ctna = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_ctna = $mysqli2->query($sql_ctna);
    while($row_ctna = $exe_ctna->fetch_assoc()) {
        $ct_na = $row_ctna['ct_na'];
    }
    //echo $ct_na;
    
    //preguntas ya contestadas
    $ct_preg_ya = $ct_ok + $ct_no;
    //echo $ct_preg_ya;
    
    $listado = "";
    
    //Se valida si ya hay registros de respuestas para el documento
    /*$sql_eval_respuestas = "SELECT COUNT(1) ct FROM tbl_respuestas WHERE identificacion = '$documento' AND a = $fanio";*/
    $sentenciaFinal = $sentencia2."'valida si hay registros en tbl_respuestas'";
    $valores = [
        '_documento*' => $documento,
        '_a*' => $fanio
    ];
    $sql_eval_respuestas = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

    $exe_eval_respuestas = $mysqli2->query($sql_eval_respuestas);
    while($row_eval_respuestas = $exe_eval_respuestas->fetch_assoc()) {
        $ct_eval_respuestas = $row_eval_respuestas['ct'];
    }
    //echo $ct_eval_respuestas;
    
    //Se insertan las respuestas temporales
    if($ct_eval_respuestas == 0) {
        //Se arma el array final
    	$temp = 0;
    	$control = 0;
    	$longitud_bio = count($array_preg_bio_final);
    	while($control < $longitud_bio){
    	    $array_final[$temp] = $array_preg_bio_final[$control];
    	    $temp++;
    	    $control++;
    	}
    	$control = 0;
    	$longitud_soc = count($array_preg_soc_final);
    	while($control < $longitud_soc){
    	    $array_final[$temp] = $array_preg_soc_final[$control];
    	    $temp++;
    	    $control++;
    	}
    	$control = 0;
    	$longitud_num = count($array_preg_num_final);
    	while($control < $longitud_num){
    	    $array_final[$temp] = $array_preg_num_final[$control];
    	    $temp++;
    	    $control++;
    	}
    	$control = 0;
    	$longitud_esp = count($array_preg_esp_final);
    	while($control < $longitud_esp){
    	    $array_final[$temp] = $array_preg_esp_final[$control];
    	    $temp++;
    	    $control++;
    	}
    	$control = 0;
    	$longitud_ing = count($array_preg_ing_final);
    	while($control < $longitud_ing){
    	    $array_final[$temp] = $array_preg_ing_final[$control];
    	    $temp++;
    	    $control++;
    	}
    	$control = 0;
    	$longitud_tec = count($array_preg_tec_final);
    	while($control < $longitud_tec){
    	    $array_final[$temp] = $array_preg_tec_final[$control];
    	    $temp++;
    	    $control++;
    	}
    	
    	if($idgrado == 11 || $idgrado == 12 || $idgrado == 17 || $idgrado == 18 ) {
    	    $control = 0;
        	$longitud_fis = count($array_preg_fis_final);
        	while($control < $longitud_fis){
        	    $array_final[$temp] = $array_preg_fis_final[$control];
        	    $temp++;
        	    $control++;
        	}
    	}
    	
    	$longitud_final = count($array_final);
        for($i = 0; $i < $longitud_final; $i++) {
            //Se consulta el id pensamiento
        	/*$sql_idpen = "SELECT id_materia FROM ".$tabla_preguntas." WHERE id = $array_final[$i]";*/
            $sentenciaFinal = $sentencia2."'consulta pensamiento'";
            $valores = [
                '_id*' => $array_final[$i]
            ];
            $sql_idpen = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        	$exe_idpen = $mysqli2->query($sql_idpen);
        	while($row_idpen = $exe_idpen->fetch_assoc()) {
        	    $idpen = $row_idpen['id_materia'];
        	}
    	
            /*$sql_insert = "INSERT tbl_respuestas (id_grado, id_materia, id_pregunta, a, identificacion, respuesta, resultado, estado) VALUES 
                ($idgrado, $idpen, $array_final[$i], $fanio, '$documento', 'NA', 'NA', 'ABIERTA')";*/
            $sentenciaFinal = $sentencia2."'insert tbl_respuestas'";
            $valores = [
                '_idgrado*' => $idgrado,
                '_idpen*' => $idpen,
                '_idpregunta*' => $array_final[$i],
                '_a*' => $fanio,
                '_documento*' => $documento,
                '_respuesta*' => 'NA',
                '_resultado*' => 'NA',
                '_estado*' => 'ABIERTA'
            ];
            $sql_insert = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

            $resultado0 = $mysqli2->query($sql_insert);
            
            //Se arma el listado de preguntas
            $listado .= $array_final[$i]."_";
        }
    }
    else {
        $temp = 0;
        /*$sql_na = "SELECT * FROM tbl_respuestas WHERE resultado = 'NA' AND identificacion = '$documento' 
        AND a = $fanio";*/
        $sentenciaFinal = $sentencia2."'valida respuestas na'";
        $valores = [
            '_a*' => $fanio,
            '_documento*' => $documento,
            '_resultado*' => 'NA'
        ];
        $sql_na = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);

        //echo $sql_na;
        $exe_na = $mysqli2->query($sql_na);
        while($row_na = $exe_na->fetch_assoc()) {
            //$array_temp[$temp] = $row_na['id_pregunta'];
            $listado .= $row_na['id_pregunta']."_";
        }
        //echo $listado;
        
        $longitud_final = $ct_eval_respuestas;
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
        
        include("../components/main_presaberes_sm.php");
        
        include('../../../components/footer.php');
        include('../../../components/bookstoresMain.php');
    ?>  
<body>
    
</html>