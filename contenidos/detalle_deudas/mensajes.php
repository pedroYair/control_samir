<?php
  $mensaje_agregar_deuda_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Deuda registra satisfactoriamente. Proceda a agregar el detalle de deuda.
  </div>";

  $mensaje_agregar_deuda_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  La deuda no pudo ser registrada.
  </div>";

  $mensaje_agregar_detalle_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Servicio agregado a la deuda.
  </div>";

  $mensaje_agregar_detalle_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El servicio no pudo ser agregado a la deuda
  </div>";

  $mensaje_eliminar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Servicio eliminado del detalle satisfactoriamente.
  </div>";

  $mensaje_eliminar_error = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El servicio no pudo ser eliminado del detalle.s
  </div>";


  echo "<div class='box-body'>";

  switch($resp)
  {
    case 'ok_agregar_deuda': 
      echo $mensaje_agregar_deuda_ok;
    break;

    case 'error_agregar_deuda':
      echo $mensaje_agregar_deuda_error;
    break;

    case 'ok_agregar_detalle': 
      echo $mensaje_agregar_detalle_ok;
    break;

    case 'error_agregar_detalle':
      echo $mensaje_agregar_detalle_error;
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