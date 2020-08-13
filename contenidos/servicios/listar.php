<?php
  // obtengo los servicios registrados
	$consulta = "SELECT * FROM servicios ORDER BY SERVICIO";
  $exc = mysqli_query($cnx, $consulta);
  
  // obtengo mensaje de insercion de servicios
  $mensaje = "";
  if( isset( $_SESSION['resp'] ) ){
    if( $_SESSION['resp'] == 'ok' ){
      $clase = 'ok';
      $mensaje = 'Servicio agregado satisfactoriamente';
    }else{
      $clase = 'error';
      $mensaje = 'El servicio no pudo ser registrado, posiblemente ya esta registrado en el sistema';
    }
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
                if($mensaje != "")
                {
                  echo "<p class='$clase' style='border-color:red;'>$mensaje</p>";
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
							  <td>Editar - Eliminar</td>
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