<?php
	if(isset($_GET['id']))
	{
		$id_deudor = $_GET['id'];
		$consulta5 = "SELECT * FROM deuda WHERE FK_DEUDOR = '$id_deudor' ORDER BY FECHA_DEUDA DESC";
		$exc5 = mysqli_query($cnx, $consulta5);
		
		$consulta6 = "SELECT FK_DEUDOR, FECHA_ABONO, ABONADO, a.OBSERVACION, s.SERVICIO
						 FROM abonos AS a JOIN servicios AS s ON a.FK_SERVICIO = s.ID
							WHERE FK_DEUDOR = '$id_deudor' ORDER BY FECHA_ABONO DESC";
		$exc6 = mysqli_query($cnx, $consulta6);
	}
	
?>

<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Historial de deudas</a></li>
              <li><a href="#tab_2" data-toggle="tab">Historial de abonos</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <table id="listado_historial_deudas" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th>Observación</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
				<?php
					if($cnx)
					{
						$contador = 1;
						while($columnas = mysqli_fetch_assoc($exc5))
						{
							echo <<<fila
							<tr id="$columnas[ID]">
							  <td>$contador</td>
							  <td>$columnas[FECHA_DEUDA]</td>
							  <td>$columnas[TOTAL]</td>
							  <td>$columnas[OBSERVACION]</td>
							  <td>
								<a class="btn btn-primary" title="Ver detalle de la venta" href="index.php?seccion=detalle_deudas&accion=ver&id1=$id_deudor&id2=$columnas[ID]"><i class="fa fa-eye"></i></a>
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table id="listado_historial_abonos" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Servicio</th>
                  <th>Abonado</th>
                  <th>Observación</th>
                </tr>
                </thead>
                <tbody>
				<?php
					if($cnx)
					{
						$contador = 1;
						while($columnas = mysqli_fetch_assoc($exc6))
						{
							echo <<<fila
							<tr>
							  <td>$contador</td>
							  <td>$columnas[FECHA_ABONO]</td>
							  <td>$columnas[SERVICIO]</td>
							  <td>$columnas[ABONADO]</td>
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
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
				<div class="box-footer">
					<a href="index.php?seccion=deudas&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
				</div>
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
</div>

