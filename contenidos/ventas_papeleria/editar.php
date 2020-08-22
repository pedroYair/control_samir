<?php
  
  $id_venta = isset($_GET['id']) ? $_GET['id'] : 0;

  //obtenemos el valor de la caja del dia anterior
  $registro = "SELECT * FROM ventas WHERE ID = '$id_venta' LIMIT 1";

  $exc_ultimo = mysqli_query($cnx, $registro);
  $ultimo = mysqli_fetch_assoc($exc_ultimo);
?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Registro de ventas dia <?php echo $ultimo['FECHA_VENTA']; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/ventas_papeleria/editar.php"  method="post">

                <div class="form-group">
                  <label>Caja día anterior</label>
                  <input type="number" name="caja_anterior" value="<?php echo $ultimo['CAJA_ANTERIOR']; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Total día actual</label>
                  <input type="number" name="total_dia" value="<?php echo $ultimo['TOTAL_DIA']; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Total esperado día actual</label>
                  <input type="number" name="total_esperado" value="<?php echo $ultimo['TOTAL_ESPERADO']; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                  <label>Deudas</label>
                  <input type="number" name="deudas" min="0" value="<?php echo $ultimo['DEUDAS']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Inversiones</label>
                  <input type="number" name="inversiones" min="0" value="<?php echo $ultimo['INVERSIONES']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Deudas canceladas</label>
                  <input type="number" name="deudas_cancel" min="0" value="<?php echo $ultimo['DEUDAS_CANCEL']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Caja real</label>
                  <input type="number" name="caja_real" min="0" value="0" class="form-control">
                </div>

                <div class="form-group">
                  <label>Observaciones</label>
                  <textarea id="obs" name="observacion" class="form-control" rows="3"><?php echo $ultimo['OBSERVACION']; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Estado</label>
                  <select name="estado" class="form-control">
                    <option value="1" <?php if($ultimo['ESTADO'] == 1){ echo 'selected';} ?>>Registro finalizado</option>
                    <option value="0" <?php if($ultimo['ESTADO'] == 0){ echo 'selected';} ?>>Registro no finalizado.</option>
                  </select>
                </div>

                <input type="hidden" name="id_venta" value="<?php echo $ultimo['ID']; ?>" class="form-control">
               
            </div>

            <div class="box-footer">
              <?php
                if(isset($_GET['estado']))
                {
                  echo "<a href='index.php?seccion=detalle_ventas&accion=agregar&id=$id_venta' style='width: 73px; height: 34px;'' class='btn btn-success'>Atrás</a>";
                }
                else
                {
                  echo "<a href='index.php?seccion=ventas_papeleria&accion=listar' style='width: 73px; height: 34px;'' class='btn btn-success'>Atrás</a>";
                }
              ?>
                <button type="submit" style="height: 34px;" class="btn btn-primary">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>