<?php

  $mensaje_finalizar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Detalle de la deuda finalizado.
  </div>";

  echo "<div class='box-body'>";

  switch($resp)
  {
    case 'ok_fin': 
      echo $mensaje_finalizar_ok;
    break;
  }

  echo "</div>";

?>