<?php

  $mensaje = "";

  if(isset($_SESSION['id_insertado']))
  {
    $id_deuda_insertada = $_SESSION['id_insertado'];
    
    $consulta = "SELECT * FROM deuda AS a JOIN deudor AS b ON a.FK_DEUDOR = b.ID WHERE a.ID = '$id_deuda_insertada' LIMIT 1";
    $exc = mysqli_query($cnx, $consulta);
    $deuda = mysqli_fetch_assoc($exc);

    // unset($_SESSION['id_insertado']); debe eliminarse cuando se 

    $consulta2 = "SELECT ID, SERVICIO FROM servicios ORDER BY SERVICIO";
    $exc2 = mysqli_query($cnx, $consulta2);

    $consulta3 = "SELECT SUM(SUBTOTAL) AS SUBTOTAL_AGREGADO FROM detalle_deuda WHERE FK_DEUDA = '$id_deuda_insertada'";
    $exc3 = mysqli_query($cnx, $consulta3);

    $subtotal_query = mysqli_fetch_assoc($exc3);

    $subtotal_agregado = 0;
    if(!is_null($subtotal_query['SUBTOTAL_AGREGADO']))
    {
      
      $subtotal_agregado = $subtotal_query['SUBTOTAL_AGREGADO'];
    }

  }
  else
  {
    $mensaje = "No se pudo encontrar el registro de esta deuda";
  }

  // obtengo mensaje de insercion, actualizacion o eliminacion de servicios
  $resp = "";
  if(isset($_SESSION['resp']))
  {
    $resp = $_SESSION['resp'];
    unset( $_SESSION['resp'] );
  }
?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Agregar detalle de deuda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            <?php
                if($resp != "")
                {
                  include("mensajes.php");
                }

                if($deuda)
                {
                  include("small_boxes.php");
                }
            ?>
            

              <form role="form" action="accionesForms/detalle_deudas/agregar.php" method="post">

                <!-- text input -->
                <div class="form-group">
                  <label>Servicio</label>
                  <select name="servicio" class="form-control">
                  <?php
                    while($servicio = mysqli_fetch_assoc($exc2))
                    {
                      echo <<<SERVICIO
                      <option value="$servicio[ID]">$servicio[SERVICIO]</option>
SERVICIO;
                    }
                  ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Subtotal</label>
                  <input type="number" name="subtotal" min="50" step="50" class="form-control">
                </div>

                <div class="form-group">
                  <label>Cantidad</label>
                  <input type="number" name="cantidad" min="1" class="form-control" placeholder="(Opcional)">
                </div>

                <div class="form-group">
                  <label>Observación</label>
                  <textarea name="observacion" class="form-control" rows="2" placeholder="(Opcional)"></textarea>
                </div>

                <input type="hidden" name="id_deuda" value="<?php echo $id_deuda_insertada; ?>">
            </div>

            <div class="box-footer">
                <button type="submit" style="height: 34px;" class="btn btn-primary">Guardar</button>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>