<?php
    function posicionTitulo($imgHTML, $titulo, $posicionTitulo, $color = '')
    {
        $title = '';
        if (strtolower($posicionTitulo) == 'abajo') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=    '<div class="col-lg-3 my-4">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .=    '<div class="col-lg-12">';
            $title .=        '<h4 class="font-roboto-black text-start '.$color.'">' . $titulo . '</h4>';
            $title .=    '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'derecha') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-8">';
            $title .=         '<h4 class="font-roboto-black'.$color.'">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=     '<div class="col-lg-8">';
            $title .=         '<h4 class="font-roboto-black text-end '.$color.'">' . $titulo . '</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'arriba') {
            $title .= '<div class="row align-items-center justify-content-start my-2">';
            $title .=     '<div class="col-lg-12 my-4">';
            $title .=         '<h4 class="font-roboto-black text-start '.$color.'">'. $titulo .'</h4>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-3">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .= '</div>';
        }
        return $title;
    }

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
        require('business/repositories/1cc2s4Org.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
        require('../business/repositories/1cc2s4Org.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
        require('../../business/repositories/1cc2s4Org.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
        require('../../../business/repositories/1cc2s4Org.php');
    }

    //Obtener Imagenes
    /*$res_sentecia = $mysqli1->query($sentencia . "106");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }*/
    $res_sentecia = $sentencia."106";
	$valores = [
		'*' => '*'
	];
	$sql_imagenes = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

    $res1 = $mysqli1->query($sql_imagenes);
    while ($row = $res1->fetch_assoc()) {
        $imagenes[] = $row;
    }

    //Obtener textos
    $res_sentecia = $sentencia."108";
	$sql_textos = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

    $res2 = $mysqli1->query($sql_textos);
    while ($row = $res2->fetch_assoc()) {
        $textos[] = $row;
    }

    $res_sentecia = $sentencia."105";
	$sql_seccion = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

    $res_seccion = $mysqli1->query($sql_seccion);
    $html = '';
    while ($row_sentencia = $res_seccion->fetch_assoc()) {
        $imagen_banner = array_shift($imagenes);
        $html .= '<section class="row mb-5">';
        $html .=    '<div class="col-lg-12">';
        $html .=        '<img '.ImageAttributeBuilder::buildAttributes($nivel, $imagen_banner['ruta'], $imagen_banner['descripcion']).' class="img-fluid w-100">';
        $html .=    '</div>';
        $html .= '</section>';

        //$html .= '</main>';
    }

    $html .= '<div class="container datosEstudiante">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-2 amarillo">
                            <h5>'.$textos[0]['identificacion'].'</h5>
                        </div>
                        <div class="col-md-1 col-1 azuloscuro">
                            <h5>'.$textos[0]['identificacion'].'</h5>
                        </div>
                        <div class="col-md-8 col-8 azuloscuro">
                            <h5>'.$textos[0]['texto'].'</h5>
                        </div>
                    </div>
                    <br>
                </div>		
            </div><br>';

    $campos_formulario = [];
    $res_sentecia = $sentencia."107";
	$sql_formulario = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

    $res_formulario = $mysqli1->query($sql_formulario);
    while ($row_datos_form = $res_formulario->fetch_assoc()) {
        $campos_formulario[] = $row_datos_form;
    }

    //<img src="assets/img/admisiones/ico1_admisiones_2025_1.jpg" id="imgh1" class="icono img-fluid"/>
    $icono_documento = array_shift($imagenes);
    $icono_datos = array_shift($imagenes);
    $imagen_continua_proceso = array_shift($imagenes);
    $gif_loading = array_shift($imagenes);
    $imagen_submit = array_shift($imagenes);
    $documento_estudiante = array_shift($campos_formulario);
    $html .= '<div class="container datosEstudiante">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-4"></div>
                        <div class="col-md-2 col-4">
                            <center>
                                <img '.ImageAttributeBuilder::buildAttributes($nivel, $icono_documento['ruta'], $icono_documento['descripcion']).' class="icono img-fluid">
                            </center>
                        </div>
                        <div class="col-md-5 col-4"></div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4 col-2"></div>
                        <div class="col-md-4 col-8">
                            <center>
                                <div class="form-group">
                                    <label for="'.$documento_estudiante['campo'].'" class="form-label1">'.$documento_estudiante['texto'].'</label>
                                    <input type="'.$documento_estudiante['tipo'].'" class="form-control campoFormulario" id="'.$documento_estudiante['campo'].'" name="'.$documento_estudiante['campo'].'" placeholder="Escribe el número de documento del estudiante" onkeyup="validarCampo(this, \'Número documento estudiante\', \'numero\', 0, \'\');" onBlur="limpiar();" required>
                                    <input type="hidden" style="width: 20px" id="ctr_'.$documento_estudiante['campo'].'" value="1"/>
                                </div>
                            </center>
                        </div>
                        <div class="col-md-4 col-2"></div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-2 col-2"></div>
                        <div class="col-md-8 col-8">
                            <h6 id="msgdocumento" style="color: blue;"></h6>
                        </div>				
                        <div class="col-md-2 col-2"></div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4 col-3"></div>
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <center>
                                    <button type="button" class="btnContinuar" onclick="valDocumentoEntrevista(\'btnEnviar\');">
                                        <img '.ImageAttributeBuilder::buildAttributes($nivel, $imagen_continua_proceso['ruta'], $imagen_continua_proceso['descripcion']).' class="img-fluid">
                                    </button>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-4 col-3"></div>
                    </div><br>
                    <div id="divcargando" class="loader">
                        <center><p><img '.ImageAttributeBuilder::buildAttributes($nivel, $gif_loading['ruta'], $gif_loading['descripcion']).' class="img-fluid"></p></center>
                    </div>
                </div>		
            </div><br>';

    $html .= '<div class="container datos">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-2 amarillo">
                            <h5>'.$textos[1]['identificacion'].'</h5>
                        </div>
                        <div class="col-md-1 col-1 azuloscuro">
                            <h5>'.$textos[1]['identificacion'].'</h5>
                        </div>
                        <div class="col-md-8 col-8 azuloscuro">
                            <h5>'.$textos[1]['texto'].'</h5>
                        </div>
                    </div>
                    <br>
                </div>		
            </div><br>';

    $html .= '<div class="container datos">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-4"></div>
                        <div class="col-md-2 col-4">
                            <center>
                                <img '.ImageAttributeBuilder::buildAttributes($nivel, $icono_datos['ruta'], $icono_datos['descripcion']).' class="icono img-fluid">
                            </center>
                        </div>
                        <div class="col-md-5 col-4"></div>
                    </div>
                </div>		
            </div><br>';

    //Formulario
    $register_documentoe_f = array_shift($campos_formulario);
    $estnuevo = array_shift($campos_formulario);
    $register_apellidos = array_shift($campos_formulario);
    $register_nombres = array_shift($campos_formulario);
    $register_grado = array_shift($campos_formulario);
    $grado_permitido = array_shift($campos_formulario);
    $register_tipo_documento = array_shift($campos_formulario);
    $td_text = array_shift($campos_formulario);
    $register_telefono = array_shift($campos_formulario);
    $register_medio = array_shift($campos_formulario);
    $register_genero = array_shift($campos_formulario);
    $activiadad_extra = array_shift($campos_formulario);
    $register_nombreA = array_shift($campos_formulario);
    $register_documentoA = array_shift($campos_formulario);
    $register_direccionA = array_shift($campos_formulario);
    $register_celularA = array_shift($campos_formulario);
    $register_correoA = array_shift($campos_formulario);
    $register_correoA1 = array_shift($campos_formulario);
    $parentesco_acudiente_1 = array_shift($campos_formulario);
    $register_ciudada = array_shift($campos_formulario);

    $html .= '<div class="container datos">
                <form name="formulario" id="formulario_entrevista" method="post" action="../dml/registro_inicial_putdat.php" enctype="multipart/form-data">
                    <input type="'.$register_documentoe_f['tipo'].'" id="'.$register_documentoe_f['campo'].'" name="'.$register_documentoe_f['campo'].'" '.$register_documentoe_f['obligatorio'].' '.$register_documentoe_f['soloLectura'].' '.$register_documentoe_f['habilitado'].'>
                    <input type="'.$estnuevo['tipo'].'" id="'.$estnuevo['campo'].'" name="'.$estnuevo['campo'].'" >
                    
                    <div class="row ml-5">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_apellidos['campo'].'" class="form-label1">'.$register_apellidos['texto'].'</label>
                                <input type="'.$register_apellidos['tipo'].'" class="form-control campoFormulario" id="'.$register_apellidos['campo'].'" name="'.$register_apellidos['campo'].'" placeholder="'.$register_apellidos['placeHolder'].'" onkeyup="validarCampo(this, \'Apellidos\', \'texto\', 1, \'btnEnviar\');" '.$register_apellidos['obligatorio'].' '.$register_apellidos['soloLectura'].' '.$register_apellidos['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_apellidos" value="1"/>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_nombres['campo'].'" class="form-label1">'.$register_nombres['texto'].'</label>
                                <input type="'.$register_nombres['tipo'].'" class="form-control campoFormulario" id="'.$register_nombres['campo'].'" name="'.$register_nombres['campo'].'" placeholder="'.$register_nombres['placeHolder'].'" onkeyup="validarCampo(this, \'Nombres\', \'texto\', 1, \'btnEnviar\');" '.$register_nombres['obligatorio'].' '.$register_nombres['soloLectura'].' '.$register_nombres['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_nombres" value="1"/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="row ml-5">                                                        	
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_grado['campo'].'" id="lblgrado" class="form-label1">'.$register_grado['texto'].'</label><br>
                                <select class="form-control form-select1 snormal select campoFormulario" id="'.$register_grado['campo'].'" name="'.$register_grado['campo'].'" '.$register_grado['obligatorio'].' '.$register_grado['soloLectura'].' '.$register_grado['habilitado'].' >
                                    <option value="NA" selected>Seleccione grado</option>';
                                    
                                        $sentenciaFinal = $sentencia2."'grados'";
                                        $valores = [
                                            '*' => '*'
                                        ];
                                        $sql = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
                                        $petecion = $mysqli2->query($sql);
                                        while ($row = mysqli_fetch_array($petecion)) {
                                            $html .= '<option value="'.$row['id'].'">'.$row['grado'].'</option>';
                                        }
                                    
                        $html .= '</select>
                                <input type="hidden" style="width: 20px" id="ctr_register_grado" value="1"/> 
                                <input type="hidden" id="grado_permitido" value="0"/>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>			
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_tipo_documento['campo'].'" id="lbltd" class="form-label1">'.$register_tipo_documento['texto'].'</label><br>
                                <select class="form-control form-select1 snormal select campoFormulario" id="'.$register_tipo_documento['campo'].'" name="'.$register_tipo_documento['campo'].'" '.$register_tipo_documento['obligatorio'].' '.$register_tipo_documento['soloLectura'].' '.$register_tipo_documento['habilitado'].' >
                                    <option value="NA" selected>Seleccione tipo documento</option>';
                                    
                                        $sentenciaFinal = $sentencia2."'tipos documento'";
                                        $valores = [
                                            '*' => '*'
                                        ];
                                        $sql = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
                                        $petecion1 = $mysqli2->query($sql);
                                        while ($row1 = mysqli_fetch_array($petecion1)) {
                                            $html .= '<option value="'.$row1['id'].'">'.$row1['tipo_documento'].'</option>';
                                        }
                                    
                        $html .= '</select>
                                <input type="hidden" style="width: 20px" id="ctr_register_tipo_documento" value="1"/> 
                                <input type="hidden" id="td_text" name="td_text"/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="row ml-5">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_telefono['campo'].'" class="form-label1">'.$register_telefono['texto'].'</label>
                                <input type="'.$register_telefono['tipo'].'" class="form-control campoFormulario" id="'.$register_telefono['campo'].'" name="'.$register_telefono['campo'].'" placeholder="'.$register_telefono['placeHolder'].'" onkeyup="validarCampo(this, \'Número telefónico\', \'texto\', 1, \'btnEnviar\');" '.$register_telefono['obligatorio'].' '.$register_telefono['soloLectura'].' '.$register_telefono['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_telefono" value="1"/>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_medio['campo'].'" id="lblmedio" class="form-label1">'.$register_medio['texto'].'</label><br>
                                <select class="form-control form-select1 snormal select campoFormulario" id="'.$register_medio['campo'].'" name="'.$register_medio['campo'].'" '.$register_medio['obligatorio'].' '.$register_medio['soloLectura'].' '.$register_medio['habilitado'].' >
                                    <option value="NA" selected>Seleccione medio</option>';
                                    
                                        $sentenciaFinal = $sentencia2."'medios llegada'";
                                        $valores = [
                                            '*' => '*'
                                        ];
                                        $sql = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
                                        $res_medio = $mysqli2->query($sql);
                                        while ($row_medio = mysqli_fetch_array($res_medio)) {
                                            $html .= '<option value="'.$row_medio['id'].'">'.$row_medio['medio'].'</option>';
                                        }
                                    
                        $html .= '</select>
                                <input type="hidden" style="width: 20px" id="ctr_register_medio" value="1"/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="row ml-5">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="register_genero" id="lblgen" class="form-label1">Género</label><br>
                                <select class="form-control form-select1 snormal select campoFormulario" id="register_genero" name="register_genero" required>
                                    <option value="NA" selected>Seleccione género</option>
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="FEMENINO">FEMENINO</option>
                                </select>
                                <input type="hidden" style="width: 20px" id="ctr_register_genero" value="1"/>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$activiadad_extra['campo'].'" class="form-label1">'.$activiadad_extra['texto'].'</label>
                                <input type="'.$activiadad_extra['tipo'].'" class="form-control campoFormulario" id="'.$activiadad_extra['campo'].'" name="'.$activiadad_extra['campo'].'" placeholder="'.$activiadad_extra['placeHolder'].'" onkeyup="validarCampo(this, \'Actividad extra\', \'texto\', 1, \'btnEnviar\');" '.$activiadad_extra['obligatorio'].' '.$activiadad_extra['soloLectura'].' '.$activiadad_extra['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_activiadad_extra" value="1"/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 col-2 amarillo">
                                <h5>'.$textos[2]['identificacion'].'</h5>
                            </div>
                            <div class="col-md-1 col-1 azuloscuro">
                                <h5>'.$textos[2]['identificacion'].'</h5>
                            </div>
                            <div class="col-md-8 col-8 azuloscuro">
                                <h5>'.$textos[2]['texto'].'</h5>
                            </div>
                        </div>
                        <br>
                    </div><br>
                    
                    <div class="row ml-5">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_nombreA['campo'].'" class="form-label1">'.$register_nombreA['texto'].'</label>
                                <input type="'.$register_nombreA['tipo'].'" class="form-control campoFormulario" id="'.$register_nombreA['campo'].'" name="'.$register_nombreA['campo'].'" placeholder="'.$register_nombreA['placeHolder'].'" onkeyup="validarCampo(this, \'Nombre acudiente\', \'texto\', 1, \'btnEnviar\');" '.$register_nombreA['obligatorio'].' '.$register_nombreA['soloLectura'].' '.$register_nombreA['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_nombreA" value="1"/>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_documentoA['campo'].'" class="form-label1">'.$register_documentoA['texto'].'</label>
                                <input type="'.$register_documentoA['tipo'].'" class="form-control campoFormulario" id="'.$register_documentoA['campo'].'" name="'.$register_documentoA['campo'].'" placeholder="'.$register_documentoA['placeHolder'].'" onkeyup="validarCampo(this, \'Documento acudiente\', \'numero\', 1, \'btnEnviar\');" '.$register_documentoA['obligatorio'].' '.$register_documentoA['soloLectura'].' '.$register_documentoA['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_documentoA" value="1"/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="row ml-5">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_direccionA['campo'].'" class="form-label1">'.$register_direccionA['texto'].'</label>
                                <input type="'.$register_direccionA['tipo'].'" class="form-control campoFormulario" id="'.$register_direccionA['campo'].'" name="'.$register_direccionA['campo'].'" placeholder="'.$register_direccionA['placeHolder'].'" onkeyup="validarCampo(this, \'Direccion de residencia acudiente\', \'texto\', 1, \'btnEnviar\');" '.$register_direccionA['obligatorio'].' '.$register_direccionA['soloLectura'].' '.$register_direccionA['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_direccionA" value="1"/>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_celularA['campo'].'" class="form-label1">'.$register_celularA['texto'].'</label>
                                <input type="'.$register_celularA['tipo'].'" class="form-control campoFormulario" id="'.$register_celularA['campo'].'" name="'.$register_celularA['campo'].'" placeholder="'.$register_celularA['placeHolder'].'" onkeyup="validarCampo(this, \'Celular acudiente\', \'numero\', 1, \'btnEnviar\');" '.$register_celularA['obligatorio'].' '.$register_celularA['soloLectura'].' '.$register_celularA['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_celularA" value="1"/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="row ml-5">
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_correoA['campo'].'" class="form-label1">'.$register_correoA['texto'].'</label>
                                <input type="'.$register_correoA['tipo'].'" class="form-control campoFormulario" id="'.$register_correoA['campo'].'" name="'.$register_correoA['campo'].'" placeholder="'.$register_correoA['placeHolder'].'" onkeyup="validarCampo(this, \'Correo electrónico acudiente\', \'correo\', 1, \'btnEnviar\');" '.$register_correoA['obligatorio'].' '.$register_correoA['soloLectura'].' '.$register_correoA['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_correoA" value="1"/>
                            </div>
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_correoA1['campo'].'" class="form-label1">'.$register_correoA1['texto'].'</label>
                                <input type="'.$register_correoA1['tipo'].'" class="form-control campoFormulario" id="'.$register_correoA1['campo'].'" name="'.$register_correoA1['campo'].'" placeholder="'.$register_correoA1['placeHolder'].'" onkeyup="validarCampo(this, \'Confirmar correo electrónico acudiente\', \'correo\', 1, \'btnEnviar\');" '.$register_correoA1['obligatorio'].' '.$register_correoA1['soloLectura'].' '.$register_correoA1['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_correoA1" value="1"/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="row ml-5">                                                        	
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="parentesco_acudiente_1" id="lblparentesco" class="form-label1">Parentesco</label>
                                <select id="parentesco_acudiente_1" name="parentesco_acudiente_1" class="form-control form-select1 snormal select campoFormulario" required>
                                    <option value="NA">Seleccione Parentesco</option>
                                    <option value="MADRE">MADRE</option>
                                    <option value="PADRE">PADRE</option>
                                    <option value="ABUELA">ABUELA</option>
                                    <option value="ABUELO">ABUELO</option>
                                    <option value="HERMANA">HERMANA</option>
                                    <option value="HERMANO">HERMANO</option>
                                    <option value="TIA">TIA</option>
                                    <option value="TIO">TIO</option>
                                    <option value="PRIMA">PRIMA</option>
                                    <option value="PRIMO">PRIMO</option>
                                    <option value="OTRO">OTRO</option>
                                </select>
                                <input type="hidden" style="width: 20px" id="ctr_parentesco_acudiente_1" value="1"/> 
                            </div>
                        </div>
                        <div class="col-1">
                        </div>			
                        <div class="col-md-5 col-12">
                            <div class="form-group">
                                <label for="'.$register_ciudada['campo'].'" class="form-label1">'.$register_ciudada['texto'].'</label>
                                <input type="'.$register_ciudada['tipo'].'" class="form-control campoFormulario" id="'.$register_ciudada['campo'].'" name="'.$register_ciudada['campo'].'" placeholder="'.$register_ciudada['placeHolder'].'" onkeyup="validarCampo(this, \'Ciudad acudiente\', \'texto\', 1, \'btnEnviar\');" '.$register_ciudada['obligatorio'].' '.$register_ciudada['soloLectura'].' '.$register_ciudada['habilitado'].' >
                                <input type="hidden" style="width: 20px" id="ctr_register_ciudada" value="1"/>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="row ml-5">                                                        	
                        <div class="col-md-4 col-4"></div>
                        <div class="col-md-4 col-4">
                            <div class="form-group">
                                <center>
                                    <button type="submit" id="btnEnviar" class="btnEnviar">
                                        <img '.ImageAttributeBuilder::buildAttributes($nivel, $imagen_submit['ruta'], $imagen_submit['descripcion']).' id="sig1" class="img-fluid"/>
                                    </button>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-4 col-4"></div>
                    </div>
                    <input type="hidden" value="<?php echo $documento; ?>" id="register_documento" name="register_documento"/>
                    
                </form><br>		
            </div>';

    //alert
    $html .= '<div id="alert" style="margin-left: 2rem;">
                <p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
                <input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0"></p>
            </div>';

    //whatsapp
    $html .= '<div id="whatsapp">
                <a href="https://wa.me/573008156531/?text=Hola. Necesito asesoría del proceso de admisiones." target="_blank">
                    <svg width="80" height="80" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                    <g class="layer">
                    <title>¿Necesitas asesoría?</title>
                    <circle cx="40" cy="40" fill="#fff" id="svg_1" r="38" stroke="#000000" stroke-width="0"/>
                    <path d="m57.81072,21.975c-4.48928,-4.5 -10.46786,-6.975 -16.82142,-6.975c-13.11429,0 -23.78571,10.67143 -23.78571,23.78571c0,4.18928 1.09286,8.28215 3.17143,11.89286l-3.375,12.32142l12.61072,-3.31072c3.47143,1.89642 7.38215,2.89286 11.36786,2.89286l0.01072,0c13.10358,0 24.01072,-10.67143 24.01072,-23.78571c0,-6.35357 -2.7,-12.32142 -7.18928,-16.82142l-0.00001,-0.00001l-0.00001,0l-0.00002,0.00001zm-16.82142,36.6c-3.55714,0 -7.03928,-0.95357 -10.07143,-2.75357l-0.71785,-0.42857l-7.47858,1.96072l1.99286,-7.29642l-0.47143,-0.75c-1.98215,-3.15 -3.02142,-6.78215 -3.02142,-10.52142c0,-10.89642 8.87143,-19.76786 19.77858,-19.76786c5.28215,0 10.24286,2.05714 13.97143,5.79642c3.72857,3.73928 6.02142,8.7 6.01072,13.98215c0,10.90714 -9.09642,19.77858 -19.99286,19.77858l0,-0.00002l-0.00001,0l-0.00001,-0.00001zm10.84286,-14.80714c-0.58928,-0.3 -3.51429,-1.73572 -4.06072,-1.92857c-0.54643,-0.20358 -0.94286,-0.3 -1.33928,0.3c-0.39642,0.6 -1.53214,1.92857 -1.88571,2.33572c-0.34286,0.39642 -0.69642,0.45 -1.28571,0.15c-3.49286,-1.74643 -5.78571,-3.11785 -8.08928,-7.07143c-0.61072,-1.05 0.61072,-0.975 1.74643,-3.24643c0.19286,-0.39642 0.09642,-0.73928 -0.05357,-1.03928c-0.15,-0.3 -1.33928,-3.225 -1.83214,-4.41429c-0.48215,-1.15714 -0.975,-0.99642 -1.33928,-1.01785c-0.34286,-0.02142 -0.73928,-0.02142 -1.13572,-0.02142c-0.39642,0 -1.03928,0.15 -1.58571,0.73928c-0.54643,0.6 -2.07858,2.03572 -2.07858,4.96072c0,2.925 2.13214,5.75357 2.42142,6.15c0.3,0.39642 4.18928,6.39642 10.15714,8.97858c3.77143,1.62857 5.25,1.76786 7.13572,1.48928c1.14643,-0.17143 3.51429,-1.43572 4.00714,-2.82857c0.49286,-1.39286 0.49286,-2.58215 0.34286,-2.82857c-0.13928,-0.26786 -0.53572,-0.41785 -1.125,-0.70714l-0.00001,-0.00001l0.00002,-0.00001l-0.00002,-0.00001z" fill="currentColor" id="svg_2"/>
                    </g>
                    </svg>
                </a>
            </div>';

    echo $html;

