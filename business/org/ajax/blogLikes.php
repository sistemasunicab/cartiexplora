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
    $liked = trim($_POST['liked']) ?? '0';

    if (!empty($blogId)) {
          if ($liked == '0') {
               $res_sentecia = $mysqli1->query($sentencia . "134");
               while ($row_sentencia = $res_sentecia->fetch_assoc()) {
                   $sql_form =  $row_sentencia['tablas'] . $row_sentencia['modificaciones'] . $row_sentencia['condiciones'];
               }
          
               $sentencia = $mysqli1->prepare($sql_form);
               $sentencia->bind_param("s", $blogId);
               $sentencia->execute();
          
               // Respuesta de éxito
               echo json_encode([
                    'status' => 'success',
                    'message' => "Dislike recibido correctamente"
               ]);
          }elseif ($liked == '1') {
               $res_sentecia = $mysqli1->query($sentencia . "133");
               while ($row_sentencia = $res_sentecia->fetch_assoc()) {
                   $sql_form =  $row_sentencia['tablas'] . $row_sentencia['modificaciones'] . $row_sentencia['condiciones'];
               }
          
               $sentencia = $mysqli1->prepare($sql_form);
               $sentencia->bind_param("s", $blogId);
               $sentencia->execute();
          
               // Respuesta de éxito
               echo json_encode([
                    'status' => 'success',
                    'message' => "Like recibido correctamente"
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