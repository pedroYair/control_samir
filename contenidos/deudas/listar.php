<?php
  
	$consulta = "SELECT b.ID, NOMBRE, ESTADO, sum(TOTAL) AS TOTAL_DEUDAS FROM deuda AS a JOIN deudor AS b ON a.FK_DEUDOR = b.ID GROUP BY b.ID";
  $exc = mysqli_query($cnx, $consulta);
  

  // obtengo mensaje de insercion o eliminacion de deudas
  $resp = "";
  if(isset( $_SESSION['resp'] ))
  {
    $resp = $_SESSION['resp'];
    unset( $_SESSION['resp'] );
  }
?>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Deudas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php
                if($resp != "")
                {
                  include("mensajes.php");
                }
            ?>

              <div class="form-group">
                    <div class="col-md-offset-2 col-md-8" style="margin-left:0px;">
                        <a class="btn btn-primary" href="index.php?seccion=deudas&accion=agregar" title="Agregar deuda" style="margin:10px;"><i class="fa fa-plus"></i> Agregar</a>
                    </div>
              </div>

              <table id="listado_deudas" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Deuda Total</th>
                  <th>Abonado</th>
                  <th>Saldo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
				<?php
					if($cnx)
					{
            $contador = 1;
            
						while($columnas = mysqli_fetch_assoc($exc))
						{
              $estado = "<a class='btn btn-sm btn-success' title='Habilitado'><i class='fa fa-check'></i></a>";
              
              if($columnas['ESTADO'] == '0')
              {
                $estado = "<a class='btn btn-sm btn-danger' title='Inhabilitado'><i class='fa fa-times'></i></a>";
              }

              $consulta2 = "SELECT sum(ABONADO) AS TOTAL_ABONADO FROM abonos AS a JOIN deudor AS d ON a.FK_DEUDOR = d.ID WHERE d.ID ='$columnas[ID]'";
              $exc2 = mysqli_query($cnx, $consulta2);
              $abono = mysqli_fetch_assoc($exc2);
              
              if(is_null($abono['TOTAL_ABONADO']))
              {
                $abono = 0;
                mysqli_free_result($exc2);
              }
              else
              {
                $abono = $abono['TOTAL_ABONADO'];
              }

              $saldo = $columnas['TOTAL_DEUDAS'] - $abono;
              
							echo <<<fila
							<tr id="$columnas[ID]">
							  <td>$contador</td>
							  <td>$columnas[NOMBRE]</td>
                <td>$estado</td>
							  <td>$columnas[TOTAL_DEUDAS]</td>
							  <td>$abono</td>
							  <td>$saldo</td>
                <td>
                <a class="btn btn-primary" title="Ver historial de deudas y abonos" href="#"><i class="fa fa-eye"></i></a>
                </td>
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
          </div>
        </div>
    </div>
          <!-- /.box -->
<?php
  mysqli_free_result($exc);
?>