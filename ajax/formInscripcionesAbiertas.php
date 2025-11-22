<?php
    $nivel = "uno";
    if ($nivel == "raiz") {
        require('business/repositories/1cc2s4Home.php');
    } else if ($nivel == "uno") {
        require('../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "dos") {
        require('../../business/repositories/1cc2s4Home.php');
    } else if ($nivel == "tres") {
        require('../../../business/repositories/1cc2s4Home.php');
    }

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $post =  $_POST;
        $nombre = trim($_POST['nombre']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $asunto = trim($_POST['asunto']) ?? '';
        $mensaje = trim($_POST['mensaje']) ?? '';
        $subscribe = isset($_POST['subscribe']) ? true : false;

        // Crear una nueva instancia de DateTime para la fecha y hora actual 
        $datetime = new DateTime();
        // Formatear la fecha en el formato compatible con MySQL 
        $fecha_mysql = $datetime->format('Y-m-d');


        if (!empty($nombre) && !empty($email) && !empty($asunto) && !empty($mensaje) && $subscribe != false && filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $res_sentecia = $mysqli1->query($sentencia . "30");
            while ($row_sentencia = $res_sentecia->fetch_assoc()) {
                $sql_form = $row_sentencia['tablas'] . $row_sentencia['inserciones'];
            }

            $sentencia = $mysqli1->prepare($sql_form);
            $sentencia->bind_param("sssss", $nombre, $email, $asunto, $mensaje, $fecha_mysql);
            if ($sentencia->execute()) {
                $url_solutions = "https://unicab.solutions/email_formulario_inscripcion.php";
                // 1. Codificar los arrays a JSON (Cadenas de texto)
                $data_original_json = json_encode($_POST);
                $params = [
                    'data_original_json' => $data_original_json
                ];
                
                // Usar cURL para hacer la llamada interna
                $ch = curl_init($url_solutions);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // (solo si estás en entorno local de prueba)
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                $respuesta_b = trim(curl_exec($ch));
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                $respuesta_json = json_decode($respuesta_b, true); // el "true" lo convierte en array asociativo
                $respuesta_correo = $respuesta_json['mensaje_correo'];

                // Respuesta de éxito
                echo json_encode([
                    'status' => 'success',
                    'message' => "Datos recibidos correctamente",
                    'respuesta_correo' => $respuesta_correo
                ]);
            }
            else {
                echo json_encode([
                    'status' => 'error'
                ]);
            }
            
        } else {
            http_response_code(400); // Código HTTP 400 (Bad Request)
            echo json_encode([
                'status' => 'error'
            ]);
        }
    } else {
        // Respuesta de error por método no permitido
        http_response_code(405); // Código HTTP 405 (Method Not Allowed)
        echo json_encode([
            'status' => 'error',
            'message' => "Método no permitido"
        ]);
    }
