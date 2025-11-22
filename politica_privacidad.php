<?php 
    $nivel = "raiz";
    $page_title = "Política de Privacidad - Uniconecta";
    include('components/headMain.php');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Política de Privacidad - Uniconecta</title>
        <!-- https://unicab.org/homeunicabpro/politica_privacidad.php -->
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                margin: 20px;
                color: #333;
            }
            h1, h2 {
                color: #2c3e50;
            }
            h1 {
                text-align: center;
            }
            .container {
                max-width: 800px;
                margin: auto;
                background: #f9f9f9;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
        </style>
    </head>
    <body>

        <?php 
            $nivel = "raiz";
            include('components/navBar.php');
        ?>

        <div class="container">
            <h1>Política de Privacidad</h1><br>
            <h2>Aplicación Uniconecta</h2><br>
            <!--<p><strong>Fecha de vigencia:</strong> [Fecha de hoy, por ejemplo: 12 de septiembre de 2025]</p>-->

            <p>Esta Política de Privacidad rige el uso de la aplicación móvil de UNICAB Colegio Virtual (en adelante, "Uniconecta"). La presente política describe cómo recopilamos, utilizamos y protegemos la información personal de nuestros usuarios.</p>
            <br>
            <h3>1. Información que Recopilamos</h3>
            <p>Para el correcto funcionamiento de la Aplicación, recopilamos la siguiente información personal:</p>
            <ul>
                <li><strong>Información de inicio de sesión:</strong> Email del usuario y contraseña para autenticar el acceso.</li>
                <li><strong>Datos del usuario para registrarse:</strong> Nombre completo, fecha de cumpleaños, ciudad de residencia, rol, email, qué lugares ha visitado o le gustaría visitar, razón por la cual elige a UNICAB, foto de perfil y contraseña.</li>
                
            </ul><br>

            <h3>2. Cómo Utilizamos la Información</h3>
            <p>Utilizamos la información recopilada para los siguientes propósitos:</p>
            <ul>
                <li>Para gestionar el acceso y la autenticación de los usuarios.</li>
                <li>Para mostrar el estado académico, financiero y de seguimiento del estudiante.</li>
                <li>Para mejorar y optimizar la funcionalidad y la experiencia del usuario dentro de la Aplicación.</li>
                <li>Para enviar notificaciones relacionadas con la reasignación de la contraseña en caso de olvido.</li>
            </ul><br>

            <h3>3. Divulgación de la Información a Terceros</h3>
            <p>No vendemos, intercambiamos, ni transferimos a terceros la información de identificación personal de nuestros usuarios..</p>

            <br>
            <h3>4. Seguridad de los Datos</h3>
            <!--<p>Implementamos diversas medidas de seguridad para proteger su información personal. Los datos se almacenan en servidores seguros y utilizamos <strong>cifrado SSL/TLS</strong> para proteger la transmisión de datos sensibles.</p>-->
			<p>Para proteger su información personal. Los datos se almacenan en servidores seguros.</p>

            <br>
            <h3>5. Derechos del Usuario</h3>
            <p>Los usuarios tienen derecho a solicitar el acceso, corrección o eliminación de su información personal, de acuerdo con la política de gestión de datos del colegio. Para ejercer estos derechos, deben contactar directamente con el departamento administrativo del colegio.</p>

            <br>
            <h3>6. Cambios en la Política de Privacidad</h3>
            <p>Nos reservamos el derecho de actualizar esta política de privacidad en cualquier momento. Notificaremos a los usuarios de cualquier cambio publicando la nueva Política de Privacidad en esta página.</p>

            <br>
            <h3>7. Contacto</h3>
            <p>Si tiene alguna pregunta sobre esta Política de Privacidad, puede contactarnos a través de la siguiente dirección de correo electrónico:</p>
            <p><strong>Correo electrónico:</strong> webmasterunicab@unicab.org</p><br>
            <p>Última actualización: Septiembre de 2025 </p>
        </div>

        <?php 
            $nivel = "raiz";
            include('components/footer.php');
        ?>

    </body>
</html>