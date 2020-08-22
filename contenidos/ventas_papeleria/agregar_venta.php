<?php
  
  $hoy = date('Y-m-d');

  //obtenemos el valor de la caja del dia anterior
  $ultimo_registro = "SELECT FECHA_VENTA, TOTAL_REAL FROM ventas 
                WHERE ID = (SELECT MAX(ID) FROM ventas WHERE FECHA_VENTA != '$hoy')";

  $exc_ultimo = mysqli_query($cnx, $ultimo_registro);
  $ultimo = mysqli_fetch_assoc($exc_ultimo);

  $caja_anterior = is_null($ultimo['TOTAL_REAL']) ? 0 : $ultimo['TOTAL_REAL'];

?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Registro de ventas dia <?php echo $hoy; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/ventas_papeleria/agregar.php"  method="post">

                <div class="form-group">
                  <label>Caja día anterior (<?php
                    $fecha = is_null($ultimo['FECHA_VENTA']) ? "" : $ultimo['FECHA_VENTA'];
                    echo $fecha;?>)</label>
                  <input type="number" name="caja_anterior" value="<?php echo $caja_anterior; ?>" class="form-control" readonly="">
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
                  <label>Deudas canceladas</label>
                  <input type="number" name="deudas_cancel" min="50" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Observaciones</label>
                  <textarea id="obs" name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
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