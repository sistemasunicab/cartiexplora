<?php
    //http://localhost:90/cartiexplora/business/org/pages/resultado_pre_admisiones_f_nuevos.php?s=CorreoOK&documento=99397454
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

    $mensaje = $_REQUEST['s'];
    $resultados = explode("_", $mensaje);

    $res_sentecia = $sentencia."112";
	$valores = [
		'*' => '*'
	];
	$sql_imagenes = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

    $res1 = $mysqli1->query($sql_imagenes);
    while ($row = $res1->fetch_assoc()) {
        $imagenes[] = $row;
    }

    //Obtener textos
    $res_sentecia = $sentencia."113";
	$sql_textos = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

    $res2 = $mysqli1->query($sql_textos);
    while ($row = $res2->fetch_assoc()) {
        $textos[] = $row;
    }

    $res_sentecia = $sentencia."111";
	$sql_seccion = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

    $res_seccion = $mysqli1->query($sql_seccion);
    $html = '';
    $texto1 = array_shift($textos);
    $texto2 = array_shift($textos);
    $texto3 = array_shift($textos);
    $texto4 = array_shift($textos);
    $texto5 = array_shift($textos);
    $texto6 = array_shift($textos);
    $texto7 = array_shift($textos);
    while ($row_sentencia = $res_seccion->fetch_assoc()) {
        $imagenAdvertencia = array_shift($imagenes);
        $imagenPanchita = array_shift($imagenes);
        $html .= '<br><br><!--== Page Title Area Start ==-->
            <section id="page-title-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 m-auto text-center">
                            <div class="page-title-content">';
                                
                                    //if($resultados[0] == "CorreoOK" && $resultados[1] == "EstudianteOK") {
                                    if($resultados[0] == "CorreoOK" || $resultados[0] == "correoOK") {
                                        $html .= '<h4>'.$texto1['texto'].$_REQUEST['documento'].'!</h4><hr class="hrResultadoPreAdmisiones">
                                                <h5>'.$texto2['texto'].'</h5>
                                                <h5>'.$texto3['texto'].'</h5><hr class="hrResultadoPreAdmisiones">
                                                <h5>'.$texto4['texto'].'</h5><hr class="hrResultadoPreAdmisiones">
                                                <h5>'.$texto5['texto'].'</h5>
                                                <img '.ImageAttributeBuilder::buildAttributes($nivel, $imagenAdvertencia['ruta'], $imagenAdvertencia['descripcion']).' width="700px"/>
                                                <h5>'.$texto6['texto'].'</h5>
                                                <h5>'.$texto7['texto'].'</h5><hr class="hrResultadoPreAdmisiones">
                                                <a href="../../../index.php" class="btn btn-success smooth-scroll">Página Principal</a>';
                                    }
                                    else if($resultados[0] == "CorreoError") {
                                        $html .= '<h2 class="h2">¡SE PRESENTARON ERRORES EN EL PROCESO DE REGISTRO!</h2><hr class="hrResultadoPreAdmisiones">
                                                <h4>Resumen:</h4><h5>Error enviando correo al área de admisiones.</h5>
                                                <hr class="hrResultadoPreAdmisiones">
                                                <p>Comunicate con Secretaría Académica e informa los datos ingresados para revisar.</p>';
                                        
                                    }
                                    else if($mensjae == "_") {
                                        $html .= '<h2 class="h2">¡SE PRESENTARON ERRORES EN EL PROCESO!</h2><hr>
                                                <hr class="hrResultadoPreAdmisiones">
                                                <p>Comunicate con Secretaría Académica e informa los datos ingresados para revisar.</p>';								
                                    }
                                    
                                
                    $html .= '</div><br><br>
                        </div>
                    </div>
                </div>
            </section><br><br>
            <!--== Page Title Area End ==-->

            <!--== Register Page Content Start ==-->
            <!--<section id="page-content-wrap">
                <div class="register-page-wrapper section-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">                        
                                <div class="jumbotronzz" align="center">
                                <img '.ImageAttributeBuilder::buildAttributes($nivel, $imagenPanchita['ruta'], $imagenPanchita['descripcion']).' alt="" class="img-fluid imgAyuda"/>
                                <h4 class="display-4">¿Necesitas ayuda?</h4>
                                <p class="lead">Sí necesitas ayuda o acompañamiento en el proceso, contáctate con nuestro equipo de trabajo</p>
                                <hr class="my-4">
                                <h4 class="llamanos">Llámanos o escríbenos</h4>
                                <h4 class="llamanos">300 815 6531 - 315 696 5291</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->';
    }

    echo $html;