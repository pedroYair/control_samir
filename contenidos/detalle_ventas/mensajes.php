<?php

  $mensaje_agregar_venta_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Venta creada proceda a agregar el detalle de la deuda.
  </div>";

  $mensaje_agregar_venta_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  La venta no pudo ser registrada.
  </div>";

  $mensaje_ok_agregar_detalle = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Servicio agregado al detalle de la venta
  </div>";

  $mensaje_error_agregar_detalle = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  El servicio no pudo ser agregado al detalle de la venta.
  </div>";
  
  $mensaje_duplicado = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  Ya existe un registro de ventas para el día en curso. Elimine el registro si desea reiniciar.
  </div>";

  $mensaje_eliminar_venta_ok = "<div class='alert alert-success alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  La venta ha sido eliminada.
  </div>";

  $mensaje_eliminar_venta_error = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  La venta no pudo ser eliminada.
  </div>";

  $mensaje_permisos = "<div class='alert alert-danger alert-dismissible'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  No cuenta con los permisos necesarios para realizar esta acción.
  </div>";

  echo "<div class='box-body'>";

  switch($resp)
  {
    case 'ok_agregar_venta': 
      echo $mensaje_agregar_venta_ok;
		break;
		
	  case 'error_agregar_venta': 
      echo $mensaje_agregar_venta_error;
		break;

    case 'ok_eliminar_venta': 
      echo $mensaje_eliminar_venta_ok;
    break;
    
    case 'error_eliminar_venta': 
      echo $mensaje_eliminar_venta_error;
    break;

    case 'registro existente': 
      echo $mensaje_duplicado;
    break;

    case 'ok_agregar_detalle': 
      echo $mensaje_ok_agregar_detalle;
    break;

    case 'error_agregar_detalle': 
      echo $mensaje_error_agregar_detalle;
    break;

    case 'error_permisos':
      echo $mensaje_permisos;
    break;
  }

  echo "</div>";

?>