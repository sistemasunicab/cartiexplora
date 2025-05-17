<?php
    include('../../../clases/GenerateQuery.php');

	$nivel = "dos";
	if ($nivel == "raiz") {
		require('repositories/1cc2s4Org.php');
	} else if ($nivel == "uno") {
		require('../repositories/1cc2s4Org.php');
	} else if ($nivel == "dos") {
		$nivel = "tres";
		require('../../repositories/1cc2s4Org.php');
	} else if ($nivel == "tres") {
		require('../../../repositories/1cc2s4Org.php');
	}

    $numero_de_directorio="55";//79
    $res_directorio=$mysqli1->query($sentencia . $numero_de_directorio);
    while ($row_directorio=$res_directorio->fetch_assoc()) {
        $condiciones_directorio=str_replace('|', '\'', $row_directorio['condiciones']);
        $sql_datos_directorio=$row_directorio['campos'] . $row_directorio['tablas'] . $condiciones_directorio;
    }

    $res_datos_directorio=$mysqli1->query($sql_datos_directorio);

    while ($row_datos_directorio=$res_datos_directorio->fetch_assoc()) {
        $html_directorio='<div class="col-9 my-2rem p-0 mx-auto d-flex flex-column">';
        $html_directorio .= '<div class="col-lg-10 col-md-10 col-sm-12 col-12 p-0 mx-auto d-flex flex-column mb-2rem">';
        $html_directorio .= '<div class="d-flex mb-2rem flex-row col-12">';
        $html_directorio .= '<h3 class="tx-blue font-roboto-light-title col-9">' . $row_datos_directorio['titulo'] . '</h3>';
        $html_directorio .= '</div>';
        $html_directorio .= '<div class="col-lg-8 col-md-8 col-sm-12 col-12 mx-auto d-flex flex-column">';
        $html_directorio .= '<h4 class="col-lg-8 col-md-12 col-sm-12 col-12 tx-orange font-roboto-light my-auto text-center mb-4">Escríbenos o Llámanos</h4>';
        $html_directorio .= '<div class="d-flex flex-column flex-md-row justify-content-between">';
        $number_sentence_image="60";//80
        $res_sentence_image=$mysqli1->query($sentencia . $number_sentence_image);

        while ($row_sentence_image=$res_sentence_image->fetch_assoc()) {
            $conditions_image=str_replace('|', '\'', $row_sentence_image['condiciones']);
            $sql_data_image=$row_sentence_image['campos'] . $row_sentence_image['tablas'] . $conditions_image;
        }

        $res_data_image=$mysqli1->query($sql_data_image);
        while ($row_data_image=$res_data_image->fetch_assoc()) {
            $ruta=htmlspecialchars($row_data_image['ruta']);
            $alt=htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen'); // Default alt text

            // Determine the correct path based on the $nivel variable
            $image_path='';
            if ($nivel == "raiz") {
                $image_path=$ruta;
            } else if ($nivel == "uno") {
                $image_path='../' . $ruta;
            } else if ($nivel == "dos") {
                $image_path='../../' . $ruta;
            } else if ($nivel == "tres") {
                $image_path='../../../' . $ruta;
            }
        }
        $number_sentence_image="135";//81
        $res_sentence_image=$mysqli1->query($sentencia . $number_sentence_image);

        while ($row_sentence_image=$res_sentence_image->fetch_assoc()) {
            $conditions_image=str_replace('|', '\'', $row_sentence_image['condiciones']);
            $sql_data_image=$row_sentence_image['campos'] . $row_sentence_image['tablas'] . $conditions_image;
        }
        $res_data_image=$mysqli1->query($sql_data_image);
        while ($row_data_image=$res_data_image->fetch_assoc()) {
            $ruta=htmlspecialchars($row_data_image['ruta']);
            $alt=htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen'); // Default alt text

            // Determine the correct path based on the $nivel variable
            $image_path_contacto='';
            if ($nivel == "raiz") {
                $image_path_contacto=$ruta;
            } else if ($nivel == "uno") {
                $image_path_contacto='../' . $ruta;
            } else if ($nivel == "dos") {
                $image_path_contacto='../../' . $ruta;
            } else if ($nivel == "tres") {
                $image_path_contacto='../../../' . $ruta;
            }
        }
        $html_directorio .= '<div class="position-relative h-auto my-auto d-inline-block col-lg-8 col-md-8 col-sm-12 col-12">';
        $html_directorio .= '<input type="text" id="search" name="search" class="form-control text-center pe-5 border-bold-blue border-2 font-roboto-bold" style="height:80px;" placeholder="Buscar">';
        $html_directorio .= '<img src="' . $image_path . '" class="img-fluid d-md-block d-none position-absolute end-0 top-50 translate-middle-y me-4" alt="Buscar" width="40px">';
        $html_directorio .= '</div>';
        $html_directorio .= '<img src="' . $image_path_contacto . '" class="img-fluid col-lg-2 col-md-2 col-sm-3 col-4 mx-auto mt-md-0 mt-3" alt="Buscar">';
        $html_directorio .= '</div>';
        $html_directorio .= '</div>';   
        $html_directorio .= '</div>';
        
        $number_sentence_table="61";//81
        $res_sentence_table=$mysqli1->query($sentencia . $number_sentence_table);

        $icons=[];

        while ($row_sentence_table=$res_sentence_table->fetch_assoc()) {
            $conditions_table=str_replace('|', '\'', $row_sentence_table['condiciones']);
            $sql_data_table=$row_sentence_table['campos'] . $row_sentence_table['tablas'] . $conditions_table;
        }

        // Ejecutamos la consulta para obtener las imágenes de los encabezados
        $res_icons=$mysqli1->query($sql_data_table);

        while ($row_icon=$res_icons->fetch_assoc()) {
            // Determinar la ruta correcta de la imagen según el nivel
            $ruta=htmlspecialchars($row_icon['ruta']);
            $titulo=htmlspecialchars($row_icon['titulo']); // Nombre del encabezado

            if ($nivel == "raiz") {
                $image_path=$ruta;
            } else if ($nivel == "uno") {
                $image_path='../' . $ruta;
            } else if ($nivel == "dos") {
                $image_path='../../' . $ruta;
            } else if ($nivel == "tres") {
                $image_path='../../../' . $ruta;
            }

            // Guardamos la información en un array asociativo
            $icons[]=['path' => $image_path, 'title' => $titulo];
        }

        // Aquí agregamos un div que manejará el overflow
        $html_directorio .= '<div class="table-responsive-md my-2rem">'; // Bootstrap tiene esta clase lista para ti
        $html_directorio .= '<table id="datos-empelados" class="table table-bordered text-center">';
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

        $number_sentence_image="104";
        $res_sentence_image=$mysqli1->query($sentencia . $number_sentence_image);

        while ($row_sentence_image=$res_sentence_image->fetch_assoc()) {
            $conditions_image=str_replace('|', '\'', $row_sentence_image['condiciones']);
            $sql_data_image=$row_sentence_image['campos'] . $row_sentence_image['tablas'] . $conditions_image;
        }
        $res_data_image=$mysqli1->query($sql_data_image);

        while ($row_data_image=$res_data_image->fetch_assoc()) {
            
            $ruta=htmlspecialchars($row_data_image['ruta']);
            $alt=htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen'); // Default alt text
            $titulo=$row_data_image['titulo'] ; // Default description
            // Determine the correct path based on the $nivel variable
            $image_path='';
            if ($nivel == "raiz") {
                $image_path=$ruta;
            } else if ($nivel == "uno") {
                $image_path='../' . $ruta;
            } else if ($nivel == "dos") {
                $image_path='../../' . $ruta;
            } else if ($nivel == "tres") {
                $image_path='../../../' . $ruta;
            }
        }
        $html_directorio .= '<div id="horarios" class="col-10 my-2rem p-0 mx-auto d-flex flex-md-row flex-column justify-content-between">';
        $html_directorio .= '<div class="mb-md-0 mx-auto ms-md-0 col-lg-5 col-md-5 col-sm-8 col-12 d-flex flex-column">';
        $html_directorio .= '<img src="' . $image_path . '" class="h-auto" alt="' . $alt . '">';
        $html_directorio .= '</div>';
        $html_directorio .= '<p class="col-lg-6 col-md-6 col-sm-12 col-12 text-center text-md-start my-auto"><b>' . $titulo . '</b></p>';
        $html_directorio .= '</div>';
        
        $html_directorio .= '</div>';

    }
?>

<div class="container-fluid m-0 p-0">
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