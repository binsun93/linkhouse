
<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title>Login | Megabox</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="../<?=THEMES?>css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../<?=THEMES?>css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../<?=THEMES?>css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../<?=THEMES?>css/font.css" type="text/css" />
    <link rel="stylesheet" href="../<?=THEMES?>css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>


<body>
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong>Sign in</strong>
        </header>

         <form  method="post" class="panel-body wrapper-lg">
            <div id="error_admin" class="error" style="color:red;"><?php $error = $this->session->all_userdata(); 
																		echo @$error['flash:new:error_admin']; ?></div><br />
          <span style="color:red"></span>
                      <div class="form-group">
            <label class="control-label">Username</label>
            <input type="text" name="email"   value="" placeholder="test@example.com" class="form-control input-lg">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" name="user_password" id="user_password" placeholder="Password" class="form-control input-lg">
          </div>
          
           
          <button type="submit" class="btn btn-primary">Sign in</button>
          <div class="line line-dashed"></div>
           
          
        </form>

         
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>Megabox <br>&copy; 2015</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="../<?=THEMES?>js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../<?=THEMES?>js/bootstrap.js"></script>
  <!-- App -->
  <script src="../<?=THEMES?>js/app.js"></script>
  <script src="../<?=THEMES?>js/app.plugin.js"></script>
  <script src="../<?=THEMES?>js/slimscroll/jquery.slimscroll.min.js"></script>
  
</body>
</html>

<?php
exit;
?>
