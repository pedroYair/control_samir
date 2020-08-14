<?php
  // obtengo los servicios registrados
	$consulta = "SELECT * FROM servicios ORDER BY SERVICIO";
  $exc = mysqli_query($cnx, $consulta);
  
  // obtengo mensaje de insercion, actualizacion o eliminacion de servicios
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
              <h3 class="box-title">Servicios</h3>
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
                    <div class="col-md-offset-2 col-md-8" style="margin-left:1px;"s>
                        <a class="btn btn-primary" href="index.php?seccion=servicios&accion=agregar" title="Agregar servicio"><i class="fa fa-plus"></i> Agregar</a>
                    </div>
              </div>

              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Servicio</th>
                  <th>Precio</th>
                  <th>Observacion</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
				<?php
					if($cnx)
					{
            $contador = 1;
						while($columnas = mysqli_fetch_assoc($exc))
						{
							echo <<<fila
							<tr id="$columnas[ID]">
							  <td>$contador</td>
							  <td>$columnas[SERVICIO]</td>
							  <td>$columnas[PRECIO]</td>
							  <td>$columnas[OBSERVACION]</td>
                <td>
                  <a class="btn btn-warning .edit" href="index.php?seccion=servicios&accion=editar&id=$columnas[ID]" title="Editar"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-danger delete" href="../../accionesForms/servicios/eliminar.php?id=$columnas[ID]" onclick="return confirm('¿Eliminar este servicio?')" title="Eliminar"><i class="fa fa-trash"></i></a>
                </td>
							</tr>
fila;
            $contador++;
						}
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