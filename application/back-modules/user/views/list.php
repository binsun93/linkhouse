
    <section class="vbox">
              <section class="scrollable padder">
                <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?=base_url().$this->uri->segment(1)?>" >User</a></li> 
                </ul>
              
              
                    <header class="panel-heading">
                    <b>Users</b>
                    </header>
                    <form id="form1" method="get">
                         <!-- .nav-justified -->
                          <section class="panel panel-default">
                            <header class="panel-heading bg-light">
                              <ul class="nav nav-tabs nav-justified">
                                <li style="width: 120px;" <?=$type=="all"?"class='active'":""?>><a href="#idList" onclick="changeTab('all')" data-toggle="tab"><i class="fa fa-list"></i> All</a></li>
                                <li style="width: 120px;" <?=$type=="1"?"class='active'":""?>><a href="#idList"  onclick="changeTab('1')" data-toggle="tab"><i class="fa fa-bookmark"></i> Publish</a></li>
                                <li style="width: 120px;" <?=$type=="0"?"class='active'":""?>><a href="#idList"  onclick="changeTab('0')" data-toggle="tab"><i class="fa fa-bookmark-o"></i> UnPublish</a></li>
                                <li style="width: 120px;" <?=$type=="2"?"class='active'":""?>><a href="#idList"  onclick="changeTab('2')" data-toggle="tab"><i class="fa fa-trash-o"></i> Trash</a></li>
                              </ul>
                            </header>
                            
                            <input type="hidden" name="type" id="type" value="<?=$type?>" />
                            <div class="panel-body">
                                
                                
                            
                              <div class="tab-content"> 
                                    <a style="color: blue;" href="<?php echo base_url()."user/addedit" ?>">[+]Add</a>
                              
                                    <div class="well m-t">  
                                        <div class="row">
                                        <div class="col-xs-1">
                                            FILTER :
                                        </div>
                                        <div class="col-xs-2">
                                            <select style="width: 150px;"  name="filter_type" id="select5-option"  title="Type">
                                                <option <?=$filter_type==-1?'selected="selected"':''?> value="-1">Full Group</option>
                                                <option <?=$filter_type==0?'selected="selected"':''?> value="0">No Group</option>
                                                
                                                <?php
                                                foreach($group as $k=>$v){
                                                    ?>
                                                    <option <?=$filter_type==$v->id_user_group?'selected="selected"':''?> value="<?=$v->id_user_group?>"><?=$v->name?></option>
                                                    <?php
                                                }
                                                ?>
                                                
                                                
                                            </select>
                                        </div>
                                        <div class="col-xs-7">
                                            <input style="display: initial;"   name="search" value="<?=str_replace( '%', ' ', $search )?>" id="search"   type="text" class="form-control" placeholder="Search title...">
                                                        
                                        </div>
                                        <div class="col-xs-2">
                                            <button id="btn_apply_filter" class="btn btn-primary" type="button"  onclick="jumpPage('a')">Apply</button>       
                                        </div>
                                         </div>
                                         
                                    </div>
                              
                              
                              
                                <div class="tab-pane active" id="idList"> 
                                <!-- Table --> 
                                <?=$listTable?>
                                </div>
                              </div>
                            </div>
                            
                          </section>
                          <!-- / .nav-justified -->
                    </form>
            </section>
    </section>  

<script>
$(document).keypress(function(event){ 
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		$('#form1').submit();	
	} 
});
function changeTab($type)
{
    $( "#type" ).val($type);
    jumpPage("a");
}
function change(publish, obj_id) {
        if (confirm("Confirm change")) {
            var data = new Object();
            var href = 'user/publish';
            data.publish = publish;
            data.id = obj_id;
            $.post(href, data, function(html) {
                $('#td_' + obj_id).html(html);
                
                jumpPage("a");
            });
            
        } 
}
function deleteBanner(id) {
        if (confirm("Confirm delete this data")) {
            var data = new Object();
            var href = 'user/delete';
            data.id = id; 
            $.post(href, data, function(html) {
                if (html == 'success') {
                    $("#tr_" + id).remove();
                }  
            });
            jumpPage("a");
        }
}
 
function jumpPage($type) { 
    var page1 = 1;
    var numPerPage1 = $( "#numPerPage" ).val();
    var listDate1 = $( "#listDate" ).val();
    var totalPage = $( "#totalPage" ).val(); 
    var tyle = $( "#type" ).val(); 
    var arrSort = $( "#mulSort" ).val(); 
    var search = $( "#search" ).val(); 
    var user_group_id = $("#select5-option").val();
    
    if($type == 'left'){
        page1 = $( "#pageLeft" ).val();
    } 
    if($type == 'right'){
        page1 = $( "#pageRight" ).val();
    }
    if(page1 != '' && page1 > 0 ){
        $.post('user/'.page1, {
            view: "ajax",
            numPerPage:numPerPage1,
            page: page1,
            listDate:listDate1,
            totalPage:totalPage, 
            type:tyle,  
            search:search,
            user_group_id:user_group_id,
            arrSort:arrSort 
        }, function(data){ 
            $('#idList').empty().html(data);
        }, 'html');
        return true;
    } else return;
}
</script>