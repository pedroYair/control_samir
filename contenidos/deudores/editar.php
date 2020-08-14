<?php

  $servicio = "";
  $precio = "";
  $obs = "";
  $id = "";

  if(isset($_GET['id']))
  {
    $id = $_GET['id'];

    $c = "SELECT * FROM servicios WHERE id= '$id' LIMIT 1";

    $fila = mysqli_query($cnx, $c);

    $fila = mysqli_fetch_assoc($fila);

    if($fila)
    {
      $servicio = $fila['SERVICIO'];
      $precio = $fila['PRECIO'];
      $obs = $fila['OBSERVACION'];
    }
    else
    {
      $mensaje_error = "<div class='alert alert-danger alert-dismissible'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      El servicio solicitado no se encuentra registrado en el sistema.
      </div>";
    }
  }

?>


<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Editar servicio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php

                if($servicio == "")
                {
                  echo $mensaje_error;
                }

              ?>

              <form role="form" action="accionesForms/servicios/editar.php" method="post">

                <!-- text input -->
                <div class="form-group">
                  <label>Servicio</label>
                  <input id="servicio" name="servicio" type="text" class="form-control" value="<?php echo $servicio; ?>" required>
                </div>

                <div class="form-group">
                  <label>Precio</label>
                  <input id="precio" name="precio" type="text" class="form-control" value="<?php echo $precio; ?>">
                </div>
                
                <!-- textarea -->
                <div class="form-group">
                  <label>Observación</label>
                  <textarea id="obs" name="observacion" class="form-control" rows="3"><?php echo $obs; ?></textarea>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=servicios&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success ancho_botones">Atrás</a>
                <?php
                if($servicio != "")
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