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
        <title>Eliminar Cuenta - Uniconecta</title>
        <!--https://unicab.org/homeunicabpro/politica_privacidad.php-->
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
            <h1>Eliminación de Cuenta</h1><br>
            <h2>Aplicación Uniconecta</h2><br>
            
            <p>Para solicitar la eliminación de la cuenta de usuario y los datos asociados en la aplicación Uniconecta puede hacerlo por alguna de las dos siguientes opciones:</p>
            <br>
            <h3>1. Directamente desde la aplicación</h3><br>
            <p>Una vez se inice sesión en la aplicación Uniconecta, al hacer clic en la imagen de pérfil que está en la parte superior derecha, se mostrará un menu con la opción "Eliminar cuenta", como se muestra en la siguiente imagen</p>
			<br>
			<img src="https://unicab.org/uniconecta/assets/img/eliminar1.png"><br><br>
            <p>Luego aparecerá un mensaje de confirmación</p><br>
			<img src="https://unicab.org/uniconecta/assets/img/eliminar2.png"><br><br>

            <h3>2. Solicitando la eliminación de la cuenta de usuario y los datos asociados en la aplicación Uniconecta a través del correo electrónico: webmasterunicab@unicab.org <br> e ingresando en el asunto: <strong>"Eliminar Cuenta De Usuario App Uniconecta"</strong></h3>
			<br>			
            <p><a href="mailto:webmasterunicab@unicab.org?Subject=Eliminar%20Cuenta%20De%20Usuario%20App%20Uniconecta" class="btn btn-success">Enviar correo</a></p><br>
            
            <p>Última actualización: Septiembre de 2025 </p>
        </div>

        <?php 
            $nivel = "raiz";
            include('components/footer.php');
        ?>

    </body>
</html>