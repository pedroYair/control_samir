<?php

  $mensaje_agregar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Registro agregado satisfactoriamente.
  </div>";

  $mensaje_agregar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro no pudo ser agregado.
  </div>";

  $mensaje_editar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro fue actualizado.
  </div>";

  $mensaje_editar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro no pudo ser actualizado.
  </div>";

  $mensaje_eliminar_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro fue eliminado.
  </div>";

  $mensaje_eliminar_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El registro no pudo ser actualizado.
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
  }

  echo "</div>";

?>