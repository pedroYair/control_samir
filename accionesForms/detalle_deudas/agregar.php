<?php 
	if(isset($_POST['id_deuda']))
	{
		$id_deuda = $_POST['id_deuda'];
		$id_servicio = $_POST['servicio'];
		$cantidad = $_POST['cantidad'];
		$subtotal = $_POST['subtotal'];

		if($cantidad == "")
		{
			$cantidad = "0";
		}
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		$_SESSION['resp'] = "error_permisos";
		header("Location: ../../index.php?seccion=deudas&accion=listar" );
		die();
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "INSERT INTO detalle_deuda 
			SET FK_DEUDA = '$id_deuda',
			FK_SERVICIO = '$id_servicio',
			CANTIDAD = '$cantidad',
			SUBTOTAL = '$subtotal'";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la inserción
	$_SESSION['resp']  = $filas >= 1 ? 'ok_agregar_detalle' : 'error_agregar_detalle';

	// si el detalle fue agregado se actualiza el total de la deuda
	if($filas >= 1)
	{
		$c2 = "SELECT TOTAL FROM deuda WHERE ID = '$id_deuda' LIMIT 1";
		$exc2 = mysqli_query($cnx, $c2);

		$total_deuda = mysqli_fetch_assoc($exc2);

		$total_deuda = $total_deuda['TOTAL'];

		$total_deuda += $subtotal;

		$c3 = "UPDATE deuda SET TOTAL = '$total_deuda' WHERE ID = '$id_deuda' LIMIT 1";
		$exc3 = mysqli_query($cnx, $c3);
	}

	header("Location: ../../index.php?seccion=detalle_deudas&accion=agregar");

?>