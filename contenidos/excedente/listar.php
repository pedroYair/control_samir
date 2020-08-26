<?php
  
  $consulta = "SELECT * FROM excedente ORDER BY FECHA DESC";
  $exc = mysqli_query($cnx, $consulta);
  
  $resp = "";
  if(isset( $_SESSION['resp'] ))
  {
    $resp = $_SESSION['resp'];
    unset( $_SESSION['resp'] );
  }

  //obtenemos el id del ultimo registro
  $ultimo_registro = "SELECT ID FROM excedente WHERE ID = (SELECT MAX(ID) FROM excedente) LIMIT 1";

  $exc_ultimo = mysqli_query($cnx, $ultimo_registro);
  $ultimo = mysqli_fetch_assoc($exc_ultimo);
  $id_ultimo = is_null($ultimo['ID']) ? 0 : $ultimo['ID'];
?>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Excedente</h3>
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
                      <a class="btn btn-primary" href="index.php?seccion=excedente&accion=agregar" title="Agregar excedente" style="margin:10px;"><i class="fa fa-plus"></i> Agregar</a>
                    </div>
              </div>

              <table id="listado_ventas" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Papeleria</th>
                  <th>Recargas</th>
                  <th>Deudas C</th>
                  <th>Inversiones</th>
                  <th>Deudas</th>
                  <th>Perdidas</th>
                  <th>Caja</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
				<?php
				
					if($cnx and !is_null($exc))
					{
						while($columnas = mysqli_fetch_assoc($exc))
						{
              $fecha = date("d/m/Y", strtotime($columnas['FECHA']));

              $boton_editar_eliminar = "<a class='btn btn-warning .edit' href='index.php?seccion=excedente&accion=editar&id=$columnas[ID]' title='Editar'><i class='fa fa-pencil'></i></a> <a class='btn btn-danger delete' href='accionesForms/excedente/eliminar.php?id=$columnas[ID]' onclick='return confirm('¿Eliminar el registro del día $columnas[FECHA]?')' title='Eliminar'><i class='fa fa-trash'></i></a>";

              if($columnas['ID'] != $id_ultimo)
              {
                $boton_editar_eliminar = "<a class='btn btn-warning .edit' href='index.php?seccion=excedente&accion=editar&id=$columnas[ID]' title='Editar' disabled><i class='fa fa-pencil'></i></a>
                <a class='btn btn-danger delete' href='accionesForms/excedente/eliminar.php?id=$columnas[ID]' onclick='return confirm('¿Eliminar el registro del día $columnas[FECHA]?')' title='Eliminar' disabled><i class='fa fa-trash'></i></a>";
              }
							
							echo <<<fila
							<tr id="$columnas[ID]">
							  <td>$fecha</td>
							  <td>$columnas[ING_PAPELERIA]</td>
                <td>$columnas[ING_RECARGAS]</td>
                <td>$columnas[DEUDAS_CANCEL]</td>
                <td>$columnas[INVERSIONES]</td>
                <td>$columnas[PRESTAMOS]</td>
                <td>$columnas[PERDIDAS]</td>
                <td>$columnas[TOTAL_REAL]</td>
							  <td>
								<a class="btn btn-primary" title="Ver detalle de venta" href="index.php?seccion=ventas_recargas&accion=ver_detalle&id=$columnas[ID]"><i class="fa fa-eye"></i></a>
                $boton_editar_eliminar
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