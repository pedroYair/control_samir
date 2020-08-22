<?php
	if(isset($_GET['id']))
	{
		$id_venta = $_GET['id'];
		$consulta5 = "SELECT * FROM ventas WHERE ID = '$id_venta' LIMIT 1";
		$exc5 = mysqli_query($cnx, $consulta5);
		$venta = mysqli_fetch_assoc($exc5);
		
		$consulta6 = "SELECT SERVICIO, CANTIDAD, SUM(SUBTOTAL) AS SUBTOTAL 
						FROM detalle_venta AS a JOIN servicios AS s ON a.FK_SERVICIO = s.ID
							WHERE FK_VENTA = '$id_venta' GROUP BY FK_SERVICIO ORDER BY SERVICIO DESC";
		$exc6 = mysqli_query($cnx, $consulta6);
	}

	if(isset($venta))
	{
		include('pages_detalle.php');
	}
	else
	{
		$mensaje_error = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El registro de esta venta no pudo ser ubicado.</div> 
		<a href='index.php?seccion=ventas_papeleria&accion=listar' style='width: 73px; height: 34px;' class='btn btn-success'>Atrás</a>";

		echo $mensaje_error;
	}



?>



