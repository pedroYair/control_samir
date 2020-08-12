<?php 
	// habilito las sesiones nuevamente, porque no incluyo el doc de configuraciones definido en el setup que ya lo tiene
	session_start();
	// borramos la sesion
	session_destroy();
	
	// volvemos a la pagina de inicio donde se mostraria el formulario de login nuevamente
	header("Location: ../index.php" );
?>