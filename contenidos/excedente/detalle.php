<?php
  
  $id = isset($_GET['id']) ? $_GET['id'] : 0;

  //obtenemos el registro a editar
  $registro = "SELECT * FROM excedente WHERE ID = '$id' LIMIT 1";
  $exc = mysqli_query($cnx, $registro);
  $venta = mysqli_fetch_assoc($exc);
?>


 <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Detalle del registro</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <form role="form">

                  <div class="row">
                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Caja anterior</label>
                      <input type="number" value="<?php echo $venta['CAJA']; ?>" class="form-control" readonly/>
                    </div>
                  </div>  

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Ingresos recargas</label>
                      <input type="number" value="<?php echo $venta['ING_RECARGAS']; ?>" class="form-control" readonly/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Ingresos papelería</label>
                      <input type="number" value="<?php echo $venta['ING_PAPELERIA']; ?>" class="form-control" readonly/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Deudas canceladas</label>
                      <input type="number" value="<?php echo $venta['DEUDAS_CANCEL']; ?>" class="form-control" readonly/>
                    </div>
                  </div>
                </div>

                <hr/>
                <div class="row">

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Deudas</label>
                      <input type="number" value="<?php echo $venta['PRESTAMOS']; ?>" class="form-control" readonly/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Inversiones</label>
                      <input type="number" value="<?php echo $venta['INVERSIONES']; ?>" class="form-control" readonly/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Pérdidas</label>
                      <input type="number" value="<?php echo $venta['PERDIDAS']; ?>" class="form-control" readonly/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Total caja esperado</label>
                      <input id="total_esperado" type="number" name="total_esperado" min="0" value="<?php echo $venta['TOTAL_REAL']; ?>" class="form-control" readonly/>
                    </div>
                  </div>

                </div>

                <hr/>

                <div class="form-group">
                  <label>Observaciones</label>
                  <textarea name="observacion" class="form-control" rows="3" readonly/><?php echo $venta['OBSERVACION']; ?></textarea>
                </div>

                </form>
              </div>
              </div>

              <div class="box-footer">
                <a href="index.php?seccion=excedente&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
              </div>

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->