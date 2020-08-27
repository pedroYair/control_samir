<?php
  $error_clave_old = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  La constraseña actual no coincide con los caracteres ingresados.
  </div>";

   $mensaje_editar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Perfil del usuario actualizado satisfactoriamente.
  </div>";

  $mensaje_editar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro del usuario no pudo ser actualizado.
  </div>";

  $mensaje_agregar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Deudor agregado satisfactoriamente.
  </div>";

  $mensaje_agregar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El deudor no pudo ser agregado.
  </div>";


  echo "<div class='box-body'>";

  switch($resp)
  {
    case 'error_clave_old': 
      echo $error_clave_old;
    break;

    case 'ok_editar': 
      echo $mensaje_editar_ok;
    break;

    case 'error_editar':
      echo $mensaje_editar_error;
    break;

    case 'ok_agregar': 
      echo $mensaje_agregar_ok;
    break;

    case 'error_agregar':
      echo $mensaje_agregar_error;
    break;

    

    case 'ok_eliminar': 
      echo $mensaje_eliminar_ok;
    break;

    case 'error_eliminar':
      echo $mensaje_eliminar_error;
    break;

  }

  echo "</div>";

?>