<?php 

	if(isset($_POST['fecha']))
	{
		$fecha = date('Y-m-d',strtotime($_POST['fecha']));

		$saldo_anterior = $_POST['saldo_anterior'];
		$recargado = $_POST['recargado'];
		$saldo_hoy = $_POST['saldo_hoy'];

		$caja_anterior = $_POST['caja_anterior'];
		$ventas_dia = $_POST['ventas_dia'];
		$deudas_canceladas = $_POST['deudas_canceladas'];

		$deudas = $_POST['deudas'];
		$inversiones = $_POST['inversiones'];
		$perdidas = $_POST['perdidas'];

		$total_esperado = $_POST['total_esperado'];
		$total_real = $_POST['total_real'];
		
		$saldo_cierre_esperado = $_POST['saldo_cierre_esp'];
		$saldo_cierre_real = $_POST['saldo_cierre_real'];

		$observaciones = $_POST['observacion'];
		$estado = $_POST['estado'];

		include( '../../setup/configuracion.php' );

		if(!verificar_seguridad())
		{
			$_SESSION['resp'] = "error_permisos";
			header("Location: ../../index.php?seccion=ventas_recargas&accion=listar" );
			die();
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
							SET FECHA = '$fecha',
							SALDO_DIA_ANTERIOR = '$saldo_anterior',
							RECARGADO = '$recargado',
							SALDO_HOY = '$saldo_hoy',
							CAJA_ANTERIOR = '$caja_anterior',
							VENTAS_DIA = '$ventas_dia',
							DEUDAS = '$deudas',
							DEUDAS_CANCEL = '$deudas_canceladas',
							INVERSIONES = '$inversiones',
							PERDIDAS = $perdidas,
							TOTAL_ESPERADO = '$total_esperado',
							TOTAL_REAL = '$total_real',
							SALDO_CIERRE_ESP = '$saldo_cierre_esperado',
							SALDO_CIERRE_REAL = '$saldo_cierre_real',
							ESTADO = '$estado',
							OBSERVACION = '$observaciones'";
		
			$exc_query = mysqli_query($cnx, $c_new_venta);

			$filas = mysqli_affected_rows($cnx);
			
			$_SESSION['resp'] = $filas >= 1 ? 'ok_agregar_venta' : 'error_agregar_venta';
			
		}
		
	}
	header("Location: ../../index.php?seccion=ventas_recargas&accion=listar");

?>