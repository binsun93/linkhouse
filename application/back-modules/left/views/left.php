<style> 
.an {display: none;} 
</style>
<?php 
 $arrDaCo = array();
foreach($contentLeft as $k=>$v){
    $arrDaCo[$v->url_except] = $v->except_id;
} 






function checkArr($arrDaCo = array() , $arrField = array() , $type = TRUE){
 
    if($type == 'all'){   
        return false;
    }elseif($type == '1'){         //  Show Tab EXCEPT   
    
        $dem = 0;   
        foreach($arrField as $k=>$v){
            if(!$arrDaCo[base_url().$v])
                $dem++; 
        }
        
        if($dem == count($arrField))
            return true;
        return false;
        
    }else{      // SHOW Tab Allow  
        $dem = 0;
        foreach($arrField as $k=>$v){ 
            if($arrDaCo[base_url().$v]){
                $dem++;
            } 
        }
        if($dem == count($arrField))
            return true;
        return false;
    } 
}
$providerName = $this->session->userdata( "user" ); 
 ?>
<!-- .aside -->
<aside class="bg-dark lter aside-md hidden-print" id="nav">
<section class="vbox">
  <section class="w-f scrollable">
    <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333"> 
          
      
    <?php
    $title = 'Cấu hình Trang Chủ';
    $urlModel = 'config_home';
    ?>
    <!-- nav -->
    <nav class="nav-primary hidden-xs">
        <ul class="nav">
          <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit",$urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if(in_array($this->uri->segment(1), array($urlModel))) echo 'class="active"';?>> <a > <i class="fa fa-key"> <b class="bg-warning"></b> </i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span><?php echo $title; ?></span> </a>
            <ul class="nav lt"> 
                    <li <?php if(checkArr($arrDaCo , array($urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>"><i class="fa fa-list"></i><span>Danh sách</span></a></li>
                    <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit" ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='addedit') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>/addedit"><i class="fa fa-plus"></i><span>Thêm mới</span></a></li>
            </ul>
          </li> 
        </ul>
    </nav>
    <!-- / nav -->


    <?php
    $title = 'Đối tác & Người thật việc thật';
    $urlModel = 'provider_people';
    ?>
    <!-- nav -->
    <nav class="nav-primary hidden-xs">
        <ul class="nav">
          <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit",$urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if(in_array($this->uri->segment(1), array($urlModel))) echo 'class="active"';?>> <a > <i class="fa fa-key"> <b class="bg-warning"></b> </i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span><?php echo $title; ?></span> </a>
            <ul class="nav lt"> 
                    <li <?php if(checkArr($arrDaCo , array($urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>"><i class="fa fa-list"></i><span>Danh sách</span></a></li>
                    <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit" ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='addedit') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>/addedit"><i class="fa fa-plus"></i><span>Thêm mới</span></a></li>
            </ul>
          </li> 
        </ul>
    </nav>
    <!-- / nav -->


    <?php
    $title = 'Admin';
    $urlModel = 'admins';
    ?>
    <!-- nav -->
    <nav class="nav-primary hidden-xs">
        <ul class="nav">
          <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit",$urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if(in_array($this->uri->segment(1), array($urlModel))) echo 'class="active"';?>> <a > <i class="fa fa-key"> <b class="bg-warning"></b> </i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span><?php echo $title; ?></span> </a>
            <ul class="nav lt"> 
                    <li <?php if(checkArr($arrDaCo , array($urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>"><i class="fa fa-list"></i><span>Danh sách</span></a></li>
                    <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit" ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='addedit') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>/addedit"><i class="fa fa-plus"></i><span>Thêm mới</span></a></li>
            </ul>
          </li> 
        </ul>
    </nav>
    <!-- / nav -->

    <?php
    $title = 'Admin Group';
    $urlModel = 'group';
    ?>
    <!-- nav -->
    <nav class="nav-primary hidden-xs">
        <ul class="nav">
          <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit",$urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if(in_array($this->uri->segment(1), array($urlModel))) echo 'class="active"';?>> <a > <i class="fa fa-key"> <b class="bg-warning"></b> </i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span><?php echo $title; ?></span> </a>
            <ul class="nav lt"> 
                    <li <?php if(checkArr($arrDaCo , array($urlModel ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>"><i class="fa fa-list"></i><span>Danh sách</span></a></li>
                    <li <?php if(checkArr($arrDaCo , array($urlModel."/addedit" ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='addedit') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>/addedit"><i class="fa fa-plus"></i><span>Thêm mới</span></a></li>
                    <li <?php if(checkArr($arrDaCo , array($urlModel."/permission" ) , '0')) echo 'style="display: none;"';?>   <?php if($this->uri->segment(1)==$urlModel&& $this->uri->segment(2)=='permission') echo 'class="active"';?>><a href="<?php echo $urlModel; ?>/permission"><i class="fa fa-plus"></i><span>Permission</span></a></li>
            </ul>
          </li> 
        </ul>
    </nav>
    <!-- / nav -->
        
      

    </div>
  </section>
  <footer class="footer lt hidden-xs b-t b-dark" style="z-index: 10;">
    <div id="chat" class="dropup">
      <section class="dropdown-menu on aside-md m-l-n">
        <section class="panel bg-white">
          <header class="panel-heading b-b b-light">Active chats</header>
          <div class="panel-body animated fadeInRight">
            <p class="text-sm">No active chats.</p>
            <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
          </div>
        </section>
      </section>
    </div>
    <div id="invite" class="dropup">
      <section class="dropdown-menu on aside-md m-l-n">
        <section class="panel bg-white">
          <header class="panel-heading b-b b-light"> John <i class="fa fa-circle text-success"></i> </header>
          <div class="panel-body animated fadeInRight">
            <p class="text-sm">No contacts in your lists.</p>
            <p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p>
          </div>
        </section>
      </section>
    </div>
     
  </footer>
</section>
</aside>
<!-- /.aside -->