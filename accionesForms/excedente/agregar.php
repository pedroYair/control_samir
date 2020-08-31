<?php 

	if(isset($_POST['caja_anterior']))
	{
		$fecha = date('Y-m-d',strtotime($_POST['fecha']));
		$caja_anterior = $_POST['caja_anterior'];
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
			$_SESSION['resp'] = "error_permisos";
			header("Location: ../../index.php?seccion=excedente&accion=listar" );
			die();
		}

		$c_new_venta = "INSERT INTO excedente
							SET FECHA = '$fecha',
							CAJA = '$caja_anterior',
							ING_RECARGAS = '$recargas',
							ING_PAPELERIA = '$papeleria',
							DEUDAS_CANCEL = '$deudas_canceladas',
							PRESTAMOS = '$deudas',
							INVERSIONES = '$inversiones',
							PERDIDAS = '$perdidas',
							TOTAL_REAL = '$total_esperado',
							OBSERVACION = '$observaciones'";
		
		$exc_query = mysqli_query($cnx, $c_new_venta);

		$filas = mysqli_affected_rows($cnx);
			
		$_SESSION['resp'] = $filas >= 1 ? 'ok_agregar' : 'error_agregar';
		
	}
	header("Location: ../../index.php?seccion=excedente&accion=listar");

?>