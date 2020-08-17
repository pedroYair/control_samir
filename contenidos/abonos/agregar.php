<?php
  if(isset($_GET['id']))
  {
    $id_deudor = $_GET['id'];

    // obtengo cuanto ha abonado el deudor
    $consulta10 = "SELECT ID, NOMBRE FROM deudor WHERE ID ='$id_deudor'";
    $exc10 = mysqli_query($cnx, $consulta10);
    $deudor = mysqli_fetch_assoc($exc10);

    // obtengo el total de la deuda y el nombre del deudor
    $consulta8 = "SELECT sum(TOTAL) AS TOTAL_DEUDAS FROM deuda WHERE FK_DEUDOR = '$deudor[ID]'";
    $exc8 = mysqli_query($cnx, $consulta8);
    $deuda = mysqli_fetch_assoc($exc8);

    // obtengo cuanto ha abonado el deudor
    $consulta9 = "SELECT sum(ABONADO) AS TOTAL_ABONADO FROM abonos WHERE FK_DEUDOR ='$deudor[ID]'";
    $exc9 = mysqli_query($cnx, $consulta9);
    $abono = mysqli_fetch_assoc($exc9);
              
    if(is_null($abono['TOTAL_ABONADO']))
    {
      $abono = 0;
    }
    else
    {
      $abono = $abono['TOTAL_ABONADO'];
    }
    mysqli_free_result($exc8);
    mysqli_free_result($exc9);
    mysqli_free_result($exc10);

    // calculo el saldo
    $saldo = $deuda['TOTAL_DEUDAS'] - $abono;

  }

?>

<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Abonar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <?php
                $resp = "";

                if(isset($_SESSION['resp']))
                {
                  $resp = $_SESSION['resp'];
                  unset($_SESSION['resp']);
                }

                if($resp != "")
                {
                  include("mensajes.php");
                }

                if($deuda)
                {
                  include("small_boxes.php");
                }
              ?>

              <form role="form" action="accionesForms/abonos/agregar.php"  method="post">

                <!-- text input -->
                <div class="form-group">
                  <input name="id_deudor" type="hidden" name="deudor" class="form-control" value="<?php echo $deudor['ID']; ?>">
                </div>

                <div class="form-group">
                  <label>Valor abono</label>
                  <input type="number" name="valor" min="50" max="<?php echo $saldo; ?>" class="form-control">
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Observación</label>
                  <textarea name="observacion" class="form-control" rows="3" placeholder="(Opcional)"></textarea>
                </div>
               
            </div>

            <div class="box-footer">
                <a href="index.php?seccion=deudas&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <?php
                  $boton = "<button type='submit' style='height: 34px;' class='btn btn-primary'>Guardar</button>";

                  if($saldo == 0)
                  {
                    echo "<button type='submit' style='height: 34px;' class='btn btn-primary' disabled>Guardar</button>";
                  }
                  else
                  {
                    echo $boton;
                  }
                ?>
            </div>
              </form>
          </div>
            <!-- /.box-body -->
</div>