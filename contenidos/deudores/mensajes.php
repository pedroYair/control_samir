<?php
  $mensaje_agregar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Deudor agregado satisfactoriamente.
  </div>";

  $mensaje_agregar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El deudor no pudo ser agregado.
  </div>";

  $mensaje_editar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Deudor actualizado satisfactoriamente.
  </div>";

  $mensaje_editar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro del deudor no pudo ser actualizado.
  </div>";

  $mensaje_eliminar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Deudor eliminado satisfactoriamente.
  </div>";

  $mensaje_editar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro del deudor no pudo ser eliminado.
  </div>";

  $mensaje_permisos = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  No cuenta con los permisos necesarios para realizar esta acción.
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

    case 'ok_eliminar': 
      echo $mensaje_eliminar_ok;
    break;

    case 'error_eliminar':
      echo $mensaje_eliminar_error;
    break;

    case 'error_permisos':
      echo $mensaje_permisos;
    break;

  }

  echo "</div>";

?>