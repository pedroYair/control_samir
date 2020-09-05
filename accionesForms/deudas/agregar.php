<?php 
	if(isset($_POST['deudor']))
	{
		$fecha = date('Y-m-d',strtotime($_POST['fecha']));
		$id_deudor = $_POST['deudor'];
		$obs = $_POST['observacion'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		$_SESSION['resp'] = "error_permisos";
		header("Location: ../../index.php?seccion=deudas&accion=listar" );
		die();
	}
	
	$c = "INSERT INTO deuda
			SET FK_DEUDOR = '$id_deudor',
			TOTAL = '0',
			FECHA_DEUDA = '$fecha',
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