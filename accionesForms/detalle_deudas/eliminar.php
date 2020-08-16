<?php
	if(isset($_GET['id1']) and isset($_GET['id2']))
	{
		// incluimos la conexion a la bd
		include("../../setup/configuracion.php");
		
		// se verifica que el usuario logueado tenga el rol de administrador
		if(!verificar_seguridad())
		{
			die("Error en la solicitud");
		}
	
		$id_deuda = $_GET['id1'];
		$id_servicio = $_GET['id2'];
		
		$sql = "DELETE FROM detalle_deuda WHERE FK_DEUDA = '$id_deuda' AND FK_SERVICIO = '$id_servicio'";
		
		$resp = mysqli_query($cnx, $sql);

		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la eliminacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_eliminar' : 'error_eliminar';
	}
	
	// regresando a la pagina principal
	header("Location: ../../index.php?seccion=detalle_deudas&accion=agregar" );
	
?>