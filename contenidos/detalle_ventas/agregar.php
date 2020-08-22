<?php
	if(isset($_GET['id']))
	{
		$hoy = date('Y-m-d');
		$resp = "";
		$id_venta = $_GET['id'];

		// obtenemos el registro de la venta
		$c1 = "SELECT ID, CAJA_ANTERIOR, TOTAL_DIA, TOTAL_ESPERADO, ESTADO
					FROM ventas
						WHERE ID = '$id_venta'";
		$exc1 = mysqli_query($cnx, $c1);
		$filas1 = mysqli_fetch_assoc($exc1);

		$caja_anterior = is_null($filas1['CAJA_ANTERIOR']) ? 0 : $filas1['CAJA_ANTERIOR'];

		if(!is_null($filas1['ID']))
		  {
		    // Obtengo los servicios
		    $c2 = "SELECT ID, SERVICIO FROM servicios WHERE SERVICIO != 'RECARGAS' AND SERVICIO != 'DEUDAS' ORDER BY SERVICIO";
		    $exc2 = mysqli_query($cnx, $c2);

		    // total del dia bajo registro
		    $total_dia = is_null($filas1['TOTAL_DIA']) ? 0 : $filas1['TOTAL_DIA'];

		    // total esperado en caja
		    $total_esperado  = is_null($filas1['TOTAL_DIA']) ? $caja_anterior : $filas1['TOTAL_ESPERADO'];

		  }
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
					
					if(isset($filas1['ID']) and $filas1['ESTADO'] == 0)
					{
					  include("small_boxes.php");
					  include("pages.php");
					}
					else
					{
						$mensaje_error = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>El registro de esta venta no pudo ser ubicado.</div> 
							<a href='index.php?seccion=ventas_papeleria&accion=listar' style='width: 73px; height: 34px;' class='btn btn-success'>Atrás</a>";

						echo $mensaje_error;
					}
				?>
			</div>
</div>
<!-- /.box-body -->
