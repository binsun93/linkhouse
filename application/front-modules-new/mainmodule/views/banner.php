<?php 
if(!empty($data)){
   ?>
		
	<div class="wrapContent1 pb10">
		<div class="container-fluid container-fluid_me">
			<div class="boxSlider boxSlider02">
				<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 1349px; height: 405px; overflow: hidden; ">
					<!-- Slides Container -->
					<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:1349px; height: 405px; overflow: hidden;">
						<div>
							<img u="image"  src="<?php echo THEME_FRONT; ?>img/banner/bnr-01.jpg" width="856" height="404" alt="slider 01"/>
						</div>
						<div>
							<img u="image"  src="<?php echo THEME_FRONT; ?>img/banner/bnr-02.jpg" width="856" height="404" alt="slider 01"/>
						</div>
						<?php  
						  foreach($data as $k=>$v){
							 ?> 
								<div>
								   <a href="<?php echo base_url($v->link); ?>" title="<?php echo $v->title; ?>"  >
										<img u="image"  src="<?php  $img = $v->image?$v->image:THEME_FRONT.DEFAULT_BANNER;    echo  $img; ?>" width="856" height="404" alt="<?php echo $v->title; ?>"/>
								   </a>
								</div> 
							 <?php
						  }
					   ?> 
					</div>
					<!-- bullet navigator container -->
					<div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
						<!-- bullet navigator item prototype -->
						<div u="prototype"></div>
					</div>
					<!-- Arrow Left -->
					<span u="arrowleft" class="jssora12l" style="top: 180px; left: 0px;"> </span>
					<!-- Arrow Right -->
					<span u="arrowright" class="jssora12r" style="top: 180px; right: 0px;"> </span>
				</div>
			</div>
		</div>
	</div>
	<!-- end: wrapContent1 --> 
   <?php
} 
?>



