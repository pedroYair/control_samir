<?php
	if(isset($_GET['id1']) and isset($_GET['id2']))
	{
		// incluimos la conexion a la bd
		include("../../setup/configuracion.php");
		
		// se verifica que el usuario logueado tenga el rol de administrador
		if(!verificar_seguridad())
		{
			$_SESSION['resp'] = "error_permisos";
			header("Location: ../../index.php?seccion=deudas&accion=listar" );
			die();
		}
	
		$id_deuda = $_GET['id1'];
		$id_servicio = $_GET['id2'];

		// obtenemos la sumatoria del detalle de deuda ante el servicio que se va a eliminar
		$c4 = "SELECT SUM(SUBTOTAL) AS SUB_ELIMINAR FROM detalle_deuda WHERE FK_DEUDA = '$id_deuda' AND FK_SERVICIO = '$id_servicio'";
		$exc4 = mysqli_query($cnx, $c4);

		$subtotal_eliminar = mysqli_fetch_assoc($exc4);
		$subtotal_eliminar = $subtotal_eliminar['SUB_ELIMINAR'];
		
		// eliminamos todos los detalles del servicio seleccionado
		$c5 = "DELETE FROM detalle_deuda WHERE FK_DEUDA = '$id_deuda' AND FK_SERVICIO = '$id_servicio'";
		$exc5 = mysqli_query($cnx, $c5);

		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la eliminacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_eliminar' : 'error_eliminar';

		// si el detalle fue agregado se actualiza el total de la deuda
		if($filas >= 1)
		{
			$c2 = "SELECT TOTAL FROM deuda WHERE ID = '$id_deuda' LIMIT 1";
			$exc2 = mysqli_query($cnx, $c2);

			$total_deuda = mysqli_fetch_assoc($exc2);

			$total_deuda = $total_deuda['TOTAL'];

			$total_deuda -= $subtotal_eliminar;

			$c3 = "UPDATE deuda SET TOTAL = '$total_deuda' WHERE ID = '$id_deuda' LIMIT 1";
			$exc3 = mysqli_query($cnx, $c3);
		}
	}
	
	// regresando a la pagina principal
	header("Location: ../../index.php?seccion=detalle_deudas&accion=agregar" );
	
?>