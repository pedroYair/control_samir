<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
              <li><a href="#tab_2" data-toggle="tab">Detalle</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                
					<div class="row" style="margin-top: 0px;">
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-aqua">
					            <div class="inner">
					              <h4><?php echo $venta['FECHA_VENTA'];?></h4>
					              <p>Fecha</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-person"></i>
					            </div>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-yellow">
					            <div class="inner">
					              <h4><?php echo $venta['CAJA_ANTERIOR']; ?></h4>

					              <p>Caja día anterior</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-stats-bars"></i>
					            </div>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-green">
					            <div class="inner">
					              <h4><?php echo $venta['TOTAL_DIA']; ?></h4>

					              <p>Total día</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-stats-bars"></i>
					            </div>
					          </div>
					        </div>

					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-red">
					            <div class="inner">
					              <h4><?php echo $venta['INVERSIONES']; ?></h4>

					              <p>Inversiones</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-stats-bars"></i>
					            </div>
					          </div>
					        </div>


					        <!-- fila 2 -->

					         <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-blue">
					            <div class="inner">
					              <h4><?php echo $venta['DEUDAS'];?></h4>
					              <p>Deudas</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-person"></i>
					            </div>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-orange">
					            <div class="inner">
					              <h4><?php echo $venta['DEUDAS_CANCEL']; ?></h4>

					              <p>Deudas canceladas</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-stats-bars"></i>
					            </div>
					          </div>
					        </div>
					        <!-- ./col -->
					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-lime">
					            <div class="inner">
					              <h4><?php echo $venta['TOTAL_ESPERADO']; ?></h4>

					              <p>Total esperado en caja</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-stats-bars"></i>
					            </div>
					          </div>
					        </div>

					        <div class="col-lg-3 col-xs-6">
					          <!-- small box -->
					          <div class="small-box bg-gray">
					            <div class="inner">
					              <h4><?php echo $venta['TOTAL_REAL']; ?></h4>

					              <p>Total real en caja</p>
					            </div>
					            <div class="icon">
					              <i class="ion ion-stats-bars"></i>
					            </div>
					          </div>
					        </div>
					      </div>

							<div class="form-group">
			                  <label>Observaciones</label>
			                  <textarea class="form-control" rows="3"><?php echo $venta['OBSERVACION']; ?></textarea>
			                </div>

			                <div class="form-group">
			                  <label>Estado</label>
			                  <?php
			                  	if($venta['ESTADO'] == 1)
			                  		{ echo "<input class='form-control' value='Registro finalizado'/>";}
			                  	else{ echo "<input class='form-control' value='Registro sin finalizar'/>";}
			                  ?>
			                </div>

				</div>

					     
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table id="listado_registros" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Servicio</th>
                  <th>Cantidad</th>
                  <th>Subtotal</th>
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
							  <td>$columnas[SERVICIO]</td>
							  <td>$columnas[CANTIDAD]</td>
							  <td>$columnas[SUBTOTAL]</td>
							</tr>
fila;
            $contador++;
						}
						mysqli_free_result($exc6);
					}
				?>
					</tfoot>
				</table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
				<div class="box-footer">
					<a href="index.php?seccion=ventas_papeleria&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
				</div>
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
</div>
</div>