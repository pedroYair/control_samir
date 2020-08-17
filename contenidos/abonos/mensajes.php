<?php

$mensaje_agregar_ok = "<div class='alert alert-success alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
Abono agregado satisfactoriamente.
</div>";

$mensaje_agregar_error = "<div class='alert alert-danger alert-dismissible'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
El abono no pudo ser agregado, posiblemente el nombre de servicio colocado ya esté registrado.
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