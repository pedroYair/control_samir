<?php
	if(isset($_GET['id']))
	{
		// incluimos la conexion a la bd
		include("../../setup/configuracion.php");
		
		// se verifica que el usuario logueado tenga el rol de administrador
		if(!verificar_seguridad())
		{
			die("Error en la solicitud");
		}
	
		$id = $_GET['id'];
		
		$sql = "UPDATE usuarios SET ESTADO = '0' WHERE ID = '$id' LIMIT 1";
		
		$resp = mysqli_query($cnx, $sql);

		echo mysqli_error($cnx);

		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la eliminacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_eliminar' : 'error_eliminar';
	}
	
	// regresando a la pagina principal
	header("Location: ../../index.php?seccion=usuarios&accion=listar" );
	
?>