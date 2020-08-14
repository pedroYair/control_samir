<?php
  $mensaje_agregar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Servicio agregado satisfactoriamente.
  </div>";

  $mensaje_agregar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El servicio no pudo ser agregado, posiblemente el nombre de servicio colocado ya esté registrado.
  </div>";

  $mensaje_editar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Servicio actualizazo satisfactoriamente.
  </div>";

  $mensaje_editar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El servicio no pudo ser actualizado, posiblemente el nombre de servicio colocado ya esté registrado.
  </div>";

  echo "<div class='box-body'>";

  switch($resp)
  {
    case 'ok_agregar': 
      echo $mensaje_agregar_ok;
    break;

    case 'error_agregar':
      echo $mensaje_agregar_error;
    break;

    case 'ok_editar': 
      echo $mensaje_editar_ok;
    break;

    case 'error_editar':
      echo $mensaje_editar_error;
    break;

  }

  echo "</div>";

?>