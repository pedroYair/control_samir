<?php 
	if(isset($_POST['nombre']))
	{
		$nombre = strtoupper($_POST['nombre']);
		$estado = $_POST['estado'];
		$obs = $_POST['observacion'];
		$imagen = str_replace("\\", "/", $_FILES['foto']['tmp_name']);
		$id = $_POST['id'];
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		$_SESSION['resp'] = "error_permisos";
		header("Location: ../../index.php?seccion=deudores&accion=listar" );
		die();
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "UPDATE deudor SET NOMBRE = NULLIF('$nombre', ''),
			OBSERVACION = '$obs',
			ESTADO = '$estado',
			FOTO = LOAD_FILE('$imagen')
			WHERE ID='$id'
			LIMIT 1";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la actualizacion
	$_SESSION['resp']  = $filas >= 1 ? 'ok_editar' : 'error_editar';

	header("Location: ../../index.php?seccion=deudores&accion=listar" );

?>