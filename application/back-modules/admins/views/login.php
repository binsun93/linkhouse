<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title>Đăng nhập</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="<?php echo THEME_ADMIN;?>css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo THEME_ADMIN;?>css/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo THEME_ADMIN;?>css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo THEME_ADMIN;?>css/font.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo THEME_ADMIN;?>css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="<?php echo THEME_ADMIN;?>js/ie/html5shiv.js"></script>
    <script src="<?php echo THEME_ADMIN;?>js/ie/respond.min.js"></script>
    <script src="<?php echo THEME_ADMIN;?>js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <section class="panel panel-default bg-white m-t-lg">
            <header class="panel-heading text-center">
              <strong>Đăng nhập</strong>
            </header>
                        <form class="panel-body wrapper-lg" method="post"  >
                            <div id="error_admin" class="error" style="color:red;">Vui lòng đăng nhập</div>
              <div class="form-group">
                <label class="control-label">Tên đăng nhập</label>
                <input type="text" name="email" placeholder="" class="form-control input-lg">
              </div>
              <div class="form-group">
                <label class="control-label">Mật khẩu</label>
                <input type="password" name="password" placeholder="Password" class="form-control input-lg">
              </div>
              <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
    </section>
    </div>
  </section>
  <!-- footer -->
  <!-- / footer -->
  <script src="<?php echo THEME_ADMIN;?>js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo THEME_ADMIN;?>js/bootstrap.js"></script>
  <!-- App -->
  <script src="<?php echo THEME_ADMIN;?>js/app.js"></script> 
  <script src="<?php echo THEME_ADMIN;?>js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo THEME_ADMIN;?>js/app.plugin.js"></script>
</body>
</html> 