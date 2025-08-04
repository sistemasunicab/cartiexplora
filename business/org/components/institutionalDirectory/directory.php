<?php

    $datosDirectorio = obtenerFilas($mysqli1, $sentencia, 55);
    foreach ($datosDirectorio as $row_datos_directorio) {

        /* Row one */

        $html_row_one = '<div class="row col-12 p-0 m-0">';
        $html_row_one .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_one .= '<div class="col-lg-5 col-6 p-0 m-0">';
        $html_row_one .= '<h3-directory class="tx-blue font-roboto-light-title col-lg-5 col-12">' . $row_datos_directorio['titulo'] . '</h3-directory>';
        $html_row_one .= '</div>';
        $html_row_one .= '<div class="col-lg-6 col-5 p-0 m-0"></div>';
        $html_row_one .= '</div>';

        /* Row two */

        $html_row_two = '<div class="row col-12 mx-auto p-0 m-0 mt-5">';
        $html_row_two .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_two .= '<div class="col-10 p-0 m-0">';
        $html_row_two .= '<div class="row col-10 mx-auto p-0 m-0 mb-2">';
        $html_row_two .= '<div class="col-lg-8 col-md-12 col-sm-12 col-12 p-0 m-0 d-flex">';
        $html_row_two .= '<h4-directory class="tx-orange font-roboto-light my-auto text-center mx-auto">Escríbenos o Llámanos</h4-directory>';
        $html_row_two .= '</div>';
        $html_row_two .= '</div>';
        $html_row_two .= '</div>';
        $html_row_two .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_two .= '</div>';

        /* Row three */

        $html_row_three = '<div class="row col-12 mx-auto p-0 m-0">';
        $html_row_three .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_three .= '<div class="col-10 p-0 m-0">';
        $html_row_three .= '<div class="row col-lg-10 col-12  mx-auto p-0 m-0">';
        $datosImagen = obtenerFilas($mysqli1, $sentencia, 60);
        $image_path = '';
        foreach ($datosImagen as $row_data_image) {
            $ruta =     $row_data_image['ruta'];
            $alt  = $row_data_image['textoAlterno'] ?? 'Imagen';
            $image_path = rutaPorNivel($ruta);
        }

        $datosImagenContacto = obtenerFilas($mysqli1, $sentencia, 135);
        $image_path_contacto = '';
        foreach ($datosImagenContacto as $row_data_image) {
            $ruta = $row_data_image['ruta'];
            $alt  = $row_data_image['textoAlterno'] ?? 'Imagen';
            $image_path_contacto = rutaPorNivel($ruta);
        }
        $html_row_three .= '<div class="position-relative h-auto my-auto d-inline-block col-lg-8 col-md-12 col-sm-12 col-12 p-0">';
        $html_row_three .= '<input type="text" id="search" name="search" class="search form-control text-center pe-lg-5 px-2 border-bold-blue border-2 font-roboto-bolditalic" placeholder="Buscar">';
        $html_row_three .= '<img src="' . $image_path . '" class="img-fluid d-lg-block d-none position-absolute end-0 top-50 translate-middle-y me-4" alt="Buscar" width="52px">';
        $html_row_three .= '</div>';
        $html_row_three .= '<div class="col-lg-4 col-md-12 col-sm-12 col-12 p-0 m-0 d-flex">';
        $html_row_three .= '<img src="' . $image_path_contacto . '" class="img-fluid logo-buscar mx-auto mt-lg-0 mt-2" alt="Buscar">';
        $html_row_three .= '</div>';
        $html_row_three .= '</div>';
        $html_row_three .= '</div>';    
        $html_row_three .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_three .= '</div>';

        $datosEncabezados = obtenerFilas($mysqli1, $sentencia, 61);
        $icons = [];
        foreach ($datosEncabezados as $row_icon) {
            $ruta   = $row_icon['ruta'];
            $titulo = $row_icon['titulo'];
            $image_path = rutaPorNivel($ruta);
            $icons[] = ['path' => $image_path, 'title' => $titulo];
        }

        /* Row four */

        $html_row_four = '<div class="row col-12 mx-auto p-0 m-0 mt-ws">';
        $html_row_four .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_four .= '<div class="col-10 p-0 m-0">';
        $html_row_four .= '<div class="custom-table table-responsive-xl">'; // Bootstrap tiene esta clase lista para ti
        $html_row_four .= '<table id="datos-empelados" class="table table-bordered text-center my-0">';
        $html_row_four .= '<thead class="bg-bold-blue text-white">';
        $html_row_four .= '<tr>';

        // Generar los encabezados dinámicamente con los íconos obtenidos
        foreach ($icons as $icon) {
            $html_row_four .= '<th>
                                    <div class="d-flex flex-row align-items-center justify-content-center">
                                        <img class="me-3" src="' . $icon['path'] . '" width="30px"> ' . $icon['title'] . '
                                    </div>
                                </th>';
        }
        $html_row_four .= '</tr>';
        $html_row_four .= '</thead>';
        $html_row_four .= '<tbody>';

        //Se hace la consulta del directorio
        $sentenciaFinal = $sentencia2."'consulta directorio'";
        $valores = [
            '_activo*' => 'activo'
        ];
        $sql_directorio = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
        $exe_directorio = $mysqli2->query($sql_directorio);
        while($row_directorio = $exe_directorio->fetch_assoc()) {
            if($row_directorio['perfil'] == "SI") {
                if($row_directorio['infografia'] == '') {
                    $html_row_four .= '
                        <tr>
                            <td class="transform-text">'.mb_strtolower($row_directorio['nombres']).' '.mb_strtolower($row_directorio['apellidos']).'</td>
                            <td class="transform-text">'.mb_strtolower($row_directorio['dependencia']).'</td>
                            <td>'.$row_directorio['email'].'</td>
                            <td class="transform-text">'.mb_strtolower($row_directorio['cargo']).'</td>
                            <td>'.$row_directorio['celular'].'</td>
                        </tr>';
                }
                else {
                    //imagen = substr($row_directorio['infografia'], 9);
                    $imagen = $row_directorio['infografia'];
                    $html_row_four .= "
                        <tr>
                            <td class= \"transform-text\">".mb_strtolower($row_directorio['nombres'])." ".mb_strtolower($row_directorio['apellidos'])."</td>
                            <td class= \"transform-text\">".mb_strtolower($row_directorio['dependencia'])."</td>
                            <td>".$row_directorio['email']."</td>
                            <td class= \"transform-text\">".mb_strtolower($row_directorio['cargo'])."</td>
                            <td><button class='btn bg-orange btn-lg btn-intitutional' onclick='verInfografia(\"".$imagen."\")'>VER</button></td>
                        </tr>"; 
                }                
            }
            else {
                $html_row_four .= '
                        <tr>
                            <td class="transform-text">'.mb_strtolower($row_directorio['nombres']).' '.mb_strtolower($row_directorio['apellidos']).'</td>
                            <td class="transform-text">'.mb_strtolower($row_directorio['dependencia']).'</td>
                            <td>'.$row_directorio['email'].'</td>
                            <td class="transform-text">'.mb_strtolower($row_directorio['cargo']).'</td>
                            <td>'.$row_directorio['celular'].'</td>
                        </tr>';
            }
        }

        $html_row_four .= '</tbody>';
        $html_row_four .= '</table>';
        $html_row_four .= '</div>'; // Cierre del div de la tabla-responsive

        $html_row_four .= '</div>';
        $html_row_four .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_four .= '</div>';

        /* Row five */

        $html_row_five = '<div class="row col-12 p-0 m-0 mt-ws">';
        $html_row_five .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_five .= '<div class="col-10 p-0 m-0">';
        // Obtenemos los datos de la imagen de horario usando la función auxiliar:
        $datosImagenHorario = obtenerFilas($mysqli1, $sentencia, 104);
        foreach ($datosImagenHorario as $row_data_image) {
            $ruta   = htmlspecialchars($row_data_image['ruta']);
            $alt    = htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen');
            $titulo = $row_data_image['titulo'];
            $image_path = rutaPorNivel($ruta);
        }
        $html_row_five .= '<div id="horarios" class="row p-0 m-0">';
        $html_row_five .= '<div class="col-lg-1 col-12 p-0 m-0"></div>';
        $html_row_five .= '<div class="col-lg-5 col-md-12 col-sm-12 col-12 mb-md-0 ms-lg-0 d-flex flex-column p-0">';
        $html_row_five .= '<img src="' . $image_path . '" class="img-horario w-100 mx-auto" alt="' . $alt . '">';
        $html_row_five .= '</div>';
        $html_row_five .= '<div class="col-lg-5 col-md-12 col-sm-12 col-12 text-center text-lg-start my-lg-auto mt-3 ms-lg-4 p-0 d-flex">';
        $html_row_five .= '<p-directory class="mx-auto"><b>' . $titulo . '</b></p-directory >';
        $html_row_five .= '</div>';
        $html_row_five .= '<div class="col-lg-1 col-12 p-0 m-0"></div>';
        $html_row_five .= '</div>';         
        $html_row_five .= '</div>';
        
        $html_row_five .= '<div class="col-1 p-0 m-0"></div>';
        $html_row_five .= '</div>'; 

        $html_directorio = $html_row_one;
        $html_directorio .= $html_row_two;
        $html_directorio .= $html_row_three;
        $html_directorio .= $html_row_four;
        $html_directorio .= $html_row_five;
    }
?>

<div class="container-fluid my-ws mx-0 p-0">
    <?php
    echo $html_directorio;
    ?>
</div>

<!-- Modal imagen grande -->
<div class="modal fade" id="modal_img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">INFOGRAFIA</h5>
        <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> -->
        </div>
        <div class="modal-body">
        <div id="divmodalimg">
            
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn bg-orange tx-white font-roboto-bold" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>