<?php
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
        $refernciaPago = array_shift($imagenes);
        $nombreResponsable = array_shift($formItems);
        $identificacionResponsable = array_shift($formItems);
        $tratamientoDatos = array_shift($formItems);
        $cardsImg = array_shift($imagenes);
        $radioReferencia = array_shift($formItems);
        $radioManual = array_shift($formItems);
        $txtRef = array_shift($formItems);
        $txtValorRef = array_shift($formItems);
        $consultarBtn = array_shift($formItems);
        $infoFinanciera = array_shift($textos);
        $titulosSeccionesPago = array_shift($textos);
        $txtNumDoc = array_shift($formItems);
        $txtAnio = array_shift($formItems);
        $txtValor = array_shift($formItems);
        $txtvalorRefMan = array_shift($formItems);
        $btnPagar = array_shift($formItems);

        $html .= '<section class="bg-bold-blue py-3 my-2rem">'.
                     '<div class="container">'.
                         '<div class="flex-lg-row d-flex flex-column justify-content-center align-items-center gap-3">'.
                                '<h2 class="tx-orange font-roboto-black pagos-title text-center">' . $tituloSeccionUno['titulo'] . '</h2>'.
                                '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $tituloSeccionUno['ruta'], $tituloSeccionUno['descripcion']) . ' class="img-fluid pagos-icono" >'.
                         '</div>'.
                     '</div>'.
                 '</section>';

        $html .= '<section class="container my-2rem">'.
                    '<div class="row align-items-center justify-content-between">'.
                        '<div class="col-lg-3 col-md-5 col-sm-12 col-12 my-lg-0 my-2rem"><img class="img-fluid w-100" ' . ImageAttributeBuilder::buildAttributes($nivel, $imagenCajaSocial['ruta'], $imagenCajaSocial['descripcion']) . '></div>'.
                        '<div class="col-lg-3 col-md-5 col-sm-12 col-12 text-center my-lg-0 my-2rem">'.
                            '<div class="bg-bold-blue mb-1 p-4">'.
                                '<img class="img-fluid w-100" ' . ImageAttributeBuilder::buildAttributes($nivel, $imagenPagoAmigo['ruta'], $imagenPagoAmigo['descripcion']) . '>'.
                            '</div>'.
                            '<button id="' . $btnPagoAmigo['campo'] . '" type="' . $btnPagoAmigo['tipo'] . '" class="pagos-btn">' . $btnPagoAmigo['texto'] . '</button>'.
                        '</div>'.
                        '<div class="col-lg-3 col-md-12 col-sm-12 col-12 my-lg-0 my-2rem text-lg-start text-center">'.
                            '<p class="font-roboto-bolditalic">' . $instructivoPago['titulo'] . '</p>'.
                            '<a href="'. $instructivoPago['enlace'] .'"><img class="img-fluid w-50" ' . ImageAttributeBuilder::buildAttributes($nivel, $instructivoPago['ruta'], $instructivoPago['descripcion']) . '></a>'.
                        '</div>'.
                    '</div>'.
                 '</section>';
    
        $html .= '<section class="bg-bold-blue py-3 my-2rem">'.
                     '<div class="container">'.
                         '<div class="d-flex flex-lg-row flex-column justify-content-center align-items-center gap-3">'.
                                '<h2 class="tx-orange font-roboto-black d-inline-block text-center">' . $tituloSeccionDos['titulo'] . '</h2>'.
                                '<img ' . ImageAttributeBuilder::buildAttributes($nivel, $tituloSeccionDos['ruta'], $tituloSeccionDos['descripcion']) . ' class="img-fluid pagos-icono" >'.
                         '</div>'.
                     '</div>'.
                 '</section>';
    
        $html .= '<section class="container my-2rem">'.
                     '<div class="row mb-2rem">'.
                         '<div class="col-lg-6 col-md-12 col-sm-12 col-12">'.
                             '<img class="img-fluid w-100 mb-3" ' . ImageAttributeBuilder::buildAttributes($nivel, $epayco['ruta'], $epayco['descripcion']) . '>'.
                             '<p class="text-uppercase text-center font-roboto-bold">' . $epayco['titulo'] . '</p>'.
                             '<table>'.
                                 '<thead>'.
                                     '<tr>'.
                                         '<th class="text-center font-roboto-black">' . $conceptos['identificacion'] . '</th>'.
                                         '<th class="text-center font-roboto-black">' . $descripciones['identificacion'] . '</th>'.
                                         '</tr>'.
                                 '</thead>'.
                                 '<tbody>';
        $conceptos = explode("|", $conceptos['texto']);
        $descripciones = explode("|", $descripciones['texto']);
        for ($i = 0; $i < count($conceptos); $i++) {
            $html .=                '<tr>'.
                                        '<td class="text-start"><img class="img-fluid flecha-icon" ' . ImageAttributeBuilder::buildAttributes($nivel, $flechaAmarilla['ruta'], $flechaAmarilla['descripcion']) . '> ' . $conceptos[$i] . '</td>'.
                                        '<td class="text-start">' . $descripciones[$i] . '</td>'.
                                    '</tr>';
        }
        $html .=               '</tbody>'.
                            '</table>'.
                        '</div>'.
                        '<div class="col-lg-6 col-md-12 col-sm-12 col-12 my-lg-0 mt-2rem">'.
                            '<h3 class="text-center font-roboto-black">' . $refernciaPago['titulo'] . '</h3>'.
                            '<img class="img-fluid w-100" ' . ImageAttributeBuilder::buildAttributes($nivel, $refernciaPago['ruta'], $refernciaPago['descripcion']) . '>'.
                        '</div>'.
                    '</div>'.
                 '</section>'.
                 '<section class="container">'.
                     '<form action="" id="pagosform">'.
                         '<div class="row bg-bold-blue tx-white p-3 my-2rem">'.
                            '<div class="col-lg-6 col-md-12 col-sm-12 col-12 my-lg-0 my-4 text-lg-center text-start">'.
                                '<input type="'. $radioReferencia['tipo'] .'" id="'.$radioReferencia['campo'].'" name="opvalor" value="0" class="mx-3 radio-btn">'.
                                '<label for="'.$radioReferencia['campo'].'" class="font-roboto-black">'.$radioReferencia['texto'].'</label>'.
                            '</div>'.
                            '<div class="col-lg-6 col-md-12 col-sm-12 col-12 my-lg-0 my-4 text-lg-center text-start">'.
                                '<input type="'. $radioManual['tipo'] .'" id="'. $radioManual['campo'] .'" name="opvalor" value="1" class="mx-3 radio-btn">'.
                                '<label for="'. $radioManual['campo'] .'" class="font-roboto-black">'. $radioManual['texto'] .'</label>'.
                            '</div>'.
                         '</div>'.
                          '<div class="row justify-content-lg-between justify-content-center align-items-center">'.
                              '<div class="col-lg-4 col-md-12 col-sm-12 col-12 my-lg-0 my-4">'.
                                  '<div class="bg-yellow ps-5">'.
                                      '<div class="bg-bold-blue py-3 px-4">'.
                                          '<p class="tx-white font-roboto-bolditalic m-0">'.$nombreResponsable['texto'].'</p>'.
                                      '</div>'.
                                  '</div>'.
                                  '<input type="' . $nombreResponsable['tipo'] . '" id="' . $nombreResponsable['campo'] . '" placeholder="' . $nombreResponsable['placeHolder'] . '" onkeyup="validarCampo(this, \'(Nombre de quien paga)\', \'texto\', 1, \'btnpagar\');" class="p-3 my-3 form-control campoFormulario" ' . $nombreResponsable['obligatorio'] . ' ' . $nombreResponsable['soloLectura'] . ' ' . $nombreResponsable['habilitado'] . '>'.
                                  '<input type="' . $identificacionResponsable['tipo'] . '" id="' . $identificacionResponsable['campo'] . '" placeholder="' . $identificacionResponsable['placeHolder'] . '" onkeyup="validarCampo(this, \'(Número de identificación)\', \'numero\', 1, \'btnpagar\');" class="p-3 my-3 form-control campoFormulario" ' . $identificacionResponsable['obligatorio'] . ' ' . $identificacionResponsable['soloLectura'] . ' ' . $identificacionResponsable['habilitado'] . '>'.
                                  '<div>'.
                                      '<input class="check-pagos" type="' . $tratamientoDatos['tipo'] . '" id="' . $tratamientoDatos['campo'] . '" name="tratamiento datos" ' . $tratamientoDatos['obligatorio'] . '>'.
                                      '<p class="little-paragraph d-inline-block m-0">' . $tratamientoDatos['texto'] . '</p>'.
                                  '</div>'.
                              '</div>'.
                              '<div class="col-lg-2 col-md-6 col-sm-12 col-12 my-lg-0 my-4 text-center">'.
                                  '<img class="img-fluid cards-icono w-100" '. ImageAttributeBuilder::buildAttributes($nivel, $cardsImg['ruta'], $cardsImg['descripcion']) .' >'.
                              '</div>'.
                              '<div class="col-lg-4 col-md-12 col-sm-12 col-12 my-lg-0 my-4">'.
                                  '<div id="medioalert" class="form-group select-alert">'.
                                      '<select id="selmediopago" name="selmediopago" class="form-select-pagos form-select-pagos-img campoFormulario font-roboto-medium" required>'.
                                          '<option value="NA">Seleccione el medio de pago</option>';
        for ($i = 0; $i < count($formasPago); $i++) {
            $html .=                         '<option value="'.$formasPago[$i]['valor'].'">'.$formasPago[$i]['texto'].'</option>';
        }
        $html .=                     '</select>';
        $html .=                 '</div>';
        $html .=             '</div>';
        $html .=         '</div>';
        $html .=         '<div class="row my-3">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-3">';
        if($infoFinanciera['identificacion'] === 'info financiera'){
            $html .=             $infoFinanciera['texto'];
        }
        $html .=             '</div>';
        $html .=         '</div>';
        $titulosSeccionesPago = explode("|", $titulosSeccionesPago['texto']);
        $html .=         '<div id="secreferencia" class="row my-3 justify-content-center" style="display: none;">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-3">'.
                                 '<h3 class="text-uppercase text-center font-roboto-black bg-bold-blue tx-white py-4">'.$titulosSeccionesPago[0].'</h3>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-4 text-center">'.
                                 '<input type="'. $txtRef['tipo'] .'" id="'. $txtRef['campo'] .'" placeholder="'. $txtRef['placeHolder'] .'" onkeyup="validarCampo(this, \'Referencia de pago\', \'texto1\', 1, \'btnpagar\'); validarConsulta();" class="form-control campoFormulario" '. $txtRef['obligatorio'] .' '. $txtRef['soloLectura'] .' '. $txtRef['habilitado'] .'>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-4">'.
                                 '<input type="'. $txtValorRef['tipo'] .'" id="'. $txtValorRef['campo'] .'" class="inactivo form-control" placeholder="'. $txtValorRef['placeHolder'] .'" '. $txtValorRef['obligatorio'] .' '. $txtValorRef['soloLectura'] .' '. $txtValorRef['habilitado'] .'>'.
                             '</div>'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">'.
                                 '<button class="pagos-btn w-50 text-uppercase" onclick="" type="'.$consultarBtn['tipo'].'" id="'.$consultarBtn['campo'].'">'.$consultarBtn['texto'].'</button>'.
                             '</div>'.
                         '</div>'.
                         '<div id="secvalman" class="row my-3 align-items-end" style="display: none;">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-3">'.
                                 '<h3 class="text-uppercase text-center font-roboto-black bg-bold-blue tx-white py-4">'.$titulosSeccionesPago[1].'</h3>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-4 text-center">'.
                                 '<label for="'. $txtNumDoc['campo'] .'">Documento estudiante</label>'.
                                 '<input type="'. $txtNumDoc['tipo'] .'" id="'. $txtNumDoc['campo'] .'" placeholder="'. $txtNumDoc['placeHolder'] .'" onkeyup="validarCampo(this, \'Documento estudiante\', \'numero\', 1, \'btnpagar\');" class="form-control campoFormulario" '. $txtNumDoc['obligatorio'] .' '. $txtNumDoc['soloLectura'] .' '. $txtNumDoc['habilitado'] .'>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-4 text-center">'.
                                 '<label for="'. $txtAnio['campo'] .'">Año</label>'.
                                 '<input type="'. $txtAnio['tipo'] .'" id="'. $txtAnio['campo'] .'" placeholder="'. $txtAnio['placeHolder'] .'" onkeyup="validarCampo(this, \'Año\', \'numero\', 1, \'btnpagar\');" class="form-control campoFormulario" '. $txtAnio['obligatorio'] .' '. $txtAnio['soloLectura'] .' '. $txtAnio['habilitado'] .'>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-4 text-center">'.
                                 '<label for="'.$txtValor['campo'].'">Ingrese valor a pagar</label>'.
                                 '<input type="'.$txtValor['tipo'].'" id="'.$txtValor['campo'].'" placeholder="'.$txtValor['placeHolder'].'" onkeyup="validarCampo(this, \'Valor a pagar\', \'numero\', 1, \'btnpagar\');" class="form-control campoFormulario" '.$txtValor['obligatorio'].' '.$txtValor['soloLectura'].' '.$txtValor['habilitado'].'>'.
                             '</div>'.
                             '<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-4 text-center">'.
                                 '<div id="conceptoalert" class="form-group select-alert">'.
                                     '<select id="selconcepto" name="selconcepto" class="form-select-pagos form-select-pagos-img campoFormulario font-roboto-medium" required>'.
                                         '<option value="NA">Seleccione concepto de pago</option>';
        for ($i=0; $i < count($conceptosPago); $i++) { 
            $html .=                         '<option value="'.$conceptosPago[$i]['valor'].'">'.$conceptosPago[$i]['texto'].'</option>';
        }
        $html .=                     '</select>'.
                                 '</div>'.
                             '</div>'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-4">'.
                                 '<input type="'. $txtvalorRefMan['tipo'] .'" id="'. $txtvalorRefMan['campo'] .'" class="inactivo form-control text-center" placeholder="'. $txtvalorRefMan['placeHolder'] .'" '. $txtvalorRefMan['obligatorio'] .' '. $txtvalorRefMan['soloLectura'] .' '. $txtvalorRefMan['habilitado'] .'>'.
                             '</div>'.
                         '</div>'.
                         '<div class="row my-3">'.
                             '<div class="col-lg-12 col-md-12 col-sm-12 col-12 my-2 text-center">'.
                                 '<button id="'.$btnPagar['campo'].'" type="'.$btnPagar['tipo'].'" class="pagos-btn w-50 bg-green text-uppercase" onclick="">'.$btnPagar['texto'].'</button>'.
                             '</div>'.
                         '</div>'.
                     '</form>'.
                 '</section>'.
                 '<div id="alert" style="margin-left: 2rem;">'.
                     '<p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>'.
                         '<input type="text" class="alert" style="width: 20px; border: none; background: transparent; color: transparent" id="txtvacio" value="0">'.
                     '</p>'.
                 '</div>';
    }
    
    echo $html;
