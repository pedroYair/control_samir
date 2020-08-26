<?php 
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];

		$recargas = $_POST['recargas'];
		$papeleria = $_POST['papeleria'];
		$deudas_canceladas = $_POST['deudas_canceladas'];
		$deudas = $_POST['deudas'];
		$inversiones = $_POST['inversiones'];
		$perdidas = $_POST['perdidas'];
		$total_esperado = $_POST['total_esperado'];
		$observaciones = $_POST['observacion'];

		include( '../../setup/configuracion.php' );

		if(!verificar_seguridad())
		{
			die("Error en la solicitud");
		}
		
		$c = "UPDATE excedente SET ING_RECARGAS = '$recargas',
							ING_PAPELERIA = '$papeleria',
							DEUDAS_CANCEL = '$deudas_canceladas',
							PRESTAMOS = '$deudas',
							INVERSIONES = '$inversiones',
							PERDIDAS = '$perdidas',
							TOTAL_REAL = '$total_esperado',
							OBSERVACION = '$observaciones'";
		
		$f = mysqli_query($cnx, $c);
		echo mysqli_error($cnx);
		
		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la actualizacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_editar' : 'error_editar';

		header("Location: ../../index.php?seccion=excedente&accion=listar" );
	}

	

?>