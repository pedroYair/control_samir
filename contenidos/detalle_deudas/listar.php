<?php
  if(isset($_GET['id1']) and isset($_GET['id2']))
  {
    $id_deudor = $_GET['id1'];
    $id_deuda = $_GET['id2'];

    $consulta7 = "SELECT SERVICIO, SUM(SUBTOTAL) AS SERVICIO_TOTAL, SUM(CANTIDAD) AS CANTIDAD_TOTAL 
					FROM detalle_deuda AS d JOIN servicios AS s ON d.FK_SERVICIO = s.ID
					WHERE d.FK_DEUDA = '$id_deuda' 
					GROUP BY FK_SERVICIO 
          ORDER BY SERVICIO";
          
  $exc7 = mysqli_query($cnx, $consulta7);
  }
	
  $mensaje_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El detalle de la deuda no pudo ser encontrado.
  </div>";

?>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detalle de la deuda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php
                if(!$exc7)
                {
                  echo $mensaje_error;
                }
            ?>

              <table id="listado_registros" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Servicio</th>
                  <th>Cantidad</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
				<?php
					if($cnx)
					{
            $contador = 1;
            
						while($columnas = mysqli_fetch_assoc($exc7))
						{
							echo <<<fila
							<tr>
							  <td>$contador</td>
							  <td>$columnas[SERVICIO]</td>
                <td>$columnas[CANTIDAD_TOTAL]</td>
							  <td>$columnas[SERVICIO_TOTAL]</td>
							</tr>
fila;
            $contador++;
						}
					}
				?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <?php
                echo "<a href='index.php?seccion=deudas&accion=ver_historial&id=$id_deudor' style='width: 73px; height: 34px;' class='btn btn-success'>Atrás</a>";
              ?>
				  </div>
          </div>
        </div>
    </div>

<?php
  mysqli_free_result($exc7);
?>