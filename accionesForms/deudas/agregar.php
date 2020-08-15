<?php 
	if(isset($_POST['deudor']))
	{
		$id_deudor = $_POST['deudor'];
		$total_deuda = $_POST['total'];
		$obs = $_POST['observacion'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		die("Error en la solicitud");
	}
	
	$c = "INSERT INTO deuda
			SET FK_DEUDOR = '$id_deudor',
			TOTAL = '$total_deuda',
			FECHA_DEUDA = NOW(),
			OBSERVACION = '$obs'";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	if($filas >= 1)
	{
		$_SESSION['id_insertado'] = mysqli_insert_id($cnx);
		$_SESSION['resp'] = 'ok_agregar_deuda';
	}
	else
	{
		$_SESSION['resp'] = 'error_agregar_deuda';
	}

	header("Location: ../../index.php?seccion=detalle_deudas&accion=agregar" );

?>