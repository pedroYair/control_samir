<?php
  
	$consulta4 = "SELECT s.ID AS ID_SER, SERVICIO, SUM(SUBTOTAL) AS SERVICIO_TOTAL, SUM(CANTIDAD) AS CANTIDAD_TOTAL 
					FROM detalle_deuda AS d JOIN servicios AS s ON d.FK_SERVICIO = s.ID
					WHERE d.FK_DEUDA = '$id_deuda_insertada' 
					GROUP BY FK_SERVICIO 
					ORDER BY SERVICIO";
  $exc4 = mysqli_query($cnx, $consulta4);

?>

<div class="row">
						<div class="col-md-6">
						  <!-- Custom Tabs -->
						  <div class="nav-tabs-custom">
							<div class="tab-content">
							  <div class="tab-pane active" id="tab_1">
								
								<form role="form" action="accionesForms/detalle_deudas/agregar.php" method="post">

									<div class="form-group">
									  <label>Servicio</label>
									  <select name="servicio" class="form-control select2">
									  <?php
										while($servicio = mysqli_fetch_assoc($exc2))
										{
										  echo <<<SERVICIO
										  <option value="$servicio[ID]">$servicio[SERVICIO]</option>
SERVICIO;
										}
									  ?>
									  </select>
									</div>

									<div class="form-group">
									  <label>Subtotal</label>
									  <input type="number" name="subtotal" min="50" step="50" class="form-control" required>
									</div>

									<div class="form-group">
									  <label>Cantidad</label>
									  <input type="number" name="cantidad" min="1" class="form-control" value="1" required>
									</div>

									<input type="hidden" name="id_deuda" value="<?php echo $id_deuda_insertada;?>">
								
									<div class="box-footer">
										<a href='index.php?seccion=deudas&accion=listar' style='width: 73px; height: 34px;' class='btn btn-success'>Atrás</a>
										<button type="submit" style="height: 34px;" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
									</div>
								  </form>
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
								  <li class="active"><a href="#tab_1-1" data-toggle="tab">Detalle de deuda en proceso</a></li>
								</ul>
								<div class="tab-content">
								  <div class="tab-pane active" id="tab_1-1">
								  <table id="listado_deudas" class="table table-bordered table-hover">
									<thead>
									<tr>
									<th>#</th>
									<th>Servicio</th>
									<th>Cantidad</th>
									<th>Subtotal</th>
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
												<tr>
												<td>$contador</td>
												<td>$columnas[SERVICIO]</td>
												<td>$columnas[CANTIDAD_TOTAL]</td>
												<td>$columnas[SERVICIO_TOTAL]</td>
												<td>
													<a class="btn btn-danger delete" href="accionesForms/detalle_deudas/eliminar.php?id1=$id_deuda_insertada&id2=$columnas[ID_SER]" onclick="return confirm('¿Eliminar el servicio $columnas[SERVICIO] del detalle?')" title="Eliminar"><i class="fa fa-trash"></i></a>
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
								</div>
								<!-- /.tab-content -->
							  </div>
							  <!-- nav-tabs-custom -->
						</div>
</div> 