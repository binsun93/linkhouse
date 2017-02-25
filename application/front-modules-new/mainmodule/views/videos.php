  <?php $SEO = $this->load->library("SEO"); ?>  
   <div class="blockbox">
						<div class="headline">
							<div class="container">
								<div class="row">
									<div class="col-xs-12">
										<div class="title-main">
											<h3 class="tt04Tline">Video - Clip</h3>
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
										<!--
										<div class="social socialPos hidden-xs">
											<a href="#" class="socialFb"><span>Facebook</span></a>
											<a href="#" class="socialTw"><span>Twitter</span></a>
											<a href="#" class="socialGp"><span>Google plus</span></a>
										</div>
										-->
									</div>
								</div>
							</div>
						</div>
						<!-- //head -->
						<div class="content ptb10 container_slide1">
							<div class="container">
								<div class="row">
									<div class="col-xs-12">
										<div class="boxSlider01"> 
											<!-- Start jssor_video -->
											<div id="jssor_video" class="video">
												<?php TemplateVideoOfHome($data , $SEO); ?> 
											</div> 
											<div id="jssor_video_tablet" class="video video-tablet">
												 <?php TemplateVideoOfHome($data , $SEO); ?> 
											</div> 
											<div id="jssor_video_mobile" class="video video-mobile">
												 <?php TemplateVideoOfHome($data , $SEO); ?> 
											</div>
											<!-- End jssor_video --> 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end: blockbox -->
					
					<?php 
					function TemplateVideoOfHome($dataVideos , $SEO){ 
						$dataVideoSub = $dataVideos
						?>
						<div data-u="slides" class="slides"> 
						<?php 
						// $img = $dataVideos[0]->image_banner!=''?$dataVideos[0]->image_banner:THEME_FRONT.DEFAULT_VIDEO_BANNER;
						$img = base_url_image($dataVideos[0]->image_banner, '423x297');
						?> 
							<div style="display: none;">
							<div class="videoLarge album-item">
								<a href="<?php echo $SEO->build_link($dataVideos[0] , "videos"); ?>" class="boxlink"> 
									<img src="<?php echo $img; ?>" alt="<?php echo $dataVideos[0]->title; ?>" class="img-responsive"> 
									<span class="mask"></span> 
									<span class="icon-play large"></span> 
									<h4><?php echo $dataVideos[0]->title; ?></h4> 
									<span class="bgrgadient"></span> 
								</a>
							</div>
							</div>
						
						<?php
						unset($dataVideos[0]);
						$dataVideos = array_values($dataVideos);
						foreach($dataVideos as $k => $v){
							// $img = $v->image_banner!=''?$v->image_banner:THEME_FRONT.DEFAULT_VIDEO_BANNER;
							$img = base_url_image($v->image_banner, '206x143');
							if ($k % 4 == 0){
								echo '<div style="display: none;">';
							} 
							$classTemp=($k%2==0?'odd':'even'); 
							?>  
								<div class="videoSmall album-item <?php echo $classTemp; ?>">
									<a href="<?php echo $SEO->build_link($v , "videos"); ?>" class="boxlink"> 
										<img src="<?php echo $img; ?>" alt="<?php echo $v->title; ?>" class="img-responsive"> 
										<span class="mask"></span> <span class="icon-play small"></span> 
											<h4><?php echo $v->title; ?></h4> 
										<span class="bgrgadient"></span> 
									</a>
								</div> 
						   <?php 
							if ($k % 4 == 3){
								echo '</div>';
							} 
						} 
						?>  
						</div>

						<!-- Arrow Left -->
						<span u="arrowleft" class="jssora123l"> </span>
						<!-- Arrow Right -->
						<span u="arrowright" class="jssora123r"> </span>
							<?php
						}
					
					?>