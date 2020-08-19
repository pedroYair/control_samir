<?php
  
	$consulta4 = "SELECT a.ID, NOMBRE, TOTAL 
					FROM deuda AS a JOIN deudor AS b ON a.FK_DEUDOR = b.ID 
						WHERE FECHA_DEUDA BETWEEN '$hoy' AND '$hoy 23:59:59'";
	$exc4 = mysqli_query($cnx, $consulta4);
	
	$consulta5 = "SELECT a.ID, NOMBRE, ABONADO , SERVICIO
					FROM abonos AS a JOIN deudor AS b ON a.FK_DEUDOR = b.ID JOIN servicios AS s ON s.ID = a.FK_SERVICIO
						WHERE FECHA_ABONO BETWEEN '$hoy' AND '$hoy 23:59:59'";
	$exc5 = mysqli_query($cnx, $consulta5);

?>

<div class="row">
						<div class="col-md-6">
						  <!-- Custom Tabs -->
						  <div class="nav-tabs-custom">
						  <ul class="nav nav-tabs">
								  <li class="active"><a href="#tab_1" data-toggle="tab">Detalle deudas hoy</a></li>
							</ul>
							<div class="tab-content">
							  <div class="tab-pane active" id="tab_1">
								
								<table id="listado_deudas_hoy" class="table table-bordered table-hover">
									<thead>
									<tr>
									<th>#</th>
									<th>Deudor</th>
									<th>Adeudado</th>
									<th>Acciones</th>
									</tr>
									</thead>
									<tbody>
									<?php
										if($cnx)
										{
											$contador = 1;
								
											while($columnas = mysqli_fetch_assoc($exc4))
											{
												echo <<<fila
												<tr id="$columnas[ID]">
												<td>$contador</td>
												<td>$columnas[NOMBRE]</td>
												<td>$columnas[TOTAL]</td>
												<td>
													<a class="btn btn-primary" title="Ver detalle de la deuda" href="index.php?seccion=detalle_deudas&accion=ver_detalle_hoy&id=$columnas[ID]"><i class="fa fa-eye"></i></a>
												</td>
												</tr>
fila;
								$contador++;
											}
											
											mysqli_free_result($exc4);
										}
									?>
									</tfoot>
								</table>

							</div>
	
							  <!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						  </div>
						  <!-- nav-tabs-custom -->
						</div>
						
					<!-- tabla detalle de deuda -->
						 <div class="col-md-6">
							  <!-- Custom Tabs (Pulled to the right) -->
							  <div class="nav-tabs-custom">
								<ul class="nav nav-tabs pull-right">
								  <li class="active"><a href="#tab_1-1" data-toggle="tab">Detalle abonos hoy</a></li>
								</ul>
								<div class="tab-content">
								  <div class="tab-pane active" id="tab_1-1">
								  <table id="listado_abonos_hoy" class="table table-bordered table-hover">
									<thead>
									<tr>
									<th>#</th>
									<th>Deudor</th>
									<th>Servicio</th>
									<th>Abonado</th>
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
												<td>$columnas[NOMBRE]</td>
												<td>$columnas[SERVICIO]</td>
												<td>$columnas[ABONADO]</td>
												<td>
													<a class="btn btn-primary" title="Ver detalle del abono" href="index.php?seccion=abonos&accion=ver_abono_hoy&id=$columnas[ID]"><i class="fa fa-eye"></i></a>
												</td>
												</tr>
fila;
								$contador++;
											}
											mysqli_free_result($exc5);
										}
									?>
									</tfoot>
								</table>
								  </div>
								  <!-- /.tab-pane -->
								</div>
								<!-- /.tab-content -->
							  </div>
							  <!-- nav-tabs-custom -->
						</div>
</div> 