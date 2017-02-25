
    <section class="vbox">
              <section class="scrollable padder">
                <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                  <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="<?=base_url().$this->uri->segment(1)?>" >Group</a></li> 
                </ul>
              
              
                    <header class="panel-heading">
                    <b>Group</b>
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
                                <a style="color: blue;" href="<?php echo base_url()."group/addedit" ?>">[+]Add</a>
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
var URL_DO_AJAX = '<?php echo $dTbl['module_controler'];?>';

  
function changeTab($type)
{
    $( "#type" ).val($type);
    jumpPage("a");
}
function change(publish, obj_id) {
        if (confirm("Confirm change")) {
            var data = new Object();
            var href = 'group/publish';
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
            var href = 'group/delete';
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
    if($type == 'left'){
        page1 = $( "#pageLeft" ).val();
    } 
    if($type == 'right'){
        page1 = $( "#pageRight" ).val();
    }
    if(page1 != '' && page1 > 0 ){
        $.post('group/'.page1, {
            view: "ajax",
            numPerPage:numPerPage1,
            page: page1,
            listDate:listDate1,
            totalPage:totalPage, 
            type:tyle,  
            arrSort:arrSort 
        }, function(data){ 
            $('#idList').empty().html(data);
        }, 'html');
        return true;
    } else return;
}
</script>