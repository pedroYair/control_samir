<?php
	$consulta = "SELECT * FROM servicios ORDER BY SERVICIO";
	
	$exc = mysqli_query($cnx, $consulta);
?>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Servicios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Servicio</th>
                  <th>Precio</th>
                  <th>Observacion</th>
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
							<tr>
							  <td>$contador</td>
							  <td>$columnas[SERVICIO]</td>
							  <td>$columnas[PRECIO]</td>
							  <td>$columnas[OBSERVACION]</td>
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