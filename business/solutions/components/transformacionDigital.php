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
    $html .= '<style>';
    $html .= '.divTablaCuentaAtras {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .caja {
                background: #16224F;
                border-radius: 12px;
                padding: 10px 15px;
                text-align: center;
                color: #ffffff;
                box-shadow: 0 6px 15px rgba(22, 34, 79, 0.25);
            }
            .caja .numero {
                font-size: 3rem;
                font-weight: bold;
                line-height: 1;
            }
            .caja .etiqueta {
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-top: 8px;
                opacity: 0.9;
            }
                
            @media (max-width: 500px) {
                .caja { min-width: 75px; padding: 15px; }
                .caja .numero { font-size: 2rem; }
            }';
    $html .= '</style>';

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
        // $html .= '<main class="container">';
        // $html .=    '<div class="row my-5 align-items-center">';
        // $html .=        '<div class="col-lg-2 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">';
        // $html .=            '<img class="solutions-icon" '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[1]['ruta'], 'icono') .'>';
        // $html .=        '</div>';
        // $html .=        '<div class="col-lg-10 col-md-12 col-sm-12 col-12">';
        // $html .=            '<h1 class="tx-blue titulo-servicio font-roboto-light-title">'. $imagenes[1]['titulo'] .'</h1>';
        // $html .=        '</div>';
        // $html .=    '</div>';
        // $html .=    '<div class="row my-5">';
        // $html .=        '<div class="col-lg-2 col-md-1 col-sm-1 col-1"></div>';
        // $html .=        '<div class="col-lg-10 col-md-11 col-sm-11 col-11">';
        // $html .=            $row_datos_seccion['texto'];
        // $html .=        '</div>';
        // $html .=    '</div>';

        $html .=    '<div class="row my-5 align-items-center cursoPensamientoLogico" id="cursoDesarrolloPensamientoLogico">';
        $html .=        '<div class="col-lg-2 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">';
        $html .=            '<img class="solutions-icon" '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[2]['ruta'], 'icono') .'>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-10 col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">';
        $html .=            '<h1 class="tx-blue titulo-servicio font-roboto-light-title">'. $imagenes[2]['titulo'] .'</h1>';
        $html .=        '</div>';
        $html .=    '</div>';

        // Obtener datos del evento
        $res_sentecia = $mysqli1->query($sentencia . "18");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_evento = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        
        $res_evento = $mysqli1->query($sql_evento);

        while($row_evento = $res_evento->fetch_assoc()){
            $evento[] = $row_evento;
        }
        $fecha = $evento[0]['fecha_descuento'];
        $dt = DateTime::createFromFormat('Ymd', $fecha);

        //Si tienes la extensión intl habilitada
        $formatter = new IntlDateFormatter(
            'es_ES',
            IntlDateFormatter::LONG,  // formato largo
            IntlDateFormatter::NONE   // sin hora
        );
        $formatter->setPattern("dd 'de' MMMM"); // día + nombre del mes
        $fechaTexto = ucfirst($formatter->format($dt));

        $dt->modify('-1 day');
        $dt->setTime(23, 59, 59);
        $fechaObjetivo = $dt->format('Y-m-d H:i:s'); 
        $timestampObjetivo = strtotime($fechaObjetivo) * 1000; // JS usa milisegundos

        //number_format(float $num, int $decimales, string $sep_decimal, string $sep_miles)

        /* ############################################################################## */
        /* Esto se agregó manualmente para el curso del desarrollo del pensamiento lógico */
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p class="text-center font-roboto" style="font-size: 1.3rem;">' ; 
        $html .=                '<strong>¿Por qué desarrollar el pensamiento lógico?</strong><br> Desarrollar el pensamiento lógico es una de las habilidades más importantes que podemos cultivar en nuestra vida personal y profesional, especialmente en la actual sociedad del conocimiento.' ; 
        $html .=            '</p>'; 
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p class="text-center font-roboto" style="font-size: 1.3rem;">'; 
        $html .=                '<strong>¿Pero qué es exactamente el pensamiento lógico?</strong><br> Es la capacidad de razonar de manera coherente y estructurada para analizar situaciones, identificar patrones, resolver problemas de forma efectiva y tomar decisiones bien fundamentadas.' ; 
        $html .=            '</p>' ; 
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section><br>';

        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p class="text-center font-roboto" style="font-size: 1.3rem;">'; 
        $html .=                '<img style="width: 4rem;" '.ImageAttributeBuilder::buildAttributes($nivel, $imagenes[1]['ruta'], 'icono') .'>';
        $html .=            '</p>' ; 
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=            '<p class="text-center font-roboto" style="font-size: 1.3rem;">'; 
        $html .=                '<strong>¿En qué profesiones se aplica el pensamiento lógico?</strong><br><br> El pensamiento lógico es importante en todas las profesiones y actividades de la vida. Sin embargo, citamos algunas profesiones en dónde es clave desarrollar el pensamiento lógico:' ; 
        $html .=            '</p>' ; 
        $html .=        '</div>';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-1"></div>';
        $html .=        '<div class="col-lg-10 col-md-10 col-sm-10 col-10">';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; text-align: justify;">'; 
        $html .=                '<strong>• Programación y desarrollo de software:</strong> Los programadores lo aplican para estructurar código limpio y eficiente, lo que facilita la detección y corrección de errores.' ; 
        $html .=            '</p><br>' ; 
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; text-align: justify;">'; 
        $html .=                '<strong>• Ingeniería:</strong> Ingenieros civiles, geológicos, mecánicos, industriales, electrónicos o eléctricos aplican principios lógicos para diseñar y construir estructuras, máquinas y sistemas seguros y funcionales.' ; 
        $html .=            '</p><br>' ; 
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; text-align: justify;">'; 
        $html .=                '<strong>• Medicina:</strong> Es crucial para analizar síntomas, realizar diagnósticos precisos y definir el tratamiento adecuado para cada paciente, evitando consecuencias graves derivadas de un error.' ; 
        $html .=            '</p><br>' ; 
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; text-align: justify;">'; 
        $html .=                '<strong>• Diseño gráfico y marketing:</strong> Los profesionales analizan las necesidades de los clientes para desarrollar soluciones visuales efectivas, además de interpretar datos y tendencias del mercado para orientar campañas y estrategias.' ; 
        $html .=            '</p><br>' ; 
        $html .=        '</div>';
        $html .=        '<div class="col-1"></div>';
        $html .=    '</div>';
        $html .= '</section><br>';

        //$html .= '<hr style="color: orange">';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-1 d-none d-md-block"></div>';
        $html .=        '<div class="col-lg-5 col-md-5 col-xs-10 col-10 movil500" style="border-top: 2px solid orange; border-bottom: 2px solid orange;">';
        $html .=            '<p class="font-roboto tx-orange" style="font-size: 1.7rem;">'; 
        $html .=                '<strong>¡Iniciamos!</strong>' ; 
        $html .=            '</p><br>' ; 
        $html .=            '<img src="https://unicab.solutions/nus/assets/img/calendar_1582043.png" style="width: 4rem;"><br><br>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem;">Presencial:</p>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; font-weight: bold;">Martes 1 de octubre de 2026</p>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; font-weight: bold;">Hora 2:00 p.m.</p><br>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem;">Virtual:</p>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; font-weight: bold;">Miércoles 2 de octubre de 2026</p>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; font-weight: bold;">Hora 2:00 p.m.</p><br>';
        $html .=        '</div>';
        $html .=        '<div class="col-lg-5 col-md-5 col-xs-10 col-10 movil500" style="border-top: 2px solid orange; border-bottom: 2px solid orange;">';
        $html .=            '<p class="font-roboto tx-orange" style="font-size: 1.7rem;">'; 
        $html .=                '<strong>Intensidad:</strong>' ; 
        $html .=            '</p><br>' ; 
        $html .=            '<img src="https://unicab.solutions/nus/assets/img/HORARIO.png" style="width: 4rem;"><br><br>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem; font-weight: bold;">40 horas en total</p><br>';
        $html .=            '<p class="font-roboto" style="font-size: 1.3rem;">El estudiante tendrá derecho a recibir un certificado de asistencia, aprobando el 80% de la totalidad del curso.</p>';
        $html .=        '</div>';
        $html .=        '<div class="col-1 d-none d-md-block"></div>';
        $html .=    '</div>';
        $html .= '</section><br>';

        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=        '<div class="col-lg-6 col-md-6 col-xs-10 col-10" >';
        $html .=            '<p class="font-roboto tx-orange text-center" style="font-size: 1.7rem;">'; 
        $html .=                '<strong>A quién está dirigido:</strong>' ; 
        $html .=            '</p><br>' ;
        $html .=            '<p class="font-roboto text-center" style="font-size: 1.3rem;">'; 
        $html .=                'El curso está dirigido a estudiantes que tengan mínimo 12 años de edad y conocimientos básicos de matemáticas.' ; 
        $html .=            '</p><br>' ;
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=        '<div class="col-lg-6 col-md-6 col-xs-10 col-10" >';
        $html .=            '<p class="font-roboto tx-orange text-center" style="font-size: 1.7rem;">'; 
        $html .=                '<strong>Inversión y forma de pago:</strong>' ; 
        $html .=            '</p><br>' ;
        $html .=            '<p class="font-roboto text-center" style="font-size: 1.3rem;">'; 
        $html .=                'El curso tiene un valor virtual o presencial de cuatrocientos mil pesos <strong>$'.number_format($evento[0]['costo'],0,',','.').' COP.</strong> <br>Forma de pago: El pago del 100% del valor se realiza en línea (más abajo) como requisito previo al formulario de inscripción al curso.' ; 
        $html .=            '</p><br>' ;
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=    '</div>';
        $html .= '</section>';        

        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=        '<div class="col-lg-6 col-md-6 col-xs-10 col-10" >';
        $html .=            '<p class="font-roboto text-center" style="font-size: 1.7rem;">'; 
        $html .=                '<strong>Hoy es un buen día para comenzar el cambio:</strong>' ; 
        $html .=            '</p><br>' ;
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=        '<div class="col-lg-6 col-md-6 col-xs-10 col-10" >';
        $html .=            '<p class="font-roboto tx-orange text-center" style="font-size: 1.7rem;">'; 
        $html .=                '<strong>¡OFERTA EXCLUSIVA POR TIEMPO LIMITADO!</strong>' ; 
        $html .=            '</p>' ;
        $html .=            '<p class="font-roboto text-center" style="font-size: 1.3rem;">'; 
        $html .=                'Antes: <span style="text-decoration: line-through;">($'.number_format($evento[0]['costo'],0,',','.').' COP)</span>' ; 
        $html .=            '</p>' ;
        $html .=            '<p class="font-roboto text-center" style="font-size: 1.3rem;">'; 
        $html .=                '<strong>¡Si te inscribes antes del '.$fechaTexto.' SOLO ($'.number_format($evento[0]['valor_con_descuento'],0,',','.').' COP)!</span>' ; 
        $html .=            '</p><br>' ;
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=        '<div class="col-lg-6 col-md-6 col-xs-10 col-10" >';
        $html .=            '<p class="font-roboto text-center" style="font-size: 1.7rem;">'; 
        $html .=                '<strong>Esta oportunidad desaparecerá en: </strong>' ;
        $html .=            '</p>' ;
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=    '</div>';
        $html .= '</section>';
        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=        '<div class="col-lg-6 col-md-6 col-xs-10 col-10 divTablaCuentaAtras">';
        $html .=                '<table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="caja">
                                                    <div class="numero" id="dias">00</div>
                                                    <div class="etiqueta">Días</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="caja">
                                                    <div class="numero" id="horas">00</div>
                                                    <div class="etiqueta">Horas</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="caja">
                                                    <div class="numero" id="minutos">00</div>
                                                    <div class="etiqueta">Minutos</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="caja">
                                                    <div class="numero" id="segundos">00</div>
                                                    <div class="etiqueta">Segundos</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>'; 
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=    '</div>';
        $html .= '</section><br>';

        $html .= '<section class="container my-4">' ;
        $html .=    '<div class="row">';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=        '<div class="col-lg-6 col-md-6 col-xs-10 col-10" >';
        $html .=            '<p class="font-roboto text-center" style="font-size: 1.3rem;">'; 
        $html .=            '<img src="../../../assets/img/contacto_curso_dpl1.png" class="img-fluid" style="width: 70%;"><br><br>';
        $html .=            '</p><br>' ;
        $html .=        '</div>';
        $html .=        '<div class="col-lg-3 col-md-3 col-xs-1 col-1"></div>';
        $html .=    '</div>';
        $html .= '</section>';

        /* ############################################################################## */

        $html .=    '<div class="container datosEstudiante">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-2 amarillo">
                                    <h6>Paso 1</h6>
                                </div>
                                <div class="col-md-10 col-10 azuloscuro">
                                    <h6>Paso 1</h6>
                                    <h6>DESCARGAR PORTAFOLIO COMPLETO</h6>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div><br>
                    
                    <div class="container">
                        <div class="row ml-5">                                                        	
                            <div class="col-12">
                                <div class="form-group">
                                    <a href="https://unicab.solutions/descargas/curso_pensamiento_logico_Unicab_2026.pdf" target="_blank" class="download-button mx-3">
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
                        <a href="../pages/pagar_curso.php?referencia=curso-dpl-nivel1&idEvento=1" target="_blank" class="btn-circulares-costos">
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
        $html .= '<input type="hidden" id="fechaObjetivo" value="'.$timestampObjetivo.'">';

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

        $html .= '<script>
                        const fechaObjetivo = '.$timestampObjetivo.';

                        const elDias     = document.getElementById("dias");
                        const elHoras    = document.getElementById("horas");
                        const elMinutos  = document.getElementById("minutos");
                        const elSegundos = document.getElementById("segundos");
                        const countdown  = document.getElementById("countdown");
                        const finalizado = document.getElementById("finalizado");

                        function actualizar() {
                            const ahora = new Date().getTime();
                            const diferencia = fechaObjetivo - ahora;

                            if (diferencia <= 0) {
                                countdown.style.display = "none";
                                finalizado.style.display = "block";
                                clearInterval(intervalo);
                                return;
                            }

                            const dias    = Math.floor(diferencia / (1000 * 60 * 60 * 24));
                            const horas   = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
                            const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

                            elDias.textContent     = String(dias).padStart(2, "0");
                            elHoras.textContent    = String(horas).padStart(2, "0");
                            elMinutos.textContent  = String(minutos).padStart(2, "0");
                            elSegundos.textContent = String(segundos).padStart(2, "0");
                        }

                        actualizar();
                        const intervalo = setInterval(actualizar, 1000);
                    </script>
                ';
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