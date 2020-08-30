<?php
  
	$consulta = "SELECT * FROM usuarios ORDER BY NOMBRE";
  $exc = mysqli_query($cnx, $consulta);

  
  // obtengo mensaje de insercion, actualizacion o eliminacion
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
              <h3 class="box-title">Usuarios</h3>
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
                        <a class="btn btn-primary" href="index.php?seccion=usuarios&accion=agregar" title="Agregar deudores" style="margin:10px;"><i class="fa fa-plus"></i> Agregar</a>
                    </div>
              </div>

              <table id="listado_registros" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Nivel</th>
                  <th>Email</th>
                  <th>Fecha Alta</th>
                  <th>Estado</th>
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

							echo <<<fila
							<tr id="$columnas[ID]">
							  <td>$contador</td>
                <td>$columnas[NOMBRE]</td>
                <td>$columnas[NIVEL]</td>
							  <td>$columnas[EMAIL]</td>
                <td>$columnas[FECHA_ALTA]</td>
                <td>$estado</td>
                <td>
                  <a class="btn btn-warning .edit" href="index.php?seccion=usuarios&accion=editar&id=$columnas[ID]" title="Editar"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-danger delete" href="accionesForms/usuarios/eliminar.php?id=$columnas[ID]" onclick="return confirm('¿Inhabilitar/Habilitar al usuario $columnas[NOMBRE]?')" title="Inhabilitar"><i class="fa fa-trash"></i></a>
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