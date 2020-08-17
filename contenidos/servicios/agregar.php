
<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar servicio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/servicios/agregar.php" method="post">

                <!-- text input -->
                <div class="form-group">
                  <label>Servicio</label>
                  <input id="servicio" name="servicio" type="text" class="form-control" placeholder="Nuevo servicio" required>
                </div>

                <div class="form-group">
                  <label>Precio</label>
                  <input id="precio" name="precio" type="number" min="50" class="form-control" placeholder="(Opcional)">
                </div>
                
                <!-- textarea -->
                <div class="form-group">
                  <label>Observación</label>
                  <textarea id="obs" name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
                </div>
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=servicios&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary">Guardar</button>
            </div>

              </form>
          </div>
            <!-- /.box-body -->
</div>