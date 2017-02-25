<style>
.no_allow {color: red;}
</style>

<?php
 
$arrDaCo = array();
foreach($listAllowMenu as $k=>$v){
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
?>  
<?php
if ($this->session->userdata('message_success')) {
    ?>
    <div  style="color: green; font-size: 16px;" >
        <?php echo $this->session->userdata('message_success'); ?>
    </div>
    <?php
    $this->session->unset_userdata('message_success');
}
if ($this->session->userdata('message_error')) {
    ?>
    <div style="color:red;">
        <?php echo $this->session->userdata('message_error'); ?>
    </div>
    <?php
    $this->session->unset_userdata('message_error');
}
?>
<div class="row"> 
  <div class="col-xs-4"  > 
        <b>Page Default when login:</b> 
   </div> 
   <div class="col-xs-4"  > 
   
        <select name="admin_group_id" id="select3-option" style="width: 150px;"  > 
              
            <?php
            $title = 'Cấu hình Trang Chủ';
            $urlModel = 'config_home';
            ?>
            <optgroup label="<?php echo $title;?>" <?php if(checkArr($arrDaCo , array($urlModel,$urlModel."/addedit") , '0') ) echo 'style="color: red;" disabled';?>>
                    <option <?php if(base_url().$urlModel == $page_default) echo 'selected';?> <?php if(checkArr($arrDaCo , array( $urlModel ) , '0') ) echo 'style="color: red;" disabled';?> value="<?php echo $urlModel; ?>">                       <?php echo $title . '-> Danh sách'; ?></option>
                    <option <?php if(base_url().$urlModel."/addedit" == $page_default) echo 'selected';?> <?php if(checkArr($arrDaCo , array( $urlModel . "/addedit" ) , '0') ) echo 'style="color: red;" disabled';?> value="<?php echo $urlModel; ?>/addedit">               <?php echo $title . '-> Thêm mới'; ?></option>
                    
            </optgroup> 

            <?php
            $title = 'Đối tác & Người thật việc thật';
            $urlModel = 'provider_people';
            ?>
            <optgroup label="<?php echo $title;?>" <?php if(checkArr($arrDaCo , array($urlModel,$urlModel."/addedit") , '0') ) echo 'style="color: red;" disabled';?>>
                    <option <?php if(base_url().$urlModel == $page_default) echo 'selected';?> <?php if(checkArr($arrDaCo , array( $urlModel ) , '0') ) echo 'style="color: red;" disabled';?> value="<?php echo $urlModel; ?>">                       <?php echo $title . '-> Danh sách'; ?></option>
                    <option <?php if(base_url().$urlModel."/addedit" == $page_default) echo 'selected';?> <?php if(checkArr($arrDaCo , array( $urlModel . "/addedit" ) , '0') ) echo 'style="color: red;" disabled';?> value="<?php echo $urlModel; ?>/addedit">               <?php echo $title . '-> Thêm mới'; ?></option>
                    
            </optgroup> 
            
              
        </select> 
      
    </div>
    <div class="col-xs-4"  >     
         <button id="btn_apply_filter" class="btn btn-primary" type="button"  onclick="choose_page_default()">Save</button>   
    </div>
</div> 