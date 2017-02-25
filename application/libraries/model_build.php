<?php
class Model_Build {
	

    
    public function buildLink($id , $subLink , $type){
        switch($type){
            
            
            case "pro_id":
                $return = "logview/providerDetail/";
                break;
            case "tbl_category_lang":
                $return = "logview/categoryDetail/";
                break;
            case "tbl_genre_lang":
                $return = "logview/genreDetail/";
                break;
            case "tbl_content_lang":
                $return = "logview/contentIdDetail/";
                break;
            case "country_id":
                $return = "logview/countryDetail/";
                break;
            case "city_id":
                $return = "logview/cityDetail/";
                break;
            case "ip":
                $return = "logview/ipDetail/";
                break;
            case "browser_id":
                $return = "logview/browserDetail/";
                break;
            case "os_id_web":
                $return = "logview/web_osDetail/";
                break;
            case "os_id_app":
                $return = "logview/app_osDetail/";
                break;
            case "device_id":
                $return = "logview/deviceDetail/";
                break;
            case "webdevice_id":
                $return = "logview/web_deviceDetail/";
                break;
            case "gender":
                $return = "logview/user_genderDetail/";
                break;
            case "age_range":
                $return = "logview/user_ageDetail/";
                break;
            case "email":
                $return = "logview/user_idDetail/";
                break;
        }
        return $return.$id.$subLink;

    }
    
    public function buildPage($numPerPage , $page , $start , $end , $max , $listDate = true){
        ?>
                        <div class="col-lg-12">
                             Show rows: 
                            <select  class="input-sm form-control input-s-sm inline v-middle" id="numPerPage" name="numPerPage">
                                <option <?=$numPerPage==1?"selected":""?> value="1">1</option>
                              <option <?=$numPerPage==10?"selected":""?> value="10">10</option>
                              <option <?=$numPerPage==20?"selected":""?> value="20">20</option>
                              <option <?=$numPerPage==50?"selected":""?> value="50">50</option>
                              <option <?=$numPerPage==100?"selected":""?> value="100">100</option>
                            </select>
                            Go to:
                            <input  size="5" type="text"  onkeydown="return isNumber(event);" name="txtpage" id="txtpage" value="<?=$page?>"/> 
                               <?=$start." - ".$end?> of <?=$max?>
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                <?php
                                if($start != 1){
                                    ?><li><a onclick="jumpPage('left')" ><i class="fa fa-chevron-left"></i></a></li><?php
                                }
                                if($end != $max){
                                    ?><li ><a onclick="jumpPage('right')"><i class="fa fa-chevron-right"></i></a></li><?php
                                }
                                ?>
                            </ul>    
                          </div>
                          <input name="pageLeft" id="pageLeft" type="hidden" value="<?=$page-1?>" />
                         <input name="pageRight" id="pageRight" type="hidden" value="<?=$page+1?>" />
                         <input name="totalPage" id="totalPage" type="hidden" value="<?=ceil($max/$numPerPage)?>" />
                         <input name="listDate" id="listDate" type="hidden" value="<?=$listDate?"1":0?>" />
                        
                    
            <script>
            function multiSort(el, onsingle, ondouble , field) {
                    if (el.getAttribute("data-dblclick") == null) {
                        el.setAttribute("data-dblclick", 1);
                        setTimeout(function () {
                            if (el.getAttribute("data-dblclick") == 1) {
                                // Clickk
                                $( "#iconSort_".field ).show();
                                var arrSort = $( "#mulSort" ).val().split(',');
                                var arr;
                                var flat = false;
                                var tamp;
                                for(var i in arrSort){
                                    arr=arrSort[i].split("/");
                                    if(arr[0]==field){
                                        if(arr[1]=="desc"){
                                            arr[1]="asc";
                                        }else{
                                            arr[1]="desc";
                                        }
                                        arrSort[i]= arr.join('/');
                                        flat = true; // Da co
                                        // Chuyen len dau Str
                                        tamp = arrSort[0];
                                        arrSort[0] = arrSort[i];
                                        arrSort[i] = tamp;
                                        
                                    }
                                    if(flat == false)
                                        arrSort[i]= arr.join('/');
                                }
                                
                                var result = arrSort.join(',');
                                if(flat == false) // field chua dc chon , them vao dau myStr
                                {
                                        result = field+"/desc,"+result;
                                }
                            
                                $( "#mulSort" ).val(result);
                                    //alert(result);
                                 jumpPage("a");
                                 return false;
                            }
                            el.removeAttribute("data-dblclick");
                        }, 300);
                    } else {
                        
                        el.removeAttribute("data-dblclick");
                        var arrSort = $( "#mulSort" ).val().split(',');
                        var arr;
                        var tamp;
                        for(var i in arrSort){
                            arr=arrSort[i].split("/");
                            if(arr[0]!=field){
                                
                                arrSort[i]= arr.join('/');
                            }else{
                                delete arrSort[i];
                            }
                        }
                        
                        var result = arrSort.join(',');
                        $( "#mulSort" ).val(result);
                      
                      
                         jumpPage("a");
                         
                         return false;
                    }
        }
            </script>
                    
        <?php
    
    }
	
    public function buildDialog($titleHead){
        ?>
             <div class="modal fade" style="padding-top: 50px;" id="myModalDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog"  style="width: 50%; " >
                    <div class="modal-content" style=" background-color: #f3f4f6;" >
                      <div class="modal-header"  style=" background-color: #41586e;" >
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        
                        <h4 class="modal-title" style="color: white; font-family: monospace;" id="myModalLabel">
                        <?=$titleHead?>
                        </h4>
                      </div>
                      <div class="modal-body" id="bodyDialog" >
                        
                           
                      
                                    
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
        <?php 
    }
    
    
    public function buildDialogMEdit($titleHead){
        ?>
             <div class="modal fade" style="padding-top: 50px;" id="myModalDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog"  style="width: 70%; " >
                    <div class="modal-content" style=" background-color: #f3f4f6;" >
                      <div class="modal-header"  style=" background-color: #41586e;" >
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        
                        <h4 class="modal-title" style="color: white; font-family: monospace;" id="myModalLabel">
                        <?=$titleHead?>
                        </h4>
                      </div>
                      <div class="modal-body" id="bodyDialog" >
                        
                           
                      
                                    
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
        <?php 
    }
    
    
    
    public function buildDialogImdb($title = ''){
        ?>
             <div class="modal fade" style="padding-top: 50px;" id="myModalDialogImdb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog"  style="width: 50%; " >
                    <div class="modal-content" style=" background-color: #f3f4f6;" >
                      <div class="modal-header"  style=" background-color: #41586e;" >
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        
                        <h4 class="modal-title" style="color: white; font-family: monospace;" id="myModalLabelInfo">
                        
                        </h4>
                      </div>
                      <div class="modal-body" id="bodyDialogImdb" >
                        
                           
                      
                                    
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
        <?php 
    }
    
    
    public function buildDialog_player($titleHead){
        ?>
             <div class="modal fade" style="padding-top: 50px;" id="myModalDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog"  style="width: 90%; " >
                    <div class="modal-content" style=" background-color: #f3f4f6;" >
                      <div class="modal-header"  style=" background-color: #41586e;" >
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        
                        <h4 class="modal-title" style="color: white; font-family: monospace;" id="myModalLabel">
                        <?=$titleHead?>
                        </h4>
                      </div>
                      <div class="modal-body" id="bodyDialog" >
                        
                           
                      
                                    
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
        <?php 
    }
    
    
    
    public function buildDialog2($titleHead){
        ?>
             <div class="modal fade" style="padding-top: 50px;" id="myModalDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog"  style="width: 50%; " id="bodyDialog" >
                
                
                
                  </div>
             </div>
        <?php 
    }
    
    
    public function toolDefault($row , $dTbl, $ad_cre, $ad_pub, $ad_modify , $typeS = ''){
        ?>
        <td>
            Create: <b><?php echo  $row->create_date; ?></b> <br />  
            <?php
            switch ($dTbl['module_controler']) {
              case 'user_email': 
                break; 
              default:
                ?>
                Modify: <b><?php echo  $row->modify_date; ?></b> <br />    
                Publish: <b><?php echo  $row->publish_date; ?></b> <br />  
                <?php
                break;
            }

            ?> 
            
        </td>

        <td> 
            <div class="btn-group">
              <i  data-toggle="dropdown">
                <?php
                if($row->status == 0){
                    ?><a href="javascript:void(0)"  title="Unpublish">Unpublish</a><?php
                }
                if($row->status == 1){
                    ?><a href="javascript:void(0)"  title="Publish">Publish</a> <?php
                }
                if($row->status == 2){
                    ?><a href="javascript:void(0)"  title="Deleted">Delete</a><?php
                } 
                ?>
              </i>
              <ul class="dropdown-menu"> 
                <?php 
                if($row->status != 0){
                    ?><li><a id="td_<?php echo $row->$dTbl['module_id']; ?>" href="javascript:changeStatusID(0 ,'<?php echo $row->$dTbl['module_id']?>')"> 
                    UnPublish</a></li><?php
                }
                if($row->status != 1){
                    ?><li><a id="td_<?php echo $row->$dTbl['module_id']; ?>" href="javascript:changeStatusID(1 ,'<?php echo $row->$dTbl['module_id']?>')"> 
                    Publish</a></li><?php
                }
                if($row->status != 2){
                    ?><li><a id="td_<?php echo $row->$dTbl['module_id']; ?>" href="javascript:changeStatusID(2 , '<?php echo $row->$dTbl['module_id']; ?>');">
                    Delete</a></li><?php
                } 
                ?>
                </ul>
            </div> 
        </td> 


        <?php
        switch ($dTbl['module_controler']) {
          case 'user_email': 
            break; 
          default:
            ?>
            <td>
                <span>
                    <a style="color: blue;" href="<?php echo base_url() . $dTbl['module_controler'].'/addedit/' . $row->$dTbl['module_id']; ?>" title="Edit">
                        [Edit]
                    </a> 
                </span>


                <?php
                switch ($dTbl['module_controler']) {
                  case 'tag':
                    ?>
                      <span>
                          <a style="color: blue;" href="javascript:void(0);" onclick="plusTopUse('<?php echo $row->$dTbl['module_id']; ?>');" title="Use Now">
                              [Use Now]
                          </a> 
                      </span>
                    <?php
                    break;
                  
                  default:
                    # code...
                    break;
                }

                ?>
                 

            </td> 
            <?php
            break;
        }

        ?> 

        
        
        <?php
    }
    
    

	
}