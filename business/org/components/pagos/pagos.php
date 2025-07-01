<?php
     function posicionTitulo($imgHTML, $titulo, $posicionTitulo)
    {
        $title = '';
        if (strtolower($posicionTitulo) == 'abajo') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">';
            $title .=        '<h2 class="h2-pagos">' . $titulo . '</h2>';
            $title .=    '</div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'derecha') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>';
            $title .=     '<div class="col-lg-2 col-md-2 col-sm-2 col-2">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-8 col-md-8 col-sm-8 col-8">';
            $title .=         '<h2 class="h2-pagos">' . $titulo . '</h2>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'izquierda') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=     '<div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>';
            $title .=     '<div class="col-lg-8 col-md-8 col-sm-8 col-8">';
            $title .=         '<h2 class="h2-pagos">' . $titulo . '</h2>';
            $title .=     '</div>';
            $title .=     '<div class="col-lg-2 col-md-2 col-sm-2 col-2">';
            $title .=         $imgHTML;
            $title .=     '</div>';
            $title .=     '<div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>';
            $title .= '</div>';
        } else if (strtolower($posicionTitulo) == 'arriba') {
            $title .= '<div class="row align-items-center justify-content-center my-2">';
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">';
            $title .=        '<h2 class="h2-pagos">' . $titulo . '</h2>';
            $title .=    '</div>';
            $title .=    '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">';
            $title .=        $imgHTML;
            $title .=    '</div>';
            $title .= '</div>';
        }
        return $title;
    }

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }
    
    $res_sentecia = $mysqli1->query($sentencia . "122");
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    
    $res_seccion = $mysqli1->query($sql_seccion);
    $html = '';
    while ($row_seccion = $res_seccion->fetch_assoc()) {
    
        $imagenes = [];
        $res_imagenes = $mysqli1->query($sentencia . "123");
        while ($row_sentencia = $res_imagenes->fetch_assoc()) {
            $sql_imagenes = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_imagenes = $mysqli1->query($sql_imagenes);
        while ($row_imagenes = $res_imagenes->fetch_assoc()) {
            $imagenes[] = $row_imagenes;
        }
    
        $formItems = [];
        $res_formitems = $mysqli1->query($sentencia . "124");
        while ($row_sentencia = $res_formitems->fetch_assoc()) {
            $sql_formitems = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_formitems = $mysqli1->query($sql_formitems);
        while ($row_formitems = $res_formitems->fetch_assoc()) {
            $formItems[] = $row_formitems;
        }
    
        $textos = [];
        $res = $mysqli1->query($sentencia . "125");
        while ($row_sentencia = $res->fetch_assoc()) {
            $sql_textos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
        }
        $res_textos = $mysqli1->query($sql_textos);
        while ($row_textos = $res_textos->fetch_assoc()) {
            $textos[] = $row_textos;
        }
    
        $conceptosPago = [];
        $res = $mysqli1->query($sentencia . "126");
        while ($row_sentencia = $res->fetch_assoc()) {
            $sql = $row_sentencia['campos'] . $row_sentencia['tablas'];
        }
        $res_conceptos = $mysqli1->query($sql);
        while ($row_conceptos = $res_conceptos->fetch_assoc()) {
            $conceptosPago[] = $row_conceptos;
        }
    
        $formasPago = [];
        $res = $mysqli1->query($sentencia . "127");
        while ($row_sentencia = $res->fetch_assoc()) {
            $sql = $row_sentencia['campos'] . $row_sentencia['tablas'];
        }
        $res_formasPago = $mysqli1->query($sql);
        while ($row_formasPago = $res_formasPago->fetch_assoc()) {
            $formasPago[] = $row_formasPago;
        }
    
        $tituloSeccionUno = array_shift($imagenes);
        $imagenCajaSocial = array_shift($imagenes);
        $imagenPagoAmigo = array_shift($imagenes);
        $btnPagoAmigo = array_shift($formItems);
        $instructivoPago = array_shift($imagenes);
        $tituloSeccionDos = array_shift($imagenes);
        $epayco = array_shift($imagenes);
        $flechaAmarilla = array_shift($imagenes);
        $conceptos = array_shift($textos);
        $descripciones = array_shift($textos);
    
        $nombreResponsable = array_shift($formItems);
        $identificacionResponsable = array_shift($formItems);
        $cardsImg = array_shift($imagenes);
        $radioReferencia = array_shift($formItems);
        $radioManual = array_shift($formItems);
        $txtRef = array_shift($formItems);
        $txtValorRef = array_shift($formItems);
        $consultarBtn = array_shift($formItems);
        $infoFinanciera = array_shift($textos);
        $titulosSeccionesPago = array_shift($textos);

        $tituloReferenciaPago = array_shift($textos);
        $identificacionRef = array_shift($textos);
        $anio = array_shift($textos);
        $conceptosRef = array_shift($textos);

        $txtNumDoc = array_shift($formItems);
        $txtAnio = array_shift($formItems);
        $txtValor = array_shift($formItems);
        $txtvalorRefMan = array_shift($formItems);
        $btnPagar = array_shift($formItems);
        $selectMedioPago = array_shift($formItems);
        $selectConceptoPago = array_shift($formItems);

        $txtCodigoFactura = array_shift($formItems);
        $txtConcepto = array_shift($formItems);
        $txtControlPago = array_shift($formItems);
        $txtIdGrado = array_shift($formItems);

        $html .= '<section class="section-title-pagos">'.
                     '<div class="container">'.
                        posicionTitulo('<img class="img-fluid h2-icon-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $tituloSeccionUno['ruta'], $tituloSeccionUno['descripcion']) . '>', $tituloSeccionUno['titulo'], $tituloSeccionUno['posicionTitulo']) .
                     '</div>'.
                 '</section>';

        $html .= '<section class="container section-pagos">'.
                    '<div class="row justify-content-center align-items-center">'.
                        '<div class="col-lg-4 col-md-6 col-sm-6 col-6 columna-1-pagos">' .
                            '<div class="d-flex justify-content-center">'.
                                '<img class="img-fluid w-100 caja-social-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $imagenCajaSocial['ruta'], $imagenCajaSocial['descripcion']) . '>'.
                            '</div>'.
                        '</div>'.
                        '<div class="col-lg-4 col-md-6 col-sm-6 col-6 columna-2-pagos">'.
                            '<div class="d-flex justify-content-center">'.
                                '<a href="'. $imagenPagoAmigo['enlace'] .'" target="_blank">
                                    <img class="mipagoamigo-pagos img-fluid w-100" ' . ImageAttributeBuilder::buildAttributes($nivel, $imagenPagoAmigo['ruta'], $imagenPagoAmigo['descripcion']) . '>
                                </a>'.
                            '</div>'.
                            '<div class="d-flex justify-content-center">'.
                                //'<button class="mipagoamigo-btn-pagos" id="' . $btnPagoAmigo['campo'] . '" type="' . $btnPagoAmigo['tipo'] . '">' . $btnPagoAmigo['texto'] . '</button>'.
                                //'<center><label class="mipagoamigo-btn-pagos">' . $btnPagoAmigo['texto'] . '</label></center>'.
                            '</div>'.
                        '</div>'.
                        '<div class="col-lg-4 col-md-12 col-sm-12 col-12 columna-3-pagos">'.
                            '<div>'.
                                '<p class="title-instructivo-pagos">' . $instructivoPago['titulo'] . '</p>'.
                                '<a class="enlace-instructivo-pagos" href="'. $instructivoPago['enlace'] .'" target="_blank"><img class="img-fluid w-100" ' . ImageAttributeBuilder::buildAttributes($nivel, $instructivoPago['ruta'], $instructivoPago['descripcion']) . '></a>'.
                            '</div>'.
                        '</div>'.
                    '</div>'.
                 '</section>';
    
        $html .= '<section class="section-title-pagos">'.
                     '<div class="container">'.
                        posicionTitulo('<img class="img-fluid h2-icon-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $tituloSeccionDos['ruta'], $tituloSeccionDos['descripcion']) . '>', $tituloSeccionDos['titulo'], $tituloSeccionDos['posicionTitulo']) .
                     '</div>'.
                 '</section>';
    
        $html .= '<section class="container section-pagos">'.
                     '<div class="row">'.
                         '<div class="col-lg-6 col-md-6 col-sm-12 col-12 padding-x-movil-pagos">'.
                             '<div class="d-flex justify-content-center align-items-center">'.
                                '<img class="img-fluid w-100 epayco-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $epayco['ruta'], $epayco['descripcion']) . '>'.
                             '</div>'.
                             '<div class="d-flex justify-content-center align-items-center">'.
                                '<p class="epayco-title-pagos">' . $epayco['titulo'] . '</p>'.
                             '</div>'.
                             '<table class="table-pagos">'.
                                 '<thead>'.
                                     '<tr>'.
                                         '<th class="epayco-subtitle-pagos">' . $conceptos['identificacion'] . '</th>'.
                                         '<th class="epayco-subtitle-pagos">' . $descripciones['identificacion'] . '</th>'.
                                     '</tr>'.
                                 '</thead>'.
                                 '<tbody>';
        $conceptos = explode("|", $conceptos['texto']);
        $descripciones = explode("|", $descripciones['texto']);
        for ($i = 0; $i < count($conceptos); $i++) {
            $html .=                '<tr>'.
                                        '<td class="p-epayco-pagos"><img class="img-fluid w-100 flecha-epayco-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $flechaAmarilla['ruta'], $flechaAmarilla['descripcion']) . '> ' . $conceptos[$i] . '</td>'.
                                        '<td class="p-epayco-pagos">' . $descripciones[$i] . '</td>'.
                                    '</tr>';
        }

        $html .=               '</tbody>'.
                            '</table>'.
                        '</div>'.

                        '<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-md-0 my-5 padding-x-movil-pagos">'.
                            '<h3 class="h3-pagos">' . $tituloReferenciaPago['texto'] . '</h3>'.
                            '<div class="row">'.
                                '<div class="col-lg-12 col-md-12 col-sm-12 col-12">'.
                                    '<table class="table-pagos">'.
                                        '<thead>'.
                                             '<tr>'.
                                                 '<th class="h3-pagos">' . $identificacionRef['identificacion'] . '</th>'.
                                                 '<th class="h3-pagos">' . $anio['identificacion'] . '</th>'.
                                                 '<th class="h3-pagos">' . $conceptosRef['identificacion'] . '</th>'.
                                            '</tr>'.
                                         '</thead>'.
                                         '<tbody class="class="col-lg-12 col-md-12 col-sm-12 col-12">';
        $html .=                            '<tr>'.
                                                '<td><div class="d-flex justify-content-center align-items-center"><img class="img-fluid refpago-flechas-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $flechaAmarilla['ruta'], $flechaAmarilla['descripcion']) . '></div></td>'.
                                                '<td><div class="d-flex justify-content-center align-items-center"><img class="img-fluid refpago-flechas-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $flechaAmarilla['ruta'], $flechaAmarilla['descripcion']) . '></div></td>'.
                                                '<td><div class="d-flex justify-content-center align-items-center"><img class="img-fluid refpago-flechas-pagos" ' . ImageAttributeBuilder::buildAttributes($nivel, $flechaAmarilla['ruta'], $flechaAmarilla['descripcion']) . '></div></td>'.
                                            '</tr>';

        $conceptos = explode("|", $conceptosRef['texto']);
        foreach ($conceptos as $i => $concepto) {
            $html .= '<tr>';
        
            if ($i === 0) {
                $html .= 
                    '<td class="subtitulo-refpago-pagos">' . $identificacionRef['texto'] . '</td>' .
                    '<td class="subtitulo-refpago-pagos">' . $anio['texto'] . '</td>' .
                    '<td class="subtitulo-refpago-pagos">' . $concepto . '</td>';
            } else {
                $html .= 
                    '<td class="td-40-pagos"></td>' .
                    '<td class="td-20-pagos"></td>' .
                    '<td class="td-40-pagos p-refpago-pagos">' . $concepto . '</td>';
            }
        
            $html .= '</tr>';
        }
        $html .=                      '</tbody>'.
                                   '</table>'.
                                '</div>'.
                            '</div>'.
                        '</div>'.
                    '</div>'.
                 '</section>'.
                 '<section class="container section-pagos">'.
                    '<div class="row radio-btn-section-pagos">'.
                       '<div class="col-lg-6 col-md-12 col-sm-12 col-12 my-lg-0 my-4 text-lg-center text-start">'.
                           '<input type="'. $radioReferencia['tipo'] .'" id="'.$radioReferencia['campo'].'" name="opvalor" value="0" class="mx-3 radio-btn">'.
                           '<label for="'.$radioReferencia['campo'].'" class="font-roboto-black">'.$radioReferencia['texto'].'</label>'.
                       '</div>'.
                       '<div class="col-lg-6 col-md-12 col-sm-12 col-12 my-lg-0 my-4 text-lg-center text-start">'.
                           '<input type="'. $radioManual['tipo'] .'" id="'. $radioManual['campo'] .'" name="opvalor" value="1" class="mx-3 radio-btn">'.
                           '<label for="'. $radioManual['campo'] .'" class="font-roboto-black">'. $radioManual['texto'] .'</label>'.
                       '</div>'.
                    '</div>'.
                     '<div class="row justify-content-center align-items-center section-pagos">'.
                         '<div class="col-lg-4 col-md-12 col-sm-12 col-12">'.
                             '<div class="bg-yellow">'.
                                  '<p class="datos-quienpaga-titulo-pagos">'.$nombreResponsable['texto'].'</p>'.
                             '</div>'.
                             '<input class="input-responsable-pagos form-control campoFormulario" type="' . $nombreResponsable['tipo'] . '" id="' . $nombreResponsable['campo'] . '" placeholder="' . $nombreResponsable['placeHolder'] . '" onkeyup="validarCampo(this, \'(Nombre de quien paga)\', \'texto\', 1, \'btnpagar\');" ' . $nombreResponsable['obligatorio'] . ' ' . $nombreResponsable['soloLectura'] . ' ' . $nombreResponsable['habilitado'] . '>'.
                             '<input class="input-responsable-pagos form-control campoFormulario" type="' . $identificacionResponsable['tipo'] . '" id="' . $identificacionResponsable['campo'] . '" placeholder="' . $identificacionResponsable['placeHolder'] . '" onkeyup="validarCampo(this, \'(Número de identificación)\', \'numero\', 1, \'btnpagar\');" ' . $identificacionResponsable['obligatorio'] . ' ' . $identificacionResponsable['soloLectura'] . ' ' . $identificacionResponsable['habilitado'] . '>'.
                         '</div>'.
                         '<div class="col-lg-4 col-md-6 col-sm-12 col-12">'.
                           '<div class="cards-icon-container-pagos">'.
                             '<img class="img-fluid w-100 cards-icon-pagos" '. ImageAttributeBuilder::buildAttributes($nivel, $cardsImg['ruta'], $cardsImg['descripcion']) .' >'.
                           '</div>'.
                         '</div>'.
                         '<div class="col-lg-4 col-md-12 col-sm-12 col-12">'.
                                '<div id="' . $selectMedioPago['campo'] . '" class="select-wrapper custom-select campoFormulario form-select-pagos" data-btn-submit="'.$btnPagar['campo'].'" data-value="NA" data-texto="'.$selectMedioPago['texto'].'" '.$selectMedioPago['obligatorio'].'>'.
                                    '<div class="display-options">'.
                                        '<span class="selected-value">' . $selectMedioPago['placeHolder'] . '</span>'.
                                    '</div>'.
                                    '<div class="custom-options">'.
                                            '<div class="custom-option" data-value="NA">' . $selectMedioPago['placeHolder'] . '</div>';
                                        
        for ($i = 0; $i < count($formasPago); $i++) {
            $html .=                         '<div class="custom-option" data-value="'.$formasPago[$i]['valor'].'">'.$formasPago[$i]['texto'].'</div>';
        }
        $html .=                    '</div>';
        $html .=                '</div>';
        $html .=         '</div>';
        $html .=      '</div>';
        $html .=      '<div class="row my-4">'.
                        '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
        if($infoFinanciera['identificacion'] === 'info financiera'){
            $html .=             $infoFinanciera['texto'];
        }
        $html .=        '</div>';
        $html .=      '</div>';
        $html .= '</section>';
        $titulosSeccionesPago = explode("|", $titulosSeccionesPago['texto']);

        $html .= '<section id="secreferencia" class="container section-mt-pagos" style="display: none;">'.
                         '<div  class="row section-mt-pagos">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">'.
                                 '<h3 class="titulo-secciones-pagos">'.$titulosSeccionesPago[0].'</h3>'.
                             '</div>'.
                         '</div>'.
                         '<div class="row form-block-pagos">'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center">'.
                                 '<input type="'. $txtRef['tipo'] .'" id="'. $txtRef['campo'] .'" placeholder="'. $txtRef['placeHolder'] .'" onkeyup="validarCampo(this, \'Referencia de pago\', \'texto1\', 1, \'btnpagar\');" class="form-control campoFormulario input-pagos" '. $txtRef['obligatorio'] .' '. $txtRef['soloLectura'] .' '. $txtRef['habilitado'] .'>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12">'.
                                 '<input type="'. $txtValorRef['tipo'] .'" id="'. $txtValorRef['campo'] .'" class="inactivo form-control input-pagos" placeholder="'. $txtValorRef['placeHolder'] .'" '. $txtValorRef['obligatorio'] .' '. $txtValorRef['soloLectura'] .' '. $txtValorRef['habilitado'] .'>'.
                             '</div>'.
                         '</div>'.
                         '<div class="row my-5">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">'.
                                 '<button class="pagos-btn w-50 text-uppercase" onclick="qval();" type="'.$consultarBtn['tipo'].'" id="'.$consultarBtn['campo'].'">'.$consultarBtn['texto'].'</button>'.
                             '</div>'.
                         '</div>'.
                 '</section>'.


                 '<section id="secvalman" class="container section-mt-pagos" style="display: none;">'.
                         '<div class="row section-mt-pagos">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-2">'.
                                 '<h3 class="titulo-secciones-pagos">'.$titulosSeccionesPago[1].'</h3>'.
                             '</div>'.
                         '</div>'.
                         '<div class="row">'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center my-3">'.
                                 '<label class="label-valor-manual-pagos" for="'. $txtNumDoc['campo'] .'">Documento estudiante</label>'.
                                 '<input type="'. $txtNumDoc['tipo'] .'" id="'. $txtNumDoc['campo'] .'" placeholder="'. $txtNumDoc['placeHolder'] .'" onkeyup="validarCampo(this, \'Documento estudiante\', \'numero\', 1, \'btnpagar\');" class="form-control campoFormulario input-pagos" '. $txtNumDoc['obligatorio'] .' '. $txtNumDoc['soloLectura'] .' '. $txtNumDoc['habilitado'] .'>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center my-3">'.
                                 '<label class="label-valor-manual-pagos" for="'. $txtAnio['campo'] .'">Año</label>'.
                                 '<input type="'. $txtAnio['tipo'] .'" id="'. $txtAnio['campo'] .'" placeholder="'. $txtAnio['placeHolder'] .'" onkeyup="validarCampo(this, \'Año\', \'numero\', 1, \'btnpagar\');" class="form-control campoFormulario input-pagos" '. $txtAnio['obligatorio'] .' '. $txtAnio['soloLectura'] .' '. $txtAnio['habilitado'] .'>'.
                             '</div>'.
                         '</div>'.
                         '<div class="row">'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center my-3">'.
                                 '<label class="label-valor-manual-pagos" for="'.$txtValor['campo'].'">Ingrese valor a pagar</label>'.
                                 '<input type="'.$txtValor['tipo'].'" id="'.$txtValor['campo'].'" placeholder="'.$txtValor['placeHolder'].'" onkeyup="validarCampo(this, \'Valor a pagar\', \'numero\', 1, \'btnpagar\');" class="form-control campoFormulario input-pagos" '.$txtValor['obligatorio'].' '.$txtValor['soloLectura'].' '.$txtValor['habilitado'].'>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center my-3">'.
                                '<div class="d-flex align-items-center h-100">' .
                                    '<div id="' . $selectConceptoPago['campo'] . '" class="select-wrapper custom-select campoFormulario form-select-pagos" data-btn-submit="'.$btnPagar['campo'].'" data-value="NA" data-texto="'.$selectConceptoPago['texto'].'" '.$selectConceptoPago['obligatorio'].'>'.
                                        '<div class="display-options">'.
                                            '<span class="selected-value">' . $selectConceptoPago['placeHolder'] . '</span>'.
                                        '</div>'.
                                        '<div class="custom-options">'.
                                                '<div class="custom-option" data-value="NA">' . $selectConceptoPago['placeHolder'] . '</div>';
                                        
        for ($i = 0; $i < count($conceptosPago); $i++) { 
            $html .=                    '<div class="custom-option" data-value="'.$conceptosPago[$i]['valor'].'">'.$conceptosPago[$i]['texto'].'</div>';
        }
        $html .=                        '</div>';
        $html .=                    '</div>';
        $html .=                '</div>' .
                            '</div>'.
                         '</div>'.
                         '<div class="row form-block-pagos">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12">'.
                                 '<input type="'. $txtvalorRefMan['tipo'] .'" id="'. $txtvalorRefMan['campo'] .'" class="inactivo form-control text-center input-pagos" placeholder="'. $txtvalorRefMan['placeHolder'] .'" '. $txtvalorRefMan['obligatorio'] .' '. $txtvalorRefMan['soloLectura'] .' '. $txtvalorRefMan['habilitado'] .'>'.
                             '</div>'.
                         '</div>'.
                 '</section>'.
                 '<section class="container section-pagos">'.
                    '<div class="row form-block-pagos">'.
                        '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">'.
                            '<button id="'.$btnPagar['campo'].'" type="'.$btnPagar['tipo'].'" class="pagos-btn w-50" onclick="callEpayco()">'.$btnPagar['texto'].'</button>'.
                        '</div>'.
                    '</div>'.
                 '</section>'.
                 '<input type="'. $txtCodigoFactura['tipo'] .'" id="'. $txtCodigoFactura['campo'] .'" >'.
                 '<input type="'. $txtConcepto['tipo'] .'" id="'. $txtConcepto['campo'] .'" >'.
                 '<input type="'. $txtControlPago['tipo'] .'" id="'. $txtControlPago['campo'] .'" value="0">'.
                 '<input type="'. $txtIdGrado['tipo'] .'" id="'. $txtIdGrado['campo'] .'" value="0">'.
                 '<div id="alert" style="margin-left: 2rem;">'.
                     '<p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>'.
                         '<input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0">'.
                     '</p>'.
                 '</div>';
    }
    
    echo $html;