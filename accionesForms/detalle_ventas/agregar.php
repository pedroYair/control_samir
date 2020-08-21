<?php 
	if(isset($_POST['id_venta']))
	{
		$id_venta = $_POST['id_venta'];
		$id_servicio = $_POST['servicio'];
		$cantidad = $_POST['cantidad'];
		$subtotal = $_POST['subtotal'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		die("Error en la solicitud");
	}

	// obtener servicio
	$c_servicio = "SELECT SERVICIO FROM servicios WHERE ID = '$id_servicio' LIMIT 1";
	$exc_servicio = mysqli_query($cnx, $c_servicio);
	$servicio = mysqli_fetch_assoc($exc_servicio);
	$servicio = $servicio['SERVICIO'];

	// porque las inversiones se restan
	if($servicio == "INVERSIONES")
	{
		$subtotal = $subtotal * -1;
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "INSERT INTO detalle_venta 
			SET FK_VENTA = '$id_venta',
			FK_SERVICIO = '$id_servicio',
			CANTIDAD = '$cantidad',
			SUBTOTAL = '$subtotal'";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la inserción
	$_SESSION['resp']  = $filas >= 1 ? 'ok_agregar_detalle' : 'error_agregar_detalle';

	// si el detalle fue agregado se actualiza el registro de la venta
	if($filas >= 1)
	{
		if($servicio != "CAJA REAL" and $servicio != "INVERSIONES")
		{
			$c3 = "UPDATE ventas SET TOTAL_DIA = TOTAL_DIA + '$subtotal', TOTAL_ESPERADO = TOTAL_ESPERADO + '$subtotal' WHERE ID = '$id_venta' LIMIT 1";
			$exc3 = mysqli_query($cnx, $c3);

			if($servicio == "DEUDAS CANCELADAS")
			{
				$c7 = "UPDATE ventas SET DEUDAS_CANCEL = DEUDAS_CANCEL + '$subtotal' WHERE ID = '$id_venta' LIMIT 1";
				$exc7 = mysqli_query($cnx, $c7);
			}
		}
		else
		{
			if($servicio == "INVERSIONES")
			{
				$c4 = "UPDATE ventas SET INVERSIONES = INVERSIONES + '$subtotal' WHERE ID = '$id_venta' LIMIT 1";
				$exc4 = mysqli_query($cnx, $c4);

				$c5 = "UPDATE ventas SET TOTAL_ESPERADO = TOTAL_ESPERADO + '$subtotal' WHERE ID = '$id_venta' LIMIT 1";
				$exc5 = mysqli_query($cnx, $c5);
			}
			else
			{
				$c6 = "UPDATE ventas SET TOTAL_REAL = '$subtotal' WHERE ID = '$id_venta' LIMIT 1";
				$exc6 = mysqli_query($cnx, $c6);
			}
		}
	}

	header("Location: ../../index.php?seccion=ventas_papeleria&accion=agregar");

?>