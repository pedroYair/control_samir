
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Donde</b>Samir</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

  <?php
			if( isset($_SESSION['login']) ){
				if($_SESSION['login'] == 'error')
				{
					echo '<p style="padding: 4px; font-size: 10px; background: pink; color: darkred">Email o clave incorrectos</p>';
				}
				else
				{
					echo '<p style="padding: 4px; font-size: 10px; background: pink; color: darkred">Cuenta deshabilitada</p>';
				}
				
				unset($_SESSION['login']);
			}			
	?>

    <form action="accionesForms/login.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Clave" name="clave">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
    
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->