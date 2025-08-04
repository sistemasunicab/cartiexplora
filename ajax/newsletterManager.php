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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/bookstores/PHPMailer-master/src/Exception.php';
require '../assets/bookstores/PHPMailer-master/src/PHPMailer.php';
require '../assets/bookstores/PHPMailer-master/src/SMTP.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $correo = trim($_POST['correo']) ?? '';
    $suscripcion = trim($_POST['suscripcion']) ?? 'false';

    if ($suscripcion == 'true' && !empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $estaRegistrado = false;
        $mail = new PHPMailer(true);

        // Verificando si existe el correo ya en base de datos.
        $sentencia_verificacion = $mysqli1->query($sentencia."158");//159
        while($row_sentencia = $sentencia_verificacion->fetch_assoc()){
             $datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('?', '\''.$correo.'\'', $row_sentencia['condiciones']);
        }  

        $respuesta = $mysqli1->query($datos);
        if ($respuesta && $respuesta->num_rows > 0) {
            echo json_encode([
                'status' => 'error',
                'message' => "El correo ya esta registrado."
            ]);

            $estaRegistrado = true;
        }

        if ($estaRegistrado == false) {
            try {
                // obteniendo informacion principal
                $res_sentencia = $mysqli1->query($sentencia."154");//155
                while($row_sentencia = $res_sentencia->fetch_assoc()){
                     $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
                }     
                $res_datos_seccion = $mysqli1->query($sql_datos);

                // Obteniendo los textos
                $res_sentencia = $mysqli1->query($sentencia."156");//157
                while($row_sentencia = $res_sentencia->fetch_assoc()){
                     $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
                }  

                $res_datos = $mysqli1->query($sql_datos);
                while($row_datos = $res_datos->fetch_assoc()){
                     $textosNewsletter[] = $row_datos['texto'];
                }   

                // Obteniendo los textos
                $res_sentencia = $mysqli1->query($sentencia."157");//158
                while($row_sentencia = $res_sentencia->fetch_assoc()){
                     $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
                }  

                $res_datos = $mysqli1->query($sql_datos);
                while($row_datos = $res_datos->fetch_assoc()){
                     $rutasImagenes[] = $row_datos['ruta'];
                }   

                // Obteniendo los enlaces
                $res_sentencia = $mysqli1->query($sentencia."159");//160
                while($row_sentencia = $res_sentencia->fetch_assoc()){
                     $sql_datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('|', '\'', $row_sentencia['condiciones']);
                }  
                $enlacesNewsletter = [];

                $res_datos = $mysqli1->query($sql_datos);
                while($row_datos = $res_datos->fetch_assoc()){
                    $enlacesNewsletter[] = $row_datos['link'];
                }   

                $enlaceHome = array_shift($enlacesNewsletter);
                $enlaceCancelarSuscripcion = array_shift($enlacesNewsletter);
                

                $mail->isSMTP();                                            
                $mail->SMTPDebug= 0;										
                $mail->Host     = 'smtp.hostinger.com';                    
                $mail->SMTPAuth = true;
                $mail->Username = 'webmaster@unicab.solutions';
                $mail->Password = 'JsNp4321*';
                $mail->Port     = 587;
            
                $mail->CharSet  = 'UTF-8';
                $mail->Encoding = 'base64';
            
                // Remitente y destinatario
                $mail->setFrom('webmaster@unicab.solutions', 'Newsletter UNICAB');
                $mail->addAddress($correo);
            
                // Contenido del correo
                $mail->isHTML(true);

                $mail->AddEmbeddedImage('../'.array_shift($rutasImagenes).'', 'logo_unicab');
                $mail->AddEmbeddedImage('../'.array_shift($rutasImagenes).'', 'chico_inscrito');
                $mail->AddEmbeddedImage('../'.array_shift($rutasImagenes).'', 'icono_publicaciones');
                $mail->AddEmbeddedImage('../'.array_shift($rutasImagenes).'', 'icono_noticias');
                $mail->AddEmbeddedImage('../'.array_shift($rutasImagenes).'', 'icono_eventos');
                $mail->AddEmbeddedImage('../'.array_shift($rutasImagenes).'', 'icono_herramientas');


                while($row_datos = $res_datos_seccion->fetch_assoc()) {
                    $mail->Body = '
                    <body style="margin:0; padding:0; font-family:Arial, sans-serif; background-color:#ffffff;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="center">

                                    <!-- Contenedor principal -->
                                    <table width="860px" cellpadding="0" cellspacing="0" border="0" style="max-width:860px;">

                                        <!-- Logo -->
                                        <tr>
                                            <td style="padding: 10px 0;" align="left">
                                                <a style="display: block;" href="'.$enlaceHome.'">
                                                    <img src="cid:logo_unicab" alt="" width="150px" style="display:block;">
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Texto principal -->
                                        <tr>
                                            <td align="center" style="padding: 10px 30px; font-size: 22px; line-height: 1.4; color:#000;">
                                                '.$row_datos['titulo'].'
                                            </td>
                                        </tr>

                                        <!-- Gracias por suscribirte -->
                                        <tr>
                                            <td align="center" style="padding: 10px 30px; font-size: 16px; color:#0B77B3; font-weight:bold;">
                                                '.$row_datos['subTitulo'].'
                                            </td>
                                        </tr>

                                        <!-- Contenedor azul -->
                                        <tr>
                                            <td align="center">
                                                <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#16224F; border-radius: 100px 100px 0 100px;">
                                                    <tr>
                                                        <!-- Columna izquierda: texto -->
                                                        <td style="padding:30px;">
                                                            <div width="60%" valign="top" style="color:#FFCE55; font-size:18px; font-style:italic; padding-right:20px;">
                                                                <div style="margin-bottom:15px;">'.$row_datos['texto'].'</div>

                                                                <div style="color:#ffffff; font-size:16px; font-weight:bold; margin:10px 0;">
                                                                    <img src="cid:icono_publicaciones" alt="" width="20" style="vertical-align:middle; margin-right:10px;">
                                                                    '.array_shift($textosNewsletter).'
                                                                </div>

                                                                <div style="color:#ffffff; font-size:16px; font-weight:bold; margin:10px 0;">
                                                                    <img src="cid:icono_noticias" alt="" width="20" style="vertical-align:middle; margin-right:10px;">
                                                                    '.array_shift($textosNewsletter).'
                                                                </div>

                                                                <div style="color:#ffffff; font-size:16px; font-weight:bold; margin:10px 0;">
                                                                    <img src="cid:icono_eventos" alt="" width="20" style="vertical-align:middle; margin-right:10px;">
                                                                    '.array_shift($textosNewsletter).'
                                                                </div>

                                                                <div style="color:#ffffff; font-size:16px; font-weight:bold; margin:10px 0;">
                                                                    <img src="cid:icono_herramientas" alt="" width="20" style="vertical-align:middle; margin-right:10px;">
                                                                    '.array_shift($textosNewsletter).'
                                                                </div>

                                                                <div style="font-style:italic; color:#FFCE55; font-size:14px; margin-top:20px;">
                                                                    '.array_shift($textosNewsletter).'
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <!-- Columna derecha: imagen del chico -->
                                                        <td width="40%" valign="bottom" align="right">
                                                            <a style="display: block;" href="'.$enlaceHome.'">
                                                                <img src="cid:chico_inscrito" alt="" width="100%" style="display:block;">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Texto de cierre -->
                                        <tr>
                                            <td align="center" style="padding: 20px 30px 0; font-size:14px; font-style:italic; color:#444;">
                                                <hr style="border:0; border-top:2px solid #F2C94C; width:80%; margin-bottom:10px;">
                                                '.array_shift($textosNewsletter).'
                                            </td>
                                        </tr>

                                        <!-- Footer -->
                                        <tr>
                                            <td>
                                                <table width="100%">
                                                    <tr>
                                                        <td align="center" style="padding: 20px; font-size:14px; color:#444;">
                                                            <div align="center">
                                                                <a href="'.$enlaceHome.'" style="color: #000000; text-decoration: none;">🌐'.array_shift($textosNewsletter).'</a>
                                                            </div>

                                                            <div>
                                                                '.str_replace('?', $enlaceCancelarSuscripcion, array_shift($textosNewsletter)).'
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                    ';

                    // el ultimo texto siempre sera el asunto
                    $mail->Subject = array_shift($textosNewsletter);
                }

                $mail->send();

                $res_sentecia = $mysqli1->query($sentencia . "152");//153
                while ($row_sentencia = $res_sentecia->fetch_assoc()) {
                    $sql_form = $row_sentencia['tablas'] . $row_sentencia['inserciones'];
                }

                $sentencia = $mysqli1->prepare($sql_form);
                $sentencia->bind_param("s", $correo);
                $sentencia->execute();

                echo json_encode([
                    'status' => 'success',
                    'message' => "El correo se envio correctamente."
                ]);

            } catch (Exception $e) {
                http_response_code(400); // Código HTTP 400 (Bad Request)
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No se pudo enviar el correo.',
                    'errorInfo' => $mail->ErrorInfo
                ]);
            }
        }
    } elseif ($suscripcion == 'false' && !empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        
        // Verificando si existe el correo ya en base de datos.
        $sentencia_verificacion = $mysqli1->query($sentencia."158");//159
        while($row_sentencia = $sentencia_verificacion->fetch_assoc()){
             $datos = $row_sentencia['campos'].$row_sentencia['tablas'].str_replace('?', '\''.$correo.'\'', $row_sentencia['condiciones']);
        }  

        $respuesta = $mysqli1->query($datos);
        if ($respuesta && $respuesta->num_rows > 0) {
            while($row_datos = $respuesta->fetch_assoc()){
                $correoId = $row_datos['id'];
                $correo = $row_datos['correo'];
            }   

            $res_sentecia = $mysqli1->query($sentencia . "166");//153
            while ($row_sentencia = $res_sentecia->fetch_assoc()) {
                $sql_form = $row_sentencia['campos'].$row_sentencia['tablas'].$row_sentencia['condiciones'];
            }

            $sentencia = $mysqli1->prepare($sql_form);
            $sentencia->bind_param("ss", $correoId, $correo);
            $sentencia->execute();

            echo json_encode([
                'status' => 'success',
                'message' => "Correo desuscrito con éxito."
            ]);
        }

    } else {
        http_response_code(400); // Código HTTP 400 (Bad Request)
        echo json_encode([
            'status' => 'error',
            'errorInfo' => 'Bad Request'
        ]);
    }
} else {
    // Respuesta de error por método no permitido
    http_response_code(405); // Código HTTP 405 (Method Not Allowed)
    echo json_encode([
        'status' => 'error',
        'message' => "Método no permitido",
        'errorInfo' => 'Not Allowed'
    ]);
}
?>