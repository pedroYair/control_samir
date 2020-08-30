<?php 
	if(isset($_POST['servicio']))
	{
		$servicio = strtoupper($_POST['servicio']);
		$precio = $_POST['precio'];
		$obs = $_POST['observacion'];
		$id = $_POST['id'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		$_SESSION['resp'] = "error_permisos";
		header("Location: ../../index.php?seccion=servicios&accion=listar" );
		die();
	}
	else
	{
		echo "no es falso";
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "UPDATE servicios SET SERVICIO = NULLIF('$servicio', ''),
			PRECIO = '$precio',
			OBSERVACION = '$obs'
			WHERE ID='$id'
			LIMIT 1";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la actualizacion
	$_SESSION['resp']  = $filas >= 1 ? 'ok_editar' : 'error_editar';

	header("Location: ../../index.php?seccion=servicios&accion=listar" );

?>