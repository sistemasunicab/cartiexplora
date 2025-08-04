<?php  
    //-- Runtime --//

    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    $res_sentecia = $mysqli1->query($sentencia . "149");//150
    while ($row_sentencia = $res_sentecia->fetch_assoc()) {
        $sql_seccion_dos = $row_sentencia['campos'] . $row_sentencia['tablas'] . $row_sentencia['condiciones'];
    }
    $res_seccion_dos = $mysqli1->query($sql_seccion_dos);

    $html = '';
    while ($row_datos_seccion = $res_seccion_dos->fetch_assoc()) {
        // renderiza la seccion
        $html .= '<br>
          <section class="">
               <div class="container-lg">
                    <div class="row">
                         <div class="col-lg-2 col-md-2 py-3 presaberes-paso">
                              <h3 class="text-center">'.$row_datos_seccion['titulo'].'</h3>
                         </div>

                         <div class="col-lg-10 col-md-10 py-3 presaberes-paso-indicacion">
                              <h3 class="d-block w-100 text-lg-start text-center">'.$nombre_completo.'</h3>
                         </div>
                    </div>
               </div>

               <div class="container"><br><br>
          ';

          // Obteniendo los parametros necesarios.
          $res_sentencia = $mysqli1->query($sentencia."150");//151
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$row_sentencia['ordenamientos'];
          }  

          $res_datos = $mysqli1->query($sql_datos);

          while($row_datos = $res_datos->fetch_assoc()){
               if ($row_datos['identificacion'] == 'indicacion') {
                    $html .= '
                    <div class="row">
                         <div class="col-lg-2 col-md-2 col-sm-0 col-0"></div>
                         <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                              <div class="row">
                                   <div class="col-1">
                                        <p class="presaberes-main-descripcionzz"><i class="fa fa-chevron-right"></i></p>
                                   </div>
                                   <div class="col-11">
                                        <p class="presaberes-main-descripcionzz">'.str_replace('_grado*', $grado, $row_datos['texto']).'</p>
                                   </div>
                              </div>                              
                         </div>
                         <div class="col-lg-2 col-md-2 col-sm-0 col-0"></div>
                    </div>';
               }
          }

          $html .= '
               </div><br>

               <div class="container">
                    <div class="row">
                         <div class="col-lg-5 col-md-4"></div>
                         <div class="col-lg-2 col-md-4">
                              <input type="hidden" name="verificacion">
                              <button class="presaberes-boton border-0 ghf1" onclick="primer_pregunta();">Comenzar</button>
                         </div>
                         <div class="col-lg-5 col-md-4"></div>
                    </div>
                    <input type="hidden" id="txt_ids_preguntas" value="'.$listado.'"/>
                    <input type="hidden" id="txt_respuesta1" value=""/>
                    <input type="hidden" id="txt_respuesta2" value=""/>
                    <input type="hidden" id="txt_respuesta3" value=""/>
                    <input type="hidden" id="txt_retro" value=""/>
                    <input type="hidden" id="txt_tp" value=""/>
                    <input type="hidden" id="txt_control_respuesta" value="ERROR"/>
                    <input type="hidden" id="txt_idpreg" value=""/>
                    <input type="hidden" id="txt_documento" value="'.$documento.'"/>

                    <input type="hidden" id="txtidgra" value="'.$idgrado.'"/>
                    <input type="hidden" id="identif" value="'.$documento.'"/>
               </div>
          </section><br><br>
          ';

          $html .= '
          <section>
               <div class="container">
                    <div class="row">
                         <div class="col-12">
                              <div id="divencp" class="btn btn-reg ghf">
                                   <table>
                                        <tbody>
                                             <tr>
                                                  <td>
                                                       <h6>Pregunta <input type="text" id="txtconteo" class="conteo btn" value="'.($ct_preg_ya + 1).'" readonly/> de <input id="txttotalpreg" type="text" class="conteo btn" value="'.$longitud_final.'" readonly/></h6>
                                                  </td>
                                                  <!--<td width="200px"></td>
                                                  <td><h6 class="oculto">Resumen: </h6></td> 
                                                  <td width="50px"></td>
                                                  <td class="fondoblancox"><input type="text" id="txtok" class="txtct oculto" value="'.$ct_ok.'"/> <img class="oculto" src="registro/images/checked_1.jpg" height="25px"/></td>
                                                  <td width="50px"></td>
                                                  <td class="fondoblancox"><input type="text" id="txtno" class="txtct oculto" value="'.$ct_no.'"/> <img class="oculto" src="registro/images/unchecked_1.jpg" width="25px"/></td>
                                                  <td width="50px"></td>
                                                  <td class="fondoblancox"><input type="text" id="txtna" class="txtct oculto" value="'.$ct_na.'"/> <img class="oculto" src="registro/images/na_1.jpg" width="25px"/></td>-->
                                             </tr>
                                        </tbody>
                                   </table>
                                   </div>
                                   <div id="divpreguntas" class="row ghf">
                                        <div id="divimagen" class="col-5 col-sm-5">
                                             <label></label>
                                        </div>
                                        <div id="divtextopregunta" class="col-7 col-sm-7">
                                             <label></label>
                                        </div>
                                   </div>
                                   <br>
                                   
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-3">
                              <div class="form-group ghf">
                                   <button id="btnsiguiente" class="presaberes-boton" onclick="sig_pregunta();"> Siguiente <i class="fa fa-arrow-circle-right"></i></button>
                                   <button id="btnfinalizar" class="presaberes-boton" onclick="finalizar_sm();" style="display: none;"> Finalizar <i class="fa fa-arrow-circle-right"></i></button>
                              </div>
                         </div>
                         <div class="col-9">
                         </div>
                    </div><br><br>
                    <div class="alert alert-danger" role="alert" id="alert" style="display: none;">
                         <p><i class="fa fa-warning"></i><span>: </span><label id="pdesc"></label>
                         <input type="text" class="alert alert-danger" style="width: 20px" id="txtvacio" value="0"></p>
                    </div>
               </div>
          </section>
          ';

          $html .= '
               <!-- Modal imagen grande -->
               <div class="modal fade" id="modal_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">IMAGEN PREGUNTA</h5>
                                   <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                   </button>
                              </div>
                              <div class="modal-body">
                                   <div id="divmodalimg">
                                        
                                   </div>
                              </div>
                              <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                              </div>
                         </div>
                    </div>
               </div>
          ';

          echo $html;
    }
?>



