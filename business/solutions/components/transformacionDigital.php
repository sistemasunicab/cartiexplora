<?php
    $nivel = "tres";
    require('../../repositories/1cc2s4Sol.php');

    date_default_timezone_set('America/Bogota');
	$fecha = time();
	$dia = date("d",$fecha);
	$mes = date("m",$fecha);
	$a = date("Y",$fecha);
	$hora = date("H",$fecha);
	$minutos = date("i",$fecha);
    $fecha2 = $a.$mes. $dia;

    $html = '';

    // Obtener las imagenes
    $res_sentecia = $mysqli1->query($sentencia . "12");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_sentencia_imagenes = $mysqli1->query($sql_imagenes);

    while($row_imagenes = $res_sentencia_imagenes->fetch_assoc()){
        $imagenes[] = $row_imagenes;
    }

    // Verificar si la seccion es visible y obtener texto
    $res_sentecia = $mysqli1->query($sentencia . "6");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_disenio = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_disenio = $mysqli1->query($sql_seccion_disenio);

    while($row_datos_seccion = $res_seccion_disenio->fetch_assoc()){

        $html .= '<div class="w-100">';
        $html .=    '<img'. ImageAttributeBuilder::buildAttributes($nivel, $imagenes[0]['ruta'],'imagenes-principal') .'class="img-fluid w-100 banner-shadow">';
        $html .= '</div>';
        $html .= '<main class="container">';
        $html .=    '<div class="row my-5 align-items-center">';
        $html .=        '<div class="col-lg-2 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">';
        $html .=            '<img class="solutions-icon" '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[1]['ruta'], 'icono') .'>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-10 col-md-12 col-sm-12 col-12">';
        $html .=            '<h1 class="tx-blue titulo-servicio font-roboto-light-title">'. $imagenes[1]['titulo'] .'</h1>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    '<div class="row my-5">';
        $html .=        '<div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>';
        $html .=        '<div class="col-lg-10 col-md-11 col-sm-11 col-11">';
        $html .=            $row_datos_seccion['texto'];
        $html .=        '</div>';
        $html .=    '</div>';

        $html .=    '<div class="row my-5 align-items-center cursoPensamientoLogico" id="cursoDesarrolloPensamientoLogico">';
        $html .=        '<div class="col-lg-2 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">';
        $html .=            '<img class="solutions-icon" '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[2]['ruta'], 'icono') .'>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-10 col-md-12 col-sm-12 col-12">';
        $html .=            '<h1 class="tx-blue titulo-servicio font-roboto-light-title">'. $imagenes[2]['titulo'] .'</h1>';
        $html .=        '</div>';
        $html .=    '</div>';

        $html .=    '<div class="container datosEstudiante">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-2 amarillo">
                                    <h6>Paso 1</h6>
                                </div>
                                <div class="col-md-10 col-10 azuloscuro">
                                    <h6>Paso 1</h6>
                                    <h6>VER PORTAFOLIO</h6>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div><br>
                    
                    <div class="container">
                        <div class="row ml-5">                                                        	
                            <div class="col-12">
                                <div class="form-group">
                                    <a href="https://unicab.solutions/descargas/curso_pensamiento_logico_unicab.pdf" target="_blank" class="download-button mx-3">
                                        <img src="../../../assets/img/paper_14969976.svg" class="img-fluid pdf-btn-costos">
                                    </a>
                                </div>
                            </div>
                        </div>                        
                    </div><br><br>';

        $html .=    '<div class="container datosEstudiante">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-2 amarillo">
                                    <h6>Paso 2</h6>
                                </div>
                                <div class="col-md-10 col-10 azuloscuro">
                                    <h6>Paso 2</h6>
                                    <h6>PAGAR VALOR CURSO</h6>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div><br>
                    
                    <div class="container">
                        <a href="../pages/pagar_curso.php?valorCurso=280000&fecha='.$fecha2.'&referencia=curso-dpl-nivel1&idEvento=1" target="_blank" class="btn-circulares-costos">
                            Pagar Curso
                        </a>
                    </div><br><br>';

        $html .=    '<div class="container">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-2 amarillo">
                                    <h6>Paso 3</h6>
                                </div>
                                <div class="col-md-10 col-10 azuloscuro">
                                    <h6>Paso 3</h6>
                                    <h6>VALIDAR PAGO</h6>
                                </div>
                            </div>
                            <br>
                        </div>		
                    </div><br>
                    
                    <div class="container">
                        <div class="row ml-5">
                        <div class="col-12 col-sm-5">
                            <div class="form-group">
                                <label for="register_documento">Ref Epayco (PIN)</label>
                                <input type="text" class="form-control borde-personalizado" id="val_ref_epayco" name="val_ref_epayco" required placeholder="Ref Epayco (PIN)">
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="form-group">
                                <button id="btnValidarEpayco" class="btn-circulares-costos">
                                    <h6 style="display: inline-block;" class="pr-3" id="entrar" onclick="validar_ref_epayco();">Validar Pago</h6>
                                </button>
                            </div>
                        </div>
                    </div><br>';

        $html .=    '<div class="container">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-2 amarillo">
                                    <h6>Paso 4</h6>
                                </div>
                                <div class="col-md-10 col-10 azuloscuro">
                                    <h6>Paso 4</h6>
                                    <h6>FORMULARIO INSCRIPCIÓN</h6>
                                </div>
                            </div>
                            <br>
                        </div>		
                    </div><br>
                    
                    <div class="container">
                        <form name="formPensamientoLogico" id="formPensamientoLogico" method="post" action="../ajax/registro_desarrollo_logico_n1.php" enctype="multipart/form-data">
                            <div class="row ml-5">
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="register_apellidos">Apellidos</label>
                                        <input type="text" class="form-control borde-personalizado campoFormulario" id="register_apellidos" name="register_apellidos" placeholder="Apellidos" required onkeyup="validarCampo(this, \'Apellidos\', \'texto\', 1, \'btnEnviarDL\');" >
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="register_nombres">Nombres</label>
                                        <input type="text" class="form-control borde-personalizado campoFormulario" id="register_nombres" name="register_nombres" required placeholder="Nombres" onkeyup="validarCampo(this, \'Nombres\', \'texto\', 1, \'btnEnviarDL\');">
                                    </div>
                                </div>
                            </div><br>

                            <div class="row ml-5">
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="register_telefono">Número telefónico</label>
                                        <input type="text" class="form-control borde-personalizado campoFormulario" id="register_telefono" name="register_telefono" required placeholder="Número telefónico sin espacios ni puntos" onkeyup="validarCampo(this, \'Número telefónico\', \'numero\', 1, \'btnEnviarDL\');">
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="register_email">Correo electrónico</span></label>
                                        <input type="text" class="form-control borde-personalizado campoFormulario" id="register_email" name="register_email" required placeholder="Correo electrónico" onkeyup="validarCampo(this, \'Correo electrónico\', \'correo\', 1, \'btnEnviarDL\');">
                                    </div>
                                </div>
                            </div><br>

                            <div class="row ml-5">
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="register_documento">Documento</label>
                                        <input type="text" class="form-control borde-personalizado campoFormulario" id="register_documento" name="register_documento" required placeholder="Documento sin espacios ni puntos" onkeyup="validarCampo(this, \'Documento\', \'numero\', 1, \'btnEnviarDL\');">
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="register_documento">Ref Epayco (PIN)</label>
                                        <input type="text" class="form-control borde-personalizado campoFormulario" id="ref_epayco" name="ref_epayco" required readonly value="0">
                                    </div>
                                </div>
                            </div><br>

                            <div class="row ml-5">                                
                                <div class="col-12 col-sm-5">
                                    <div class="form-group">
                                        <label for="register_comprobante">Comprobante de pago</span></label>
                                        <input type="file" id="register_comprobante" name="register_comprobante" required accept=".pdf" class="ArchivosAdjuntos tx-white bg-orange font-roboto-bolditalic d-lg-inline d-md-block d-sm-block d-block">
                                    </div>
                                </div>
                            </div><br>
                            <input type="hidden" id="id_evento" name="id_evento" value="1">
                            <input type="hidden" id="id_tipo_participante" name="id_tipo_participante" value="5">

                            <div class="row ml-5">                                                        	
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" id="btnEnviarDL" class="btn-circulares-costos">
                                            <h6 style="display: inline-block;" class="pr-3" id="entrar">Enviar Inscripción Curso</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                        
                        <div class="alert alert-danger" role="alert" id="alert">
                            <p>⚠️<span>: </span><label id="pdesc"></label>
                            <input type="hidden" class="alert alert-danger" style="width: 20px" id="txtvacio" value="0"></p>
                        </div>
                        <br><br>
                    </div>';

        $html .= '</main>';

        $html .= '<script>';
        $html .= 'const formulario = document.getElementById("formPensamientoLogico");';
        $html .= 'const boton = document.getElementById("btnEnviarDL");';
        $html .= 'const mensajeCarga = "Enviando...";';
        $html .= 'formulario.addEventListener("submit", function(event) {';
        $html .= 'boton.disabled = true;';
        $html .= 'boton.innerHTML = mensajeCarga;';
        $html .= 'boton.innerHTML = \'<img src="../../../assets/img/subiendo.gif" class="img-fluid" style="width: 20%; vertical-align: middle; margin-right: 8px;"> Enviando, por favor espera...\';';
        $html .= '});';
        $html .= '</script>';
    }

    echo $html;

    /*$url_solutions = "https://secure.payco.co/restpagos/transaction/response.json?ref_payco=320878260&public_key=870fd53ee9274a76a62c34f434b09569";
	// Usar cURL para hacer la llamada interna
	$ch = curl_init($url_solutions);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($ch, CURLOPT_POST, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$respuesta_b = trim(curl_exec($ch));
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	$respuesta_json = json_decode($respuesta_b, true); // el "true" lo convierte en array asociativo
	//var_dump($respuesta_json);
    echo $respuesta_json['data']['x_amount'];*/

    //echo $_SERVER['DOCUMENT_ROOT'];
?>