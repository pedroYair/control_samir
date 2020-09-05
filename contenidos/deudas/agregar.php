<?php

  $consulta = "SELECT ID, NOMBRE FROM deudor WHERE ESTADO = '1' ORDER BY NOMBRE";

  $exc = mysqli_query($cnx, $consulta);

?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar deuda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/deudas/agregar.php"  method="post">

                <div class="row">
                  <div class="col-xs-4">
                    <div class="form-group">
                          <label>Fecha deuda</label>
                          <input id="fecha" type="date" name="fecha" class="form-control" required/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-10">
                    <div class="form-group">
                      <label>Deudor (Solo deudores habilitados)</label>
                      <select name="deudor" class="form-control select2">
                      <?php
                        while($deudor = mysqli_fetch_assoc($exc))
                        {
                          echo <<<DEUDOR
                          <option value="$deudor[ID]">$deudor[NOMBRE]</option>
DEUDOR;
                        }
                      ?>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- textarea -->
                <div class="row">
                  <div class="col-xs-10">
                    <div class="form-group">
                      <label>Observación</label>
                      <textarea id="obs" name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
                    </div>
                  </div>
                </div>

               
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=deudas&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>