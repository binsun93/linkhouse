<div class="filter-row">
  <div class="container-fluid">
    <div class="row"> 
    <?php
    foreach($channels as $k=>$v){
    	?>
    	<div class="col-lg-2 col-md-3 col-sm-4">
            <div class="box-channel">
              <div class="box-channel-logo">
                <a class="box-channel-image" href="channel-detail.html" title="<?=$v->name?>">
                  <figure><img src="<?php echo THEME_FRONT; ?>images/channel-logo.png" alt=""></figure>
                  <span>Xem ngay <i class="xgtv-play3"></i></span>
                </a>
              </div>
              <div class="box-channel-content">
                <div class="x-customScrollbar">
                  <ul class="list-time"> 
                    <li class="sr-ampm"> Sáng </li>
                    <?php
                    $scheduleOfChannel = json_decode($v->schedule[0]->data_schedule , true);
                    foreach ($scheduleOfChannel as $key => $value) {
                    	$time = trim((string)$key); 
                    	$vArr = explode('||', $value);
                    	$title = $vArr[0];
                    	if($title == ''){
                    		continue;
                    	}

                    	$genre = '';
                    	if(isset($vArr[1]))
                    		$genre = $vArr[1];

                    	// if($time >= '11:00'){
                    	// 	echo `<li class="sr-ampm"> Trưa </li>`;
                    	// }

                    	// if($time >= '14:00'){
                    	// 	echo `<li class="sr-ampm"> Chiều </li>`;
                    	// }

                    	// if($time >= '19:00'){
                    	// 	echo `<li class="sr-ampm"> Tối </li>`;
                    	// }  
                    	?>
                    	<li class="<?=$current_time<=$time?'active':'inactive'?>">
	                      <span class="time"><?=$time?></span>
	                      <a href="#">
	                        <span class="tt"><?=$title?></span>
	                        <span class="txt"><?=$genre?></span>
	                      </a>
	                    </li>
                    	<?php
                    } 
                    ?> 
                  </ul>
                </div>
              </div>
            </div>
          </div>
    	<?php
    }
    ?>


      





    </div>
  </div>
</div>