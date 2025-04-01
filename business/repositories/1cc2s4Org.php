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
        $mysqli2 = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME_L'), getenv('DB_PASSWORD_L'), getenv('DB_DATABASE_ORG'), getenv('DB_PORT'));
    }
    else if (getenv('APP_ENV') == "pro") {
        $mysqli2 = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME_ORG'), getenv('DB_PASSWORD_ORG'), getenv('DB_DATABASE_ORG'));
    }
    
	if(mysqli_connect_error()) {
        echo mb_convert_encoding("Error al conectar con base de datos unicab org:", 'UTF-8'),mysqli_connect_error();
        exit();
    }
    else {
        //echo "Conexión exitosa";
    }
    
    $mysqli2->set_charset("utf8");
    $sentencia2 = str_replace('-', ' ', getenv('SENTENCIA_PROCESO_SQL'))." = ";
?>