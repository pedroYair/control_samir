
<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar usuario</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="accionesForms/usuarios/agregar.php" enctype="multipart/form-data" method="post">

                <!-- text input -->
                <div class="form-group">
                  <label>Nombre</label>
                  <input name="nombre" type="text" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="email" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Clave</label>
                  <input name="password" type="text" class="form-control" required/>
                </div>

                <div class="form-group">
                  <label>Nivel</label>
                    <select name="nivel" class="form-control">
                      <option value="administrador">Administrador</option>
                      <option value="moderador">Moderador</option>
                      <option value="lector">Lector</option>
                    </select>
                </div>

                <div class="form-group">
                  <label>Foto (Opcional)</label>
                  <input type="file" name="foto" accept="image/jpeg,image/png" class="form-control">
                </div>
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=usuarios&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <button type="submit" style="height: 34px;" class="btn btn-primary">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>