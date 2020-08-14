<?php 
	if(isset($_POST['servicio']))
	{
		$servicio = strtoupper($_POST['servicio']);
		$precio = $_POST['precio'];
		$obs = $_POST['observacion'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		die("Error en la solicitud");
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "INSERT INTO servicios 
			SET SERVICIO = NULLIF('$servicio', ''),
			PRECIO = '$precio',
			OBSERVACION = '$obs'";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la inserción
	$_SESSION['resp']  = $filas >= 1 ? 'ok_agregar' : 'error_agregar';

	header("Location: ../../index.php?seccion=servicios&accion=listar" );

?>