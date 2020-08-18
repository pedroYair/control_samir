<?php 

$seccion = isset($_GET['seccion']) ? $_GET['seccion']:'home';

// el archivo de conf incluye la conexion a bd
include( 'setup/configuracion.php' );

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DondeSamir</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <style>
        th, td {text-align: center}
  </style>

  <?php
  
	if(isset($_GET['accion']))
	{
    if($_GET['accion'] == "listar" or $_GET['accion'] == "ver_historial")
    {
      echo <<<TABLES
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
TABLES;
    }
	}
  
  ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- HEADER - ASIDE -->
  <?php
	
    if(isset($_SESSION['NIVEL']))
    {
      include("contenidos/base/header.php");
      include("contenidos/base/aside.php");
    }

  ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content------------------------------------------------------------------------------------- -->
    <section class="content">
	
      <?php
		if($cnx === false)
		{
			include( 'contenidos/noSql.php' );
		}
		else
		{
			if($seccion and isset($_SESSION['NIVEL']))
			{
				switch( $seccion ):
				case 'home': include("contenidos/base/small_boxes.php"); break;
        case 'servicios': 

          $accion = $_GET['accion'];

          switch( $accion ):
            case 'listar': include( 'contenidos/servicios/listar.php'); break;
            case 'agregar': include( 'contenidos/servicios/agregar.php'); break;
            case 'editar': include( 'contenidos/servicios/editar.php'); break;
          endswitch;
        break;
          
        case 'deudores': 
          $accion = $_GET['accion'];

          switch( $accion ):
            case 'listar': include( 'contenidos/deudores/listar.php'); break;
            case 'agregar': include( 'contenidos/deudores/agregar.php'); break;
            case 'editar': include( 'contenidos/deudores/editar.php'); break;
          endswitch;
        break;

        case 'deudas':
          $accion = $_GET['accion'];

          switch( $accion ):
            case 'listar': include( 'contenidos/deudas/listar.php'); break;
            case 'agregar': include( 'contenidos/deudas/agregar.php'); break;
            // ver lista de detalles de deudas y abonos (separados por pestañas)
            case 'ver_historial': include( 'contenidos/deudas/historial_deudas_abonos.php'); break;
          endswitch;
        break;
        case 'detalle_deudas':
          $accion = $_GET['accion'];

          switch( $accion ):
            case 'agregar': include( 'contenidos/detalle_deudas/agregar.php'); break;
            case 'ver': include( 'contenidos/detalle_deudas/listar.php'); break;
          endswitch;
        break;
        case 'abonos':
          $accion = $_GET['accion'];

          switch( $accion ):
            case 'agregar': include( 'contenidos/abonos/agregar.php'); break;
          endswitch;
        break;
				case 'error': include( 'contenidos/error_document.php'); break;
				default: 
					echo "<p class='error'>La sección solicitada ($seccion), no existe</p>";
					include( 'contenidos/home.php' ); 
					break;
				endswitch;
				
			}
			else
			{
				include("contenidos/login.php");
			}
		}
	 
	  ?>
	  
	  

    </section>
    <!-- /.content------------------------------------------------------------------------------------------ -->
	
	
	
  </div>
  <!-- /.content-wrapper -->
  
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020 <a href="https://adminlte.io">Control Samir</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<?php
  
	if(!isset($_GET['accion']) or $_GET['accion'] == "listar" or $_GET['accion'] == "ver_historial")
	{
		echo <<<TABLES
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#listado_historial_deudas').DataTable()
    $('#listado_historial_abonos').DataTable()
    $('#listado_registros').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function () {
    $('#listado_deudas').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'order': [[ 5, "desc" ]],
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
TABLES;
	}
  
  ?>
</body>
</html>
