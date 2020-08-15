
<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar deudor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/deudores/agregar.php" enctype="multipart/form-data" method="post">

                <!-- text input -->
                <div class="form-group">
                  <label>Nombre deudor</label>
                  <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre deudor" required>
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Observación</label>
                  <textarea id="obs" name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
                </div>

                <div class="form-group">
                  <label>Foto (Opcional)</label>
                  <input type="file" name="foto" accept="image/jpeg,image/png" class="form-control">
                </div>
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=deudores&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>