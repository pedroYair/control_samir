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

		$id_venta = $_GET['id1'];
		$id_servicio = $_GET['id2'];

		// obtener servicio
		$c_servicio = "SELECT SERVICIO FROM servicios WHERE ID = '$id_servicio' LIMIT 1";
		$exc_servicio = mysqli_query($cnx, $c_servicio);
		$servicio = mysqli_fetch_assoc($exc_servicio);
		$servicio = $servicio['SERVICIO'];

		// obtenemos la sumatoria del detalle de deuda ante el servicio que se va a eliminar
		$c4 = "SELECT SUM(SUBTOTAL) AS SUB_ELIMINAR FROM detalle_venta WHERE FK_VENTA = '$id_venta' AND FK_SERVICIO = '$id_servicio'";
		$exc4 = mysqli_query($cnx, $c4);

		$subtotal_eliminar = mysqli_fetch_assoc($exc4);
		$subtotal_eliminar = $subtotal_eliminar['SUB_ELIMINAR'];
		
		// eliminamos todos los detalles del servicio seleccionado
		$c5 = "DELETE FROM detalle_venta WHERE FK_VENTA = '$id_venta' AND FK_SERVICIO = '$id_servicio'";
		$exc5 = mysqli_query($cnx, $c5);

		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la eliminacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_eliminar' : 'error_eliminar';

		// si el detalle fue agregado se actualiza el total de la deuda
		if($filas >= 1)
		{
			if($servicio != "CAJA REAL" and $servicio != "INVERSIONES")
			{
				$c3 = "UPDATE ventas SET TOTAL_DIA = TOTAL_DIA - '$subtotal_eliminar', TOTAL_ESPERADO = TOTAL_ESPERADO - '$subtotal_eliminar' WHERE ID = '$id_venta' LIMIT 1";
				$exc3 = mysqli_query($cnx, $c3);

				if($servicio == "DEUDAS CANCELADAS")
				{
					$c6 = "UPDATE ventas SET DEUDAS_CANCEL = '0' WHERE ID = '$id_venta' LIMIT 1";
					$exc6 = mysqli_query($cnx, $c6);

				}
			}
			else
			{
				if($servicio == "INVERSIONES")
				{
					$c4 = "UPDATE ventas SET TOTAL_ESPERADO = TOTAL_ESPERADO - '$subtotal_eliminar', INVERSIONES = '0' WHERE ID = '$id_venta' LIMIT 1";
					$exc4 = mysqli_query($cnx, $c4);
				}
				else
				{
					$c5 = "UPDATE ventas SET TOTAL_REAL = '0' WHERE ID = '$id_venta' LIMIT 1";
					$exc5 = mysqli_query($cnx, $c5);
				}
			}
			
		}
	}
	
	// regresando a la pagina principal
	header("Location: ../../index.php?seccion=ventas_papeleria&accion=agregar");
	
?>