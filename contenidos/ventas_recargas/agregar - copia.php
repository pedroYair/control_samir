<?php
  
  $hoy = date('Y-m-d');

  //obtenemos el valor de la caja del dia anterior
  $ultimo_registro = "SELECT FECHA, TOTAL_REAL, SALDO_CIERRE_REAL FROM ventas_recargas
                WHERE ID = (SELECT MAX(ID) FROM ventas_recargas WHERE FECHA != '$hoy')";

  $exc_ultimo = mysqli_query($cnx, $ultimo_registro);
  $ultimo = mysqli_fetch_assoc($exc_ultimo);

  $caja_anterior = is_null($ultimo['TOTAL_REAL']) ? 0 : $ultimo['TOTAL_REAL'];

  $saldo_anterior = is_null($ultimo['SALDO_CIERRE_REAL']) ? 0 : $ultimo['SALDO_CIERRE_REAL'];

?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Registro de ventas dia <?php echo $hoy; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/ventas_recargas/agregar.php"  method="post">

                <div class="form-group">
                  <label>Saldo día anterior (<?php
                    $fecha = is_null($ultimo['FECHA']) ? "" : $ultimo['FECHA'];
                    echo $fecha;?>)</label>
                  <input type="number" name="saldo_anterior" value="<?php echo $saldo_anterior; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Recargado</label>
                  <input type="number" name="recargado" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Saldo hoy</label>
                  <input type="number" name="saldo_hoy" value="<?php echo $saldo_anterior; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Caja día anterior</label>
                  <input type="number" name="caja_anterior" value="<?php echo $caja_anterior; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Ventas del día actual</label>
                  <input type="number" name="ventas_dia" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Deudas canceladas</label>
                  <input type="number" name="deudas_cancel" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Deudas</label>
                  <input type="number" name="deudas" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Inversiones</label>
                  <input type="number" name="inversiones" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Total caja esperado</label>
                  <input type="number" name="total_esperado" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Total caja real</label>
                  <input type="number" name="inversiones" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Saldo cierre esperado</label>
                  <input type="number" name="total_esperado" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Saldo cierre real</label>
                  <input type="number" name="inversiones" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Observaciones</label>
                  <textarea name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
                </div>

                <div class="form-group">
                  <label>Estado</label>
                  <select name="estado" class="form-control">
                    <option value="1">Registro finalizado</option>
                    <option value="0">Registro no finalizado.</option>
                  </select>
                </div>
               
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=ventas_papeleria&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>