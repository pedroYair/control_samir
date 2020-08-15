<?php
  $mensaje_agregar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Deuda agregada satisfactoriamente. Proceda a agregar el detalle de venta.
  </div>";

  $mensaje_agregar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  La deuda no pudo ser agregada.
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

  }

  echo "</div>";

?>