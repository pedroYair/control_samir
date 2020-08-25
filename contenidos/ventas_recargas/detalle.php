 <?php
  
  $id_venta = isset($_GET['id']) ? $_GET['id'] : 0;

  //obtenemos el registro a editar
  $registro = "SELECT * FROM ventas_recargas WHERE ID = '$id_venta' LIMIT 1";
  $exc = mysqli_query($cnx, $registro);
  $venta = mysqli_fetch_assoc($exc);

  // deudas del dia consultado
  $fecha = $venta['FECHA'];

  $consulta2 = "SELECT NOMBRE, TOTAL, a.OBSERVACION FROM deuda AS a JOIN deudor AS b ON a.FK_DEUDOR = b.ID JOIN detalle_deuda AS c ON a.ID = c.FK_DEUDA JOIN servicios AS d ON d.ID = c.FK_SERVICIO WHERE SERVICIO = 'RECARGAS' AND FECHA_DEUDA BETWEEN '$fecha' AND '$fecha 23:59:59'";
  $exc2 = mysqli_query($cnx, $consulta2);

  echo mysqli_error($cnx);

  // deudas canceladas
  $consulta3 = "SELECT NOMBRE, ABONADO, a.OBSERVACION FROM abonos AS a JOIN deudor AS b ON a.FK_DEUDOR = b.ID JOIN servicios AS d ON d.ID = a.FK_SERVICIO WHERE SERVICIO = 'RECARGAS' AND FECHA_ABONO BETWEEN '$fecha' AND '$fecha 23:59:59'";
  $exc3 = mysqli_query($cnx, $consulta3);
?>


 <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Detalle ventas</a></li>
              <li><a href="#tab_2" data-toggle="tab">Deudas por pagar</a></li>
              <li><a href="#tab_3" data-toggle="tab">Deudas canceladas</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <form role="form" action="accionesForms/ventas_recargas/editar.php"  method="post">

                    <div class="row">
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Saldo día anterior</label>
                          <input type="number" value="<?php echo $venta['SALDO_DIA_ANTERIOR']; ?>" class="form-control" readonly>
                        </div>
                      </div>  

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Recargado</label>
                          <input type="number" value="<?php echo $venta['RECARGADO']; ?>" class="form-control" readonly/>
                        </div>
                      </div>

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Saldo hoy</label>
                          <input type="number" value="<?php echo $venta['SALDO_HOY']; ?>" class="form-control" readonly>
                        </div>
                      </div>
                    </div>

                    <hr/>
                    <div class="row">
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Caja día anterior</label>
                          <input type="number" value="<?php echo $venta['CAJA_ANTERIOR']; ?>" class="form-control" readonly>
                        </div>
                      </div>  

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Ventas del día</label>
                          <input type="number" value="<?php echo $venta['VENTAS_DIA']; ?>" class="form-control" readonly/>
                        </div>
                      </div>

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Deudas canceladas</label>
                          <input type="number" value="<?php echo $venta['DEUDAS_CANCEL']; ?>" class="form-control" readonly/>
                        </div>
                      </div>
                    </div>

                    <hr/>
                    <div class="row">

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Deudas</label>
                          <input type="number" value="<?php echo $venta['DEUDAS']; ?>" class="form-control" readonly/>
                        </div>
                      </div>

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Inversiones</label>
                          <input type="number" value="<?php echo $venta['INVERSIONES']; ?>" class="form-control" readonly/>
                        </div>
                      </div>

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Pérdidas</label>
                          <input type="number" value="<?php echo $venta['PERDIDAS']; ?>" class="form-control" readonly/>
                        </div>
                      </div>
                    </div>

                    <hr/>
                    <div class="row">

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Total caja esperado</label>
                          <input type="number" value="<?php echo $venta['TOTAL_ESPERADO']; ?>" class="form-control" readonly/>
                        </div>
                      </div>

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Total caja real</label>
                          <input type="number" value="<?php echo $venta['TOTAL_REAL']; ?>" class="form-control" readonly/>
                        </div>
                      </div>

                    </div>

                    <hr/>
                    <div class="row">

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Saldo cierre esperado</label>
                          <input type="number" value="<?php echo $venta['SALDO_CIERRE_ESP']; ?>" class="form-control" readonly/>
                        </div>
                      </div>

                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Saldo cierre real</label>
                          <input type="number" value="<?php echo $venta['SALDO_CIERRE_REAL']; ?>" class="form-control" readonly/>
                        </div>
                      </div>
                    </div>

                    <hr/>

                    <?php if($venta['OBSERVACION'] != ""): ?>
                    <div class="form-group">
                      <label>Observaciones</label>
                      <textarea class="form-control" rows="3" readonly><?php echo $venta['OBSERVACION']; ?></textarea>
                    </div>

                  <?php endif ?>

                    
                    <div class="form-group">
                      <label>Estado</label>
                      <select class="form-control" disabled>
                        <?php
                          if($venta['ESTADO'] == 1)
                          {
                            echo "<option>Registro finalizado</option>";
                          }
                          else
                          {
                            echo "<option>Registro sin finalizar</option>";
                          }
                        ?>
                      </select>
                    </div>
                  
              </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Deudor</th>
                  <th>Valor deuda</th>
                  <th>Observación</th>
                </tr>
                </thead>
                <tbody>
                <?php
                
                  if($cnx and !is_null($exc2))
                  {
                    $contador = 1;
                    while($columnas = mysqli_fetch_assoc($exc2))
                    {
              echo <<<fila
              <tr>
                <td>$contador</td>
                <td>$columnas[NOMBRE]</td>
                <td>$columnas[TOTAL]</td>
                <td>$columnas[OBSERVACION]</td>
              </tr>
fila;
            $contador += 1;
            }
            mysqli_free_result($exc2);
          }
          
        ?>
                </tfoot>
              </table>
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Deudor</th>
                  <th>Valor abono</th>
                  <th>Observación</th>
                </tr>
                </thead>
                <tbody>
                <?php
                
                  if($cnx and !is_null($exc3))
                  {
                    $contador = 1;
                    while($columnas = mysqli_fetch_assoc($exc3))
                    {
              echo <<<fila
              <tr>
                <td>$contador</td>
                <td>$columnas[NOMBRE]</td>
                <td>$columnas[ABONADO]</td>
                <td>$columnas[OBSERVACION]</td>
              </tr>
fila;
            $contador += 1;
            }
            mysqli_free_result($exc3);
          }
          
        ?>
                </tfoot>
              </table>
              </div>
              <div class="box-footer">
                <a href="index.php?seccion=ventas_recargas&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
              </div>

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
</div>