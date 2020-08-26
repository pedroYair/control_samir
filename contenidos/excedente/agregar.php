<?php
  
  //obtenemos el valor de la caja del ultimo registro
  $ultimo_registro = "SELECT FECHA, TOTAL_REAL FROM excedente
                WHERE ID = (SELECT MAX(ID) FROM excedente) LIMIT 1";

  $exc_ultimo = mysqli_query($cnx, $ultimo_registro);
  $ultimo = mysqli_fetch_assoc($exc_ultimo);

  $caja_anterior = is_null($ultimo['TOTAL_REAL']) ? 0 : $ultimo['TOTAL_REAL'];

?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar registro a excedente</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/excedente/agregar.php"  method="post">

                <div class="row">
                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Caja actual (<?php 
                        $fecha = is_null($ultimo['FECHA']) ? "" : $ultimo['FECHA']; 
                        echo $fecha;?>)</label>
                      <input id="caja_anterior" type="number" name="caja_anterior" value="<?php echo $caja_anterior; ?>" class="form-control" readonly>
                    </div>
                  </div>  

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Ingresos recargas</label>
                      <input id="recargas" type="number" name="recargas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Ingresos papelería</label>
                      <input id="papeleria" type="number" name="papeleria" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Deudas canceladas</label>
                      <input id="deudas_canceladas" type="number" name="deudas_canceladas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>
                </div>

                <hr/>
                <div class="row">

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Deudas</label>
                      <input id="deudas" type="number" name="deudas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Inversiones</label>
                      <input id="inversiones" type="number" name="inversiones" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Pérdidas</label>
                      <input id="perdidas" type="number" name="perdidas" min="0" value="0" class="form-control" onmouseout="calcular();"/>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <label>Total caja esperado</label>
                      <input id="total_esperado" type="number" name="total_esperado" min="0" value="<?php echo $caja_anterior; ?>" class="form-control" readonly>
                    </div>
                  </div>
                </div>

                <hr/>

                <div class="form-group">
                  <label>Observaciones</label>
                  <textarea name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
                </div>
                
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=excedente&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary" onmouseover="calcular();">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>

 <script type="text/javascript">

   function calcular()
  {
    var numero1 = parseInt(document.getElementById("caja_anterior").value) || 0;
    var numero2 = parseInt(document.getElementById("recargas").value) || 0;
    var numero3 = parseInt(document.getElementById("papeleria").value) || 0;
    var numero7 = parseInt(document.getElementById("deudas_canceladas").value) || 0;

    var ingresos = numero1 + numero2 + numero3 + numero7;

    var numero4 = parseInt(document.getElementById("deudas").value) || 0;
    var numero5 = parseInt(document.getElementById("inversiones").value) || 0;
    var numero6 = parseInt(document.getElementById("perdidas").value) || 0;

    var salidas = numero4 + numero5 + numero6;

    document.getElementById("total_esperado").value = ingresos - salidas;
  }
 </script>