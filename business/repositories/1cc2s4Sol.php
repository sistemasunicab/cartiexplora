<?php
    //echo $nivel;
    if ($nivel == "raiz") {
        require_once('clases/DevCoder/DotEnv.php');
        (new \clases\DevCoder\DotEnv('.env'))->load();
    }
    else if ($nivel == "uno") {
        require_once('../clases/DevCoder/DotEnv.php');
        (new \clases\DevCoder\DotEnv('../.env'))->load();
    }
    else if ($nivel == "dos") {
        require_once('../../clases/DevCoder/DotEnv.php');
        (new \clases\DevCoder\DotEnv('../../.env'))->load();
    }
    else if ($nivel == "tres") {
        require_once('../../../clases/DevCoder/DotEnv.php');
        (new \clases\DevCoder\DotEnv('../../../.env'))->load();
    }
    
    if (getenv('APP_ENV') == "local") {
        $mysqli1 = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME_L'), getenv('DB_PASSWORD_L'), getenv('DB_DATABASE_U_SOLUTIONS'), getenv('DB_PORT'));
    }
    else if (getenv('APP_ENV') == "pro") {
        $mysqli1 = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME_PUS'), getenv('DB_PASSWORD_PUS'), getenv('DB_DATABASE_U_SOLUTIONS'));
    }
    
	if(mysqli_connect_error()) {
        echo mb_convert_encoding("Error al conectar con base de datos unicab solutions:", 'UTF-8'),mysqli_connect_error();
        exit();
    }
    else {
        //echo "Conexión exitosa";
    }
    
    $mysqli1->set_charset("utf8");
    $sentencia = str_replace('-', ' ', getenv('SENTENCIA_SQL'))." = ";
?>