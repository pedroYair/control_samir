<?php
  $nombre_servicio = "RECARGA";
  $consulta_deuda_recargas = "SELECT SUM(SUBTOTAL) AS TOTAL
                                FROM detalle_deuda AS d JOIN servicios AS s ON d.FK_SERVICIO = s.ID
                                 WHERE s.SERVICIO LIKE '%$nombre_servicio%'";
  $box_resp = mysqli_query($cnx, $consulta_deuda_recargas);

  $total_deuda_rec = mysqli_fetch_assoc($box_resp);

  // consulta para grafico del excedente
  $consulta_exc = "SELECT FECHA, TOTAL_REAL FROM excedente LIMIT 15";
  $exc_resp = mysqli_query($cnx, $consulta_exc);

  $response = array();
  while($row = mysqli_fetch_assoc($exc_resp)) $response[] = $row;

  // save the JSON encoded array
  $jsonData = json_encode($response); 
?>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>Excedente</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                  if(is_null($total_deuda_rec['TOTAL']))
                  {
                    echo "0";
                  }
                  else
                  {
                    echo $total_deuda_rec['TOTAL'];
                  }
                ?>
              </h3>

              <p>Deudas recargas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Deudas papeleria</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Deudas por pagar</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
</div>

<div style="width: 100%">
  <canvas id="canvas"></canvas>
</div>
