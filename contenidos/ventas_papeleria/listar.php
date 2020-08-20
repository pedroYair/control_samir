<?php
  
  $consulta = "SELECT * FROM ventas ORDER BY FECHA_VENTA DESC";
  $exc = mysqli_query($cnx, $consulta);
  
  $resp = "";
  if(isset( $_SESSION['resp'] ))
  {
    $resp = $_SESSION['resp'];
    unset( $_SESSION['resp'] );
  }

  // revisar esto en la lista de deudas al fin como es la eliminacion del indice
  /*
  if(isset($_GET['estado']) and isset($_SESSION['id_insertado']))
  {
    unset($_SESSION['id_insertado']);
    $resp = "ok_fin";
  }
  */
?>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ventas papeleria</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php
                if($resp != "")
                {
                  include("mensajes.php");
                }
            ?>

              <div class="form-group">
                    <div class="col-md-offset-2 col-md-8" style="margin-left:0px;">
                        <a class="btn btn-primary" href="index.php?seccion=deudas&accion=agregar" title="Agregar deuda" style="margin:10px;"><i class="fa fa-plus"></i> Agregar</a>
                    </div>
              </div>

              <table id="listado_ventas_papeleria" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Total día</th>
                  <th>Total caja esperado</th>
                  <th>Total caja real</th>
                  <th>Deudas</th>
                  <th>Inversiones</th>
                  <th>Deudas canceladas</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
				<?php
				
					if($cnx and !is_null($exc))
					{
						while($columnas = mysqli_fetch_assoc($exc))
						{
							/*
						  $consulta2 = "SELECT sum(ABONADO) AS TOTAL_ABONADO FROM abonos WHERE FK_DEUDOR ='$columnas[ID]'";
						  $exc2 = mysqli_query($cnx, $consulta2);
						  $abono = mysqli_fetch_assoc($exc2);
						  
						  if(is_null($abono['TOTAL_ABONADO']))
						  {
							$abono = 0;
							mysqli_free_result($exc2);
						  }
						  else
						  {
							$abono = $abono['TOTAL_ABONADO'];
						  }

						  $saldo = $columnas['TOTAL_DEUDAS'] - $abono;
						  */
              
							echo <<<fila
							<tr id="$columnas[ID]">
							  <td>$columnas[FECHA_VENTA]</td>
							  <td>$columnas[TOTAL_DIA]</td>
							  <td>$columnas[TOTAL_ESPERADO]</td>
							  <td>$columnas[TOTAL_REAL]</td>
							  <td>---</td>
							  <td>---</td>
							  <td>---</td>
							  <td>
								<a class="btn btn-primary" title="Ver detalle de venta" href="index.php?seccion=deudas&accion=ver_historial&id=$columnas[ID]"><i class="fa fa-eye"></i></a>
							  </td>
							</tr>
fila;
						}
						mysqli_free_result($exc);
					}
					
				?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>
          <!-- /.box -->