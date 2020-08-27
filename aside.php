
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
	  
		<li>
          <a href="index.php?seccion=servicios&accion=listar">
            <i class="fa fa-th"></i> <span>Servicios</span>
          </a>
        </li>
		
		<li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?seccion=ventas_papeleria&accion=listar"><i class="fa fa-circle-o"></i> Papeleria</a></li>
            <li><a href="index.php?seccion=ventas_recargas&accion=listar"><i class="fa fa-circle-o"></i> Recargas</a></li>
          </ul>
        </li>
		
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Deudas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?seccion=deudores&accion=listar"><i class="fa fa-circle-o"></i> Deudores</a></li>
            <li><a href="index.php?seccion=deudas&accion=listar"><i class="fa fa-circle-o"></i> Deudas</a></li>
            <li><a href="index.php?seccion=detalle_deudas&accion=hoy"><i class="fa fa-circle-o"></i> Deudas y abonos hoy</a></li>
          </ul>
        </li>
        
        <li><a href="index.php?seccion=excedente&accion=listar"><i class="fa fa-money"></i> <span>Excedente</span></a></li>

        <?php if(isset($_SESSION['NIVEL']) and $_SESSION['NIVEL'] == "administrador" ): ?>
          <li><a href="#"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
        <?php endif ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>