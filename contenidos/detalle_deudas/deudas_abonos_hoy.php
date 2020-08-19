<?php
		$hoy = date('Y-m-d');

		$consulta5 = "SELECT SUM(TOTAL) AS TOTAL_HOY FROM deuda WHERE FECHA_DEUDA BETWEEN '$hoy' AND '$hoy 23:59:59'";
		$exc5 = mysqli_query($cnx, $consulta5);
		$total_deudas_hoy = mysqli_fetch_assoc($exc5);
		$total_deudas_hoy = $total_deudas_hoy['TOTAL_HOY'];
		
		if(is_null($total_deudas_hoy))
		{
			$total_deudas_hoy = 0;
		}
		
		// si total deudas es mayor a 0 se hace la consulta detallada lo mismo para abonos
		
		
		$consulta6 = "SELECT SUM(ABONADO) AS TOTAL_HOY FROM abonos WHERE FECHA_ABONO BETWEEN '$hoy' AND '$hoy 23:59:59'";
		$exc6 = mysqli_query($cnx, $consulta6);
		$total_abonos_hoy = mysqli_fetch_assoc($exc6);
		$total_abonos_hoy = $total_abonos_hoy['TOTAL_HOY'];
		
		if(is_null($total_abonos_hoy))
		{
			$total_abonos_hoy = 0;
		}
		
?>

<div class="row" style="margin-top: 0px;">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><?php echo $total_deudas_hoy; ?></h4>
              <p>Deudas hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4><?php echo $total_abonos_hoy; ?></h4>

              <p>Abonos hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
</div>

<?php
  if($total_deudas_hoy > 0 or $total_abonos_hoy > 0)
  {
	  include('pages_hoy.php');
  }
?>