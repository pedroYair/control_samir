<?php 
	if(isset($_POST['id_deudor']))
	{
		$id_deudor = $_POST['id_deudor'];
		$valor = $_POST['valor'];
		$observacion = $_POST['observacion'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		die("Error en la solicitud");
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "INSERT INTO abonos
			SET FK_DEUDOR = '$id_deudor',
			ABONADO = '$valor',
			FECHA_ABONO = NOW(),
			OBSERVACION = '$observacion'";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la inserción
	$_SESSION['resp']  = $filas >= 1 ? 'ok_agregar' : 'error_agregar';

	header("Location: ../../index.php?seccion=abonos&accion=agregar&id=$id_deudor");

?>