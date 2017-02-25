<!DOCTYPE html>
<html dir="ltr" lang="en">
<head> 
	<?php echo Modules::run('header'); ?>  
</head>

<body>

	<div class="wrapper">
		<?php echo Modules::run('head'); ?>  
		

 
	  <main class="main"> 
	    <?php echo Modules::run('menu'); ?>   
	    <?php echo $template['body']; ?>   
	  </main>

	  <?php echo Modules::run('footer'); ?>

	  
	</div>
	<script src="<?php echo THEME_FRONT; ?>dist/app.min.js"></script>
</body>
</html>
