<?php 
	if(isset($_POST['id_venta']))
	{
		$id_venta = $_POST['id_venta'];
		$caja_anterior = $_POST['caja_anterior'];
		$total_dia = $_POST['total_dia'];
		$total_esperado = $_POST['id_venta'];
		$deudas = $_POST['deudas'];
		$inversiones = $_POST['inversiones'];
		$caja_real = $_POST['caja_real'];
		$deudas_cancel = $_POST['deudas_cancel'];
		$observaciones = $_POST['observacion'];
		$estado = $_POST['estado'];

		$total_esperado = ($caja_anterior + $total_dia + $deudas_cancel) - $inversiones;

		include( '../../setup/configuracion.php' );

		if(!verificar_seguridad())
		{
			die("Error en la solicitud");
		}
		
		// si $servicio es una cadena vacia se coloca null y eso hace que falle el insert
		$c = "UPDATE ventas SET TOTAL_ESPERADO = '$total_esperado',
				TOTAL_REAL = '$caja_real',
				INVERSIONES = '$inversiones',
				DEUDAS = '$deudas',
				DEUDAS_CANCEL = '$deudas_cancel',
				OBSERVACION = '$observaciones',
				ESTADO = '$estado'
				WHERE ID='$id_venta'
				LIMIT 1";
		
		$f = mysqli_query($cnx, $c);
		echo mysqli_error($cnx);
		
		// numero de filas afectadas
		$filas = mysqli_affected_rows($cnx);

		// obtenemos la respuesta ante la actualizacion
		$_SESSION['resp']  = $filas >= 1 ? 'ok_editar_venta' : 'error_editar_venta';

		header("Location: ../../index.php?seccion=ventas_papeleria&accion=listar" );
	}

	

?>