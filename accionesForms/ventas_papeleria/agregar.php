<?php 
	$fecha = date('Y-m-d',strtotime($_POST['fecha']));
	$caja_anterior = $_POST['caja_anterior'];
	$deudas = $_POST['deudas'];
	$inversiones = $_POST['inversiones'];
	$deudas_cancel = $_POST['deudas_cancel'];
	$total_real = $_POST['total_real'];
	$observaciones = $_POST['observacion'];

	$total_esperado = ($caja_anterior + $deudas_cancel) - $inversiones;

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		$_SESSION['resp'] = "error_permisos";
		header("Location: ../../index.php?seccion=ventas_papeleria&accion=listar" );
		die();
	}

	// verificamos que no exista una venta de dia actual
	
	$verificar = "SELECT COUNT(ID) AS CANTIDAD FROM ventas WHERE FECHA_VENTA = '$fecha'";
	$exc_ver = mysqli_query($cnx, $verificar);
	$actual = mysqli_fetch_assoc($exc_ver);
	$cantidad = $actual['CANTIDAD'];
	
	// si no existe el registro se crea
	$resp = "";
	if($cantidad == 0)
	{

		// inserto la nueva venta
		$c_new_venta = "INSERT INTO ventas
						SET FECHA_VENTA = '$fecha',
						TOTAL_DIA = '0',
						TOTAL_ESPERADO = '$total_esperado',
						TOTAL_REAL = '$total_real',
						CAJA_ANTERIOR = '$caja_anterior',
						INVERSIONES = '$inversiones',
						DEUDAS = '$deudas',
						DEUDAS_CANCEL = '$deudas_cancel',
						ESTADO = '0',
						OBSERVACION = '$observaciones'";
	
		$exc_query = mysqli_query($cnx, $c_new_venta);
		
		
		$filas = mysqli_affected_rows($cnx);
		
		$_SESSION['resp'] = $filas >= 1 ? 'ok_agregar_venta' : 'error_agregar_venta';
		
		if($filas >= 1)
		{
			$id_venta = mysqli_insert_id($cnx);
		}
	}


	header("Location: ../../index.php?seccion=detalle_ventas&accion=agregar&id=$id_venta");

?>