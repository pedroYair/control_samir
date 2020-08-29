<?php 
	if(isset($_POST['id']) and isset($_POST['email']) and isset($_POST['new_password']))
	{
		$nombre = strtoupper($_POST['nombre']);
		$email = $_POST['email'];
		$nivel = $_POST['nivel'];
		$old_pass = isset($_POST['password']) ? $_POST['password'] : "";
		$new_pass = $_POST['new_password'] != "" ? $_POST['new_password'] : $_POST['password'];
		$estado = isset($_POST['estado']) ? $_POST['estado'] : 1;
		$imagen = str_replace("\\", "/", $_FILES['foto']['tmp_name']);
		$id = $_POST['id'];
		$acceso = isset($_POST['acceso']) ? $_POST['acceso'] : "";
	}

	include( '../../setup/configuracion.php' );

	if($old_pass != "")
	{
		$old_pass = sha1($old_pass);
		$c1 = "SELECT COUNT(ID) AS CANTIDAD FROM usuarios WHERE ID = '$id' AND CLAVE = '$old_pass' LIMIT 1";
		$exc1 = mysqli_query($cnx, $c1);

		$cantidad = mysqli_fetch_assoc($exc1);
		$cantidad = $cantidad['CANTIDAD'];
		$cantidad = is_null($cantidad) ? 0 : $cantidad;

		if($cantidad == 0)
		{
			$_SESSION['resp'] = 'error_clave_old';

		}
	}
	
	if(isset($cantidad) and $cantidad > 0)
	{
		$c = "UPDATE usuarios SET NOMBRE = NULLIF('$nombre', ''),
			ESTADO = '$estado',
			FOTO = LOAD_FILE('$imagen'),
			EMAIL = '$email',
			CLAVE = sha1('$new_pass'),
			NIVEL = '$nivel'
			WHERE ID='$id'
			LIMIT 1";

		$f = mysqli_query($cnx, $c);
	
		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la actualizacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_editar' : 'error_editar';

	}

	if($acceso == "perfil")
	{
		header("Location: ../../index.php?seccion=usuarios&accion=editar&acceso=perfil" );
	}
	else
	{
		header("Location: ../../index.php?seccion=usuarios&accion=listar" );
	}
	
?>