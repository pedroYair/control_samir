<?php

  // consulta de la caja 1
  $consul_c1 = "SELECT TOTAL_REAL, FECHA FROM excedente WHERE ID = (SELECT MAX(ID) FROM excedente) LIMIT 1";
  $exc_resp = mysqli_query($cnx, $consul_c1);

  $resp1 = mysqli_fetch_assoc($exc_resp);
  $excedente = is_null($resp1['TOTAL_REAL']) ? 0 : $resp1['TOTAL_REAL'];
  $fecha = is_null($resp1['FECHA']) ? "" : $resp1['FECHA'];
  mysqli_free_result($exc_resp); 

  // consulta caja 2

  $hoy = date('Y-m-d');
  $nombre_servicio = "RECARGA";

  $consul_c2 = "SELECT SUM(SUBTOTAL) AS TOTAL_HOY 
                  FROM detalle_deuda AS d JOIN servicios AS s ON d.FK_SERVICIO = s.ID 
                    JOIN deuda AS a ON a.ID = d.FK_DEUDA 
                      WHERE s.SERVICIO LIKE '%$nombre_servicio%' AND FECHA_DEUDA BETWEEN '$hoy' AND '$hoy 23:59:59'";
  $exc_resp2 = mysqli_query($cnx, $consul_c2);
  $total_deudas_hoy = mysqli_fetch_assoc($exc_resp2);
  $total_deudas_rec_hoy = is_null($total_deudas_hoy['TOTAL_HOY']) ? 0 : $total_deudas_hoy['TOTAL_HOY'];
  mysqli_free_result($exc_resp2);

  // consulta caja 3

  $consul_c3 = "SELECT SUM(SUBTOTAL) AS TOTAL_HOY 
                  FROM detalle_deuda AS d JOIN servicios AS s ON d.FK_SERVICIO = s.ID 
                    JOIN deuda AS a ON a.ID = d.FK_DEUDA 
                      WHERE s.SERVICIO NOT LIKE '%$nombre_servicio%' AND FECHA_DEUDA BETWEEN '$hoy' AND '$hoy 23:59:59'";
  $exc_resp3 = mysqli_query($cnx, $consul_c3);
  $total_deudas_hoy = mysqli_fetch_assoc($exc_resp3);
  $total_deudas_pap_hoy = is_null($total_deudas_hoy['TOTAL_HOY']) ? 0 : $total_deudas_hoy['TOTAL_HOY'];
  mysqli_free_result($exc_resp3);  

  // consulta caja 4

  $consul_c4 = "SELECT SUM(ABONADO) AS TOTAL_HOY FROM abonos WHERE FECHA_ABONO BETWEEN '$hoy' AND '$hoy 23:59:59'";
    $exc_resp4 = mysqli_query($cnx, $consul_c4);
    $total_abonos_hoy = mysqli_fetch_assoc($exc_resp4);
    $total_abonos_hoy = is_null($total_abonos_hoy['TOTAL_HOY']) ? 0 : $total_abonos_hoy['TOTAL_HOY'];
    mysqli_free_result($exc_resp4); 
    

  // consulta para grafico del excedente
  $consulta_exc = "SELECT * FROM (SELECT FECHA, TOTAL_REAL FROM excedente ORDER BY FECHA DESC LIMIT 15) AS tabla ORDER BY tabla.FECHA";
  $exc_resp = mysqli_query($cnx, $consulta_exc);

  $response = array();
  while($row = mysqli_fetch_assoc($exc_resp)) $response[] = $row;

  // save the JSON encoded array
  $jsonData = json_encode($response); 
  mysqli_free_result($exc_resp);
?>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $excedente; ?></h3>

              <p><?php echo "Excedente actual ".$fecha; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="index.php?seccion=excedente&accion=listar" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                    echo $total_deudas_rec_hoy;
                ?>
              </h3>

              <p>Deudas recargas hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="index.php?seccion=detalle_deudas&accion=hoy" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
                    echo $total_deudas_pap_hoy;
                  ?> 
              </h3>

              <p>Deudas papeleria hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="index.php?seccion=detalle_deudas&accion=hoy" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php
                    echo $total_abonos_hoy;
                  ?> 
                </h3>

              <p>Abonos hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="index.php?seccion=detalle_deudas&accion=hoy" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
</div>

<div style="width: 100%">
  <canvas id="canvas"></canvas>
</div>
