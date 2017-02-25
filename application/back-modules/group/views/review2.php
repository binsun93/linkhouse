<style>
.da_co {background: silver; font-size: 14px; }
.chua_co {background: blue; font-size: 14px;}
.title1 {color: chocolate; background-color: whitesmoke; }
.an {display: none;}


</style>
<?php
$arrDaCo = array();
foreach($content as $k=>$v){
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
        
    }else{      // SHOW Tab Not Allow  
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
 

?>


 <p>
    <b>    Select All: <input id="checkAll" type="checkbox">  </b>
 </p>
<script> 
    $( '#checkAll' ).change(function(e) {
        e && e.preventDefault();
		var  $checked = $(e.target).is(':checked'); 
        $( "[type='checkbox']" ).each(function() {
            $( this ).prop('checked', $checked  ); 
          });  
    }); 
</script>
<div class="table-responsive" style="background: gainsboro;">
       <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333"> 
            
            <?php
            $title = 'Cấu hình Trang Chủ';
            $urlModel = 'config_home';
            ?>
            <!-- nav -->
            <nav class="nav-primary hidden-xs">
                <ul class="nav">
                  <li  <?php if(checkArr($arrDaCo , array( $urlModel,$urlModel."/addedit" ) , $type) ) echo 'style="display: none;"';?> > <a class='title1'> <i class="fa fa-star"> <b class="bg-warning"></b> </i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span><?php echo $title;?></span> </a>
                    <ul class="nav lt">  
                            <li <?php if(checkArr($arrDaCo , array( $urlModel ) , $type) ) echo 'style="display: none;"';?> <?php if($arrDaCo[base_url().$urlModel]) echo 'class="da_co"';?>><a><i class="fa fa-list"></i><span>Danh sách</span>      
                                <?php if($arrDaCo[base_url().$urlModel]){ ?>    
                                    <b  style="float: right; color: red;" onclick="javascript:deletePer(<?php echo $arrDaCo[base_url().$urlModel]; ?>, '<?php echo $urlModel;?>');" title="Not Allow">
                                        Not Allow
                                    </b>  
                                    <?php }else{  
                                            if($page_default == base_url().$urlModel){
                                                ?>
                                                <b style="float: right; color: blue;">Is Default Page when login</b>
                                                <?php
                                            }else{
                                                ?>
                                                <input style="float: right;" type="checkbox" name="url_except" value="<?=base_url().$urlModel?>">
                                                <?php
                                            }
                                    } ?>
                                  </a></li>  

                            <li <?php if(checkArr($arrDaCo , array( $urlModel."/addedit" ) , $type) ) echo 'style="display: none;"';?> <?php if($arrDaCo[base_url().'/addedit']) echo 'class="da_co"';?>><a  ><i class="fa fa-plus"></i><span>Thêm mới</span>   
                                <?php if($arrDaCo[base_url().$urlModel.'/addedit']){ ?>    
                                    <b  style="float: right; color: red;" onclick="javascript:deletePer(<?php echo $arrDaCo[base_url().$urlModel.'/addedit']; ?>, '/addedit');" title="Not Allow">
                                        Not Allow
                                    </b>  
                                <?php }else{  
                                            if($page_default == base_url().$urlModel."/addedit"){
                                                ?>
                                                <b style="float: right; color: blue;">Is Default Page when login</b>
                                                <?php
                                            }else{
                                                ?>
                                                <input style="float: right;" type="checkbox" name="url_except" value="<?=base_url().$urlModel?>/addedit">
                                                <?php
                                            }
                                    } ?> 
                                </a></li>
                             
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
                  <li  <?php if(checkArr($arrDaCo , array( $urlModel,$urlModel."/add" ) , $type) ) echo 'style="display: none;"';?> > <a class='title1'> <i class="fa fa-star"> <b class="bg-warning"></b> </i> <span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> <span><?php echo $title;?></span> </a>
                    <ul class="nav lt">  
                            <li <?php if(checkArr($arrDaCo , array( $urlModel ) , $type) ) echo 'style="display: none;"';?> <?php if($arrDaCo[base_url().$urlModel]) echo 'class="da_co"';?>><a><i class="fa fa-list"></i><span>Danh sách</span>      
                                <?php if($arrDaCo[base_url().$urlModel]){ ?>    
                                    <b  style="float: right; color: red;" onclick="javascript:deletePer(<?php echo $arrDaCo[base_url().$urlModel]; ?>, '<?php echo $urlModel;?>');" title="Not Allow">
                                        Not Allow
                                    </b>  
                                    <?php }else{  
                                            if($page_default == base_url().$urlModel){
                                                ?>
                                                <b style="float: right; color: blue;">Is Default Page when login</b>
                                                <?php
                                            }else{
                                                ?>
                                                <input style="float: right;" type="checkbox" name="url_except" value="<?=base_url().$urlModel?>">
                                                <?php
                                            }
                                    } ?>
                                  </a></li>  

                            <li <?php if(checkArr($arrDaCo , array( $urlModel."/addedit" ) , $type) ) echo 'style="display: none;"';?> <?php if($arrDaCo[base_url().'/addedit']) echo 'class="da_co"';?>><a  ><i class="fa fa-plus"></i><span>Thêm mới</span>   
                                <?php if($arrDaCo[base_url().$urlModel.'/addedit']){ ?>    
                                    <b  style="float: right; color: red;" onclick="javascript:deletePer(<?php echo $arrDaCo[base_url().$urlModel.'/addedit']; ?>, '/addedit');" title="Not Allow">
                                        Not Allow
                                    </b>  
                                <?php }else{  
                                            if($page_default == base_url().$urlModel."/addedit"){
                                                ?>
                                                <b style="float: right; color: blue;">Is Default Page when login</b>
                                                <?php
                                            }else{
                                                ?>
                                                <input style="float: right;" type="checkbox" name="url_except" value="<?=base_url().$urlModel?>/addedit">
                                                <?php
                                            }
                                    } ?> 
                                </a></li>
                             
                    </ul>
                  </li>  
                </ul>
            </nav>
            <!-- / nav -->
               
              

            </div> 
       
                  
</div>
             
            
         
                 
 