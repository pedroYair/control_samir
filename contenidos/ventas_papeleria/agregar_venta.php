<?php
  
  $hoy = date('Y-m-d');

  //obtenemos el valor de la caja del dia anterior
  $ultimo_registro = "SELECT FECHA_VENTA, TOTAL_REAL FROM ventas 
                WHERE ID = (SELECT MAX(ID) FROM ventas)";

  $exc_ultimo = mysqli_query($cnx, $ultimo_registro);
  $ultimo = mysqli_fetch_assoc($exc_ultimo);

  $caja_anterior = is_null($ultimo['TOTAL_REAL']) ? 0 : $ultimo['TOTAL_REAL'];

?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Registro de ventas diario</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/ventas_papeleria/agregar.php"  method="post">

                <div class="row">
                  <div class="col-xs-3">
                    <div class="form-group">
                          <label>Fecha control</label>
                          <input id="fecha" type="date" name="fecha" class="form-control" required/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                        <label>Caja día anterior (<?php
                          $fecha = is_null($ultimo['FECHA_VENTA']) ? "" : $ultimo['FECHA_VENTA'];
                          echo $fecha;?>)</label>
                        <input id="caja_anterior" type="number" name="caja_anterior" value="<?php echo $caja_anterior; ?>" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                          <label>Deudas</label>
                          <input id="deudas" type="number" name="deudas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                        </div>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                        <label>Inversiones</label>
                        <input id="inversiones" type="number" name="inversiones" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                        <label>Deudas canceladas</label>
                        <input id="deudas_cancel" type="number" name="deudas_cancel" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                          <label>Total esperado</label>
                          <input id="total_esp" type="number" name="total_esp" min="0" value="<?php echo $caja_anterior; ?>" class="form-control" readonly/>
                        </div>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                        <label>Total real</label>
                        <input id="total_real" type="number" name="total_real" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="form-group">
                        <label>Diferencia</label>
                        <input id="diferencia" type="number" value="0" class="form-control" readonly/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label>Observaciones</label>
                  <textarea id="obs" name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
                </div>
               
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=ventas_papeleria&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary" onmouseout="calcular();"s>Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>

<script type="text/javascript">

   function calcular()
  {
    var numero1 = parseInt(document.getElementById("caja_anterior").value) || 0;
    var numero3 = parseInt(document.getElementById("deudas_cancel").value) || 0;

    var ingresos = numero1 + numero3;

    var salidas = parseInt(document.getElementById("inversiones").value) || 0;

    document.getElementById("total_esp").value = ingresos - salidas;

    // actualizando diferencia totales en caja

    var numero8 = parseInt(document.getElementById("total_real").value) || 0;
    document.getElementById("diferencia").value = (ingresos - salidas) - numero8;
  }
 </script>