<?php 
	if(isset($_POST['nombre']))
	{
		$nombre = strtoupper($_POST['nombre']);
		$obs = $_POST['observacion'];
		// reemplzamos la "\" de la ruta de la imagen por "/" para evitar errores
		$imagen = str_replace("\\", "/", $_FILES['foto']['tmp_name']);
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		$_SESSION['resp'] = "error_permisos";
		header("Location: ../../index.php?seccion=deudores&accion=listar" );
		die();
	}
	
	// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
	$c = "INSERT INTO deudor 
			SET NOMBRE = NULLIF('$nombre', ''),
			FECHA_ALTA = NOW(),
			OBSERVACION = '$obs',
			FOTO= LOAD_FILE('$imagen'),
			ESTADO= '1'";
	
	$f = mysqli_query($cnx, $c);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la inserción
	$_SESSION['resp']  = $filas >= 1 ? 'ok_agregar' : 'error_agregar';

	header("Location: ../../index.php?seccion=deudores&accion=listar" );

?>