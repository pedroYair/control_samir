<?php 
	if(isset($_POST['nombre']) and isset($_POST['email']))
	{
		$nombre = strtoupper($_POST['nombre']);
		$email = $_POST['email'];
		$pass = $_POST['password'];
		// $clave = SHA1($clave);
		echo $pass;
		$nivel = $_POST['nivel'];
		// reemplzamos la "\" de la ruta de la imagen por "/" para evitar errores
		$imagen = str_replace("\\", "/", $_FILES['foto']['tmp_name']);
	}

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		die("Error en la solicitud");
	}
	
	$c = "INSERT INTO usuarios 
			SET NOMBRE = NULLIF('$nombre', ''),
			FECHA_ALTA = NOW(),
			EMAIL = NULLIF('$email', ''),
			CLAVE = SHA1('$pass'),
			NIVEL = '$nivel',
			FOTO= LOAD_FILE('$imagen'),
			ESTADO= '1'";
	
	$f = mysqli_query($cnx, $c);

	echo mysqli_error($cnx);
	
	// numero de filas afectadas
	$filas = mysqli_affected_rows($cnx);

	// obtenemos la respuesta ante la inserción
	$_SESSION['resp']  = $filas >= 1 ? 'ok_agregar' : 'error_agregar';

	header("Location: ../../index.php?seccion=usuarios&accion=listar" );

?>