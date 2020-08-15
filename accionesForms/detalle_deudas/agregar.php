<?php 
	if(isset($_POST['id_deuda']))
	{
		$id_deuda = $_POST['id_deuda'];
		$id_servicio = $_POST['servicio'];
		$cantidad = $_POST['cantidad'];
		$subtotal = $_POST['subtotal'];
		$obs = $_POST['observacion'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		die("Error en la solicitud");
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "INSERT INTO detalle_deuda 
			SET FK_DEUDA = '$id_deuda',
			FK_SERVICIO = '$id_servicio',
			CANTIDAD = '$cantidad',
			SUBTOTAL = '$subtotal',
			OBSERVACION = '$obs'";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la inserción
	$_SESSION['resp']  = $filas >= 1 ? 'ok_agregar_detalle' : 'error_agregar_detalle';

	header("Location: ../../index.php?seccion=detalle_deudas&accion=agregar");

?>