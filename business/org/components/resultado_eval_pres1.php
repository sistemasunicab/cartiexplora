<?php  
     //Estas 4 líneas se borran en producción
     /*include('../../../clases/GenerateQuery.php');
     include('../../../clases/ImageAttributeBuilder.php');
     $nivel = "tres";
     include('../../../components/headMain.php');*/
     
     if ($nivel == "raiz") {
          require('business/repositories/1cc2s4Home.php');
     } else if ($nivel == "uno") {
          require('../business/repositories/1cc2s4Home.php');
     } else if ($nivel == "dos") {
          require('../../business/repositories/1cc2s4Home.php');
     } else if ($nivel == "tres") {
          require('../../../business/repositories/1cc2s4Home.php');
     }

     $res_sentecia = $sentencia."162";
	$valores = [
		'*' => '*'
	];
	$sql_imagenes = GenerateQuery::querySql($mysqli1, $res_sentecia, $valores);

     $res1 = $mysqli1->query($sql_imagenes);
     while ($row = $res1->fetch_assoc()) {
          $imagenes[] = $row;
     }

     $encabezado = array_shift($imagenes);
     $cheked = array_shift($imagenes);
     $uncheked = array_shift($imagenes);
     $na = array_shift($imagenes);

     $html = '';
     $html .= '<br>
          <section class="">
               <div class="container-lg">
                    <div class="row">
                         <div class="col-1">
                         </div>
                         <div class="col-10">
                              <!-- ###################################################################### -->
                              <div id="divenc1">
                                   <div>
                                        <img class="img-fluid" ' . ImageAttributeBuilder::buildAttributes($nivel, $encabezado['ruta'], $encabezado['descripcion']) . '>
                                   </div>
                              </div><br>
                         
                              <div id="divenc2">
                                   <div id="divenc2_1">
                                        <p>Evaluación de Admisión</p>
                                        <p>Nombres y Apellidos: <strong>'.$nombre_completo.'</strong></p>
                                        <p>Documento: <strong>'.$documento.'</strong></p>
                                        <p>Grado: <strong>'.$grado_ra.'</strong></p>
                                   </div>
                                   <div id="divenc2_2">
                                        <p style="font-family: poppins-semi-bold; font-size: 24px; font-style: italic; color: #093A5F">GLOBAL</p>
                                        <p style="font-family: poppins-semi-bold; font-size: 18px; color: #093A5F; padding: 0 5px;">De '.$total_todos.' puntos posibles, su puntaje global es de '.$total_todos_ok.'</p>
                                   </div>
                              </div><br>

                              <div style="width: 100%; background: #093A5F; color: #F1F1F2; text-align: center; font-size: 20px; font-weight: bold; font-family: "PT Sans Narrow";">Informe Global
                              </div>
                              <div style="width: 100%; background: #F1F1F2; text-align: center; font-size: 20px; font-family: "Poppins-medium";">
                                   <br><p>A continuación se relacionan los puntajes obtenidos en cada uno de los pensamientos evaluados en la evaluación de admisión:</p><br>
                              </div>

                              <div class="row" id="divglobal">          
                                   <table id="tblglobal" style="text-align: center;">
                                        <thead style="font-family: "PT Sans Narrow";">
                                             <tr style="background: #45A872; color: #F1F1F2; font-size: 20px; font-weight: bold; border: 2px;"><td colspan="9">Pensamientos</td></tr>
                                             <tr>
                                                       <td colspan="2" width="200px" style="background: #FA4D59; color: #F1F1F2; font-size: 20px; font-weight: bold; border: 2px solid black;">Global</td>
                                                       <td width="100px" style="background: #093A5F; color: #F1F1F2; font-weight: bold; border: 2px solid black;">Bio</td>
                                                       <td width="100px" style="background: #093A5F; color: #F1F1F2; font-weight: bold; border: 2px solid black;">Esp</td>
                                                       <td width="100px" style="background: #093A5F; color: #F1F1F2; font-weight: bold; border: 2px solid black;">Ing</td>
                                                       <td width="100px" style="background: #093A5F; color: #F1F1F2; font-weight: bold; border: 2px solid black;">Num</td>
                                                       <td width="100px" style="background: #093A5F; color: #F1F1F2; font-weight: bold; border: 2px solid black;">Soc</td>
                                                       <td width="100px" style="background: #093A5F; color: #F1F1F2; font-weight: bold; border: 2px solid black;">Tec</td>
                                                       <td width="100px" style="background: #093A5F; color: #F1F1F2; font-weight: bold; border: 2px solid black;">Fis</td>
                                             </tr>
                                        </thead>
                                        <tbody style="font-family: "PT Sans Narrow";">';                                             
                                        
                                             $linea = '<tr>';
                                             $linea .= '<td style="color: #064C86; border: 2px solid black;">Puntaje</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$total_todos_ok.' / '.$total_todos.'</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$obj_json_decode['bio']['ctok'].' / '.$obj_json_decode['bio']['ctpen'].'</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$obj_json_decode['esp']['ctok'].' / '.$obj_json_decode['esp']['ctpen'].'</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$obj_json_decode['ing']['ctok'].' / '.$obj_json_decode['ing']['ctpen'].'</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$obj_json_decode['num']['ctok'].' / '.$obj_json_decode['num']['ctpen'].'</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$obj_json_decode['soc']['ctok'].' / '.$obj_json_decode['soc']['ctpen'].'</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$obj_json_decode['tec']['ctok'].' / '.$obj_json_decode['tec']['ctpen'].'</td>';
                                             $linea .= '<td style="border: 2px solid black; color: #093A5F; font-weight: bold;">'.$obj_json_decode['fis']['ctok'].' / '.$obj_json_decode['fis']['ctpen'].'</td>';
                                             $linea .= '</tr>';
     $html .= $linea;
                                             
                                             $linea = '<tr>';
                                             $linea .= '<td style="color: #064C86; border: 2px solid black;">Desempeño</td>';
                                             $linea .= '<td style="color: '.$colglo.'; border: 2px solid black; font-weight: bold;">'.$nivglo.'</td>';
                                             $linea .= '<td style="color: '.$colbio.'; border: 2px solid black; font-weight: bold;">'.$nivbio.'</td>';
                                             $linea .= '<td style="color: '.$colesp.'; border: 2px solid black; font-weight: bold;">'.$nivesp.'</td>';
                                             $linea .= '<td style="color: '.$coling.'; border: 2px solid black; font-weight: bold;">'.$niving.'</td>';
                                             $linea .= '<td style="color: '.$colnum.'; border: 2px solid black; font-weight: bold;">'.$nivnum.'</td>';
                                             $linea .= '<td style="color: '.$colsoc.'; border: 2px solid black; font-weight: bold;">'.$nivsoc.'</td>';
                                             $linea .= '<td style="color: '.$coltec.'; border: 2px solid black; font-weight: bold;">'.$nivtec.'</td>';
                                             $linea .= '<td style="color: '.$colfis.'; border: 2px solid black; font-weight: bold;">'.$nivfis.'</td>';
                                             $linea .= '</tr>';
     $html .= $linea;                                   
                                   
     $html .= '                         </tbody>
                                   </table>
                              </div><br>

                              <div style="width: 100%; background: #093A5F; color: #F1F1F2; text-align: center; font-size: 20px; font-weight: bold; font-family: "PT Sans Narrow";">Informe por Pensamientos</div>

                              <div class="form-group" style="background: #F1F1F2;">';
     
     $pensamiento = "";
     $peticion = $mysqli2->query($sql);
	while($fila = $peticion->fetch_assoc()) {
	    if($pensamiento != $fila['pensamiento']) {
               $pensamiento = $fila['pensamiento'];
               $html .= '<div style="height: 65px; color: #093A5F; background: #45A872; display: inline-block;"><label style="padding: 15px 10px; font-size: 30px;">'.$pensamiento.'</label></div><br><br>';
          }
          if($fila['resultado'] == "NO") {
               $img_resul = "https://unicab.org/registro/images/respuesta_no2.jpg";
          }
          else if($fila['resultado'] == "OK") {
               $img_resul = "https://unicab.org/registro/images/respuesta_ok2.jpg";
          }
          else if($fila['resultado'] == "NA") {
               $img_resul = "https://unicab.org/registro/images/respuesta_no2.jpg";
          }
          $img_pregunta = "https://unicab.org/registro/".$fila['ruta'];
          $tbl_pregunta = '<table id="tblres" class="table" style="width:100%;"><tbody><tr><td style="color: #F1F1F2; width: 100px;">Pregunta</td><td style="width: 600px;">'.$fila['pregunta'].'</td><td style="text-align: center;"><img src="'.$img_pregunta.'" width="50%" alt=""/></td></tr>';
          $tbl_pregunta .= '<tr style="background: #1d2b2e; color: #F1F1F2;"><td style="color: #1d2b2e; width: 100px;">Respuesta</td><td>Tu respuesta: '.$fila['respuesta'].'</td><td  style="text-align: center;"><img src="'.$img_resul.'" width="80px"/></td></tr>';
          $tbl_pregunta .= '</tbody></table><br>';
          $html .= $tbl_pregunta;
	}


     $html .= '                    <input type="hidden" id="txtctnum" value="'.$ct_num.'"/>
                                   <input type="hidden" id="txtctbio" value="'.$ct_bio.'"/>
                                   <input type="hidden" id="txtctsoc" value="'.$ct_soc.'"/>
                                   <input type="hidden" id="txtctesp" value="'.$ct_esp.'"/>
                                   <input type="hidden" id="txtcting" value="'.$ct_ing.'"/>
                                   <input type="hidden" id="txtcttec" value="'.$ct_tec.'"/>';

     if($idgra == 11 || $idgra == 12 || $idgra == 17 || $idgra == 18 ) {
          $html .= '               <input type="hidden" id="txtctfis" value="'.$ct_fis.'"/>';
     }

     $html .= '               </div>

                              <div style="width: 100%; background: #093A5F; color: #F1F1F2; text-align: center; font-size: 20px; font-weight: bold; font-family: "PT Sans Narrow";">Ruta sugerida para reforzar conceptos:
                              </div><br>

                              <div class="form-group" style="background: #F1F1F2;">';
     
     $exe_retro_bio = $mysqli2->query($sql_retro_bio);
     $filas = $exe_retro_bio->num_rows;
     if($filas > 0) {
          $html .= '<ul class="list-group">';
          $html .= '<li style="color: #5ac48c; font-size: 16px;">Pensamiento: BIOÉTICO</li>';
          while($row_retro_bio = $exe_retro_bio->fetch_assoc()) {
               $html .= '<li style="font-size: 14px;">'.$row_retro_bio['retroalimentacion'].'</li>';
          }
          $html .= '</ul><br>';
     }
     
     $exe_retro_esp = $mysqli2->query($sql_retro_esp);
     $filas = $exe_retro_esp->num_rows;
     if($filas > 0) {
          $html .= '<ul class="list-group">';
          $html .= '<li style="color: #5ac48c; font-size: 16px;">Pensamiento: HUMANÍSTICO ESPAÑOL</li>';
          while($row_retro_esp = $exe_retro_esp->fetch_assoc()) {
               $html .= '<li style="font-size: 14px;">'.$row_retro_esp['retroalimentacion'].'</li>';
          }
          $html .= '</ul><br>';
     }
     
     $exe_retro_ing = $mysqli2->query($sql_retro_ing);
     $filas = $exe_retro_ing->num_rows;
     if($filas > 0) {
          $html .= '<ul class="list-group">';
          $html .= '<li style="color: #5ac48c; font-size: 16px;">Pensamiento: HUMANÍSTICO INGLÉS</li>';
          while($row_retro_ing = $exe_retro_ing->fetch_assoc()) {
               $html .= '<li style="font-size: 14px;">'.$row_retro_ing['retroalimentacion'].'</li>';
          }
          $html .= '</ul><br>';
     }
     
     $exe_retro_num = $mysqli2->query($sql_retro_num);
     $filas = $exe_retro_num->num_rows;
     if($filas > 0) {
          $html .= '<ul class="list-group">';
          $html .= '<li style="color: #5ac48c; font-size: 16px;">Pensamiento: NUMÉRICO</li>';
          while($row_retro_num = $exe_retro_num->fetch_assoc()) {
               $html .= '<li style="font-size: 14px;">'.$row_retro_num['retroalimentacion'].'</li>';
          }
          $html .= '</ul><br>';
     }
     
     $exe_retro_soc = $mysqli2->query($sql_retro_soc);
     $filas = $exe_retro_soc->num_rows;
     if($filas > 0) {
          $html .= '<ul class="list-group">';
          $html .= '<li style="color: #5ac48c; font-size: 16px;">Pensamiento: SOCIAL</li>';
          while($row_retro_soc = $exe_retro_soc->fetch_assoc()) {
               $html .= '<li style="font-size: 14px;">'.$row_retro_soc['retroalimentacion'].'</li>';
          }
          $html .= '</ul><br>';
     }
          
     $exe_retro_tec = $mysqli2->query($sql_retro_tec);
     $filas = $exe_retro_tec->num_rows;
     if($filas > 0) {
          $html .= '<ul class="list-group">';
          $html .= '<li style="color: #5ac48c; font-size: 16px;">Pensamiento: TECNOLÓGICO</li>';
          while($row_retro_tec = $exe_retro_tec->fetch_assoc()) {
               $html .= '<li style="font-size: 14px;">'.$row_retro_tec['retroalimentacion'].'</li>';
          }
          $html .= '</ul><br>';
     }
     
     if($idgra == 11 || $idgra == 12 || $idgra == 17 || $idgra == 18 ) {
          $exe_retro_fis = $mysqli2->query($sql_retro_fis);
          $filas = $exe_retro_fis->num_rows;
          if($filas > 0) {
               $html .= '<ul class="list-group">';
               $html .= '<li style="color: #5ac48c; font-size: 16px;">Pensamiento: BIOÉTICO (FÍSCIA)</li>';
               while($row_retro_fis = $exe_retro_fis->fetch_assoc()) {
                    $html .= '<li style="font-size: 14px;">'.$row_retro_fis['retroalimentacion'].'</li>';
               }
               $html .= '</ul><br>';
          }
     }

     $html .= '               <!-- ###################################################################### -->
                         </div>
                         <div class="col-1">
                         </div>
                    </div>
               </div>
          </section><br><br>
     ';

     echo $html;
?>



