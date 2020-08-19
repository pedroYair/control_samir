<?php
  if(isset($_GET['id']))
  {
    $id_abono = $_GET['id'];

    $consulta6 = "SELECT SERVICIO, ABONADO, a.OBSERVACION
					FROM abonos AS a JOIN servicios AS s ON a.FK_SERVICIO = s.ID
						WHERE a.ID = '$id_abono' 
							ORDER BY SERVICIO";
          
	$exc6 = mysqli_query($cnx, $consulta6);
  }
	
  $mensaje_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro del abono no pudo ser encontrado.
  </div>";

?>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detalle del abono</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php
                if(is_null($exc6))
                {
                  echo $mensaje_error;
                }
            ?>

              <table id="listado_registros" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Servicio</th>
                  <th>Abonado</th>
                  <th>Observacion</th>
                </tr>
                </thead>
                <tbody>
				<?php
					if($cnx and !is_null($exc6))
					{
						$contador = 1;
						while($columnas = mysqli_fetch_assoc($exc6))
						{
							echo <<<fila
							<tr>
							  <td>$contador</td>
							  <td>$columnas[SERVICIO]</td>
							  <td>$columnas[ABONADO]</td>
							  <td>$columnas[OBSERVACION]</td>
							</tr>
fila;
            $contador++;
						}
						mysqli_free_result($exc6);
					}
				?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <?php
                echo "<a href='index.php?seccion=detalle_deudas&accion=hoy' style='width: 73px; height: 34px;' class='btn btn-success'>Atrás</a>";
              ?>
			</div>
          </div>
        </div>
    </div>