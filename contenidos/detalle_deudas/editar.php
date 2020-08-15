<?php

  $nombre = "";
  $estado = "";
  $obs = "";
  $foto = "";
  $id = "";

  if(isset($_GET['id']))
  {
    $id = $_GET['id'];

    $c = "SELECT NOMBRE, ESTADO, OBSERVACION, FOTO FROM deudor WHERE id= '$id' LIMIT 1";

    $fila = mysqli_query($cnx, $c);

    $fila = mysqli_fetch_assoc($fila);

    if($fila)
    {
      $nombre = $fila['NOMBRE'];
      $estado = $fila['ESTADO'];
      $obs = $fila['OBSERVACION'];
      $foto = $fila['FOTO'];
    }
    else
    {
      $mensaje_error = "<div class='alert alert-danger alert-dismissible'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      El deudor solicitado no se encuentra registrado en el sistema.
      </div>";
    }
  }

?>


<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Editar deudor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php

                if($nombre == "")
                {
                  echo $mensaje_error;
                }

              ?>

              <form role="form" action="accionesForms/deudores/editar.php" method="post" enctype="multipart/form-data">

                <!-- text input -->
                <div class="form-group">
                  <label>Nombre</label>
                  <input id="nombre" name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" required>
                </div>

                <div class="form-group">
                  <label>Estado</label>
                  <select name="estado" class="form-control">
                    <option value="1" <?php if($estado == 1){ echo 'selected';} ?>>Activo</option>
                    <option value="0" <?php if($estado == 0){ echo 'selected';} ?>>Innactivo</option>
                  </select>
                </div>
                
                <!-- textarea -->
                <div class="form-group">
                  <label>Observación</label>
                  <textarea id="obs" name="observacion" class="form-control" rows="3"><?php echo $obs; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Foto(se muestra la foto actualmente registrada en el sistema)</label>
                  <br/>
                  <?php
                    if($foto)
                    {
                      echo '<img src="data:image/jpeg;base64,'.base64_encode( $foto ).'" width="160" alt="Avatar actual"/>';
                    }
                  ?>
                  <input name="foto" type="file" class="form-control">
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=deudores&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success ancho_botones">Atrás</a>
                <?php
                if($nombre != "")
                {
                  echo "<button type='submit' style='height: 34px;' class='btn btn-primary'>Guardar</button>";
                }
                else
                {
                  echo "<button type='submit' style='height: 34px;' class='btn btn-primary' disabled>Guardar</button>";
                }
                ?>
            </div>

              </form>
          </div>
            <!-- /.box-body -->
</div>