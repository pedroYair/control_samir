<?php

  $mensaje_finalizar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Detalle de la deuda finalizado.
  </div>";

  $mensaje_permisos = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  No cuenta con los permisos necesarios para realizar esta acción.
  </div>";

  echo "<div class='box-body'>";

  switch($resp)
  {
    case 'ok_fin': 
      echo $mensaje_finalizar_ok;
    break;

    case 'error_permisos':
      echo $mensaje_permisos;
    break;
  }

  echo "</div>";

?>