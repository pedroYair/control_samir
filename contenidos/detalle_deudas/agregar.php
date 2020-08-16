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
					  include("pages.php");
					}
				?>
			</div>
</div>
<!-- /.box-body -->

<?php
  mysqli_free_result($exc);
  mysqli_free_result($exc2);
  mysqli_free_result($exc3);
  mysqli_free_result($exc4);
?>