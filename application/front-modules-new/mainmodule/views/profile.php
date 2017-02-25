 <div class="blockbox">

	<div class="headline">

		<div class="container">

			<div class="row">

				<div class="col-xs-12">

					<div class="title-main">

						<h3 class="tt04Tline"><a href="<?php echo base_url("hot-teen"); ?>">Hot Teen Việt</a></h3>

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

	<div class="content ptb10">

		<div class="container">

			<div class="row">

				<div class="col-xs-12">

					<div class="boxSlider01">

						<div class="jssor_2_hide" id="jssor_2" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 796px; overflow: hidden;">

							<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 796px; overflow: hidden;">

									<?php  

									  foreach($data as $k=>$v){

											if($k % 2 == 0 ){

											   echo '<div style="display: none;">'; 

											   echo $this->main->tooltip($v, '185x269');

											}else{

											   echo $this->main->tooltip($v, '185x269');

											   echo '</div>'; 

											} 

									  }

									 ?>   

							</div>

							<!-- Arrow Left -->

							<span u="arrowleft" class="jssora123l" style="top: 180px; left: 0px;"> </span>

							<!-- Arrow Right -->

							<span u="arrowright" class="jssora123r" style="top: 180px; right: 0px;"> </span>

						</div>

						<div  class="jssor_2_2_hide">

							<div id="jssor_2_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 767px; height: 1320px; overflow: hidden;">

								<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 767px; height: 1320px; overflow: hidden;">

									<?php  

									  foreach($data as $k=>$v){

											if($k % 2 == 0 ){

											   echo '<div style="display: none;">'; 

											   echo $this->main->tooltip($v, '185x269');

											}else{

											   echo $this->main->tooltip($v, '185x269');

											   echo '</div>'; 

											} 

									  }

									 ?>  

								</div>

								<!-- Arrow Left -->

								<span u="arrowleft" class="jssora123l" style="top: 180px; left: 0px;"> </span>

								<!-- Arrow Right -->

								<span u="arrowright" class="jssora123r" style="top: 180px; right: 0px;"> </span>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<!-- end: blockbox -->