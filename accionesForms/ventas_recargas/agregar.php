<?php 

	$caja_anterior = $_POST['caja_anterior'];
	$saldo_anterior = $_POST['saldo_anterior'];
	$recargado = $_POST['recargado'];
	$observaciones = $_POST['observacion'];

	$hoy = date('Y-m-d');
	$saldo_hoy = $saldo_anterior + $recargado;
	

	include( '../../setup/configuracion.php' );

	if(!verificar_seguridad())
	{
		die("Error en la solicitud");
	}

	// verificamos que no exista una venta de dia actual
	
	$verificar = "SELECT COUNT(ID) AS CANTIDAD FROM ventas_recargas WHERE FECHA = '$hoy'";
	$exc_ver = mysqli_query($cnx, $verificar);
	$actual = mysqli_fetch_assoc($exc_ver);
	$cantidad = $actual['CANTIDAD'];
	
	// si no existe el registro se crea
	$resp = "";
	if($cantidad == 0)
	{

		// inserto la nueva venta
		$c_new_venta = "INSERT INTO ventas_recargas
						SET FECHA = '$hoy',
						SALDO_DIA_ANTERIOR = '$saldo_anterior',
						RECARGADO = '$recargado',
						SALDO_HOY = '$saldo_hoy',
						CAJA_ANTERIOR = '$caja_anterior',
						VENTAS_DIA = '0',
						DEUDAS = '0',
						DEUDAS_CANCEL = '0',
						INVERSIONES = '0',
						TOTAL_ESPERADO = '$caja_anterior',
						TOTAL_REAL = '0',
						SALDO_CIERRE_ESP = '$saldo_hoy',
						SALDO_CIERRE_REAL = '0',
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

	header("Location: ../../index.php?seccion=ventas_recargas&accion=listar&id=$id_venta");

?>