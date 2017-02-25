
    <section class="vbox">
              <section class="scrollable padder">
                <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?=base_url()."group"?>" >Group</a></li>
                  <li><a href="<?=base_url()."group/permission"?>" >Permission</a></li>  
                </ul>
              
              
                    <header class="panel-heading">
                    <b>Permission</b>
                    </header>
                    <form id="form1" method="get">
                         <!-- .nav-justified -->
                          <section class="panel panel-default">
                            <header class="panel-heading bg-light">
                              <ul class="nav nav-tabs nav-justified">
                                <li style="width: 120px;" <?=$type=="all"?"class='active'":""?>><a href="#idList" onclick="changeTabP('all')" data-toggle="tab"><i class="fa fa-list"></i> All</a></li>
                                <li style="width: 120px;" <?=$type=="1"?"class='active'":""?>><a href="#idList"  onclick="changeTabP('1')" data-toggle="tab"><i class="fa fa-bookmark"></i> Not Allow</a></li>
                                <li style="width: 180px;" <?=$type=="0"?"class='active'":""?>><a href="#idList"  onclick="changeTabP('0')" data-toggle="tab"><i class="fa fa-bookmark-o"></i> Allow</a></li> 
                              </ul>
                            </header>
                            
                            <input type="hidden" name="type" id="type" value="<?=$type?>" />
                            <div class="panel-body">
                              <div class="tab-content"> 
                                <div class="col-xs-6" >
                                        <div class="well m-t">
                                        
                                            <div class="row"> 
                                              <div class="col-xs-4"  > 
                                                    <select name="admin_group_id" id="select2-option" style="width: 150px;"  > 
                                                        <option value="0">Choose Group</option>
                                                        <?php
                                                        foreach ($group as $row) { 
                                                            $selcet_pro = '';
                                                            if ($_GET['admin_group_id'] == $row->admin_group_id)
                                                                $selcet_pro = 'selected="selected" ';
                                                            echo '<option ' . $selcet_pro . ' value="' . $row->admin_group_id . '">' . $row->name . '</option>';
                                                        }
                                                        ?>  
                                                    </select> 
                                               </div> 
                                               <div class="col-xs-4"  > 
                                                  
                                                  
                                                </div>
                                                <div class="col-xs-4"  >     
                                                     <button id="btn_apply_filter" class="btn btn-primary" type="button"  onclick="addPermission()">Not Allow checked</button>   
                                                </div>
                                            </div> 
                                        </div>  
                                        <br />
                                        <div class="well m-t" id="page_default_well" style="display: none;" >  
                                        </div> 
                                </div>
                                <div class="col-xs-6" >
                                 
                                    <div class="tab-pane active" id="idList">  
                                        <?=$listTable?>
                                    </div>
                                </div>
                              </div>
                            </div>
                            
                          </section>
                          <!-- / .nav-justified -->
                    </form>
            </section>
    </section>  

<script>
 var clickDrag = 1;
 
function reviewClick($title , $link)
{   
    $( "#url_except_title" ).val($title);
    $( "#url_except" ).val($link);
}
function reviewHTML()
{  
    var admin_group_id = $( "#select2-option" ).val();
    $.post('group/reviewHTML', {
        view: "ajax" ,
        admin_group_id:admin_group_id
    }, function(data){ 
        $('#reviewHTML').empty().html(data);
    }, 'html');
    return true; 
}

function load_page_default_html(){
    var admin_group_id = $( "#select2-option" ).val();
    $.post('group/page_default', {
        view: "ajax" ,
        admin_group_id:admin_group_id
    }, function(data){ 
        $('#page_default_well').empty().html(data);
    }, 'html');
    return true; 
}



//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

 $("#select2-option").change(function() {
        $("#draggable").css("display" , "none");
        $("#review").html("Review"); 
        clickDrag = 1;
        if ($(this).val() != 0) { 
            showPermission($(this).val());
            $("#page_default_well").css("display" , "block"); 
            load_page_default_html();
        }else{
            $("#page_default_well").css("display" , "none"); 
        }
 }); 
 
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

function fmain(){
    
}

function choose_page_default(){
     
    var page_default = $( "#select3-option" ).val(); 
    var admin_group_id = $( "#select2-option" ).val();
    $.post('group/page_default', {
        view: "changePageDefault" ,
        admin_group_id:admin_group_id,
        page_default:'<?=base_url()?>'+page_default
    }, function(data){ 
        $('#page_default_well').empty().html(data);
        
  
            jumpPageP('a');
    
        
    }, 'html');
    return true;
}

function showPermission($id){
    var tyle = $( "#type" ).val(); 
        $.post('group/permission/', { 
            view:"showPermission",
            type:tyle,
            admin_group_id:$id 
        }, function(data){ 
            $('#idList').empty().html(data);
            
       
                load_page_default_html();
             
            
        }, 'html');
        return true; 
}
function addPermission(){ 
    var admin_group_id = $( "#select2-option" ).val();   
    var items = [];
    $("input[type='checkbox'][name='url_except']:checked").each(function(){items.push($(this).val());});
 
    if(admin_group_id == 0){
        console.log("Please choose Group !!");
        return false;
    }
  
        $.post('group/add_permission/', { 
            view:"addPermission",
            arr_url_except:items,
            admin_group_id:admin_group_id 
        }, function(data){ 
            $( "#url_except" ).val("");
            
 
            load_page_default_html(); 
            jumpPageP('a');
            
            
        }, 'html');
        return true; 
}

function deletePer(id , module) {
      
            var data = new Object();
            var href = 'group/deletePer';
            data.id = id; 
            data.module = id; 
            $.post(href, data, function(html) {
                $('#td_' + module).html(html);
                load_page_default_html(); 
                jumpPageP("a");
            });
            //jumpPageP("a");
    
}
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////



function changeTabP($type)
{
    $( "#type" ).val($type); 
    jumpPageP("a");
}
function change(publish, obj_id) {
        if (confirm("Confirm change")) {
            var data = new Object();
            var href = 'group/publish_permission';
            data.publish = publish;
            data.id = obj_id;
            $.post(href, data, function(html) {
                $('#td_' + obj_id).html(html);
                
                jumpPageP("a");
            });  
        } 
} 

 
function jumpPageP($type) { 
    var page1 = 1;
    var numPerPage1 = $( "#numPerPage" ).val();
    var listDate1 = $( "#listDate" ).val();
    var totalPage = $( "#totalPage" ).val(); 
    var tyle = $( "#type" ).val(); 
    var arrSort = $( "#mulSort" ).val(); 
    var admin_group_id = $( "#select2-option" ).val();
    if($type == 'left'){
        page1 = $( "#pageLeft" ).val();
    } 
    if($type == 'right'){
        page1 = $( "#pageRight" ).val();
    }
    if(page1 != '' && page1 > 0 ){
        $.post('group/permission/'.page1, {
            view: "ajax",
            numPerPage:numPerPage1,
            page: page1,
            listDate:listDate1,
            totalPage:totalPage, 
            type:tyle,  
            admin_group_id:admin_group_id,
            arrSort:arrSort 
        }, function(data){ 
            $('#idList').empty().html(data);
        }, 'html');
        return true;
    } else return;
}
</script>