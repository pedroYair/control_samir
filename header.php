
<header class="main-header">
  
    <!-- Logo -->
    <a href="index.php?seccion=home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Donde</b>Samir</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 4 mensajes</li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">*</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">El saldo actual es de 10000</li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php
              if($_SESSION['FOTO'])
              {
                $base64 = base64_encode($_SESSION['FOTO']);
                echo "<img src='data:image/jpeg;base64,$base64' class='user-image' alt='$_SESSION[NOMBRE]' height='50'/>";
              }
            ?>
              
              <span class="hidden-xs">
                <?php
                  echo $_SESSION['NOMBRE'];
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <?php
                if($_SESSION['FOTO'])
                {
                  $base64 = base64_encode($_SESSION['FOTO']);
                  echo "<img src='data:image/jpeg;base64,$base64' class='img-circle' alt='Imagen de usuario' height='50'/>";
                }
              ?>
                <p>
                  <small>
                    <?php
                      echo "Miembro desde"." ".$_SESSION['FECHA_ALTA'];
                    ?>
                  </small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?seccion=usuarios&accion=editar&acceso=perfil" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="accionesForms/logout.php" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
