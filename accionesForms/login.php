<?php 
	if(isset($_POST['email']) and isset($_POST['clave']))
	$email = $_POST['email'];
	$cl = sha1($_POST['clave']);
	
	include( '../setup/configuracion.php' );
	
	// LOGIN CONTRA LA BASE DE DATOS.
	$c = "SELECT 
			ID, 
			NOMBRE, 
			EMAIL,
			FOTO,
			NIVEL,
			IF( ESTADO = 1 , 'Activo', 'Inactivo' ) AS ESTADO,
			FECHA_ALTA,
			DATE_FORMAT( FECHA_ALTA , '%d-%m-%Y %H:%ihs' ) AS FECHA_ESPANIOL
		FROM 
			usuarios
		WHERE 
			EMAIL='$email' AND CLAVE='$cl'
		LIMIT 1";
	$f = mysqli_query($cnx, $c);
	
	$a = mysqli_fetch_assoc($f);
	
	if($a){
		// si el login es exitoso creamos el array de sesiones (los indices son creados por uno mismo no tiene que corresponder al de array de los datos)
		if($a['ESTADO'] == "Activo")
		{
			$_SESSION = $a; // se creara una variable de sesion por cada columna que retorne la consulta sql
			echo "creando sesiones";
		}
		else
		{
			$_SESSION['login'] = "banneado";
		}
		
	}
	else
	{
		$_SESSION['login'] = "error";
		echo "error";
	}

	header("Location: ../index.php" );
?>