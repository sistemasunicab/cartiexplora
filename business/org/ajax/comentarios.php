<?php
$nivel = "tres";
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

    $blogId = trim($_POST['id']) ?? '';
    $email = trim($_POST['email']) ?? '';
    $mensaje = trim($_POST['comentario']) ?? '';

    // Crear un DateTime para la fecha actual 
    // Formatear la fecha en el formato MySQL 
    $datetime = new DateTime();
    $fecha = $datetime->format('Y-m-d');


    if (!empty($mensaje) && !empty($email) && !empty($blogId) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $res_sentecia = $mysqli1->query($sentencia . "117");
        while ($row_sentencia = $res_sentecia->fetch_assoc()) {
            $sql_form =  $row_sentencia['tablas'] . $row_sentencia['inserciones'];
        }

        $sentencia = $mysqli1->prepare($sql_form);
        $sentencia->bind_param("ssss", $blogId, $mensaje, $email, $fecha);
        $sentencia->execute();

        // Respuesta de éxito
        echo json_encode([
            'status' => 'success',
            'message' => "Datos recibidos correctamente"
        ]);
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