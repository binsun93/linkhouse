
<!DOCTYPE html>
<html lang="en" class="app">
<base href="<?php echo base_url();?>" />
<head>
<meta charset="utf-8" />
<title>Link House</title>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel='shortcut icon' type='image/x-icon' href='<?php echo LINK_STATIC; ?>THEME_ADMIN/front/images/favicon.ico' />

<link rel="stylesheet" href="<?=THEME_ADMIN?>css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>css/animate.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>css/font.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>css/app.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>js/select2/select2.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>fancybox/jquery.fancybox.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>js/select2/theme.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>js/fuelux/fuelux.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>js/datepicker/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?=THEME_ADMIN?>js/slider/slider.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=THEME_ADMIN?>css/tooltip.css">
<link rel="stylesheet" type="text/css" href="<?=THEME_ADMIN?>css/yt.css">

<script src="<?=THEME_ADMIN?>js/tooltip.js"></script> 



 
<style>
 #codeigniter_profiler{
        clear: both; 
          background-color: #fff;
          padding: 10px;
          /* height: 100px; */
          position: absolute;
          top: 0;
          bottom: 0;
          OVERFLOW: AUTO;
          Z-INDEX: 999999;
    }
</style>
<style>
            .fileinput-button
            {
                position:relative;
            }
            .fileinput-button input
            { 
                position: absolute;
                top: 0;
                right: 0;
                margin: 0;
                opacity: 0;
                -ms-filter: 'alpha(opacity=0)';
                width:200px;
                height:40px;
                direction: ltr;
                cursor: pointer;
            }
        </style>
<script src="<?=THEME_ADMIN?>js/jquery.min.js"></script> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--[if lt IE 9]>
    <script src="public/Admin/js/ie/html5shiv.js"></script>
    <script src="public/Admin/js/ie/respond.min.js"></script>
    <script src="public/Admin/js/ie/excanvas.js"></script>
  <![endif]-->
  
  
  
   <script type="text/javascript">
   
   var module = '<?php echo $this->uri->segment(1);  ?>';
   var base_url ='<?php echo base_url();  ?>';
   var img_path = '<?php echo $this->config->item('img_path')  ?>';
                $(document).ready(function(){
                    
                	$('a[href^="#"]').bind('click.smoothscroll',function (e) {
                	    e.preventDefault();
                	    var target = this.hash,
                	    $target = $(target);
                	 
                	    $('html, body').stop().animate({
                	        'scrollTop': $target.offset().top
                	    }, 900, 'swing', function () {
                	       // window.location.hash = target;
                	    });
                        
                        
                       // window.scrollTo(0, $("#idListView").offset().top);
                	});
                });
    </script>       
   <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>DROP -->

   
    
</head>
<body>
<section class="vbox">

<?php 
$member=$this->session->userdata('admin_htv_user');
?>
<header class="bg-dark dk header navbar navbar-fixed-top-xs">
    <div class="navbar-header aside-md"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html"> <i class="fa fa-bars"></i> </a> <a href="#" class="navbar-brand" data-toggle="fullscreen"></a> <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user"> <i class="fa fa-cog"></i> </a> </div>
    <ul class="nav navbar-nav hidden-xs">
      <li class="dropdown">  
        <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
          <div class="wrapper lter m-t-n-xs"> <a href="#" class="thumb pull-left m-r"> <img src="<?php echo THEME_ADMIN; ?>images/avatar.jpg" class="img-circle"> </a>
            <div class="clear"> <a href="#"><span class="text-white font-bold">@<?php echo @$member;?></a></span> <small class="block">Art Director</small> <a href="#" class="btn btn-xs btn-success m-t-xs">Upgrade</a> </div>
          </div>
          <div class="row m-l-none m-r-none m-b-n-xs text-center">
            <div class="col-xs-4">
              <div class="padder-v"> <span class="m-b-xs h4 block text-white">25</span> <small class="text-muted">Followers</small> </div>
            </div>
            <div class="col-xs-4 dk">
              <div class="padder-v"> <span class="m-b-xs h4 block text-white">55</span> <small class="text-muted">Likes</small> </div>
            </div>
            <div class="col-xs-4">
              <div class="padder-v"> <span class="m-b-xs h4 block text-white">2,035</span> <small class="text-muted">Photos</small> </div>
            </div>
          </div>
        </section>
      </li>
       
    </ul>
    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
      <li class="hidden-xs">   
        <section class="dropdown-menu aside-xl">
          <section class="panel bg-white">
            <header class="panel-heading b-light bg-light"> <strong>You have <span class="count">2</span> notifications</strong> </header>
            <div class="list-group list-group-alt animated fadeInRight"> <a href="#" class="media list-group-item"> <span class="pull-left thumb-sm"> <img src="<?=THEME_ADMIN?>images/avatar.jpg" alt="John said" class="img-circle"> </span> <span class="media-body block m-b-none"> Use awesome animate.css<br>
              <small class="text-muted">10 minutes ago</small> </span> </a> <a href="#" class="media list-group-item"> <span class="media-body block m-b-none"> 1.0 initial released<br>
              <small class="text-muted">1 hour ago</small> </span> </a> </div>
            <footer class="panel-footer text-sm"> <a href="#" class="pull-right"><i class="fa fa-cog"></i></a> <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a> </footer>
          </section>
        </section>
      </li>
      <li class="dropdown hidden-xs">  
        <section class="dropdown-menu aside-xl animated fadeInUp">
          <section class="panel bg-white">
            <form role="search">
              <div class="form-group wrapper m-b-none">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search">
                  <span class="input-group-btn">
                  <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                  </span> </div>
              </div>
            </form>
          </section>
        </section>
      </li>
      <li class="dropdown"> <a href="" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb-sm avatar pull-left"> <img src="<?php echo THEME_ADMIN;?>images/avatar.jpg"> </span> <?php echo @$this->session->userdata('admin_htv_user');?> <b class="caret"></b> </a>
        <ul class="dropdown-menu animated fadeInRight">
          <span class="arrow top"></span> 
          <li> <a href="<?php echo base_url()."admins/changepassword";?>">Change Password</a> </li> 
          <li class="divider"></li>
          <li> <a href="<?php echo base_url()."admins/logout";?>"  >Logout</a> </li>
        </ul>
      </li>
    </ul>
  </header>
