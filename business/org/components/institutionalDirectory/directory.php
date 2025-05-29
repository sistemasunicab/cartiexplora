<?php

    $datosDirectorio = obtenerFilas($mysqli1, $sentencia, 55);
    foreach ($datosDirectorio as $row_datos_directorio) {
        $html_directorio='<div class="col-9 p-0 mx-auto d-flex flex-column">';
        $html_directorio .= '<div class="col-lg-12 col-md-10 col-sm-12 col-12 p-0 mx-auto d-flex flex-column">';
        $html_directorio .= '<div class="row d-flex flex-row col-12">';
        $html_directorio .= '<h3-directory class="tx-blue font-roboto-light-title col-lg-5 col-12">' . $row_datos_directorio['titulo'] . '</h3-directory>';
        $html_directorio .= '</div>';
        $html_directorio .= '<div class="row col-lg-8 col-md-8 col-sm-12 col-12 mx-auto mt-lg-5 mt-4 d-flex flex-column">';
        $html_directorio .= '<h4-directory class="col-lg-8 col-md-12 col-sm-12 col-12 tx-orange font-roboto-light my-auto text-center mb-2">Escríbenos o Llámanos</h4-directory>';
        $html_directorio .= '<div class="d-flex flex-column flex-lg-row justify-content-between">';
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
        $html_directorio .= '<div class="position-relative h-auto my-auto d-inline-block col-lg-8 col-md-12 col-sm-12 col-12">';
        $html_directorio .= '<input type="text" id="search" name="search" class="search form-control text-center pe-lg-5 px-2 border-bold-blue border-2 font-roboto-bolditalic" style="height:80px;" placeholder="Buscar">';
        $html_directorio .= '<img src="' . $image_path . '" class="img-fluid d-lg-block d-none position-absolute end-0 top-50 translate-middle-y me-4" alt="Buscar" width="52px">';
        $html_directorio .= '</div>';
        $html_directorio .= '<img src="' . $image_path_contacto . '" class="img-fluid logo-buscar mx-auto mt-lg-0 mt-3" alt="Buscar">';
        $html_directorio .= '</div>';
        $html_directorio .= '</div>';   
        $html_directorio .= '</div>';
        
        $datosEncabezados = obtenerFilas($mysqli1, $sentencia, 61);
        $icons = [];
        foreach ($datosEncabezados as $row_icon) {
            $ruta   = $row_icon['ruta'];
            $titulo = $row_icon['titulo'];
            $image_path = rutaPorNivel($ruta);
            $icons[] = ['path' => $image_path, 'title' => $titulo];
        }

        // Aquí agregamos un div que manejará el overflow
        $html_directorio .= '<div class="custom-table table-responsive-lg mt-ws">'; // Bootstrap tiene esta clase lista para ti
        $html_directorio .= '<table id="datos-empelados" class="table table-bordered text-center my-0">';
        $html_directorio .= '<thead class="bg-bold-blue text-white">';
        $html_directorio .= '<tr>';

        // Generar los encabezados dinámicamente con los íconos obtenidos
        foreach ($icons as $icon) {
            $html_directorio .= '<th>
                                    <div class="d-flex flex-row align-items-center justify-content-center">
                                        <img class="me-3" src="' . $icon['path'] . '" width="30px"> ' . $icon['title'] . '
                                    </div>
                                </th>';
        }
        $html_directorio .= '</tr>';
        $html_directorio .= '</thead>';
        $html_directorio .= '<tbody>';

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
                    $html_directorio .= "
                        <tr>
                            <td>".$row_directorio['nombres']." ".$row_directorio['apellidos']."</td>
                            <td>".$row_directorio['dependencia']."</td>
                            <td>".$row_directorio['email']."</td>
                            <td>".$row_directorio['cargo']."</td>
                            <td>".$row_directorio['celular']."</td>
                        </tr>";
                }
                else {
                    $imagen = substr($row_directorio['infografia'], 9);
                    $html_directorio .= "
                        <tr>
                            <td>".$row_directorio['nombres']." ".$row_directorio['apellidos']."</td>
                            <td>".$row_directorio['dependencia']."</td>
                            <td>".$row_directorio['email']."</td>
                            <td>".$row_directorio['cargo']."</td>
                            <td><button class='btn btn-info btn-lg' onclick='verInfografia(\"".$imagen."\")'>VER</button></td>
                        </tr>";
                }                
            }
            else {
                $html_directorio .= "
                    <tr>
                        <td>".$row_directorio['nombres']." ".$row_directorio['apellidos']."</td>
                        <td>".$row_directorio['dependencia']."</td>
                        <td>".$row_directorio['email']."</td>
                        <td>".$row_directorio['cargo']."</td>
                        <td>".$row_directorio['celular']."</td>
                    </tr>";
            }
        }

        $html_directorio .= '</tbody>';
        $html_directorio .= '</table>';
        $html_directorio .= '</div>'; // Cierre del div de la tabla-responsive

        // Obtenemos los datos de la imagen de horario usando la función auxiliar:
        $datosImagenHorario = obtenerFilas($mysqli1, $sentencia, 104);
        foreach ($datosImagenHorario as $row_data_image) {
            $ruta   = htmlspecialchars($row_data_image['ruta']);
            $alt    = htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen');
            $titulo = $row_data_image['titulo'];
            $image_path = rutaPorNivel($ruta);
        }
        $html_directorio .= '<div id="horarios" class="row col-10 mt-ws p-0 mx-auto d-flex flex-lg-row flex-column justify-content-between">';
        $html_directorio .= '<div class="col-lg-6 col-md-12 col-sm-12 col-12 mb-md-0 mx-auto ms-lg-0 d-flex flex-column">';
        $html_directorio .= '<img src="' . $image_path . '" class="img-horario" alt="' . $alt . '">';
        $html_directorio .= '</div>';
        $html_directorio .= '<p-directory class="col-lg-6 col-md-12 col-sm-12 col-12 text-center text-lg-start my-lg-auto mt-3"><b>' . $titulo . '</b></p-directory >';
        $html_directorio .= '</div>';
        
        $html_directorio .= '</div>';

    }
?>

<div class="container-fluid my-ws mx-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_directorio;
        ?>
    </div>
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