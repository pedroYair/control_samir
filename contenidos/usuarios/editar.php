<?php

  $nombre = "";
  $estado = "";
  $email = "";
  $nivel = "";
  $foto = "";
  $id = "";
  $resp = "";

  if(isset($_SESSION['ID']) or isset($_GET['id']))
  {
    $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['ID'];

    $c = "SELECT EMAIL, ESTADO, NIVEL, NOMBRE, FOTO FROM usuarios WHERE ID= '$id' LIMIT 1";

    $fila = mysqli_query($cnx, $c);

    $fila = mysqli_fetch_assoc($fila);

    if($fila)
    {
      $nombre = $fila['NOMBRE'];
      $estado = $fila['ESTADO'];
      $email = $fila['EMAIL'];
      $nivel = $fila['NIVEL'];
      $foto = $fila['FOTO'];
      $acceso = isset($_GET['acceso']) ? $_GET['acceso'] : "";
    }
    else
    {
      $resp = "<div class='alert alert-danger alert-dismissible'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      El usuario solicitado no se encuentra registrado en el sistema.
      </div>";
    }
  }

  $resp = "";
  if(isset( $_SESSION['resp'] ))
  {
    $resp = $_SESSION['resp'];
    unset( $_SESSION['resp'] );
  }

?>


<!-- general form elements disabled -->
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Perfil del usuario</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php

                if($resp != "")
                {
                  include("mensajes.php");
                }

              ?>

              <form role="form" action="accionesForms/usuarios/editar.php" method="post" enctype="multipart/form-data">

                <input name="id" type="hidden" class="form-control" value="<?php echo $id; ?>">

                <?php if($acceso == "perfil"): ?>
                  <input name="acceso" type="hidden" class="form-control" value="<?php echo $acceso; ?>" required>
                <?php endif ?>

                <!-- text input -->
                <div class="form-group">
                  <label>Nombre</label>
                  <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" required>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="text" class="form-control" value="<?php echo $email; ?>" required>
                </div>

                <div class="form-group">
                  <label>Contraseña actual</label>
                  <input name="password" type="password" class="form-control" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <label>Contraseña nueva</label>
                  <input name="new_password" type="password" class="form-control" autocomplete="off">
                </div>

                <div class="form-group">
                  <label>Nivel</label>
                  <?php if($_SESSION['NIVEL'] == "administrador"): ?>
                    <select name="nivel" class="form-control">
                      <option value="administrador" <?php if($nivel == "administrador"){ echo 'selected';} ?>>Administrador</option>
                      <option value="moderador" <?php if($nivel == "moderador"){ echo 'selected';} ?>>Moderador</option>
                      <option value="lector" <?php if($nivel == "lector"){ echo 'selected';} ?>>Lector</option>
                    </select>
                  <?php else: ?>  
                    <input name="nivel" type="text" class="form-control" value="<?php echo $nivel; ?>" required readonly>
                  <?php endif ?>
                </div>

              <?php if($_SESSION['NIVEL'] == "administrador"): ?>

                <div class="form-group">
                  <label>Estado</label>
                  <select name="estado" class="form-control">
                    <option value="1" <?php if($estado == 1){ echo 'selected';} ?>>Activo</option>
                    <option value="0" <?php if($estado == 0){ echo 'selected';} ?>>Innactivo</option>
                  </select>
                </div>

              <?php endif ?>

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
            </div>

            <div class="box-footer">
                <?php if($acceso == ""): ?>
                  <a href="index.php?seccion=usuarios&accion=listar" style="width: 73px; height: 34px;" class="btn btn-success">Atrás</a>
                <?php endif ?>
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