
<?php 
	if(isset($_GET['id']))
	{
		$id_deudor = $_GET['id'];
		include( '../../setup/configuracion.php' );

		$queryexport = "SELECT FECHA_DEUDA, SUBTOTAL, SERVICIO, a.OBSERVACION
						 FROM deuda AS a JOIN detalle_deuda AS b ON a.ID = b.FK_DEUDA 
						 	JOIN servicios AS c ON c.ID = b.FK_SERVICIO WHERE FK_DEUDOR = '$id_deudor' ORDER BY FECHA_DEUDA DESC";


		$result = mysqli_query($cnx, $queryexport);
		$row = mysqli_fetch_assoc($result);
		$header = '';

		$cabeceras = array('Fecha Deuda', 'Subtotal', 'Servicio', 'Observacion');
		for ($i = 0; $i < sizeof($cabeceras); $i++)
		{
		   $header .= $cabeceras[$i]."\t";
		}

		$data = "";
		while($row = mysqli_fetch_row($result))
		{
		   $line = '';
		   foreach($row as $value){
		          if(!isset($value) || $value == ""){
		                 $value = "\t";
		          }else{
		                 $value = str_replace('"', '""', $value);
		                 $value = '"' . $value . '"' . "\t";
		                 }
		          $line .= $value;
		          }
		   $data .= trim($line)."\n";
		   $data = str_replace("\r", "", $data);

			if ($data == "") 
			{
			   $data = "\nno matching records found\n";
			}
		}
		header("Content-type: application/vnd.ms-Excel; name='Excel'");
		header("Content-Disposition: attachment; filename=Historial de deudas.xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		// output data
		echo $header."\n".$data;

		mysqli_close($cnx);
	}
?>