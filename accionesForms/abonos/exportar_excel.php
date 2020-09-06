
<?php 
	if(isset($_GET['id']))
	{
		$id_deudor = $_GET['id'];

		include( '../../setup/configuracion.php' );

		$queryexport = "SELECT FECHA_ABONO, ABONADO, s.SERVICIO, a.OBSERVACION
						 FROM abonos AS a JOIN servicios AS s ON a.FK_SERVICIO = s.ID
							WHERE FK_DEUDOR = '$id_deudor' ORDER BY FECHA_ABONO DESC";


		$result = mysqli_query($cnx, $queryexport);

		$columnHeader = "Fecha abono" . "\t" . "Abonado" . "\t" . "Servicio" . "\t" . "Observacion";

		$setData = ''; 
		while ($rec = mysqli_fetch_row($result)) 
		{  
		    $rowData = '';  
		    foreach ($rec as $value) {  
		        $value = '"' . $value . '"' . "\t";  
		        $rowData .= $value;  
		    }  
		    $setData .= trim($rowData) . "\n";  
		} 
		
		header("Content-type: application/vnd.ms-Excel; name='Excel'");
		header("Content-Disposition: attachment; filename=Historial de abonos.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		// output data
		echo ucwords($columnHeader) . "\n" . $setData . "\n"; 
	}
?>