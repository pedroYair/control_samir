<?php
	if(isset($_GET['id']))
	{
		// incluimos la conexion a la bd
		include("../../setup/configuracion.php");
		
		// se verifica que el usuario logueado tenga el rol de administrador
		if(!verificar_seguridad())
		{
			$_SESSION['resp'] = "error_permisos";
			header("Location: ../../index.php?seccion=excedente&accion=listar" );
			die();
		}

		$id = $_GET['id'];
		
		$c5 = "DELETE FROM excedente WHERE ID = '$id' LIMIT 1";
		$exc5 = mysqli_query($cnx, $c5);

		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la eliminacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_eliminar' : 'error_eliminar';
	}
	
	// regresando a la pagina principal
	header("Location: ../../index.php?seccion=excedente&accion=listar");
	
?>