<?php
  
  //obtenemos el valor de la caja del dia anterior
  $ultimo_registro = "SELECT FECHA, TOTAL_REAL, SALDO_CIERRE_REAL FROM ventas_recargas
                WHERE ID = (SELECT MAX(ID) FROM ventas_recargas) LIMIT 1";

  $exc_ultimo = mysqli_query($cnx, $ultimo_registro);
  $ultimo = mysqli_fetch_assoc($exc_ultimo);

  $caja_anterior = is_null($ultimo['TOTAL_REAL']) ? 0 : $ultimo['TOTAL_REAL'];

  $saldo_anterior = is_null($ultimo['SALDO_CIERRE_REAL']) ? 0 : $ultimo['SALDO_CIERRE_REAL'];

?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Registro de ventas recargas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/ventas_recargas/agregar.php"  method="post">

                <div class="row">
                  <div class="col-xs-4">
                    <div class="form-group">
                          <label>Fecha control</label>
                          <input id="fecha" type="date" name="fecha" class="form-control" required/>
                    </div>
                  </div>
                </div>

                <hr/>

                <div class="row">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Saldo día anterior (<?php 
                        $fecha = is_null($ultimo['FECHA']) ? "" : $ultimo['FECHA']; 
                        echo $fecha;?>)</label>
                      <input id="saldo_anterior" type="number" name="saldo_anterior" value="<?php echo $saldo_anterior; ?>" class="form-control" readonly>
                    </div>
                  </div>  

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Recargado</label>
                      <input id="recargado" type="number" name="recargado" value="0" class="form-control">
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Saldo hoy</label>
                      <input id="saldo_hoy" type="number" name="saldo_hoy" value="<?php echo $saldo_anterior; ?>" class="form-control" readonly>
                    </div>
                  </div>
                </div>

                <hr/>
                <div class="row">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Caja día anterior (<?php 
                        $fecha = is_null($ultimo['FECHA']) ? "" : $ultimo['FECHA']; 
                        echo $fecha;?>)</label>
                      <input id="caja_anterior" type="number" name="caja_anterior" value="<?php echo $caja_anterior; ?>" class="form-control" readonly>
                    </div>
                  </div>  

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Ventas del día actual</label>
                      <input id="ventas_dia" type="number" name="ventas_dia" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Deudas canceladas</label>
                      <input id="deudas_canceladas" type="number" name="deudas_canceladas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>
                </div>

                <hr/>
                <div class="row">

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Deudas</label>
                      <input id="deudas" type="number" name="deudas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Inversiones</label>
                      <input id="inversiones" type="number" name="inversiones" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Pérdidas</label>
                      <input id="perdidas" type="number" name="perdidas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>
                </div>

                <hr/>
                <div class="row">

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Total caja esperado</label>
                      <input id="total_esperado" type="number" name="total_esperado" min="0" value="<?php echo $caja_anterior; ?>" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Total caja real</label>
                      <input id="total_real" type="number" name="total_real" min="0" value="0" class="form-control" onmouseout="calcular();">
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Diferencia totales</label>
                      <input id="diferencia1" type="number" min="0" value="0" class="form-control" readonly/>
                    </div>
                  </div>

                </div>

                <hr/>
                <div class="row">

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Saldo cierre esperado</label>
                      <input id="saldo_cierre_esp" type="number" name="saldo_cierre_esp" min="0" value="<?php echo $saldo_anterior; ?>" class="form-control" readonly>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Saldo cierre real</label>
                      <input id="saldo_cierre_real" type="number" name="saldo_cierre_real" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Diferencia saldos</label>
                      <input id="diferencia2" type="number" min="0" value="0" class="form-control" readonly/>
                    </div>
                  </div>

                </div>

                <hr/>

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
                <a href="index.php?seccion=ventas_recargas&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary" onmouseover="calcular();">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>

 <script>
  document.getElementById("recargado").onmouseout = function()
  {
    var numero1 = parseInt(document.getElementById("saldo_anterior").value) || 0;
    var numero2 = parseInt(document.getElementById("recargado").value) || 0;
    var suma = numero1 + numero2;
    document.getElementById("saldo_hoy").value = suma;
    document.getElementById("saldo_cierre_esp").value = suma;
  }
 </script>

 <script type="text/javascript">

   function calcular()
  {
    var numero1 = parseInt(document.getElementById("caja_anterior").value) || 0;
    var numero2 = parseInt(document.getElementById("ventas_dia").value) || 0;
    var numero3 = parseInt(document.getElementById("deudas_canceladas").value) || 0;

    var ingresos = numero1 + numero2 + numero3;

    var numero4 = parseInt(document.getElementById("deudas").value) || 0;
    var numero5 = parseInt(document.getElementById("inversiones").value) || 0;
    var numero6 = parseInt(document.getElementById("perdidas").value) || 0;

    var salidas = numero4 + numero5 + numero6;

    document.getElementById("total_esperado").value = ingresos - salidas;

    // actualizando el saldo al cierre

    var numero7 = parseInt(document.getElementById("saldo_hoy").value) || 0;
    document.getElementById("saldo_cierre_esp").value = numero7 - numero2;

    // actualizando diferencia totales en caja

    var numero8 = parseInt(document.getElementById("total_real").value) || 0;
    document.getElementById("diferencia1").value = (ingresos - salidas) - numero8;

    // actualizando diferencia saldos cierre

    var numero9 = parseInt(document.getElementById("saldo_cierre_real").value) || 0;
    document.getElementById("diferencia2").value = (numero7 - numero2) - numero9;

  }
 </script>