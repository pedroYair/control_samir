<?php
	
	$hoy = date('Y-m-d');
	$caja_anterior = 0;

	//obtenemos el valor de la caja del dia anterior
	$ultimo_registro = "SELECT TOTAL_REAL FROM ventas 
								WHERE ID = (SELECT MAX(ID) FROM ventas WHERE FECHA_VENTA != '$hoy')";

	$exc_ultimo = mysqli_query($cnx, $ultimo_registro);
	$ultimo = mysqli_fetch_assoc($exc_ultimo);

	$caja_anterior = is_null($ultimo['TOTAL_REAL']) ? 0 : $ultimo['TOTAL_REAL'];

	// verificamos que no exista una venta de dia actual
	
	$verificar = "SELECT ID, ESTADO, TOTAL_DIA, TOTAL_ESPERADO FROM ventas WHERE FECHA_VENTA = '$hoy'";
	$exc_ver = mysqli_query($cnx, $verificar);
	
	$actual = mysqli_fetch_assoc($exc_ver);
	
	// si no existe el registro se crea
	$resp = "";
	if(is_null($actual['ID']))
	{

		// inserto la nueva venta
		$c_new_venta = "INSERT INTO ventas
						SET FECHA_VENTA = '$hoy',
						TOTAL_DIA = '0',
						TOTAL_ESPERADO = '$caja_anterior',
						TOTAL_REAL = '0',
						CAJA_ANTERIOR = '$caja_anterior',
						INVERSIONES = '0',
						DEUDAS = '0',
						DEUDAS_CANCEL = '0',
						ESTADO = '0'";
	
		$exc_query = mysqli_query($cnx, $c_new_venta);
		
		
		$filas = mysqli_affected_rows($cnx);
		
		$resp  = $filas >= 1 ? 'ok_agregar_venta' : 'error_agregar_venta';
		
		if($filas >= 1)
		{
			$_SESSION['id_venta'] = mysqli_insert_id($cnx);
		}
	}
	else
	{
		if($actual['ESTADO'] == 1)
		{
			$resp = "registro existente";
		}
		else
		{
			$_SESSION['id_venta'] = $actual['ID'];
		}
	
	}

 
  if(isset($_SESSION['id_venta']))
  {
    $id_venta_actual = $_SESSION['id_venta'];

    // Obtengo los servicios
    $consulta2 = "SELECT ID, SERVICIO FROM servicios WHERE SERVICIO != 'RECARGAS' AND SERVICIO != 'DEUDAS' ORDER BY SERVICIO";
    $exc2 = mysqli_query($cnx, $consulta2);

    // t
    $total_dia = is_null($actual['TOTAL_DIA']) ? 0 : $actual['TOTAL_DIA'];

    // total esperado en caja
    $total_esperado  = is_null($actual['TOTAL_DIA']) ? $caja_anterior : $actual['TOTAL_ESPERADO'];

  }
  else
  {
    $mensaje = "No se pudo encontrar el registro de esta deuda";
  }
  
?>

<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar detalle de ventas Papeleria</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<?php
					if(isset($_SESSION['resp']))
					{
						$resp = $_SESSION['resp'];
						unset($_SESSION['resp']);
					}

					if($resp != "")
					{
					  include("mensajes.php");
					}
					
					if(isset($_SESSION['id_venta']))
					{
					  include("small_boxes.php");
					  include("pages.php");
					}
				?>
			</div>
</div>
<!-- /.box-body -->
