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
		
		$c3 = "UPDATE ventas SET TOTAL_DIA = TOTAL_DIA + '$subtotal', TOTAL_ESPERADO = TOTAL_ESPERADO + '$subtotal' WHERE ID = '$id_venta' LIMIT 1";
		$exc3 = mysqli_query($cnx, $c3);
	}

	header("Location: ../../index.php?seccion=detalle_ventas&accion=agregar&id=$id_venta");

?>