<?php
function capitalizarInicial($texto) {
    $texto = mb_strtolower($texto, 'UTF-8');
    $longitud = mb_strlen($texto, 'UTF-8');
    for ($i = 0; $i < $longitud; $i++) {
        $char = mb_substr($texto, $i, 1, 'UTF-8');
        // Si es una letra alfabética
        if (preg_match('/\p{L}/u', $char)) {
            $letraMayus = mb_strtoupper($char, 'UTF-8');
            return mb_substr($texto, 0, $i, 'UTF-8') . $letraMayus . mb_substr($texto, $i + 1, null, 'UTF-8');
        }
     }
    return $texto;
}
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

    $blogId = intval(trim($_POST['id'])) ?? 0;

    if (!empty($blogId)) {
          // comentarios de este blog
          $res_sentencia = $mysqli1->query($sentencia."118");
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$blogId;
          }  

          $res_datos = $mysqli1->query($sql_datos);
          $comentarios = [];

          while($row_datos = $res_datos->fetch_assoc()){
               $comentarios[] = [
                    'comentario' => $row_datos['comentario'],
                    'correo' => $row_datos['correo'],
                    'fecha' => $row_datos['fecha']
               ];
          } 

          // Obteniendo blog para mostrar
          $res_sentencia = $mysqli1->query($sentencia."116");
          while($row_sentencia = $res_sentencia->fetch_assoc()){
               $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']).$blogId;
          }  
     
          $res_datos = $mysqli1->query($sql_datos);
          while($row_datos = $res_datos->fetch_assoc()){
               $showBlog = [
                    'status' => 'success',
                    'imagen' => $row_datos['imagen'],
                    'fecha' => $row_datos['fechaPublicacion'],
                    'descripcion' => $row_datos['descripcionPrincipal'], 
                    'titulo' => capitalizarInicial($row_datos['titulo']),
                    'autor' => $row_datos['autor'],
                    'comentarios' => $comentarios,
                    'id' => $blogId
               ];
          }
     
          // Respuesta de éxito
          echo json_encode($showBlog);
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