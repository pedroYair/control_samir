<?php
  
  // DETALLE DE CADA SERVICIO TOTAL
 
	$consulta4 = "SELECT s.ID AS ID_SER, SERVICIO, SUM(SUBTOTAL) AS SERVICIO_TOTAL, SUM(CANTIDAD) AS CANTIDAD_TOTAL 
					FROM detalle_venta AS d JOIN servicios AS s ON d.FK_SERVICIO = s.ID
					WHERE d.FK_VENTA = '$id_venta' 
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
								
								<form role="form" action="accionesForms/detalle_ventas/agregar.php" method="post">

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

									<input type="hidden" name="id_venta" value="<?php echo $id_venta;?>">
								
									<div class="box-footer">
										<a href="index.php?seccion=ventas_papeleria&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>

										<a href='index.php?seccion=ventas_papeleria&accion=editar&id=<?php echo $id_venta;?>&estado=ok' style='width: 73px; height: 34px;' class='btn btn-primary'>Finalizar</a>
											
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
													<a class="btn btn-danger delete" href="accionesForms/detalle_ventas/eliminar.php?id1=$id_venta&id2=$columnas[ID_SER]" onclick="return confirm('¿Eliminar el servicio $columnas[SERVICIO] del detalle?')" title="Eliminar"><i class="fa fa-trash"></i></a>
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