<?php 
	if(isset($_POST['id_venta']))
	{
		$id_venta = $_POST['id_venta'];
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
			die("Error en la solicitud");
		}
		
		$c = "UPDATE ventas_recargas SET SALDO_DIA_ANTERIOR = '$saldo_anterior',
							RECARGADO = '$recargado',
							SALDO_HOY = '$saldo_hoy',
							CAJA_ANTERIOR = '$caja_anterior',
							VENTAS_DIA = '$ventas_dia',
							DEUDAS = '$deudas',
							PERDIDAS = $perdidas,
							DEUDAS_CANCEL = '$deudas_canceladas',
							INVERSIONES = '$inversiones',
							TOTAL_ESPERADO = '$total_esperado',
							TOTAL_REAL = '$total_real',
							SALDO_CIERRE_ESP = '$saldo_cierre_esperado',
							SALDO_CIERRE_REAL = '$saldo_cierre_real',
							ESTADO = '$estado',
							OBSERVACION = '$observaciones'
							WHERE ID='$id_venta' 
							LIMIT 1";
		
		$f = mysqli_query($cnx, $c);
		echo mysqli_error($cnx);
		
		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la actualizacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_editar_venta' : 'error_editar_venta';

		header("Location: ../../index.php?seccion=ventas_recargas&accion=listar" );
	}

	

?>