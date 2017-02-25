<div class="headline" style="    display: none;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="title-main">
					<h3 class="tt04Tline">hot teen viet</h3>
				</div>
				<div class="hotnews hidden-xs">
					<ul>
						<li>
							<marquee onmouseover="this.stop();" onmouseout="this.start();"  behavior="scroll" scrollamount="1" height ="30" direction="up">
								<div>
									<a href="#">Some more information</a>
								</div>
								<div>
									<a href="#">Some more information</a>
								</div>
							</marquee>
						</li>
					</ul>
				</div>
				<div class="social socialPos hidden-xs">
					<a href="#" class="socialFb"><span>Facebook</span></a>
					<a href="#" class="socialTw"><span>Twitter</span></a>
					<a href="#" class="socialGp"><span>Google plus</span></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- //head -->
<div class="content ptb10" style="    display: none;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-8">
				<div class="style-croll_111" id="style-croll_111">
					<div class="row">
						
						<?php 
					   foreach($data as $k=>$v){
							echo '<div class="col-xs-6 col-sm-6 col-md-3">';
							echo $this->main->tooltip($v, '185x269');
							echo '</div>';
					   }
					   ?> 
					 
					</div>
					<div class="row">
						 
						 
					</div>
				</div>
			</div> 
			<div class="xs-12 col-sm-6 col-md-4">
				<div class="sidebar sidebar_home">
					<div class="boxSlider boxSlider04 hidden-xs">
						<div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 423px; height: 192px; overflow: hidden; ">
							<!-- Slides Container -->
							<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 423px; height: 192px; overflow: hidden;">
								<div>
									<a href="#"> <img  u="image"  src="<?php echo THEME_FRONT; ?>img/banner/side-01.jpg" width="423" height="192" alt="side 01"/></a>
								</div>
								<div>
									<a href="#"> <img  u="image"  src="<?php echo THEME_FRONT; ?>img/banner/side-02.jpg" width="423" height="192" alt="side 01"/></a>
								</div>
							</div>
							<!-- bullet navigator container -->
							<div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
								<!-- bullet navigator item prototype -->
								<div u="prototype"></div>
							</div>
						</div>
						<!-- // -->
						<div class="group"> 
							<?php echo $posts_html; ?> 
							<?php echo $videos_html; ?>  
						</div>
						<!-- // -->
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>
<!-- end: blockbox --> 