<?php
	if(isset($_GET['id']))
	{
		// incluimos la conexion a la bd
		include("../../setup/configuracion.php");
		
		// se verifica que el usuario logueado tenga el rol de administrador
		if(!verificar_seguridad())
		{
			$_SESSION['resp'] = "error_permisos";
			header("Location: ../../index.php?seccion=ventas_recargas&accion=listar" );
			die();
		}

		$id_venta = $_GET['id'];
		
		$c5 = "DELETE FROM ventas_recargas WHERE ID = '$id_venta' LIMIT 1";
		$exc5 = mysqli_query($cnx, $c5);

		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la eliminacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_eliminar_venta' : 'error_eliminar_venta';
	}
	
	// regresando a la pagina principal
	header("Location: ../../index.php?seccion=ventas_recargas&accion=listar");
	
?>