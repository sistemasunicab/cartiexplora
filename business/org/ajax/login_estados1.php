 <html>
 <head>
 <meta http-equiv="content-type" content="text/html" />
 <meta charset="UTF-8">
 </head>
 </html>
<?php
    session_start();
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

	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
	set_time_limit(300);

    try {
		$usuario = $_POST['correo'];
		$password = $_POST['contraseña'];
		//echo $usuario;
		//echo $password;

		/*$sql="SELECT * FROM tbl_empleados WHERE email = '".$usuario."' and n_documento = '".$password."' AND estado = 'activo'";*/
		$sentenciaFinal = $sentencia2."'autorizados para estados financieros'";
		$valores = [
			'_usuario*' => $usuario,
			'_pass*' => $password,
			'_estado*' => 'activo'
		];
		$sql = GenerateQuery::querySql($mysqli2, $sentenciaFinal, $valores);
		//echo $sql_grado;
		$petecion = $mysqli2->query($sql);
		$total = $petecion->num_rows;
		
		//echo $sql;
		if ($total > 0) {
			while($row = $petecion->fetch_assoc()) {
				$_SESSION['email'] = $usuario;
				$_SESSION['perfil'] = $row['perfil'];
				
				$_SESSION['est_fin'] = $usuario;
				$_SESSION['nombre'] = $row['nombres']." ".$row['apellidos'];				
				
				//echo "<script>location.href='../../login_registro.php';</script>";
				//se direcciona según el perfil
				if($_SESSION['perfil'] == "AR_AW" || $_SESSION['perfil'] == "FI" || $_SESSION['perfil'] == "SU") {
				    echo "<script>alert('Bienvenido(a) ".$row['nombres']." ".$row['apellidos']."');</script>";
				    echo "<script>location.href='../pages/estadosFinancieros_1.php';</script>";
				}
				else {
				    echo "<script>alert('Usuario no autorizado');</script>";
				    echo "<script>location.href='../pages/estadosFinancieros.php';</script>";
				}
			}

			/*while ($row = mysqli_fetch_array($petecion)) {
				$_SESSION['email'] = $usuario;
				$_SESSION['perfil'] = $row['perfil'];
				
				$_SESSION['est_fin'] = $usuario;
				$_SESSION['nombre'] = $row['nombres']." ".$row['apellidos'];
				
				
				//echo "<script>location.href='../../login_registro.php';</script>";
				//se direcciona según el perfil
				if($_SESSION['perfil'] == "AR_AW" || $_SESSION['perfil'] == "FI" || $_SESSION['perfil'] == "SU") {
				    echo "<script>alert('Bienvenido(a) ".$row['nombres']." ".$row['apellidos']."');</script>";
				    echo "<script>location.href='../../../est_fin.php';</script>";
				}
				else {
				    echo "<script>alert('Usuario no autorizado');</script>";
				    echo "<script>location.href='../../../login_estados.php';</script>";
				}
			}*/
		}else{
			echo "<script>alert('Usuario no encontrado');</script>";
			echo "<script>location.href='../pages/estadosFinancieros.php'</script>";
		}
	} catch (Exception $e) {
			echo "<script>alert('intentelo más tarde');</script>";
			echo "<script>location.href='../pages/estadosFinancieros.php'</script>";
	}
?>
