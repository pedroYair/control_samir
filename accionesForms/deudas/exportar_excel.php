
<?php 
	if(isset($_GET['id']))
	{
		$id_deudor = $_GET['id'];

		include( '../../setup/configuracion.php' );

		$queryexport = "SELECT FECHA_DEUDA, SUBTOTAL, SERVICIO, a.OBSERVACION
						 FROM deuda AS a JOIN detalle_deuda AS b ON a.ID = b.FK_DEUDA 
						 	JOIN servicios AS c ON c.ID = b.FK_SERVICIO WHERE FK_DEUDOR = '$id_deudor' ORDER BY FECHA_DEUDA DESC";


		$result = mysqli_query($cnx, $queryexport);

		$columnHeader = "Fecha deuda" . "\t" . "Subtotal" . "\t" . "Servicio" . "\t" . "Observacion";

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
		header("Content-Disposition: attachment; filename=Historial de deudas.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		// output data
		echo ucwords($columnHeader) . "\n" . $setData . "\n"; 
	}
?>