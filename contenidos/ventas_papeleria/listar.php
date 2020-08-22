<?php
  
  $consulta = "SELECT * FROM ventas ORDER BY FECHA_VENTA DESC";
  $exc = mysqli_query($cnx, $consulta);
  
  $resp = "";
  if(isset( $_SESSION['resp'] ))
  {
    $resp = $_SESSION['resp'];
    unset( $_SESSION['resp'] );
  }
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
                      <?php
                        $hoy = date('Y-m-d');
                        $verificar = "SELECT ID, ESTADO FROM ventas WHERE FECHA_VENTA = '$hoy'";
                        $exc_ver = mysqli_query($cnx, $verificar);
                        $actual = mysqli_fetch_assoc($exc_ver);

                        if(is_null($actual['ID']) or $actual['ESTADO'] == 0)
                        {
                          if(is_null($actual['ID'])) 
                          {
                            echo "<a class='btn btn-primary' href='index.php?seccion=ventas_papeleria&accion=agregar' title='Agregar ventas papeleria' style='margin:10px;'><i class='fa fa-plus'></i> Agregar</a>";
                          }
                          else
                          {
                            echo "<a class='btn btn-primary' href='index.php?seccion=detalle_ventas&accion=agregar&id=$actual[ID]' title='Agregar ventas papeleria' style='margin:10px;'><i class='fa fa-plus'></i> Agregar</a>";
                          }
                          
                        }
                        else
                        {
                          echo "<a class='btn btn-primary' href='index.php?seccion=ventas_papeleria&accion=agregar' title='Agregar ventas papeleria' style='margin:10px;' disabled><i class='fa fa-plus'></i> Agregar</a>";
                        }
                      ?>
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
							
							echo <<<fila
							<tr id="$columnas[ID]">
							  <td>$columnas[FECHA_VENTA]</td>
							  <td>$columnas[TOTAL_DIA]</td>
							  <td>$columnas[TOTAL_ESPERADO]</td>
							  <td>$columnas[TOTAL_REAL]</td>
							  <td>$columnas[DEUDAS]</td>
                <td>$columnas[INVERSIONES]</td>
                <td>$columnas[DEUDAS_CANCEL]</td>
							  <td>
								<a class="btn btn-primary" title="Ver detalle de venta" href="index.php?seccion=detalle_ventas&accion=ver_detalle&id=$columnas[ID]"><i class="fa fa-eye"></i></a>
                <a class="btn btn-warning .edit" href="index.php?seccion=ventas_papeleria&accion=editar&id=$columnas[ID]" title="Editar"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger delete" href="accionesForms/ventas_papeleria/eliminar.php?id=$columnas[ID]" onclick="return confirm('¿Eliminar el registro del día $columnas[FECHA_VENTA]?')" title="Eliminar"><i class="fa fa-trash"></i></a>
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